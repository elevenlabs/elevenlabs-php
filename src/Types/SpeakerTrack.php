<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SpeakerTrack extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('media_ref', required: true)]
  public \ElevenLabs\Types\DubbingMediaReference $mediaRef;

  #[JsonProperty('speaker_name', required: true)]
  public string $speakerName;

  /**
   * @var array<string, string>
   */
  #[JsonProperty('voices', required: true), ArrayType(['string' => 'string'])]
  public array $voices;

  /**
   * @var string[]
   */
  #[JsonProperty('segments', required: true), ArrayType(['string'])]
  public array $segments;

  /**
   * @param array{
   *   id: string,
   *   mediaRef: \ElevenLabs\Types\DubbingMediaReference,
   *   speakerName: string,
   *   voices: array<string, string>,
   *   segments: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->mediaRef = $values['mediaRef'];
    $this->speakerName = $values['speakerName'];
    $this->voices = $values['voices'];
    $this->segments = $values['segments'];

    $this->_dirtyFields = [
      'id' => true,
      'media_ref' => true,
      'speaker_name' => true,
      'voices' => true,
      'segments' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'media_ref',
      'contents' => json_encode($this->mediaRef),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'speaker_name',
      'contents' => $this->speakerName
    ];

    $parts[] = [
      'name' => 'voices',
      'contents' => json_encode($this->voices),
      'headers' => ['Content-Type' => 'application/json']
    ];

    foreach ($this->segments as $item) {
      $parts[] = [
        'name' => 'segments',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->mediaRef->validate();
  }
}
