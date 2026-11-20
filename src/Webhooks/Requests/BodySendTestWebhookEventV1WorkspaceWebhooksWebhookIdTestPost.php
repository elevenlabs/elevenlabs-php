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
class BodySendTestWebhookEventV1WorkspaceWebhooksWebhookIdTestPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\WebhookTypes>
   */
  #[JsonProperty('webhook_type', required: true)]
  public string $webhookType;

  /**
   * @param array{
   *   webhookType: value-of<\ElevenLabs\Types\WebhookTypes>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->webhookType = $values['webhookType'];

    $this->_dirtyFields = [
      'webhook_type' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'webhook_type',
      'contents' => $this->webhookType
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
