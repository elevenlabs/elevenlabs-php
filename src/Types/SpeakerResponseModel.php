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
class SpeakerResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the speaker.
   */
  #[JsonProperty('speaker_id', required: true)]
  public string $speakerId;

  /**
   * The duration of the speaker segment in seconds.
   */
  #[JsonProperty('duration_secs', required: true)]
  public float $durationSecs;

  /**
   * @var \ElevenLabs\Types\UtteranceResponseModel[]|null
   * The utterances of the speaker.
   */
  #[JsonProperty('utterances'), ArrayType([\ElevenLabs\Types\UtteranceResponseModel::class])]
  public ?array $utterances;

  /**
   * @param array{
   *   speakerId: string,
   *   durationSecs: float,
   *   utterances?: \ElevenLabs\Types\UtteranceResponseModel[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->speakerId = $values['speakerId'];
    $this->durationSecs = $values['durationSecs'];
    $this->utterances = $values['utterances'] ?? null;

    $this->_dirtyFields = [
      'speaker_id' => true,
      'duration_secs' => true
    ];
    if (array_key_exists('utterances', $values)) {
      $this->_dirtyFields['utterances'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'speaker_id',
      'contents' => $this->speakerId
    ];

    $parts[] = [
      'name' => 'duration_secs',
      'contents' => (string) $this->durationSecs
    ];

    if ($this->utterances !== null) {
      $parts[] = [
        'name' => 'utterances',
        'contents' => json_encode($this->utterances),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->utterances ?? [] as $item) {
      $item->validate();
    }
  }
}
