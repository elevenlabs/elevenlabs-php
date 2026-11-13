<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class InternalAlertingWebhookNotifier extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\InternalAlertingWebhookNotifierType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * The URL to send alert lifecycle notifications to.
   */
  #[JsonProperty('url', required: true)]
  public string $url;

  /**
   * @var ?value-of<\ElevenLabs\Types\AlertingWebhookMethod>
   */
  #[JsonProperty('method')]
  public ?string $method;

  /**
   * @var \ElevenLabs\Types\AlertingWebhookHeader[]|null
   * Custom request headers sent with every notification. Secret header values are encrypted at rest and never returned by the API.
   */
  #[JsonProperty('headers'), ArrayType([\ElevenLabs\Types\AlertingWebhookHeader::class])]
  public ?array $headers;

  /**
   * @param array{
   *   url: string,
   *   type?: ?value-of<\ElevenLabs\Types\InternalAlertingWebhookNotifierType>,
   *   method?: ?value-of<\ElevenLabs\Types\AlertingWebhookMethod>,
   *   headers?: \ElevenLabs\Types\AlertingWebhookHeader[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'webhook';
    $this->url = $values['url'];
    $this->method = $values['method'] ?? null;
    $this->headers = $values['headers'] ?? null;

    $this->_dirtyFields = [
      'url' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('method', $values)) {
      $this->_dirtyFields['method'] = true;
    }
    if (array_key_exists('headers', $values)) {
      $this->_dirtyFields['headers'] = true;
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
      'name' => 'url',
      'contents' => $this->url
    ];

    if ($this->method !== null) {
      $parts[] = [
        'name' => 'method',
        'contents' => $this->method
      ];
    }

    if ($this->headers !== null) {
      $parts[] = [
        'name' => 'headers',
        'contents' => json_encode($this->headers),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->url, 'url', maxLength: 2048);
    foreach ($this->headers ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->headers, 'headers', maxItems: 25);
  }
}
