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
class ModerationGuardrailOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\GuardrailExecutionMode>
   */
  #[JsonProperty('execution_mode')]
  public ?string $executionMode;

  #[JsonProperty('config')]
  public ?\ElevenLabs\Types\ModerationConfig $config;

  /**
   * @param array{
   *   executionMode?: ?value-of<\ElevenLabs\Types\GuardrailExecutionMode>,
   *   config?: ?\ElevenLabs\Types\ModerationConfig,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->executionMode = $values['executionMode'] ?? null;
    $this->config = $values['config'] ?? null;

    if (array_key_exists('executionMode', $values)) {
      $this->_dirtyFields['execution_mode'] = true;
    }
    if (array_key_exists('config', $values)) {
      $this->_dirtyFields['config'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->executionMode !== null) {
      $parts[] = [
        'name' => 'execution_mode',
        'contents' => $this->executionMode
      ];
    }

    if ($this->config !== null) {
      $parts[] = [
        'name' => 'config',
        'contents' => json_encode($this->config),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->config?->validate();
  }
}
