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
class ScribeError extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ScribeErrorMessageType>
   */
  #[JsonProperty('message_type', required: true)]
  public string $messageType;

  #[JsonProperty('error', required: true)]
  public string $error;

  /**
   * @param array{
   *   messageType: value-of<\ElevenLabs\Types\ScribeErrorMessageType>,
   *   error: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'];
    $this->error = $values['error'];

    $this->_dirtyFields = [
      'message_type' => true,
      'error' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'message_type',
      'contents' => $this->messageType
    ];

    $parts[] = [
      'name' => 'error',
      'contents' => $this->error
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
