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
class VideoSegment extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('start_ms', required: true)]
  public int $startMs;

  #[JsonProperty('end_ms', required: true)]
  public int $endMs;

  #[JsonProperty('description', required: true)]
  public string $description;

  /**
   * @var string[]|null
   */
  #[JsonProperty('subjects'), ArrayType(['string'])]
  public ?array $subjects;

  #[JsonProperty('shot_type')]
  public ?string $shotType;

  #[JsonProperty('camera_movement')]
  public ?string $cameraMovement;

  #[JsonProperty('transition_in')]
  public ?string $transitionIn;

  #[JsonProperty('has_speech')]
  public ?bool $hasSpeech;

  #[JsonProperty('has_music')]
  public ?bool $hasMusic;

  #[JsonProperty('pacing')]
  public ?string $pacing;

  /**
   * @param array{
   *   startMs: int,
   *   endMs: int,
   *   description: string,
   *   subjects?: string[]|null,
   *   shotType?: ?string,
   *   cameraMovement?: ?string,
   *   transitionIn?: ?string,
   *   hasSpeech?: ?bool,
   *   hasMusic?: ?bool,
   *   pacing?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->startMs = $values['startMs'];
    $this->endMs = $values['endMs'];
    $this->description = $values['description'];
    $this->subjects = $values['subjects'] ?? null;
    $this->shotType = $values['shotType'] ?? null;
    $this->cameraMovement = $values['cameraMovement'] ?? null;
    $this->transitionIn = $values['transitionIn'] ?? null;
    $this->hasSpeech = $values['hasSpeech'] ?? null;
    $this->hasMusic = $values['hasMusic'] ?? null;
    $this->pacing = $values['pacing'] ?? null;

    $this->_dirtyFields = [
      'start_ms' => true,
      'end_ms' => true,
      'description' => true
    ];
    if (array_key_exists('subjects', $values)) {
      $this->_dirtyFields['subjects'] = true;
    }
    if (array_key_exists('shotType', $values)) {
      $this->_dirtyFields['shot_type'] = true;
    }
    if (array_key_exists('cameraMovement', $values)) {
      $this->_dirtyFields['camera_movement'] = true;
    }
    if (array_key_exists('transitionIn', $values)) {
      $this->_dirtyFields['transition_in'] = true;
    }
    if (array_key_exists('hasSpeech', $values)) {
      $this->_dirtyFields['has_speech'] = true;
    }
    if (array_key_exists('hasMusic', $values)) {
      $this->_dirtyFields['has_music'] = true;
    }
    if (array_key_exists('pacing', $values)) {
      $this->_dirtyFields['pacing'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'start_ms',
      'contents' => (string) $this->startMs
    ];

    $parts[] = [
      'name' => 'end_ms',
      'contents' => (string) $this->endMs
    ];

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    if ($this->subjects !== null) {
      foreach ($this->subjects ?? [] as $item) {
        $parts[] = [
          'name' => 'subjects',
          'contents' => $item
        ];
      }
    }

    if ($this->shotType !== null) {
      $parts[] = [
        'name' => 'shot_type',
        'contents' => $this->shotType
      ];
    }

    if ($this->cameraMovement !== null) {
      $parts[] = [
        'name' => 'camera_movement',
        'contents' => $this->cameraMovement
      ];
    }

    if ($this->transitionIn !== null) {
      $parts[] = [
        'name' => 'transition_in',
        'contents' => $this->transitionIn
      ];
    }

    if ($this->hasSpeech !== null) {
      $parts[] = [
        'name' => 'has_speech',
        'contents' => $this->hasSpeech ? 'true' : 'false'
      ];
    }

    if ($this->hasMusic !== null) {
      $parts[] = [
        'name' => 'has_music',
        'contents' => $this->hasMusic ? 'true' : 'false'
      ];
    }

    if ($this->pacing !== null) {
      $parts[] = [
        'name' => 'pacing',
        'contents' => $this->pacing
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
