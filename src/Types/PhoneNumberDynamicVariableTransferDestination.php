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
class PhoneNumberDynamicVariableTransferDestination extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestinationType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('phone_number', required: true)]
  public string $phoneNumber;

  /**
   * @param array{
   *   phoneNumber: string,
   *   type?: ?value-of<\ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestinationType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'phone_dynamic_variable';
    $this->phoneNumber = $values['phoneNumber'];

    $this->_dirtyFields = [
      'phone_number' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
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

    $parts[] = [
      'name' => 'phone_number',
      'contents' => $this->phoneNumber
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
