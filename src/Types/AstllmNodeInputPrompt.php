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
class AstllmNodeInputPrompt extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AstllmNodeInputPromptType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * The prompt to evaluate to a boolean value. Deprecated. Use a boolean schema instead.
   */
  #[JsonProperty('prompt', required: true)]
  public string $prompt;

  /**
   * @param array{
   *   prompt: string,
   *   type?: ?value-of<\ElevenLabs\Types\AstllmNodeInputPromptType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'llm';
    $this->prompt = $values['prompt'];

    $this->_dirtyFields = [
      'prompt' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
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

    $parts[] = [
      'name' => 'prompt',
      'contents' => $this->prompt
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
