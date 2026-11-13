<?php

declare(strict_types=1);

namespace ElevenLabs\Core\WebSocket;

use ElevenLabs\Core\Client\ErrorResponseHeaders;
use ElevenLabs\Exceptions\ElevenlabsApiException;
use ElevenLabs\Exceptions\ElevenlabsException;
use ElevenLabs\Exceptions\TimeoutException;
use Psr\Http\Message\ResponseInterface;
use WebSocket\Client;
use WebSocket\Exception\ConnectionTimeoutException;
use WebSocket\Exception\ExceptionInterface;
use WebSocket\Exception\HandshakeException;
use WebSocket\Message\Binary;
use WebSocket\Message\Close;
use WebSocket\Message\Text;
use WebSocket\Middleware\CloseHandler;
use WebSocket\Middleware\PingResponder;

/**
 * The default WebSocketConnection, backed by phrity/websocket.
 */
final class PhrityWebSocketConnection implements WebSocketConnection
{
  // phrity 3.x reports a close frame without a status as null; 4.x reports it as 1005.
  private const NORMAL_CLOSE_STATUSES = [1000, 1005, null];

  private function __construct(private readonly Client $client, private readonly ?float $timeout)
  {
  }

  /**
   * @param array<string, string> $headers
   * @param ?float $timeout Seconds to wait for a message before throwing; null waits forever.
   */
  public static function open(string $url, array $headers, ?float $timeout): self
  {
    try {
      $client = new Client($url);
      $client->addMiddleware(new CloseHandler())->addMiddleware(new PingResponder());
      foreach ($headers as $name => $value) {
        $client->addHeader($name, $value);
      }
      if ($timeout !== null) {
        $client->setTimeout($timeout);
      }
      $client->connect();
    } catch (ExceptionInterface $e) {
      throw self::connectFailure($e);
    }

    return new self($client, $timeout);
  }

  private static function connectFailure(ExceptionInterface $e): ElevenlabsException
  {
    if (!($e instanceof HandshakeException)) {
      return new ElevenlabsException($e->getMessage(), 0, $e);
    }
    return self::handshakeFailure($e->getResponse(), $e);
  }

  // Takes the response as nullable because phrity 3.x declares it non-null and 4.x nullable.
  private static function handshakeFailure(
    ?ResponseInterface $response,
    HandshakeException $e
  ): ElevenlabsApiException {
    $status = $response === null ? 0 : $response->getStatusCode();
    return ErrorResponseHeaders::attach(
      new ElevenlabsApiException(
        message: $status === 401
          ? 'WebSocket handshake rejected: invalid credentials.'
          : "WebSocket handshake failed with status {$status}.",
        statusCode: $status,
        body: '',
        previous: $e
      ),
      $response === null ? [] : $response->getHeaders()
    );
  }

  public function sendText(string $data): void
  {
    try {
      $this->client->text($data);
    } catch (ExceptionInterface $e) {
      throw new ElevenlabsException($e->getMessage(), 0, $e);
    }
  }

  public function sendBinary(string $data): void
  {
    try {
      $this->client->binary($data);
    } catch (ExceptionInterface $e) {
      throw new ElevenlabsException($e->getMessage(), 0, $e);
    }
  }

  public function receive(): ?WebSocketFrame
  {
    while (true) {
      try {
        $message = $this->client->receive();
      } catch (ConnectionTimeoutException $e) {
        // phrity times a read out even with no deadline set; the connection survives it.
        if ($this->timeout === null) {
          continue;
        }
        throw new TimeoutException($e->getMessage(), $e);
      } catch (ExceptionInterface $e) {
        throw new ElevenlabsException($e->getMessage(), 0, $e);
      }

      if ($message instanceof Text) {
        return new WebSocketFrame($message->getContent());
      }
      if ($message instanceof Binary) {
        return new WebSocketFrame($message->getContent(), true);
      }
      if ($message instanceof Close) {
        $status = $message->getCloseStatus();
        if (in_array($status, self::NORMAL_CLOSE_STATUSES, true)) {
          return null;
        }
        throw new ElevenlabsException(
          "WebSocket closed with status {$status}: {$message->getContent()}",
          (int) $status
        );
      }
    }
  }

  public function close(): void
  {
    if ($this->client->isConnected()) {
      $this->client->close();
    }
  }
}
