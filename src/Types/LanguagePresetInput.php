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
class LanguagePresetInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('overrides', required: true)]
  public \ElevenLabs\Types\ConversationConfigClientOverrideInput $overrides;

  /**
   * The translation of the first message
   */
  #[JsonProperty('first_message_translation')]
  public ?\ElevenLabs\Types\LanguagePresetTranslation $firstMessageTranslation;

  /**
   * The translation of the soft timeout message
   */
  #[JsonProperty('soft_timeout_translation')]
  public ?\ElevenLabs\Types\LanguagePresetTranslation $softTimeoutTranslation;

  /**
   * The translation of the noisy environment message
   */
  #[JsonProperty('noisy_environment_message_translation')]
  public ?\ElevenLabs\Types\LanguagePresetTranslation $noisyEnvironmentMessageTranslation;

  /**
   * @param array{
   *   overrides: \ElevenLabs\Types\ConversationConfigClientOverrideInput,
   *   firstMessageTranslation?: ?\ElevenLabs\Types\LanguagePresetTranslation,
   *   softTimeoutTranslation?: ?\ElevenLabs\Types\LanguagePresetTranslation,
   *   noisyEnvironmentMessageTranslation?: ?\ElevenLabs\Types\LanguagePresetTranslation,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->overrides = $values['overrides'];
    $this->firstMessageTranslation = $values['firstMessageTranslation'] ?? null;
    $this->softTimeoutTranslation = $values['softTimeoutTranslation'] ?? null;
    $this->noisyEnvironmentMessageTranslation =
      $values['noisyEnvironmentMessageTranslation'] ?? null;

    $this->_dirtyFields = [
      'overrides' => true
    ];
    if (array_key_exists('firstMessageTranslation', $values)) {
      $this->_dirtyFields['first_message_translation'] = true;
    }
    if (array_key_exists('softTimeoutTranslation', $values)) {
      $this->_dirtyFields['soft_timeout_translation'] = true;
    }
    if (array_key_exists('noisyEnvironmentMessageTranslation', $values)) {
      $this->_dirtyFields['noisy_environment_message_translation'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'overrides',
      'contents' => json_encode($this->overrides),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->firstMessageTranslation !== null) {
      $parts[] = [
        'name' => 'first_message_translation',
        'contents' => json_encode($this->firstMessageTranslation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->softTimeoutTranslation !== null) {
      $parts[] = [
        'name' => 'soft_timeout_translation',
        'contents' => json_encode($this->softTimeoutTranslation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->noisyEnvironmentMessageTranslation !== null) {
      $parts[] = [
        'name' => 'noisy_environment_message_translation',
        'contents' => json_encode($this->noisyEnvironmentMessageTranslation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->overrides->validate();
    $this->firstMessageTranslation?->validate();
    $this->softTimeoutTranslation?->validate();
    $this->noisyEnvironmentMessageTranslation?->validate();
  }
}
