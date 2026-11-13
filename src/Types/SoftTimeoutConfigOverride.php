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
class SoftTimeoutConfigOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Message to show when the first soft timeout is reached while waiting for LLM response. Supports dynamic variables (e.g., {{system__time}}, {{custom_variable}}).
   */
  #[JsonProperty('message')]
  public ?string $message;

  /**
   * @var string[]|null
   * Extra static filler messages for subsequent soft timeouts in the same LLM generation. The first timeout uses `message`. If fewer messages are configured than `max_soft_timeouts_per_generation`, the last configured message is repeated; otherwise a built-in filler is used.
   */
  #[JsonProperty('additional_soft_timeout_messages'), ArrayType(['string'])]
  public ?array $additionalSoftTimeoutMessages;

  /**
   * @param array{
   *   message?: ?string,
   *   additionalSoftTimeoutMessages?: string[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->message = $values['message'] ?? null;
    $this->additionalSoftTimeoutMessages = $values['additionalSoftTimeoutMessages'] ?? null;

    if (array_key_exists('message', $values)) {
      $this->_dirtyFields['message'] = true;
    }
    if (array_key_exists('additionalSoftTimeoutMessages', $values)) {
      $this->_dirtyFields['additional_soft_timeout_messages'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->message !== null) {
      $parts[] = [
        'name' => 'message',
        'contents' => $this->message
      ];
    }

    if ($this->additionalSoftTimeoutMessages !== null) {
      foreach ($this->additionalSoftTimeoutMessages ?? [] as $item) {
        $parts[] = [
          'name' => 'additional_soft_timeout_messages',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
