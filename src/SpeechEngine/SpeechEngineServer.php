<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechEngine;

use Psr\Http\Message\RequestInterface;
use WebSocket\Connection;
use WebSocket\Message\Text;
use WebSocket\Server;

/**
 * Standalone WebSocket server that produces a {@see SpeechEngineSession} for each
 * inbound connection from the ElevenLabs Speech Engine API.
 *
 * Every connection is verified against the API key (the
 * `X-ElevenLabs-Speech-Engine-Authorization` JWT) before its session is wired up,
 * unless `disableAuth` is set. Built on `phrity/websocket` (already a dependency
 * of this SDK), so it owns its own event loop — call {@see serve()} from a CLI
 * worker or long-running process, not a web request.
 *
 * Hand-written (see `.fernignore`), mirroring `SpeechEngineServer` in the
 * Python/TS SDKs. There is no attach-to-an-existing-HTTP-server variant: PHP has
 * no shared long-lived HTTP server object, so the SDK owns the server itself.
 *
 * @phpstan-type Handlers array{onInit?: \Closure, onTranscript?: \Closure, onClose?: \Closure, onDisconnect?: \Closure, onError?: \Closure}
 */
final class SpeechEngineServer
{
  /** @var \SplObjectStorage<Connection, SpeechEngineSession> */
  private \SplObjectStorage $sessions;

  private ?Server $server = null;

  /** @var \Closure(string): void */
  private readonly \Closure $log;

  /**
   * @param ?string $apiKey The account API key. Falls back to the
   *                        `ELEVENLABS_API_KEY` environment variable.
   * @param Handlers $handlers Event handlers wired onto each session.
   */
  public function __construct(
    private readonly int $port = 3001,
    private readonly ?string $path = null,
    private readonly ?string $apiKey = null,
    private readonly bool $debug = false,
    private readonly bool $disableAuth = false,
    private readonly array $handlers = [],
  ) {
    $this->sessions = new \SplObjectStorage();
    $this->log = $debug
      ? static fn(string $m) => error_log("[SpeechEngine] {$m}")
      : static fn(string $m) => null;
  }

  /**
   * Start the server. Blocks until {@see stop()} is called.
   *
   * @throws \RuntimeException If no API key is available and auth is not disabled.
   */
  public function serve(): void
  {
    $apiKey = $this->apiKey ?: (getenv('ELEVENLABS_API_KEY') ?: null);
    if ($apiKey === null && !$this->disableAuth) {
      throw new \RuntimeException(
        'SpeechEngineServer requires an API key to verify incoming connections. '
          . 'Pass apiKey: or set the ELEVENLABS_API_KEY environment variable. To run without '
          . 'authentication, pass disableAuth: true — but only behind an IP allowlist.'
      );
    }
    if ($this->disableAuth) {
      error_log(
        '[SpeechEngine] authentication is disabled — incoming connections will NOT be verified. '
          . 'Make sure the server is protected by an IP allowlist restricting traffic to ElevenLabs.'
      );
    }

    $server = new Server($this->port);
    $this->server = $server;

    $server->onHandshake(function (Server $srv, Connection $conn, RequestInterface $request) use ($apiKey): void {
      if ($this->path !== null && $request->getUri()->getPath() !== $this->path) {
        ($this->log)("rejected connection — path mismatch: expected {$this->path}, got {$request->getUri()->getPath()}");
        $conn->disconnect();
        return;
      }

      if (!$this->disableAuth) {
        $header = $request->getHeaderLine('X-ElevenLabs-Speech-Engine-Authorization');
        if ($header === '') {
          ($this->log)('rejected connection — missing X-ElevenLabs-Speech-Engine-Authorization header');
          $conn->disconnect();
          return;
        }
        try {
          SpeechEngineJwtVerifier::verify($header, (string) $apiKey);
        } catch (\Throwable $e) {
          ($this->log)("rejected connection — {$e->getMessage()}");
          $conn->disconnect();
          return;
        }
      }

      ($this->log)('verified connection, creating session');
      $this->sessions[$conn] = $this->createSession($conn);
    });

    $server->onText(function (Server $srv, Connection $conn, Text $message): void {
      $session = $this->sessions[$conn] ?? null;
      $session?->handleRawMessage($message->getContent());
    });

    $server->onDisconnect(function (Server $srv, Connection $conn): void {
      $session = $this->sessions[$conn] ?? null;
      $session?->handleDisconnect();
      unset($this->sessions[$conn]);
    });

    $server->onError(function (Server $srv, ?Connection $conn, \Throwable $e): void {
      ($this->log)("connection error — {$e->getMessage()}");
      if ($conn !== null && isset($this->sessions[$conn])) {
        $this->sessions[$conn]->handleDisconnect();
        unset($this->sessions[$conn]);
      }
    });

    ($this->log)("speech engine server listening on port {$this->port}");
    $server->start();
  }

  /**
   * Wrap a phrity connection in a session with this server's handlers wired up.
   * Public for callers managing their own phrity server.
   */
  public function createSession(Connection $conn): SpeechEngineSession
  {
    $session = new SpeechEngineSession(
      send: static function (string $text) use ($conn): void {
        $conn->send(new Text($text));
      },
      close: static function () use ($conn): void {
        $conn->closeWrite();
      },
      debug: $this->debug,
    );
    $this->wireHandlers($session);
    return $session;
  }

  /** Signal the server to stop accepting connections and shut down. */
  public function stop(): void
  {
    $this->server?->stop();
  }

  private function wireHandlers(SpeechEngineSession $session): void
  {
    foreach (
      [
        'onInit' => 'init',
        'onTranscript' => 'user_transcript',
        'onClose' => 'close',
        'onDisconnect' => 'disconnected',
        'onError' => 'error',
      ] as $key => $event
    ) {
      $handler = $this->handlers[$key] ?? null;
      if ($handler instanceof \Closure) {
        $session->on($event, $handler);
      }
    }
  }
}
