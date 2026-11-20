<?php

declare(strict_types=1);

namespace ElevenLabs\ContentProvenance\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyCheckWatermarkV1ContentProvenanceWatermarkPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Utils\File
   * Audio file to check for an embedded watermark.
   */
  #[JsonProperty('file', required: true)]
  public \ElevenLabs\Utils\File $file;

  /**
   * Watermark decoder version. Defaults to latest.
   */
  #[JsonProperty('version')]
  public ?string $version;

  /**
   * @param array{
   *   file: \ElevenLabs\Utils\File,
   *   version?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->file = $values['file'];
    $this->version = $values['version'] ?? null;

    $this->_dirtyFields = [
      'file' => true
    ];
    if (array_key_exists('version', $values)) {
      $this->_dirtyFields['version'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = $this->file->toMultipartFormDataPart('file')->toGuzzlePart();

    if ($this->version !== null) {
      $parts[] = [
        'name' => 'version',
        'contents' => $this->version
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
