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
class SayNodePromptMessageOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\SayNodePromptMessageOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * Description of the message the LLM should generate. It is appended to the agent's system prompt while this node is active.
   */
  #[JsonProperty('prompt', required: true)]
  public string $prompt;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\SayNodePromptMessageOutputType>,
   *   prompt: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->prompt = $values['prompt'];

    $this->_dirtyFields = [
      'type' => true,
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
      'name' => 'prompt',
      'contents' => $this->prompt
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
