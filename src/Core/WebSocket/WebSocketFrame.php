<?php

declare(strict_types=1);

namespace ElevenLabs\Core\WebSocket;

final class WebSocketFrame
{
  public function __construct(public readonly string $data, public readonly bool $isBinary = false)
  {
  }
}
