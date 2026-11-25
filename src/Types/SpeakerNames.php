<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * With infer_speaker_names, the names inferred so far for diarized speakers, keyed
 * by speaker_id. Sent in full each time a speaker is named or a merge changes the
 * names.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SpeakerNames extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SpeakerNamesMessageType>
   */
  #[JsonProperty('message_type')]
  public ?string $messageType;

  /**
   * @var array<string, string>
   */
  #[JsonProperty('speaker_names', required: true), ArrayType(['string' => 'string'])]
  public array $speakerNames;

  /**
   * @param array{
   *   speakerNames: array<string, string>,
   *   messageType?: ?value-of<\ElevenLabs\Types\SpeakerNamesMessageType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'] ?? 'speaker_names';
    $this->speakerNames = $values['speakerNames'];

    $this->_dirtyFields = [
      'speaker_names' => true
    ];
    if (array_key_exists('messageType', $values)) {
      $this->_dirtyFields['message_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->messageType !== null) {
      $parts[] = [
        'name' => 'message_type',
        'contents' => $this->messageType
      ];
    }

    $parts[] = [
      'name' => 'speaker_names',
      'contents' => json_encode($this->speakerNames),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
