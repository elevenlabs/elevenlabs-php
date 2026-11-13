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
class WorkflowToolLocator extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('tool_id', required: true)]
  public string $toolId;

  /**
   * @var array<string, \ElevenLabs\Types\WorkflowToolLocatorSchemaOverridesValue>|null
   * Per-node parameter overrides applied on top of the tool's own configuration. Keys are dotted parameter paths (webhook tools prefix keys with path_params./query_params./request_body.). These take precedence over any overrides already defined on the tool itself.
   */
  #[
    JsonProperty('schema_overrides'),
    ArrayType(['string' => \ElevenLabs\Types\WorkflowToolLocatorSchemaOverridesValue::class])
  ]
  public ?array $schemaOverrides;

  /**
   * @param array{
   *   toolId: string,
   *   schemaOverrides?: array<string, \ElevenLabs\Types\WorkflowToolLocatorSchemaOverridesValue>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->toolId = $values['toolId'];
    $this->schemaOverrides = $values['schemaOverrides'] ?? null;

    $this->_dirtyFields = [
      'tool_id' => true
    ];
    if (array_key_exists('schemaOverrides', $values)) {
      $this->_dirtyFields['schema_overrides'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tool_id',
      'contents' => $this->toolId
    ];

    if ($this->schemaOverrides !== null) {
      $parts[] = [
        'name' => 'schema_overrides',
        'contents' => json_encode($this->schemaOverrides),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
