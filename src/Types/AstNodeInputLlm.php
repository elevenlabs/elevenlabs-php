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
class AstNodeInputLlm extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AstNodeInputLlmType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('value_schema')]
  public ?\ElevenLabs\Types\LlmLiteralJsonSchemaProperty $valueSchema;

  /**
   * The prompt to evaluate to a boolean value. Deprecated. Use a boolean schema instead.
   */
  #[JsonProperty('prompt')]
  public ?string $prompt;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\AstNodeInputLlmType>,
   *   valueSchema?: ?\ElevenLabs\Types\LlmLiteralJsonSchemaProperty,
   *   prompt?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? 'llm';
    $this->valueSchema = $values['valueSchema'] ?? null;
    $this->prompt = $values['prompt'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('valueSchema', $values)) {
      $this->_dirtyFields['value_schema'] = true;
    }
    if (array_key_exists('prompt', $values)) {
      $this->_dirtyFields['prompt'] = true;
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

    if ($this->valueSchema !== null) {
      $parts[] = [
        'name' => 'value_schema',
        'contents' => json_encode($this->valueSchema),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->prompt !== null) {
      $parts[] = [
        'name' => 'prompt',
        'contents' => $this->prompt
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->valueSchema?->validate();
  }
}
