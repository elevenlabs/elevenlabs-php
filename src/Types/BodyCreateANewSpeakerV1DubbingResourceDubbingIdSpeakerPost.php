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
class BodyCreateANewSpeakerV1DubbingResourceDubbingIdSpeakerPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Name to attribute to this speaker.
   */
  #[JsonProperty('speaker_name')]
  public ?string $speakerName;

  /**
   * Either the identifier of a voice from the ElevenLabs voice library, or one of ['track-clone', 'clip-clone'].
   */
  #[JsonProperty('voice_id')]
  public ?string $voiceId;

  /**
   * For models that support it, the voice similarity value to use. This will default to 0.65, with a valid range of [0.0, 1.0].
   */
  #[JsonProperty('voice_stability')]
  public ?float $voiceStability;

  /**
   * For models that support it, the voice similarity value to use. This will default to 1.0, with a valid range of [0.0, 1.0].
   */
  #[JsonProperty('voice_similarity')]
  public ?float $voiceSimilarity;

  /**
   * For models that support it, the voice style value to use. This will default to 1.0, with a valid range of [0.0, 1.0].
   */
  #[JsonProperty('voice_style')]
  public ?float $voiceStyle;

  /**
   * @param array{
   *   speakerName?: ?string,
   *   voiceId?: ?string,
   *   voiceStability?: ?float,
   *   voiceSimilarity?: ?float,
   *   voiceStyle?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->speakerName = $values['speakerName'] ?? null;
    $this->voiceId = $values['voiceId'] ?? null;
    $this->voiceStability = $values['voiceStability'] ?? null;
    $this->voiceSimilarity = $values['voiceSimilarity'] ?? null;
    $this->voiceStyle = $values['voiceStyle'] ?? null;

    if (array_key_exists('speakerName', $values)) {
      $this->_dirtyFields['speaker_name'] = true;
    }
    if (array_key_exists('voiceId', $values)) {
      $this->_dirtyFields['voice_id'] = true;
    }
    if (array_key_exists('voiceStability', $values)) {
      $this->_dirtyFields['voice_stability'] = true;
    }
    if (array_key_exists('voiceSimilarity', $values)) {
      $this->_dirtyFields['voice_similarity'] = true;
    }
    if (array_key_exists('voiceStyle', $values)) {
      $this->_dirtyFields['voice_style'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->speakerName !== null) {
      $parts[] = [
        'name' => 'speaker_name',
        'contents' => $this->speakerName
      ];
    }

    if ($this->voiceId !== null) {
      $parts[] = [
        'name' => 'voice_id',
        'contents' => $this->voiceId
      ];
    }

    if ($this->voiceStability !== null) {
      $parts[] = [
        'name' => 'voice_stability',
        'contents' => (string) $this->voiceStability
      ];
    }

    if ($this->voiceSimilarity !== null) {
      $parts[] = [
        'name' => 'voice_similarity',
        'contents' => (string) $this->voiceSimilarity
      ];
    }

    if ($this->voiceStyle !== null) {
      $parts[] = [
        'name' => 'voice_style',
        'contents' => (string) $this->voiceStyle
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
