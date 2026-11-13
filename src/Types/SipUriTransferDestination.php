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
class SipUriTransferDestination extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SipUriTransferDestinationType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('sip_uri', required: true)]
  public string $sipUri;

  /**
   * @param array{
   *   sipUri: string,
   *   type?: ?value-of<\ElevenLabs\Types\SipUriTransferDestinationType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'sip_uri';
    $this->sipUri = $values['sipUri'];

    $this->_dirtyFields = [
      'sip_uri' => true
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
      'name' => 'sip_uri',
      'contents' => $this->sipUri
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
