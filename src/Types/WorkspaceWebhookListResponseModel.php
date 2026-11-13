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
class WorkspaceWebhookListResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\WorkspaceWebhookResponseModel[]
   * List of webhooks currently configured for the workspace
   */
  #[
    JsonProperty('webhooks', required: true),
    ArrayType([\ElevenLabs\Types\WorkspaceWebhookResponseModel::class])
  ]
  public array $webhooks;

  /**
   * @param array{
   *   webhooks: \ElevenLabs\Types\WorkspaceWebhookResponseModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->webhooks = $values['webhooks'];

    $this->_dirtyFields = [
      'webhooks' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'webhooks',
      'contents' => json_encode($this->webhooks),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->webhooks as $item) {
      $item->validate();
    }
  }
}
