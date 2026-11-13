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
class VerifiedVoiceLanguageResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The language of the voice.
   */
  #[JsonProperty('language', required: true)]
  public string $language;

  /**
   * The voice's model ID.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  /**
   * The voice's accent, if applicable.
   */
  #[JsonProperty('accent')]
  public ?string $accent;

  /**
   * The voice's locale, if applicable.
   */
  #[JsonProperty('locale')]
  public ?string $locale;

  /**
   * The voice's preview URL, if applicable.
   */
  #[JsonProperty('preview_url')]
  public ?string $previewUrl;

  /**
   * @param array{
   *   language: string,
   *   modelId: string,
   *   accent?: ?string,
   *   locale?: ?string,
   *   previewUrl?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->language = $values['language'];
    $this->modelId = $values['modelId'];
    $this->accent = $values['accent'] ?? null;
    $this->locale = $values['locale'] ?? null;
    $this->previewUrl = $values['previewUrl'] ?? null;

    $this->_dirtyFields = [
      'language' => true,
      'model_id' => true
    ];
    if (array_key_exists('accent', $values)) {
      $this->_dirtyFields['accent'] = true;
    }
    if (array_key_exists('locale', $values)) {
      $this->_dirtyFields['locale'] = true;
    }
    if (array_key_exists('previewUrl', $values)) {
      $this->_dirtyFields['preview_url'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'language',
      'contents' => $this->language
    ];

    $parts[] = [
      'name' => 'model_id',
      'contents' => $this->modelId
    ];

    if ($this->accent !== null) {
      $parts[] = [
        'name' => 'accent',
        'contents' => $this->accent
      ];
    }

    if ($this->locale !== null) {
      $parts[] = [
        'name' => 'locale',
        'contents' => $this->locale
      ];
    }

    if ($this->previewUrl !== null) {
      $parts[] = [
        'name' => 'preview_url',
        'contents' => $this->previewUrl
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
