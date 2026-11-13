<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechEngine\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CreateSpeechEngineRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Name of the speech engine
   */
  #[JsonProperty('name')]
  public ?string $name;

  #[JsonProperty('speech_engine', required: true)]
  public \ElevenLabs\Types\SpeechEngineConfig $speechEngine;

  #[JsonProperty('asr')]
  public ?\ElevenLabs\Types\AsrConversationalConfig $asr;

  #[JsonProperty('tts')]
  public ?\ElevenLabs\Types\TtsConversationalConfigInput $tts;

  #[JsonProperty('turn')]
  public ?\ElevenLabs\Types\BaseTurnConfig $turn;

  #[JsonProperty('vad')]
  public ?\ElevenLabs\Types\VadConfig $vad;

  #[JsonProperty('conversation')]
  public ?\ElevenLabs\Types\ConversationConfigInput $conversation;

  #[JsonProperty('privacy')]
  public ?\ElevenLabs\Types\PrivacyConfigInput $privacy;

  #[JsonProperty('call_limits')]
  public ?\ElevenLabs\Types\AgentCallLimits $callLimits;

  #[JsonProperty('auth')]
  public ?\ElevenLabs\Types\SpeechEngineAuthConfig $auth;

  /**
   * Language for the speech engine
   */
  #[JsonProperty('language')]
  public ?string $language;

  /**
   * Time in seconds to wait for the upstream speech engine endpoint to respond before the attempt is abandoned and retried. Must be between 2 and 15 seconds.
   */
  #[JsonProperty('cascade_timeout_seconds')]
  public ?float $cascadeTimeoutSeconds;

  /**
   * @var string[]|null
   * Tags for categorization
   */
  #[JsonProperty('tags'), ArrayType(['string'])]
  public ?array $tags;

  #[JsonProperty('overrides')]
  public ?\ElevenLabs\Types\SpeechEngineConversationInitiationClientDataConfig $overrides;

  /**
   * @param array{
   *   speechEngine: \ElevenLabs\Types\SpeechEngineConfig,
   *   name?: ?string,
   *   asr?: ?\ElevenLabs\Types\AsrConversationalConfig,
   *   tts?: ?\ElevenLabs\Types\TtsConversationalConfigInput,
   *   turn?: ?\ElevenLabs\Types\BaseTurnConfig,
   *   vad?: ?\ElevenLabs\Types\VadConfig,
   *   conversation?: ?\ElevenLabs\Types\ConversationConfigInput,
   *   privacy?: ?\ElevenLabs\Types\PrivacyConfigInput,
   *   callLimits?: ?\ElevenLabs\Types\AgentCallLimits,
   *   auth?: ?\ElevenLabs\Types\SpeechEngineAuthConfig,
   *   language?: ?string,
   *   cascadeTimeoutSeconds?: ?float,
   *   tags?: string[]|null,
   *   overrides?: ?\ElevenLabs\Types\SpeechEngineConversationInitiationClientDataConfig,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'] ?? null;
    $this->speechEngine = $values['speechEngine'];
    $this->asr = $values['asr'] ?? null;
    $this->tts = $values['tts'] ?? null;
    $this->turn = $values['turn'] ?? null;
    $this->vad = $values['vad'] ?? null;
    $this->conversation = $values['conversation'] ?? null;
    $this->privacy = $values['privacy'] ?? null;
    $this->callLimits = $values['callLimits'] ?? null;
    $this->auth = $values['auth'] ?? null;
    $this->language = $values['language'] ?? null;
    $this->cascadeTimeoutSeconds = $values['cascadeTimeoutSeconds'] ?? null;
    $this->tags = $values['tags'] ?? null;
    $this->overrides = $values['overrides'] ?? null;

    $this->_dirtyFields = [
      'speech_engine' => true
    ];
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('asr', $values)) {
      $this->_dirtyFields['asr'] = true;
    }
    if (array_key_exists('tts', $values)) {
      $this->_dirtyFields['tts'] = true;
    }
    if (array_key_exists('turn', $values)) {
      $this->_dirtyFields['turn'] = true;
    }
    if (array_key_exists('vad', $values)) {
      $this->_dirtyFields['vad'] = true;
    }
    if (array_key_exists('conversation', $values)) {
      $this->_dirtyFields['conversation'] = true;
    }
    if (array_key_exists('privacy', $values)) {
      $this->_dirtyFields['privacy'] = true;
    }
    if (array_key_exists('callLimits', $values)) {
      $this->_dirtyFields['call_limits'] = true;
    }
    if (array_key_exists('auth', $values)) {
      $this->_dirtyFields['auth'] = true;
    }
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
    if (array_key_exists('cascadeTimeoutSeconds', $values)) {
      $this->_dirtyFields['cascade_timeout_seconds'] = true;
    }
    if (array_key_exists('tags', $values)) {
      $this->_dirtyFields['tags'] = true;
    }
    if (array_key_exists('overrides', $values)) {
      $this->_dirtyFields['overrides'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    $parts[] = [
      'name' => 'speech_engine',
      'contents' => json_encode($this->speechEngine),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->asr !== null) {
      $parts[] = [
        'name' => 'asr',
        'contents' => json_encode($this->asr),
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

    if ($this->turn !== null) {
      $parts[] = [
        'name' => 'turn',
        'contents' => json_encode($this->turn),
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

    if ($this->conversation !== null) {
      $parts[] = [
        'name' => 'conversation',
        'contents' => json_encode($this->conversation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->privacy !== null) {
      $parts[] = [
        'name' => 'privacy',
        'contents' => json_encode($this->privacy),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->callLimits !== null) {
      $parts[] = [
        'name' => 'call_limits',
        'contents' => json_encode($this->callLimits),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->auth !== null) {
      $parts[] = [
        'name' => 'auth',
        'contents' => json_encode($this->auth),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language
      ];
    }

    if ($this->cascadeTimeoutSeconds !== null) {
      $parts[] = [
        'name' => 'cascade_timeout_seconds',
        'contents' => (string) $this->cascadeTimeoutSeconds
      ];
    }

    if ($this->tags !== null) {
      foreach ($this->tags ?? [] as $item) {
        $parts[] = [
          'name' => 'tags',
          'contents' => $item
        ];
      }
    }

    if ($this->overrides !== null) {
      $parts[] = [
        'name' => 'overrides',
        'contents' => json_encode($this->overrides),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->speechEngine->validate();
    $this->asr?->validate();
    $this->tts?->validate();
    $this->turn?->validate();
    $this->vad?->validate();
    $this->conversation?->validate();
    $this->privacy?->validate();
    $this->callLimits?->validate();
    $this->auth?->validate();
    Validator::validateNumber(
      $this->cascadeTimeoutSeconds,
      'cascade_timeout_seconds',
      min: 2,
      max: 15
    );
    $this->overrides?->validate();
  }
}
