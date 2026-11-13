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
class WorkflowToolNodeModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WorkflowToolNodeModelInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('position')]
  public ?\ElevenLabs\Types\PositionInput $position;

  /**
   * @var string[]|null
   * The ids of outgoing edges in the order they should be evaluated.
   */
  #[JsonProperty('edge_order'), ArrayType(['string'])]
  public ?array $edgeOrder;

  /**
   * @var \ElevenLabs\Types\WorkflowToolLocator[]|null
   * List of tools to execute in parallel. The entire node is considered successful if all tools are executed successfully.
   */
  #[JsonProperty('tools'), ArrayType([\ElevenLabs\Types\WorkflowToolLocator::class])]
  public ?array $tools;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\WorkflowToolNodeModelInputType>,
   *   position?: ?\ElevenLabs\Types\PositionInput,
   *   edgeOrder?: string[]|null,
   *   tools?: \ElevenLabs\Types\WorkflowToolLocator[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? 'tool';
    $this->position = $values['position'] ?? null;
    $this->edgeOrder = $values['edgeOrder'] ?? null;
    $this->tools = $values['tools'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('position', $values)) {
      $this->_dirtyFields['position'] = true;
    }
    if (array_key_exists('edgeOrder', $values)) {
      $this->_dirtyFields['edge_order'] = true;
    }
    if (array_key_exists('tools', $values)) {
      $this->_dirtyFields['tools'] = true;
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

    if ($this->position !== null) {
      $parts[] = [
        'name' => 'position',
        'contents' => json_encode($this->position),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->edgeOrder !== null) {
      foreach ($this->edgeOrder ?? [] as $item) {
        $parts[] = [
          'name' => 'edge_order',
          'contents' => $item
        ];
      }
    }

    if ($this->tools !== null) {
      $parts[] = [
        'name' => 'tools',
        'contents' => json_encode($this->tools),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->position?->validate();
    foreach ($this->tools ?? [] as $item) {
      $item->validate();
    }
  }
}
