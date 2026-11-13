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
class ConversationConfigClientOverrideConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('asr')]
  public ?\ElevenLabs\Types\AsrConversationalConfigOverrideConfig $asr;

  #[JsonProperty('turn')]
  public ?\ElevenLabs\Types\TurnConfigOverrideConfig $turn;

  #[JsonProperty('tts')]
  public ?\ElevenLabs\Types\TtsConversationalConfigOverrideConfig $tts;

  #[JsonProperty('conversation')]
  public ?\ElevenLabs\Types\ConversationConfigOverrideConfig $conversation;

  #[JsonProperty('agent')]
  public ?\ElevenLabs\Types\AgentConfigOverrideConfig $agent;

  /**
   * @param array{
   *   asr?: ?\ElevenLabs\Types\AsrConversationalConfigOverrideConfig,
   *   turn?: ?\ElevenLabs\Types\TurnConfigOverrideConfig,
   *   tts?: ?\ElevenLabs\Types\TtsConversationalConfigOverrideConfig,
   *   conversation?: ?\ElevenLabs\Types\ConversationConfigOverrideConfig,
   *   agent?: ?\ElevenLabs\Types\AgentConfigOverrideConfig,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->asr = $values['asr'] ?? null;
    $this->turn = $values['turn'] ?? null;
    $this->tts = $values['tts'] ?? null;
    $this->conversation = $values['conversation'] ?? null;
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
    $this->agent?->validate();
  }
}
