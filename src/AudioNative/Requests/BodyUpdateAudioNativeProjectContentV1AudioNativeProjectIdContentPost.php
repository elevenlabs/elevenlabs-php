<?php

declare(strict_types=1);

namespace ElevenLabs\AudioNative\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyUpdateAudioNativeProjectContentV1AudioNativeProjectIdContentPost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?\ElevenLabs\Utils\File
   * Either txt or HTML input file containing the article content. HTML should be formatted as follows '&lt;html&gt;&lt;body&gt;&lt;div&gt;&lt;p&gt;Your content&lt;/p&gt;&lt;h5&gt;More of your content&lt;/h5&gt;&lt;p&gt;Some more of your content&lt;/p&gt;&lt;/div&gt;&lt;/body&gt;&lt;/html&gt;'
   */
  #[JsonProperty('file')]
  public ?\ElevenLabs\Utils\File $file;

  /**
   * Whether to auto convert the project to audio or not.
   */
  #[JsonProperty('auto_convert')]
  public ?bool $autoConvert;

  /**
   * Whether to auto publish the new project snapshot after it's converted.
   */
  #[JsonProperty('auto_publish')]
  public ?bool $autoPublish;

  /**
   * @param array{
   *   file?: ?\ElevenLabs\Utils\File,
   *   autoConvert?: ?bool,
   *   autoPublish?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->file = $values['file'] ?? null;
    $this->autoConvert = $values['autoConvert'] ?? null;
    $this->autoPublish = $values['autoPublish'] ?? null;

    if (array_key_exists('file', $values)) {
      $this->_dirtyFields['file'] = true;
    }
    if (array_key_exists('autoConvert', $values)) {
      $this->_dirtyFields['auto_convert'] = true;
    }
    if (array_key_exists('autoPublish', $values)) {
      $this->_dirtyFields['auto_publish'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->file !== null) {
      $parts[] = $this->file->toMultipartFormDataPart('file')->toGuzzlePart();
    }

    if ($this->autoConvert !== null) {
      $parts[] = [
        'name' => 'auto_convert',
        'contents' => $this->autoConvert ? 'true' : 'false'
      ];
    }

    if ($this->autoPublish !== null) {
      $parts[] = [
        'name' => 'auto_publish',
        'contents' => $this->autoPublish ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
