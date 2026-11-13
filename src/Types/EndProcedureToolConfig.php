<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class EndProcedureToolConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\EndProcedureToolConfigSystemToolType>
   */
  #[JsonProperty('system_tool_type')]
  public ?string $systemToolType;

  /**
   * @var array<string, \ElevenLabs\Types\ProcedureVersionRef|\ElevenLabs\Types\ProcedureDraftRef>|null
   */
  #[
    JsonProperty('procedures'),
    ArrayType([
      'string' => new Union(
        \ElevenLabs\Types\ProcedureVersionRef::class,
        \ElevenLabs\Types\ProcedureDraftRef::class
      )
    ])
  ]
  public ?array $procedures;

  /**
   * @param array{
   *   systemToolType?: ?value-of<\ElevenLabs\Types\EndProcedureToolConfigSystemToolType>,
   *   procedures?: array<string, \ElevenLabs\Types\ProcedureVersionRef|\ElevenLabs\Types\ProcedureDraftRef>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->systemToolType = $values['systemToolType'] ?? 'end_procedure';
    $this->procedures = $values['procedures'] ?? null;

    if (array_key_exists('systemToolType', $values)) {
      $this->_dirtyFields['system_tool_type'] = true;
    }
    if (array_key_exists('procedures', $values)) {
      $this->_dirtyFields['procedures'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->systemToolType !== null) {
      $parts[] = [
        'name' => 'system_tool_type',
        'contents' => $this->systemToolType
      ];
    }

    if ($this->procedures !== null) {
      $parts[] = [
        'name' => 'procedures',
        'contents' => json_encode($this->procedures),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
