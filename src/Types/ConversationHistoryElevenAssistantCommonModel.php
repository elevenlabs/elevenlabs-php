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
class ConversationHistoryElevenAssistantCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('is_eleven_assistant')]
  public ?bool $isElevenAssistant;

  /**
   * @param array{
   *   isElevenAssistant?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->isElevenAssistant = $values['isElevenAssistant'] ?? null;

    if (array_key_exists('isElevenAssistant', $values)) {
      $this->_dirtyFields['is_eleven_assistant'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->isElevenAssistant !== null) {
      $parts[] = [
        'name' => 'is_eleven_assistant',
        'contents' => $this->isElevenAssistant ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
