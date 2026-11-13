<?php

declare(strict_types=1);

namespace ElevenLabs\Core\WebSocket;

/**
 * The transport behind a generated socket.
 *
 * Implement it to supply your own connection — a fake in tests, for example — through the
 * `websocketClient` client option.
 */
interface WebSocketConnection
{
  public function sendText(string $data): void;

  public function sendBinary(string $data): void;

  /**
   * Blocks until the next text or binary message. Returns null once the server has closed the
   * connection normally.
   */
  public function receive(): ?WebSocketFrame;

  public function close(): void;
}
