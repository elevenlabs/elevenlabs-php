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
class VerificationAttemptResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The text of the verification attempt.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * The date of the verification attempt in Unix time.
   */
  #[JsonProperty('date_unix', required: true)]
  public int $dateUnix;

  /**
   * Whether the verification attempt was accepted.
   */
  #[JsonProperty('accepted', required: true)]
  public bool $accepted;

  /**
   * The similarity of the verification attempt.
   */
  #[JsonProperty('similarity', required: true)]
  public float $similarity;

  /**
   * The Levenshtein distance of the verification attempt.
   */
  #[JsonProperty('levenshtein_distance', required: true)]
  public float $levenshteinDistance;

  /**
   * The recording of the verification attempt.
   */
  #[JsonProperty('recording')]
  public ?\ElevenLabs\Types\RecordingResponse $recording;

  /**
   * @param array{
   *   text: string,
   *   dateUnix: int,
   *   accepted: bool,
   *   similarity: float,
   *   levenshteinDistance: float,
   *   recording?: ?\ElevenLabs\Types\RecordingResponse,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->dateUnix = $values['dateUnix'];
    $this->accepted = $values['accepted'];
    $this->similarity = $values['similarity'];
    $this->levenshteinDistance = $values['levenshteinDistance'];
    $this->recording = $values['recording'] ?? null;

    $this->_dirtyFields = [
      'text' => true,
      'date_unix' => true,
      'accepted' => true,
      'similarity' => true,
      'levenshtein_distance' => true
    ];
    if (array_key_exists('recording', $values)) {
      $this->_dirtyFields['recording'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'date_unix',
      'contents' => (string) $this->dateUnix
    ];

    $parts[] = [
      'name' => 'accepted',
      'contents' => $this->accepted ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'similarity',
      'contents' => (string) $this->similarity
    ];

    $parts[] = [
      'name' => 'levenshtein_distance',
      'contents' => (string) $this->levenshteinDistance
    ];

    if ($this->recording !== null) {
      $parts[] = [
        'name' => 'recording',
        'contents' => json_encode($this->recording),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->recording?->validate();
  }
}
