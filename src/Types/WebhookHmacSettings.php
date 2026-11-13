<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Settings for creating an HMAC-authenticated webhook
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WebhookHmacSettings extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\WebhookHmacSettingsAuthType>
   * The authentication type for this webhook
   */
  #[JsonProperty('auth_type', required: true)]
  public string $authType;

  /**
   * The display name for this webhook
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The HTTPS callback URL that will be called when this webhook is triggered
   */
  #[JsonProperty('webhook_url', required: true)]
  public string $webhookUrl;

  /**
   * @var array<string, string>|null
   * Optional custom request headers to include with each webhook delivery
   */
  #[JsonProperty('request_headers'), ArrayType(['string' => 'string'])]
  public ?array $requestHeaders;

  /**
   * @param array{
   *   authType: value-of<\ElevenLabs\Types\WebhookHmacSettingsAuthType>,
   *   name: string,
   *   webhookUrl: string,
   *   requestHeaders?: array<string, string>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->authType = $values['authType'];
    $this->name = $values['name'];
    $this->webhookUrl = $values['webhookUrl'];
    $this->requestHeaders = $values['requestHeaders'] ?? null;

    $this->_dirtyFields = [
      'auth_type' => true,
      'name' => true,
      'webhook_url' => true
    ];
    if (array_key_exists('requestHeaders', $values)) {
      $this->_dirtyFields['request_headers'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'auth_type',
      'contents' => $this->authType
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'webhook_url',
      'contents' => $this->webhookUrl
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
