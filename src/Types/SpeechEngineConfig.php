<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SpeechEngineConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The WebSocket URL for the transcript server
   */
  #[JsonProperty('ws_url', required: true)]
  public string $wsUrl;

  /**
   * @var array<string, string|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiDynamicVariable>|null
   * Headers to include in the WebSocket connection request
   */
  #[
    JsonProperty('request_headers'),
    ArrayType([
      'string' => new Union(
        'string',
        \ElevenLabs\Types\ConvAiSecretLocator::class,
        \ElevenLabs\Types\ConvAiDynamicVariable::class
      )
    ])
  ]
  public ?array $requestHeaders;

  /**
   * @param array{
   *   wsUrl: string,
   *   requestHeaders?: array<string, string|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiDynamicVariable>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->wsUrl = $values['wsUrl'];
    $this->requestHeaders = $values['requestHeaders'] ?? null;

    $this->_dirtyFields = [
      'ws_url' => true
    ];
    if (array_key_exists('requestHeaders', $values)) {
      $this->_dirtyFields['request_headers'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'ws_url',
      'contents' => $this->wsUrl
    ];

    if ($this->requestHeaders !== null) {
      $parts[] = [
        'name' => 'request_headers',
        'contents' => json_encode($this->requestHeaders),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
