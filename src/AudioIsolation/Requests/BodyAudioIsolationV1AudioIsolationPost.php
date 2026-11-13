<?php

declare(strict_types=1);

namespace ElevenLabs\AudioIsolation\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyAudioIsolationV1AudioIsolationPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Utils\File
   * The audio file from which vocals/speech will be isolated from.
   */
  #[JsonProperty('audio', required: true)]
  public \ElevenLabs\Utils\File $audio;

  /**
   * @var ?value-of<\ElevenLabs\AudioIsolation\Types\AudioIsolationRequestFileFormat>
   * The format of input audio. Options are 'pcm_s16le_16' or 'other' For `pcm_s16le_16`, the input audio must be 16-bit PCM at a 16kHz sample rate, single channel (mono), and little-endian byte order. Latency will be lower than with passing an encoded waveform.
   */
  #[JsonProperty('file_format')]
  public ?string $fileFormat;

  /**
   * Optional preview image base64 for tracking this generation.
   */
  #[JsonProperty('preview_b64')]
  public ?string $previewB64;

  /**
   * @param array{
   *   audio: \ElevenLabs\Utils\File,
   *   fileFormat?: ?value-of<\ElevenLabs\AudioIsolation\Types\AudioIsolationRequestFileFormat>,
   *   previewB64?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->audio = $values['audio'];
    $this->fileFormat = $values['fileFormat'] ?? null;
    $this->previewB64 = $values['previewB64'] ?? null;

    $this->_dirtyFields = [
      'audio' => true
    ];
    if (array_key_exists('fileFormat', $values)) {
      $this->_dirtyFields['file_format'] = true;
    }
    if (array_key_exists('previewB64', $values)) {
      $this->_dirtyFields['preview_b64'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = $this->audio->toMultipartFormDataPart('audio')->toGuzzlePart();

    if ($this->fileFormat !== null) {
      $parts[] = [
        'name' => 'file_format',
        'contents' => $this->fileFormat
      ];
    }

    if ($this->previewB64 !== null) {
      $parts[] = [
        'name' => 'preview_b64',
        'contents' => $this->previewB64
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
