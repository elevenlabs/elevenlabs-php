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
class ConversationHistoryTranscriptToolCallClientDetails extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetailsType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('parameters', required: true)]
  public string $parameters;

  /**
   * @param array{
   *   parameters: string,
   *   type?: ?value-of<\ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetailsType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'client';
    $this->parameters = $values['parameters'];

    $this->_dirtyFields = [
      'parameters' => true
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
      'name' => 'parameters',
      'contents' => $this->parameters
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
