<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A WhatsApp user by phone number and/or BSUID; the phone wins where one is needed.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WhatsAppRecipient extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('phone')]
  public ?string $phone;

  #[JsonProperty('bsuid')]
  public ?string $bsuid;

  /**
   * @param array{
   *   phone?: ?string,
   *   bsuid?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->phone = $values['phone'] ?? null;
    $this->bsuid = $values['bsuid'] ?? null;

    if (array_key_exists('phone', $values)) {
      $this->_dirtyFields['phone'] = true;
    }
    if (array_key_exists('bsuid', $values)) {
      $this->_dirtyFields['bsuid'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->phone !== null) {
      $parts[] = [
        'name' => 'phone',
        'contents' => $this->phone
      ];
    }

    if ($this->bsuid !== null) {
      $parts[] = [
        'name' => 'bsuid',
        'contents' => $this->bsuid
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
