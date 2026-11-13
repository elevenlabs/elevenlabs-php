<?php

declare(strict_types=1);

namespace ElevenLabs\Webhooks\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyCreateWorkspaceWebhookV1WorkspaceWebhooksPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Settings for creating an HMAC-authenticated webhook
   */
  #[JsonProperty('settings', required: true)]
  public \ElevenLabs\Types\WebhookHmacSettings $settings;

  /**
   * @param array{
   *   settings: \ElevenLabs\Types\WebhookHmacSettings,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->settings = $values['settings'];

    $this->_dirtyFields = [
      'settings' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'settings',
      'contents' => json_encode($this->settings),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->settings->validate();
  }
}
