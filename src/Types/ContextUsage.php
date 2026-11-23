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
class ContextUsage extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('context_usage_event', required: true)]
  public \ElevenLabs\Types\ContextUsageContextUsageEvent $contextUsageEvent;

  /**
   * @var ?value-of<\ElevenLabs\Types\ContextUsageType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   contextUsageEvent: \ElevenLabs\Types\ContextUsageContextUsageEvent,
   *   type?: ?value-of<\ElevenLabs\Types\ContextUsageType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->contextUsageEvent = $values['contextUsageEvent'];
    $this->type = $values['type'] ?? 'context_usage';

    $this->_dirtyFields = [
      'context_usage_event' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'context_usage_event',
      'contents' => json_encode($this->contextUsageEvent),
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
    $this->contextUsageEvent->validate();
  }
}
