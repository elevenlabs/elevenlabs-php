<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkspaceCreateWebhookResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('webhook_id', required: true)]
  public string $webhookId;

  #[JsonProperty('webhook_secret')]
  public ?string $webhookSecret;

  /**
   * @param array{
   *   webhookId: string,
   *   webhookSecret?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->webhookId = $values['webhookId'];
    $this->webhookSecret = $values['webhookSecret'] ?? null;

    $this->_dirtyFields = [
      'webhook_id' => true
    ];
    if (array_key_exists('webhookSecret', $values)) {
      $this->_dirtyFields['webhook_secret'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'webhook_id',
      'contents' => $this->webhookId
    ];

    if ($this->webhookSecret !== null) {
      $parts[] = [
        'name' => 'webhook_secret',
        'contents' => $this->webhookSecret
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
