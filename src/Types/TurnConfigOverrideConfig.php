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
class TurnConfigOverrideConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('soft_timeout_config')]
  public ?\ElevenLabs\Types\SoftTimeoutConfigOverrideConfig $softTimeoutConfig;

  /**
   * Whether to allow overriding the noisy_environment_message field.
   */
  #[JsonProperty('noisy_environment_message')]
  public ?bool $noisyEnvironmentMessage;

  /**
   * @param array{
   *   softTimeoutConfig?: ?\ElevenLabs\Types\SoftTimeoutConfigOverrideConfig,
   *   noisyEnvironmentMessage?: ?bool,
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
        'contents' => $this->noisyEnvironmentMessage ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->softTimeoutConfig?->validate();
  }
}
