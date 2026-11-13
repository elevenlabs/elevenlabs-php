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
class ConversationInitiationClientDataWebhook extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The URL to send the webhook to
   */
  #[JsonProperty('url', required: true)]
  public string $url;

  /**
   * @var array<string, string|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiEnvVarLocator>
   * The headers to send with the webhook request
   */
  #[
    JsonProperty('request_headers', required: true),
    ArrayType([
      'string' => new Union(
        'string',
        \ElevenLabs\Types\ConvAiSecretLocator::class,
        \ElevenLabs\Types\ConvAiEnvVarLocator::class
      )
    ])
  ]
  public array $requestHeaders;

  /**
   * @param array{
   *   url: string,
   *   requestHeaders: array<string, string|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiEnvVarLocator>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->url = $values['url'];
    $this->requestHeaders = $values['requestHeaders'];

    $this->_dirtyFields = [
      'url' => true,
      'request_headers' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'url',
      'contents' => $this->url
    ];

    $parts[] = [
      'name' => 'request_headers',
      'contents' => json_encode($this->requestHeaders),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
