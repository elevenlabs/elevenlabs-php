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
class GuardrailTriggered extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('guardrail_triggered_event', required: true)]
  public \ElevenLabs\Types\GuardrailTriggeredGuardrailTriggeredEvent $guardrailTriggeredEvent;

  /**
   * @var ?value-of<\ElevenLabs\Types\GuardrailTriggeredType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   guardrailTriggeredEvent: \ElevenLabs\Types\GuardrailTriggeredGuardrailTriggeredEvent,
   *   type?: ?value-of<\ElevenLabs\Types\GuardrailTriggeredType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->guardrailTriggeredEvent = $values['guardrailTriggeredEvent'];
    $this->type = $values['type'] ?? 'guardrail_triggered';

    $this->_dirtyFields = [
      'guardrail_triggered_event' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'guardrail_triggered_event',
      'contents' => json_encode($this->guardrailTriggeredEvent),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->guardrailTriggeredEvent->validate();
  }
}
