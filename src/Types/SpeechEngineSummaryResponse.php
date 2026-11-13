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
class SpeechEngineSummaryResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The speech engine resource ID
   */
  #[JsonProperty('speech_engine_id', required: true)]
  public string $speechEngineId;

  /**
   * Human-readable name for the speech engine
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * Voice ID assigned to this speech engine
   */
  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  /**
   * Creation time in Unix seconds
   */
  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  /**
   * Last update time in Unix seconds
   */
  #[JsonProperty('updated_at_unix_secs', required: true)]
  public int $updatedAtUnixSecs;

  /**
   * @var string[]
   * Arbitrary tags for categorization and filtering
   */
  #[JsonProperty('tags', required: true), ArrayType(['string'])]
  public array $tags;

  #[JsonProperty('access_info', required: true)]
  public \ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * @param array{
   *   speechEngineId: string,
   *   name: string,
   *   voiceId: string,
   *   createdAtUnixSecs: int,
   *   updatedAtUnixSecs: int,
   *   tags: string[],
   *   accessInfo: \ElevenLabs\Types\ResourceAccessInfo,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->speechEngineId = $values['speechEngineId'];
    $this->name = $values['name'];
    $this->voiceId = $values['voiceId'];
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];
    $this->updatedAtUnixSecs = $values['updatedAtUnixSecs'];
    $this->tags = $values['tags'];
    $this->accessInfo = $values['accessInfo'];

    $this->_dirtyFields = [
      'speech_engine_id' => true,
      'name' => true,
      'voice_id' => true,
      'created_at_unix_secs' => true,
      'updated_at_unix_secs' => true,
      'tags' => true,
      'access_info' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'speech_engine_id',
      'contents' => $this->speechEngineId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    $parts[] = [
      'name' => 'updated_at_unix_secs',
      'contents' => (string) $this->updatedAtUnixSecs
    ];

    foreach ($this->tags as $item) {
      $parts[] = [
        'name' => 'tags',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'access_info',
      'contents' => json_encode($this->accessInfo),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->accessInfo->validate();
  }
}
