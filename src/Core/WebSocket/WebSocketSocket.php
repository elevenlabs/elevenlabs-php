<?php

declare(strict_types=1);

namespace ElevenLabs\Core\WebSocket;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Exceptions\ElevenlabsException;

/**
 * A connected channel. Iterate it to read messages until the server closes the connection.
 *
 * Reading blocks the process, so run sockets in a CLI worker or queue job, not a web request.
 *
 * @template TMessage
 * @implements \IteratorAggregate<int, TMessage>
 */
abstract class WebSocketSocket implements \IteratorAggregate
{
  private bool $closed = false;

  public function __construct(private readonly WebSocketConnection $connection)
  {
  }

  /**
   * @return \Generator<int, TMessage>
   */
  public function getIterator(): \Generator
  {
    while (($message = $this->receive()) !== null) {
      yield $message;
    }
  }

  /**
   * Blocks until the next message. Returns null once the server has closed the connection.
   *
   * @return TMessage|null
   * @throws ElevenlabsException On a binary frame; this channel declares no binary message type.
   */
  public function receive(): mixed
  {
    if ($this->closed) {
      return null;
    }
    $frame = $this->connection->receive();
    if ($frame === null) {
      $this->closed = true;
      return null;
    }
    if ($frame->isBinary) {
      throw new ElevenlabsException(
        'Received an unexpected binary frame; this channel declares no binary message type.'
      );
    }
    return $this->parse($frame->data);
  }

  /**
   * Sends a message as-is: a model or array as JSON, a string as a text frame.
   *
   * @param JsonSerializableType|array<mixed>|string $message
   * @throws ElevenlabsException If the server already closed the connection.
   */
  public function send(JsonSerializableType|array|string $message): void
  {
    $this->assertOpen();
    $this->connection->sendText(
      match (true) {
        $message instanceof JsonSerializableType => $message->toJson(),
        is_array($message) => json_encode($message, JSON_THROW_ON_ERROR),
        default => $message
      }
    );
  }

  /**
   * @throws ElevenlabsException If the server already closed the connection.
   */
  public function sendBinary(string $data): void
  {
    $this->assertOpen();
    $this->connection->sendBinary($data);
  }

  /**
   * Guards `send`/`sendBinary` against a connection the server already closed. Without this, the
   * underlying phrity client silently reconnects on the next write, and the frame lands on a
   * SECOND handshake the caller was never told about.
   */
  private function assertOpen(): void
  {
    if ($this->closed) {
      throw new ElevenlabsException('Cannot send on a WebSocket connection the server has closed.');
    }
  }

  public function close(): void
  {
    if (!$this->closed) {
      $this->closed = true;
      $this->connection->close();
    }
  }

  public function __destruct()
  {
    try {
      $this->close();
    } catch (\Throwable) {
      // Nothing can surface an error from a destructor.
    }
  }

  /**
   * @return TMessage
   */
  abstract protected function parse(string $text): mixed;

  /**
   * The payload as `$class`, or null when it does not fit, so one malformed message from the
   * server cannot end the read loop.
   *
   * @template T of JsonSerializableType
   * @param class-string<T> $class
   * @param array<mixed> $data
   * @return ?T
   */
  protected static function tryDeserialize(string $class, array $data): ?JsonSerializableType
  {
    try {
      return $class::jsonDeserialize($data);
    } catch (\JsonException | \TypeError | \InvalidArgumentException) {
      return null;
    }
  }
}
