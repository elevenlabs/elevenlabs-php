<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

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
class InitializeConnectionMulti extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\InitializeConnectionMultiText>
   * The initial text that must be sent is a blank space.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  #[JsonProperty('voice_settings')]
  public ?\ElevenLabs\Types\InitializeConnectionMultiVoiceSettings $voiceSettings;

  #[JsonProperty('generation_config')]
  public ?\ElevenLabs\Types\InitializeConnectionMultiGenerationConfig $generationConfig;

  /**
   * @var \ElevenLabs\Types\InitializeConnectionMultiPronunciationDictionaryLocatorsItem[]|null
   */
  #[
    JsonProperty('pronunciation_dictionary_locators'),
    ArrayType([
      \ElevenLabs\Types\InitializeConnectionMultiPronunciationDictionaryLocatorsItem::class
    ])
  ]
  public ?array $pronunciationDictionaryLocators;

  #[JsonProperty('xi_api_key')]
  public ?string $xiApiKey;

  #[JsonProperty('authorization')]
  public ?string $authorization;

  #[JsonProperty('context_id')]
  public ?string $contextId;

  /**
   * @param array{
   *   text: value-of<\ElevenLabs\Types\InitializeConnectionMultiText>,
   *   voiceSettings?: ?\ElevenLabs\Types\InitializeConnectionMultiVoiceSettings,
   *   generationConfig?: ?\ElevenLabs\Types\InitializeConnectionMultiGenerationConfig,
   *   pronunciationDictionaryLocators?: \ElevenLabs\Types\InitializeConnectionMultiPronunciationDictionaryLocatorsItem[]|null,
   *   xiApiKey?: ?string,
   *   authorization?: ?string,
   *   contextId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->voiceSettings = $values['voiceSettings'] ?? null;
    $this->generationConfig = $values['generationConfig'] ?? null;
    $this->pronunciationDictionaryLocators = $values['pronunciationDictionaryLocators'] ?? null;
    $this->xiApiKey = $values['xiApiKey'] ?? null;
    $this->authorization = $values['authorization'] ?? null;
    $this->contextId = $values['contextId'] ?? null;

    $this->_dirtyFields = [
      'text' => true
    ];
    if (array_key_exists('voiceSettings', $values)) {
      $this->_dirtyFields['voice_settings'] = true;
    }
    if (array_key_exists('generationConfig', $values)) {
      $this->_dirtyFields['generation_config'] = true;
    }
    if (array_key_exists('pronunciationDictionaryLocators', $values)) {
      $this->_dirtyFields['pronunciation_dictionary_locators'] = true;
    }
    if (array_key_exists('xiApiKey', $values)) {
      $this->_dirtyFields['xi_api_key'] = true;
    }
    if (array_key_exists('authorization', $values)) {
      $this->_dirtyFields['authorization'] = true;
    }
    if (array_key_exists('contextId', $values)) {
      $this->_dirtyFields['context_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    if ($this->voiceSettings !== null) {
      $parts[] = [
        'name' => 'voice_settings',
        'contents' => json_encode($this->voiceSettings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->generationConfig !== null) {
      $parts[] = [
        'name' => 'generation_config',
        'contents' => json_encode($this->generationConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->pronunciationDictionaryLocators !== null) {
      $parts[] = [
        'name' => 'pronunciation_dictionary_locators',
        'contents' => json_encode($this->pronunciationDictionaryLocators),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->xiApiKey !== null) {
      $parts[] = [
        'name' => 'xi_api_key',
        'contents' => $this->xiApiKey
      ];
    }

    if ($this->authorization !== null) {
      $parts[] = [
        'name' => 'authorization',
        'contents' => $this->authorization
      ];
    }

    if ($this->contextId !== null) {
      $parts[] = [
        'name' => 'context_id',
        'contents' => $this->contextId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->voiceSettings?->validate();
    $this->generationConfig?->validate();
    foreach ($this->pronunciationDictionaryLocators ?? [] as $item) {
      $item->validate();
    }
  }
}
