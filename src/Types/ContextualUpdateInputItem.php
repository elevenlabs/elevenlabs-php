<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ContextualUpdateInputItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ContextualUpdateInputItemType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * Context for the agent that the user did not write, such as the client's current state.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * What the update describes. The agent sees only the latest update for each `context_id`.
   */
  #[JsonProperty('context_id', required: true)]
  public string $contextId;

  /**
   * @var ?value-of<\ElevenLabs\Types\ContextualUpdatePlacement>
   * Where the LLM view renders a contextual update.
   */
  #[JsonProperty('placement')]
  public ?string $placement;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\ContextualUpdateInputItemType>,
   *   text: string,
   *   contextId: string,
   *   placement?: ?value-of<\ElevenLabs\Types\ContextualUpdatePlacement>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->text = $values['text'];
    $this->contextId = $values['contextId'];
    $this->placement = $values['placement'] ?? null;

    $this->_dirtyFields = [
      'type' => true,
      'text' => true,
      'context_id' => true
    ];
    if (array_key_exists('placement', $values)) {
      $this->_dirtyFields['placement'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'context_id',
      'contents' => $this->contextId
    ];

    if ($this->placement !== null) {
      $parts[] = [
        'name' => 'placement',
        'contents' => $this->placement
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->text, 'text', minLength: 1);
    Validator::validateString($this->contextId, 'context_id', minLength: 1);
  }
}
