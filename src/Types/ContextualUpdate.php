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
class ContextualUpdate extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ContextualUpdateType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * Context text to inject into the conversation without interrupting.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * Optional client-supplied identifier. When a newer update with the same context_id arrives, the older one supersedes it: the older update is dropped from the LLM view and visually marked as superseded in the rendered transcript.
   */
  #[JsonProperty('context_id')]
  public ?string $contextId;

  /**
   * @param array{
   *   text: string,
   *   type?: ?value-of<\ElevenLabs\Types\ContextualUpdateType>,
   *   contextId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'contextual_update';
    $this->text = $values['text'];
    $this->contextId = $values['contextId'] ?? null;

    $this->_dirtyFields = [
      'text' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('contextId', $values)) {
      $this->_dirtyFields['context_id'] = true;
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
      'name' => 'text',
      'contents' => $this->text
    ];

    if ($this->contextId !== null) {
      $parts[] = [
        'name' => 'context_id',
        'contents' => $this->contextId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
