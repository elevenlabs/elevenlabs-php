<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Deliver the result to all of the workspace's configured flows webhooks.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WebhookTargetAll extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\WebhookTargetAllType>
   * Send the result to all of the workspace's configured flows webhooks.
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\WebhookTargetAllType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];

    $this->_dirtyFields = [
      'type' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
