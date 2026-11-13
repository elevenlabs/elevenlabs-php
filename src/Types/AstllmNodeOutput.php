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
class AstllmNodeOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AstllmNodeOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('value_schema', required: true)]
  public \ElevenLabs\Types\LlmLiteralJsonSchemaProperty $valueSchema;

  /**
   * The prompt to evaluate to a boolean value. Deprecated. Use a boolean schema instead.
   */
  #[JsonProperty('prompt', required: true)]
  public string $prompt;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\AstllmNodeOutputType>,
   *   valueSchema: \ElevenLabs\Types\LlmLiteralJsonSchemaProperty,
   *   prompt: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->valueSchema = $values['valueSchema'];
    $this->prompt = $values['prompt'];

    $this->_dirtyFields = [
      'type' => true,
      'value_schema' => true,
      'prompt' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'value_schema',
      'contents' => json_encode($this->valueSchema),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'prompt',
      'contents' => $this->prompt
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->valueSchema->validate();
  }
}
