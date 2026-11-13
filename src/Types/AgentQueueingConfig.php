<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AgentQueueingConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Hold callers in a wait queue when the agent is at its concurrency limit, instead of rejecting them immediately. New agents are created with queueing enabled unless this field is set explicitly.
   */
  #[JsonProperty('enabled')]
  public ?bool $enabled;

  /**
   * Maximum time a caller can wait in the queue before being rejected
   */
  #[JsonProperty('wait_timeout_seconds')]
  public ?int $waitTimeoutSeconds;

  /**
   * Custom hold audio played to queued callers; when unset, callers hear the default hold tone. Read-only: set it by uploading a file through the agent hold-audio endpoint.
   */
  #[JsonProperty('hold_audio')]
  public ?\ElevenLabs\Types\AgentHoldAudioConfig $holdAudio;

  /**
   * @param array{
   *   enabled?: ?bool,
   *   waitTimeoutSeconds?: ?int,
   *   holdAudio?: ?\ElevenLabs\Types\AgentHoldAudioConfig,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enabled = $values['enabled'] ?? null;
    $this->waitTimeoutSeconds = $values['waitTimeoutSeconds'] ?? null;
    $this->holdAudio = $values['holdAudio'] ?? null;

    if (array_key_exists('enabled', $values)) {
      $this->_dirtyFields['enabled'] = true;
    }
    if (array_key_exists('waitTimeoutSeconds', $values)) {
      $this->_dirtyFields['wait_timeout_seconds'] = true;
    }
    if (array_key_exists('holdAudio', $values)) {
      $this->_dirtyFields['hold_audio'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->enabled !== null) {
      $parts[] = [
        'name' => 'enabled',
        'contents' => $this->enabled ? 'true' : 'false'
      ];
    }

    if ($this->waitTimeoutSeconds !== null) {
      $parts[] = [
        'name' => 'wait_timeout_seconds',
        'contents' => (string) $this->waitTimeoutSeconds
      ];
    }

    if ($this->holdAudio !== null) {
      $parts[] = [
        'name' => 'hold_audio',
        'contents' => json_encode($this->holdAudio),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->waitTimeoutSeconds, 'wait_timeout_seconds', max: 1800);
    $this->holdAudio?->validate();
  }
}
