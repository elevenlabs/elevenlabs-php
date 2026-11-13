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
class LlmSchemaOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\LlmSchemaOverrideSource>
   */
  #[JsonProperty('source')]
  public ?string $source;

  /**
   * Prompt override for the LLM. If not provided, the original schema description is used.
   */
  #[JsonProperty('prompt')]
  public ?string $prompt;

  /**
   * @param array{
   *   source?: ?value-of<\ElevenLabs\Types\LlmSchemaOverrideSource>,
   *   prompt?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->source = $values['source'] ?? 'llm';
    $this->prompt = $values['prompt'] ?? null;

    if (array_key_exists('source', $values)) {
      $this->_dirtyFields['source'] = true;
    }
    if (array_key_exists('prompt', $values)) {
      $this->_dirtyFields['prompt'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->source !== null) {
      $parts[] = [
        'name' => 'source',
        'contents' => $this->source
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
  }
}
