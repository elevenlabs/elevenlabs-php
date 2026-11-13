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
class AgentTransferOpPush extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentTransferOpPushType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('return_node_id')]
  public ?string $returnNodeId;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\AgentTransferOpPushType>,
   *   returnNodeId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? 'push';
    $this->returnNodeId = $values['returnNodeId'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('returnNodeId', $values)) {
      $this->_dirtyFields['return_node_id'] = true;
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

    if ($this->returnNodeId !== null) {
      $parts[] = [
        'name' => 'return_node_id',
        'contents' => $this->returnNodeId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
