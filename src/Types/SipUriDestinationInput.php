<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SipUriDestinationInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Phone number, SIP URI, or the dynamic variable name that resolves to one.
   */
  #[JsonProperty('destination', required: true)]
  public string $destination;

  /**
   * @var ?value-of<\ElevenLabs\Types\SipUriDestinationInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   destination: string,
   *   type?: ?value-of<\ElevenLabs\Types\SipUriDestinationInputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->destination = $values['destination'];
    $this->type = $values['type'] ?? 'sip_uri';

    $this->_dirtyFields = [
      'destination' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'destination',
      'contents' => $this->destination
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
    Validator::validateString($this->destination, 'destination', minLength: 1);
  }
}
