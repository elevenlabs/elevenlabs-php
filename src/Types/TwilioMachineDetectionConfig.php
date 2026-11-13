<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * How to run Twilio's carrier-level answering machine detection (AMD) on a call.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TwilioMachineDetectionConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TwilioMachineDetectionMode>
   * Which Twilio answering-machine-detection (AMD) mode to request for a call.
   *
   * `enable` returns a verdict as soon as Twilio can tell a human from a machine.
   * `detect_message_end` additionally waits for the greeting to finish, which is what
   * distinguishes the `machine_end_*` verdicts, at the cost of a later result.
   */
  #[JsonProperty('mode')]
  public ?string $mode;

  /**
   * @var \ElevenLabs\Types\TwilioMachineDetectionRule[]|null
   * Actions to take on the call per AMD verdict. Each action can appear in at most one rule, so list all of its verdicts together. Verdicts without a rule leave the call running.
   */
  #[JsonProperty('actions'), ArrayType([\ElevenLabs\Types\TwilioMachineDetectionRule::class])]
  public ?array $actions;

  /**
   * @param array{
   *   mode?: ?value-of<\ElevenLabs\Types\TwilioMachineDetectionMode>,
   *   actions?: \ElevenLabs\Types\TwilioMachineDetectionRule[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->mode = $values['mode'] ?? null;
    $this->actions = $values['actions'] ?? null;

    if (array_key_exists('mode', $values)) {
      $this->_dirtyFields['mode'] = true;
    }
    if (array_key_exists('actions', $values)) {
      $this->_dirtyFields['actions'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->mode !== null) {
      $parts[] = [
        'name' => 'mode',
        'contents' => $this->mode
      ];
    }

    if ($this->actions !== null) {
      $parts[] = [
        'name' => 'actions',
        'contents' => json_encode($this->actions),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->actions ?? [] as $item) {
      $item->validate();
    }
  }
}
