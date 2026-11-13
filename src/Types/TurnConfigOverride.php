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
class TurnConfigOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Configuration for soft timeout functionality. Provides immediate feedback during longer LLM responses.
   */
  #[JsonProperty('soft_timeout_config')]
  public ?\ElevenLabs\Types\SoftTimeoutConfigOverride $softTimeoutConfig;

  /**
   * What the agent says when it detects a noisy environment.
   */
  #[JsonProperty('noisy_environment_message')]
  public ?string $noisyEnvironmentMessage;

  /**
   * @param array{
   *   softTimeoutConfig?: ?\ElevenLabs\Types\SoftTimeoutConfigOverride,
   *   noisyEnvironmentMessage?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->softTimeoutConfig = $values['softTimeoutConfig'] ?? null;
    $this->noisyEnvironmentMessage = $values['noisyEnvironmentMessage'] ?? null;

    if (array_key_exists('softTimeoutConfig', $values)) {
      $this->_dirtyFields['soft_timeout_config'] = true;
    }
    if (array_key_exists('noisyEnvironmentMessage', $values)) {
      $this->_dirtyFields['noisy_environment_message'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->softTimeoutConfig !== null) {
      $parts[] = [
        'name' => 'soft_timeout_config',
        'contents' => json_encode($this->softTimeoutConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->noisyEnvironmentMessage !== null) {
      $parts[] = [
        'name' => 'noisy_environment_message',
        'contents' => $this->noisyEnvironmentMessage
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->softTimeoutConfig?->validate();
  }
}
