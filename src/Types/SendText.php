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
class SendText extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('text', required: true)]
  public string $text;

  #[JsonProperty('try_trigger_generation')]
  public ?bool $tryTriggerGeneration;

  #[JsonProperty('voice_settings')]
  public ?\ElevenLabs\Types\SendTextVoiceSettings $voiceSettings;

  #[JsonProperty('generation_config')]
  public ?\ElevenLabs\Types\SendTextGenerationConfig $generationConfig;

  #[JsonProperty('flush')]
  public ?bool $flush;

  /**
   * @param array{
   *   text: string,
   *   tryTriggerGeneration?: ?bool,
   *   voiceSettings?: ?\ElevenLabs\Types\SendTextVoiceSettings,
   *   generationConfig?: ?\ElevenLabs\Types\SendTextGenerationConfig,
   *   flush?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->tryTriggerGeneration = $values['tryTriggerGeneration'] ?? null;
    $this->voiceSettings = $values['voiceSettings'] ?? null;
    $this->generationConfig = $values['generationConfig'] ?? null;
    $this->flush = $values['flush'] ?? null;

    $this->_dirtyFields = [
      'text' => true
    ];
    if (array_key_exists('tryTriggerGeneration', $values)) {
      $this->_dirtyFields['try_trigger_generation'] = true;
    }
    if (array_key_exists('voiceSettings', $values)) {
      $this->_dirtyFields['voice_settings'] = true;
    }
    if (array_key_exists('generationConfig', $values)) {
      $this->_dirtyFields['generation_config'] = true;
    }
    if (array_key_exists('flush', $values)) {
      $this->_dirtyFields['flush'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    if ($this->tryTriggerGeneration !== null) {
      $parts[] = [
        'name' => 'try_trigger_generation',
        'contents' => $this->tryTriggerGeneration ? 'true' : 'false'
      ];
    }

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

    if ($this->flush !== null) {
      $parts[] = [
        'name' => 'flush',
        'contents' => $this->flush ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->voiceSettings?->validate();
    $this->generationConfig?->validate();
  }
}
