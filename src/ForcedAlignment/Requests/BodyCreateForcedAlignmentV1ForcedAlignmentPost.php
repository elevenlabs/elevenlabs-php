<?php

declare(strict_types=1);

namespace ElevenLabs\ForcedAlignment\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyCreateForcedAlignmentV1ForcedAlignmentPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Utils\File
   * The file to align. All major audio formats are supported. The file size must be less than 1GB.
   */
  #[JsonProperty('file', required: true)]
  public \ElevenLabs\Utils\File $file;

  /**
   * The text to align with the audio. The input text can be in any format, however diarization is not supported at this time.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * @param array{
   *   file: \ElevenLabs\Utils\File,
   *   text: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->file = $values['file'];
    $this->text = $values['text'];

    $this->_dirtyFields = [
      'file' => true,
      'text' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = $this->file->toMultipartFormDataPart('file')->toGuzzlePart();

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
