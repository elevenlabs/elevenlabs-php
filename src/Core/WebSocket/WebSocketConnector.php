<?php

declare(strict_types=1);

namespace ElevenLabs\Core\WebSocket;

use ElevenLabs\Exceptions\ElevenlabsException;

final class WebSocketConnector
{
  /**
   * @param array<string, mixed> $requestOptions The handshake `headers` and serialized `query`.
   * @param array<string, mixed> $clientOptions The client's options, read for `websocketClient`.
   * @param array<string, mixed> $resolvedConfig Per-call config, read for `timeout`.
   */
  public static function connect(
    string $url,
    array $requestOptions,
    array $clientOptions,
    array $resolvedConfig
  ): WebSocketConnection {
    $url = (string) preg_replace('#^http(s?)://#i', 'ws$1://', $url);
    $query = $requestOptions['query'] ?? '';
    if (is_array($query)) {
      $query = http_build_query($query);
    }
    if ($query !== '') {
      $url .= (str_contains($url, '?') ? '&' : '?') . $query;
    }

    $headers = [];
    foreach ($requestOptions['headers'] ?? [] as $name => $value) {
      if ($value !== null) {
        $headers[(string) $name] = is_bool($value) ? ($value ? 'true' : 'false') : (string) $value;
      }
    }

    $factory = $clientOptions['websocketClient'] ?? null;
    if ($factory === null) {
      $timeout = $resolvedConfig['timeout'] ?? null;
      return PhrityWebSocketConnection::open(
        $url,
        $headers,
        $timeout === null ? null : (float) $timeout
      );
    }

    $connection = $factory($url, $headers);
    if (!($connection instanceof WebSocketConnection)) {
      throw new ElevenlabsException(
        'The websocketClient option must return a ' . WebSocketConnection::class . '.'
      );
    }
    return $connection;
  }
}
