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
class AgentOutputError extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('code', required: true)]
  public string $code;

  #[JsonProperty('message', required: true)]
  public string $message;

  /**
   * @param array{
   *   type: string,
   *   code: string,
   *   message: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->code = $values['code'];
    $this->message = $values['message'];

    $this->_dirtyFields = [
      'type' => true,
      'code' => true,
      'message' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'code',
      'contents' => $this->code
    ];

    $parts[] = [
      'name' => 'message',
      'contents' => $this->message
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
