<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Deliver the result to specific configured flows webhooks.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WebhookTargetIds extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\WebhookTargetIdsType>
   * Send the result to the listed flows webhooks.
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @var string[]
   * The IDs of the workspace flows webhooks to deliver the result to. Each must be one of the workspace's configured flows webhooks.
   */
  #[JsonProperty('ids', required: true), ArrayType(['string'])]
  public array $ids;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\WebhookTargetIdsType>,
   *   ids: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->ids = $values['ids'];

    $this->_dirtyFields = [
      'type' => true,
      'ids' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    foreach ($this->ids as $item) {
      $parts[] = [
        'name' => 'ids',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->ids, 'ids', minItems: 1);
  }
}
