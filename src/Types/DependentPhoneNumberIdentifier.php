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
class DependentPhoneNumberIdentifier extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('phone_number_id', required: true)]
  public string $phoneNumberId;

  #[JsonProperty('phone_number', required: true)]
  public string $phoneNumber;

  #[JsonProperty('label', required: true)]
  public string $label;

  /**
   * @var value-of<\ElevenLabs\Types\TelephonyProvider>
   */
  #[JsonProperty('provider', required: true)]
  public string $provider;

  /**
   * @param array{
   *   phoneNumberId: string,
   *   phoneNumber: string,
   *   label: string,
   *   provider: value-of<\ElevenLabs\Types\TelephonyProvider>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->phoneNumberId = $values['phoneNumberId'];
    $this->phoneNumber = $values['phoneNumber'];
    $this->label = $values['label'];
    $this->provider = $values['provider'];

    $this->_dirtyFields = [
      'phone_number_id' => true,
      'phone_number' => true,
      'label' => true,
      'provider' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'phone_number_id',
      'contents' => $this->phoneNumberId
    ];

    $parts[] = [
      'name' => 'phone_number',
      'contents' => $this->phoneNumber
    ];

    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    $parts[] = [
      'name' => 'provider',
      'contents' => $this->provider
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
