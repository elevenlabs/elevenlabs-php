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
class SpeechEngineResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The speech engine resource ID
   */
  #[JsonProperty('speech_engine_id', required: true)]
  public string $speechEngineId;

  /**
   * Human-readable name for the speech engine
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('speech_engine', required: true)]
  public \ElevenLabs\Types\SpeechEngineConfig $speechEngine;

  #[JsonProperty('asr', required: true)]
  public \ElevenLabs\Types\AsrConversationalConfig $asr;

  #[JsonProperty('tts', required: true)]
  public \ElevenLabs\Types\TtsConversationalConfigOutput $tts;

  #[JsonProperty('turn', required: true)]
  public \ElevenLabs\Types\BaseTurnConfig $turn;

  #[JsonProperty('vad', required: true)]
  public \ElevenLabs\Types\VadConfig $vad;

  #[JsonProperty('conversation', required: true)]
  public \ElevenLabs\Types\ConversationConfigOutput $conversation;

  #[JsonProperty('privacy', required: true)]
  public \ElevenLabs\Types\PrivacyConfigOutput $privacy;

  #[JsonProperty('call_limits', required: true)]
  public \ElevenLabs\Types\AgentCallLimits $callLimits;

  #[JsonProperty('auth', required: true)]
  public \ElevenLabs\Types\SpeechEngineAuthConfig $auth;

  /**
   * ISO language code used by the speech engine (e.g. 'en')
   */
  #[JsonProperty('language', required: true)]
  public string $language;

  /**
   * Time in seconds to wait for the upstream speech engine endpoint to respond before the attempt is abandoned and retried. Must be between 2 and 15 seconds.
   */
  #[JsonProperty('cascade_timeout_seconds', required: true)]
  public float $cascadeTimeoutSeconds;

  /**
   * @var string[]
   * Arbitrary tags for categorization and filtering
   */
  #[JsonProperty('tags', required: true), ArrayType(['string'])]
  public array $tags;

  #[JsonProperty('overrides', required: true)]
  public \ElevenLabs\Types\SpeechEngineConversationInitiationClientDataConfig $overrides;

  #[JsonProperty('metadata', required: true)]
  public \ElevenLabs\Types\AgentMetadataDbModel $metadata;

  /**
   * The access information of the speech engine for the user
   */
  #[JsonProperty('access_info')]
  public ?\ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * @param array{
   *   speechEngineId: string,
   *   name: string,
   *   speechEngine: \ElevenLabs\Types\SpeechEngineConfig,
   *   asr: \ElevenLabs\Types\AsrConversationalConfig,
   *   tts: \ElevenLabs\Types\TtsConversationalConfigOutput,
   *   turn: \ElevenLabs\Types\BaseTurnConfig,
   *   vad: \ElevenLabs\Types\VadConfig,
   *   conversation: \ElevenLabs\Types\ConversationConfigOutput,
   *   privacy: \ElevenLabs\Types\PrivacyConfigOutput,
   *   callLimits: \ElevenLabs\Types\AgentCallLimits,
   *   auth: \ElevenLabs\Types\SpeechEngineAuthConfig,
   *   language: string,
   *   cascadeTimeoutSeconds: float,
   *   tags: string[],
   *   overrides: \ElevenLabs\Types\SpeechEngineConversationInitiationClientDataConfig,
   *   metadata: \ElevenLabs\Types\AgentMetadataDbModel,
   *   accessInfo?: ?\ElevenLabs\Types\ResourceAccessInfo,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->speechEngineId = $values['speechEngineId'];
    $this->name = $values['name'];
    $this->speechEngine = $values['speechEngine'];
    $this->asr = $values['asr'];
    $this->tts = $values['tts'];
    $this->turn = $values['turn'];
    $this->vad = $values['vad'];
    $this->conversation = $values['conversation'];
    $this->privacy = $values['privacy'];
    $this->callLimits = $values['callLimits'];
    $this->auth = $values['auth'];
    $this->language = $values['language'];
    $this->cascadeTimeoutSeconds = $values['cascadeTimeoutSeconds'];
    $this->tags = $values['tags'];
    $this->overrides = $values['overrides'];
    $this->metadata = $values['metadata'];
    $this->accessInfo = $values['accessInfo'] ?? null;

    $this->_dirtyFields = [
      'speech_engine_id' => true,
      'name' => true,
      'speech_engine' => true,
      'asr' => true,
      'tts' => true,
      'turn' => true,
      'vad' => true,
      'conversation' => true,
      'privacy' => true,
      'call_limits' => true,
      'auth' => true,
      'language' => true,
      'cascade_timeout_seconds' => true,
      'tags' => true,
      'overrides' => true,
      'metadata' => true
    ];
    if (array_key_exists('accessInfo', $values)) {
      $this->_dirtyFields['access_info'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'speech_engine_id',
      'contents' => $this->speechEngineId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'speech_engine',
      'contents' => json_encode($this->speechEngine),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'asr',
      'contents' => json_encode($this->asr),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'tts',
      'contents' => json_encode($this->tts),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'turn',
      'contents' => json_encode($this->turn),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'vad',
      'contents' => json_encode($this->vad),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'conversation',
      'contents' => json_encode($this->conversation),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'privacy',
      'contents' => json_encode($this->privacy),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'call_limits',
      'contents' => json_encode($this->callLimits),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'auth',
      'contents' => json_encode($this->auth),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'language',
      'contents' => $this->language
    ];

    $parts[] = [
      'name' => 'cascade_timeout_seconds',
      'contents' => (string) $this->cascadeTimeoutSeconds
    ];

    foreach ($this->tags as $item) {
      $parts[] = [
        'name' => 'tags',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'overrides',
      'contents' => json_encode($this->overrides),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'metadata',
      'contents' => json_encode($this->metadata),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->accessInfo !== null) {
      $parts[] = [
        'name' => 'access_info',
        'contents' => json_encode($this->accessInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->speechEngine->validate();
    $this->asr->validate();
    $this->tts->validate();
    $this->turn->validate();
    $this->vad->validate();
    $this->conversation->validate();
    $this->privacy->validate();
    $this->callLimits->validate();
    $this->auth->validate();
    $this->overrides->validate();
    $this->metadata->validate();
    $this->accessInfo?->validate();
  }
}
