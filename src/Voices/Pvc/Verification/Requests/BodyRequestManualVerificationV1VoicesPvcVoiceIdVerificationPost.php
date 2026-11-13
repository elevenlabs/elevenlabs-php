<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Pvc\Verification\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyRequestManualVerificationV1VoicesPvcVoiceIdVerificationPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var mixed[]
   * Verification documents
   */
  #[JsonProperty('files', required: true)]
  public array $files;

  /**
   * Extra text to be used in the manual verification process.
   */
  #[JsonProperty('extra_text')]
  public ?string $extraText;

  /**
   * @param array{
   *   files: mixed[],
   *   extraText?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->files = $values['files'];
    $this->extraText = $values['extraText'] ?? null;

    $this->_dirtyFields = [
      'files' => true
    ];
    if (array_key_exists('extraText', $values)) {
      $this->_dirtyFields['extra_text'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->files as $item) {
      $parts[] = $item->toMultipartFormDataPart('files')->toGuzzlePart();
    }

    if ($this->extraText !== null) {
      $parts[] = [
        'name' => 'extra_text',
        'contents' => $this->extraText
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
