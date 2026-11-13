<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationHistoryTranscriptToolCallWebhookDetails extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetailsType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('method', required: true)]
  public string $method;

  #[JsonProperty('url', required: true)]
  public string $url;

  /**
   * @var array<string, string>|null
   */
  #[JsonProperty('headers'), ArrayType(['string' => 'string'])]
  public ?array $headers;

  /**
   * @var array<string, string>|null
   */
  #[JsonProperty('path_params'), ArrayType(['string' => 'string'])]
  public ?array $pathParams;

  /**
   * @var array<string, string>|null
   */
  #[JsonProperty('query_params'), ArrayType(['string' => 'string'])]
  public ?array $queryParams;

  #[JsonProperty('body')]
  public ?string $body;

  /**
   * @param array{
   *   method: string,
   *   url: string,
   *   type?: ?value-of<\ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetailsType>,
   *   headers?: array<string, string>|null,
   *   pathParams?: array<string, string>|null,
   *   queryParams?: array<string, string>|null,
   *   body?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'webhook';
    $this->method = $values['method'];
    $this->url = $values['url'];
    $this->headers = $values['headers'] ?? null;
    $this->pathParams = $values['pathParams'] ?? null;
    $this->queryParams = $values['queryParams'] ?? null;
    $this->body = $values['body'] ?? null;

    $this->_dirtyFields = [
      'method' => true,
      'url' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('headers', $values)) {
      $this->_dirtyFields['headers'] = true;
    }
    if (array_key_exists('pathParams', $values)) {
      $this->_dirtyFields['path_params'] = true;
    }
    if (array_key_exists('queryParams', $values)) {
      $this->_dirtyFields['query_params'] = true;
    }
    if (array_key_exists('body', $values)) {
      $this->_dirtyFields['body'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'method',
      'contents' => $this->method
    ];

    $parts[] = [
      'name' => 'url',
      'contents' => $this->url
    ];

    if ($this->headers !== null) {
      $parts[] = [
        'name' => 'headers',
        'contents' => json_encode($this->headers),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->pathParams !== null) {
      $parts[] = [
        'name' => 'path_params',
        'contents' => json_encode($this->pathParams),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->queryParams !== null) {
      $parts[] = [
        'name' => 'query_params',
        'contents' => json_encode($this->queryParams),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->body !== null) {
      $parts[] = [
        'name' => 'body',
        'contents' => $this->body
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
