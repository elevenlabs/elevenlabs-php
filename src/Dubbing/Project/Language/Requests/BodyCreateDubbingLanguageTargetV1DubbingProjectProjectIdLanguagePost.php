<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Project\Language\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyCreateDubbingLanguageTargetV1DubbingProjectProjectIdLanguagePost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * BCP-47 language tag to dub the project into (for example, `fr` or `es-MX`). Must be one of the [languages the project's dubbing model supports](https://elevenlabs.io/docs/help-center/product/dubbing/which-languages-are-supported-in-dubbing), and a region-qualified tag must be one of the supported dialects.
   */
  #[JsonProperty('target_language', required: true)]
  public string $targetLanguage;

  /**
   * Voice settings applied to every speaker in this language. Omit to use the defaults.
   */
  #[JsonProperty('voice_settings')]
  public ?\ElevenLabs\Types\VoiceSettings $voiceSettings;

  /**
   * @var array<string, string>|null
   * Enterprise only. Optional translations to use instead of machine translation. A map from each source segment's `external_id` (or its `id`, if you supplied none) to the translated text; every source segment must be covered exactly once. At most 20,000 entries, totaling at most 4 MiB of text. See [Bring your own transcript](https://elevenlabs.io/docs/eleven-api/guides/how-to/dubbing/bring-your-own-transcript).
   */
  #[JsonProperty('translations'), ArrayType(['string' => 'string'])]
  public ?array $translations;

  /**
   * @param array{
   *   targetLanguage: string,
   *   voiceSettings?: ?\ElevenLabs\Types\VoiceSettings,
   *   translations?: array<string, string>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->targetLanguage = $values['targetLanguage'];
    $this->voiceSettings = $values['voiceSettings'] ?? null;
    $this->translations = $values['translations'] ?? null;

    $this->_dirtyFields = [
      'target_language' => true
    ];
    if (array_key_exists('voiceSettings', $values)) {
      $this->_dirtyFields['voice_settings'] = true;
    }
    if (array_key_exists('translations', $values)) {
      $this->_dirtyFields['translations'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'target_language',
      'contents' => $this->targetLanguage
    ];

    if ($this->voiceSettings !== null) {
      $parts[] = [
        'name' => 'voice_settings',
        'contents' => json_encode($this->voiceSettings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->translations !== null) {
      $parts[] = [
        'name' => 'translations',
        'contents' => json_encode($this->translations),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->voiceSettings?->validate();
  }
}
