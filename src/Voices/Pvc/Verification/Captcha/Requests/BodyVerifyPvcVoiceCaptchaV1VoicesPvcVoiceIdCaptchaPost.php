<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Pvc\Verification\Captcha\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyVerifyPvcVoiceCaptchaV1VoicesPvcVoiceIdCaptchaPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Utils\File
   * Audio recording of the user
   */
  #[JsonProperty('recording', required: true)]
  public \ElevenLabs\Utils\File $recording;

  /**
   * @param array{
   *   recording: \ElevenLabs\Utils\File,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->recording = $values['recording'];

    $this->_dirtyFields = [
      'recording' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = $this->recording->toMultipartFormDataPart('recording')->toGuzzlePart();

    return $parts;
  }

  public function validate(): void
  {
  }
}
