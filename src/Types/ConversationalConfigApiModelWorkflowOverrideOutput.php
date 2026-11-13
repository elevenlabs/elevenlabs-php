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
class ConversationalConfigApiModelWorkflowOverrideOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Configuration for conversational transcription
   */
  #[JsonProperty('asr')]
  public ?\ElevenLabs\Types\AsrConversationalConfigWorkflowOverride $asr;

  /**
   * Configuration for turn detection
   */
  #[JsonProperty('turn')]
  public ?\ElevenLabs\Types\TurnConfigWorkflowOverride $turn;

  /**
   * Configuration for conversational text to speech
   */
  #[JsonProperty('tts')]
  public ?\ElevenLabs\Types\TtsConversationalConfigWorkflowOverrideOutput $tts;

  /**
   * Configuration for conversational events
   */
  #[JsonProperty('conversation')]
  public ?\ElevenLabs\Types\ConversationConfigWorkflowOverrideOutput $conversation;

  /**
   * @var array<string, \ElevenLabs\Types\LanguagePresetOutput>|null
   * Language presets for conversations
   */
  #[
    JsonProperty('language_presets'),
    ArrayType(['string' => \ElevenLabs\Types\LanguagePresetOutput::class])
  ]
  public ?array $languagePresets;

  /**
   * Configuration for voice activity detection
   */
  #[JsonProperty('vad')]
  public ?\ElevenLabs\Types\VadConfigWorkflowOverride $vad;

  /**
   * Agent specific configuration
   */
  #[JsonProperty('agent')]
  public ?\ElevenLabs\Types\AgentConfigApiModelWorkflowOverrideOutput $agent;

  /**
   * @param array{
   *   asr?: ?\ElevenLabs\Types\AsrConversationalConfigWorkflowOverride,
   *   turn?: ?\ElevenLabs\Types\TurnConfigWorkflowOverride,
   *   tts?: ?\ElevenLabs\Types\TtsConversationalConfigWorkflowOverrideOutput,
   *   conversation?: ?\ElevenLabs\Types\ConversationConfigWorkflowOverrideOutput,
   *   languagePresets?: array<string, \ElevenLabs\Types\LanguagePresetOutput>|null,
   *   vad?: ?\ElevenLabs\Types\VadConfigWorkflowOverride,
   *   agent?: ?\ElevenLabs\Types\AgentConfigApiModelWorkflowOverrideOutput,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->asr = $values['asr'] ?? null;
    $this->turn = $values['turn'] ?? null;
    $this->tts = $values['tts'] ?? null;
    $this->conversation = $values['conversation'] ?? null;
    $this->languagePresets = $values['languagePresets'] ?? null;
    $this->vad = $values['vad'] ?? null;
    $this->agent = $values['agent'] ?? null;

    if (array_key_exists('asr', $values)) {
      $this->_dirtyFields['asr'] = true;
    }
    if (array_key_exists('turn', $values)) {
      $this->_dirtyFields['turn'] = true;
    }
    if (array_key_exists('tts', $values)) {
      $this->_dirtyFields['tts'] = true;
    }
    if (array_key_exists('conversation', $values)) {
      $this->_dirtyFields['conversation'] = true;
    }
    if (array_key_exists('languagePresets', $values)) {
      $this->_dirtyFields['language_presets'] = true;
    }
    if (array_key_exists('vad', $values)) {
      $this->_dirtyFields['vad'] = true;
    }
    if (array_key_exists('agent', $values)) {
      $this->_dirtyFields['agent'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->asr !== null) {
      $parts[] = [
        'name' => 'asr',
        'contents' => json_encode($this->asr),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->turn !== null) {
      $parts[] = [
        'name' => 'turn',
        'contents' => json_encode($this->turn),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->tts !== null) {
      $parts[] = [
        'name' => 'tts',
        'contents' => json_encode($this->tts),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->conversation !== null) {
      $parts[] = [
        'name' => 'conversation',
        'contents' => json_encode($this->conversation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->languagePresets !== null) {
      $parts[] = [
        'name' => 'language_presets',
        'contents' => json_encode($this->languagePresets),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->vad !== null) {
      $parts[] = [
        'name' => 'vad',
        'contents' => json_encode($this->vad),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->agent !== null) {
      $parts[] = [
        'name' => 'agent',
        'contents' => json_encode($this->agent),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->asr?->validate();
    $this->turn?->validate();
    $this->tts?->validate();
    $this->conversation?->validate();
    $this->vad?->validate();
    $this->agent?->validate();
  }
}
