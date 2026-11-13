<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * A voice this workspace can use.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class VoiceReference extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\VoiceReferenceType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * The ID of a voice in this workspace.
   */
  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\VoiceReferenceType>,
   *   voiceId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->voiceId = $values['voiceId'];

    $this->_dirtyFields = [
      'type' => true,
      'voice_id' => true
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
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->voiceId, 'voice_id', minLength: 1);
  }
}
