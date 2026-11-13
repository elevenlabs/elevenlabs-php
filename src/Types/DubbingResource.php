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
class DubbingResource extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('version', required: true)]
  public int $version;

  #[JsonProperty('source_language', required: true)]
  public string $sourceLanguage;

  /**
   * @var string[]
   */
  #[JsonProperty('target_languages', required: true), ArrayType(['string'])]
  public array $targetLanguages;

  #[JsonProperty('input', required: true)]
  public \ElevenLabs\Types\DubbingMediaReference $input;

  #[JsonProperty('background', required: true)]
  public ?\ElevenLabs\Types\DubbingMediaReference $background;

  #[JsonProperty('foreground', required: true)]
  public ?\ElevenLabs\Types\DubbingMediaReference $foreground;

  /**
   * @var array<string, \ElevenLabs\Types\SpeakerTrack>
   */
  #[
    JsonProperty('speaker_tracks', required: true),
    ArrayType(['string' => \ElevenLabs\Types\SpeakerTrack::class])
  ]
  public array $speakerTracks;

  /**
   * @var array<string, \ElevenLabs\Types\SpeakerSegment>
   */
  #[
    JsonProperty('speaker_segments', required: true),
    ArrayType(['string' => \ElevenLabs\Types\SpeakerSegment::class])
  ]
  public array $speakerSegments;

  /**
   * @var array<string, \ElevenLabs\Types\Render>
   */
  #[
    JsonProperty('renders', required: true),
    ArrayType(['string' => \ElevenLabs\Types\Render::class])
  ]
  public array $renders;

  /**
   * @param array{
   *   id: string,
   *   version: int,
   *   sourceLanguage: string,
   *   targetLanguages: string[],
   *   input: \ElevenLabs\Types\DubbingMediaReference,
   *   background: ?\ElevenLabs\Types\DubbingMediaReference,
   *   foreground: ?\ElevenLabs\Types\DubbingMediaReference,
   *   speakerTracks: array<string, \ElevenLabs\Types\SpeakerTrack>,
   *   speakerSegments: array<string, \ElevenLabs\Types\SpeakerSegment>,
   *   renders: array<string, \ElevenLabs\Types\Render>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->version = $values['version'];
    $this->sourceLanguage = $values['sourceLanguage'];
    $this->targetLanguages = $values['targetLanguages'];
    $this->input = $values['input'];
    $this->background = $values['background'];
    $this->foreground = $values['foreground'];
    $this->speakerTracks = $values['speakerTracks'];
    $this->speakerSegments = $values['speakerSegments'];
    $this->renders = $values['renders'];

    $this->_dirtyFields = [
      'id' => true,
      'version' => true,
      'source_language' => true,
      'target_languages' => true,
      'input' => true,
      'background' => true,
      'foreground' => true,
      'speaker_tracks' => true,
      'speaker_segments' => true,
      'renders' => true
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
      'name' => 'version',
      'contents' => (string) $this->version
    ];

    $parts[] = [
      'name' => 'source_language',
      'contents' => $this->sourceLanguage
    ];

    foreach ($this->targetLanguages as $item) {
      $parts[] = [
        'name' => 'target_languages',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'input',
      'contents' => json_encode($this->input),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'background',
      'contents' => json_encode($this->background),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'foreground',
      'contents' => json_encode($this->foreground),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'speaker_tracks',
      'contents' => json_encode($this->speakerTracks),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'speaker_segments',
      'contents' => json_encode($this->speakerSegments),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'renders',
      'contents' => json_encode($this->renders),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->input->validate();
    $this->background?->validate();
    $this->foreground?->validate();
  }
}
