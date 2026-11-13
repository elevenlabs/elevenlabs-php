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
class SoftTimeoutConfigOverrideConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether to allow overriding the message field.
   */
  #[JsonProperty('message')]
  public ?bool $message;

  /**
   * Whether to allow overriding the additional_soft_timeout_messages field.
   */
  #[JsonProperty('additional_soft_timeout_messages')]
  public ?bool $additionalSoftTimeoutMessages;

  /**
   * @param array{
   *   message?: ?bool,
   *   additionalSoftTimeoutMessages?: ?bool,
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
        'contents' => $this->message ? 'true' : 'false'
      ];
    }

    if ($this->additionalSoftTimeoutMessages !== null) {
      $parts[] = [
        'name' => 'additional_soft_timeout_messages',
        'contents' => $this->additionalSoftTimeoutMessages ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
