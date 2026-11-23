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
class AgentChatResponsePart extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('text_response_part', required: true)]
  public \ElevenLabs\Types\AgentChatResponsePartTextResponsePart $textResponsePart;

  /**
   * @var ?value-of<\ElevenLabs\Types\Type2>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   textResponsePart: \ElevenLabs\Types\AgentChatResponsePartTextResponsePart,
   *   type?: ?value-of<\ElevenLabs\Types\Type2>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->textResponsePart = $values['textResponsePart'];
    $this->type = $values['type'] ?? 'agent_chat_response_part';

    $this->_dirtyFields = [
      'text_response_part' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text_response_part',
      'contents' => json_encode($this->textResponsePart),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->textResponsePart->validate();
  }
}
