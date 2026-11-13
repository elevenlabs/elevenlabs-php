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
class ClipAnimation extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ClipAnimationEnterEffect>
   */
  #[JsonProperty('enter_effect')]
  public ?string $enterEffect;

  #[JsonProperty('enter_duration_ms')]
  public ?int $enterDurationMs;

  /**
   * @var ?value-of<\ElevenLabs\Types\ClipAnimationExitEffect>
   */
  #[JsonProperty('exit_effect')]
  public ?string $exitEffect;

  #[JsonProperty('exit_duration_ms')]
  public ?int $exitDurationMs;

  /**
   * @param array{
   *   enterEffect?: ?value-of<\ElevenLabs\Types\ClipAnimationEnterEffect>,
   *   enterDurationMs?: ?int,
   *   exitEffect?: ?value-of<\ElevenLabs\Types\ClipAnimationExitEffect>,
   *   exitDurationMs?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enterEffect = $values['enterEffect'] ?? null;
    $this->enterDurationMs = $values['enterDurationMs'] ?? null;
    $this->exitEffect = $values['exitEffect'] ?? null;
    $this->exitDurationMs = $values['exitDurationMs'] ?? null;

    if (array_key_exists('enterEffect', $values)) {
      $this->_dirtyFields['enter_effect'] = true;
    }
    if (array_key_exists('enterDurationMs', $values)) {
      $this->_dirtyFields['enter_duration_ms'] = true;
    }
    if (array_key_exists('exitEffect', $values)) {
      $this->_dirtyFields['exit_effect'] = true;
    }
    if (array_key_exists('exitDurationMs', $values)) {
      $this->_dirtyFields['exit_duration_ms'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->enterEffect !== null) {
      $parts[] = [
        'name' => 'enter_effect',
        'contents' => $this->enterEffect
      ];
    }

    if ($this->enterDurationMs !== null) {
      $parts[] = [
        'name' => 'enter_duration_ms',
        'contents' => (string) $this->enterDurationMs
      ];
    }

    if ($this->exitEffect !== null) {
      $parts[] = [
        'name' => 'exit_effect',
        'contents' => $this->exitEffect
      ];
    }

    if ($this->exitDurationMs !== null) {
      $parts[] = [
        'name' => 'exit_duration_ms',
        'contents' => (string) $this->exitDurationMs
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
