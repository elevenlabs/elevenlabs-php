<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyStemSeparationV1MusicStemSeparationPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AllowedOutputFormats>
   * Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
   */
  public ?string $outputFormat;

  /**
   * When enable_logging is set to false zero retention mode will be used for the request. Zero retention mode may only be used by enterprise customers.
   */
  public ?bool $enableLogging;

  /**
   * @var \ElevenLabs\Utils\File
   * The audio file to separate into stems.
   */
  #[JsonProperty('file', required: true)]
  public \ElevenLabs\Utils\File $file;

  /**
   * @var ?value-of<\ElevenLabs\Music\Types\SeparateStemsMusicRequestStemVariationId>
   * The id of the stem variation to use.
   */
  #[JsonProperty('stem_variation_id')]
  public ?string $stemVariationId;

  /**
   * Whether to sign the generated song with C2PA. Applicable only for mp3 files.
   */
  #[JsonProperty('sign_with_c2pa')]
  public ?bool $signWithC2Pa;

  /**
   * @param array{
   *   file: \ElevenLabs\Utils\File,
   *   outputFormat?: ?value-of<\ElevenLabs\Types\AllowedOutputFormats>,
   *   enableLogging?: ?bool,
   *   stemVariationId?: ?value-of<\ElevenLabs\Music\Types\SeparateStemsMusicRequestStemVariationId>,
   *   signWithC2Pa?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->enableLogging = $values['enableLogging'] ?? null;
    $this->file = $values['file'];
    $this->stemVariationId = $values['stemVariationId'] ?? null;
    $this->signWithC2Pa = $values['signWithC2Pa'] ?? null;

    $this->_dirtyFields = [
      'file' => true
    ];
    if (array_key_exists('stemVariationId', $values)) {
      $this->_dirtyFields['stem_variation_id'] = true;
    }
    if (array_key_exists('signWithC2Pa', $values)) {
      $this->_dirtyFields['sign_with_c2pa'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = $this->file->toMultipartFormDataPart('file')->toGuzzlePart();

    if ($this->stemVariationId !== null) {
      $parts[] = [
        'name' => 'stem_variation_id',
        'contents' => $this->stemVariationId
      ];
    }

    if ($this->signWithC2Pa !== null) {
      $parts[] = [
        'name' => 'sign_with_c2pa',
        'contents' => $this->signWithC2Pa ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
