<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AudioRefChunk extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the song to source the chunk from. You can find the song ID in the response headers when you generate a song.
   */
  #[JsonProperty('song_id', required: true)]
  public string $songId;

  #[JsonProperty('range', required: true)]
  public \ElevenLabs\Types\TimeRange $range;

  /**
   * @param array{
   *   songId: string,
   *   range: \ElevenLabs\Types\TimeRange,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->songId = $values['songId'];
    $this->range = $values['range'];

    $this->_dirtyFields = [
      'song_id' => true,
      'range' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'song_id',
      'contents' => $this->songId
    ];

    $parts[] = [
      'name' => 'range',
      'contents' => json_encode($this->range),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->songId, 'song_id', minLength: 1, maxLength: 100);
    $this->range->validate();
  }
}
