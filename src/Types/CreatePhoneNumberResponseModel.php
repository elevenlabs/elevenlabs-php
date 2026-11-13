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
class CreatePhoneNumberResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Phone entity ID
   */
  #[JsonProperty('phone_number_id', required: true)]
  public string $phoneNumberId;

  /**
   * @param array{
   *   phoneNumberId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->phoneNumberId = $values['phoneNumberId'];

    $this->_dirtyFields = [
      'phone_number_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'phone_number_id',
      'contents' => $this->phoneNumberId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
