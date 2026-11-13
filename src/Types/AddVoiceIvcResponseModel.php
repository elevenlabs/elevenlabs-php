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
class AddVoiceIvcResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the newly created voice.
   */
  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  /**
   * Whether the voice requires verification
   */
  #[JsonProperty('requires_verification', required: true)]
  public bool $requiresVerification;

  /**
   * Set when the samples match a protected voice that is available in the Voice Library. The new voice requires verification before use; adding the library voice is the alternative.
   */
  #[JsonProperty('library_voice_match')]
  public ?\ElevenLabs\Types\LibraryVoiceMatchResponseModel $libraryVoiceMatch;

  /**
   * @param array{
   *   voiceId: string,
   *   requiresVerification: bool,
   *   libraryVoiceMatch?: ?\ElevenLabs\Types\LibraryVoiceMatchResponseModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->voiceId = $values['voiceId'];
    $this->requiresVerification = $values['requiresVerification'];
    $this->libraryVoiceMatch = $values['libraryVoiceMatch'] ?? null;

    $this->_dirtyFields = [
      'voice_id' => true,
      'requires_verification' => true
    ];
    if (array_key_exists('libraryVoiceMatch', $values)) {
      $this->_dirtyFields['library_voice_match'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    $parts[] = [
      'name' => 'requires_verification',
      'contents' => $this->requiresVerification ? 'true' : 'false'
    ];

    if ($this->libraryVoiceMatch !== null) {
      $parts[] = [
        'name' => 'library_voice_match',
        'contents' => json_encode($this->libraryVoiceMatch),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->libraryVoiceMatch?->validate();
  }
}
