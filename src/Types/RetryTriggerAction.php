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
class RetryTriggerAction extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\RetryTriggerActionType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * Custom feedback to inject into the agent when retrying after guardrail trigger.
   */
  #[JsonProperty('feedback')]
  public ?string $feedback;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\RetryTriggerActionType>,
   *   feedback?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? 'retry';
    $this->feedback = $values['feedback'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('feedback', $values)) {
      $this->_dirtyFields['feedback'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->feedback !== null) {
      $parts[] = [
        'name' => 'feedback',
        'contents' => $this->feedback
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
