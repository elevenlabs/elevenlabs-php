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
class OTelStatus extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('code', required: true)]
  public int $code;

  #[JsonProperty('message')]
  public ?string $message;

  /**
   * @param array{
   *   code: int,
   *   message?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->code = $values['code'];
    $this->message = $values['message'] ?? null;

    $this->_dirtyFields = [
      'code' => true
    ];
    if (array_key_exists('message', $values)) {
      $this->_dirtyFields['message'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'code',
      'contents' => (string) $this->code
    ];

    if ($this->message !== null) {
      $parts[] = [
        'name' => 'message',
        'contents' => $this->message
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
