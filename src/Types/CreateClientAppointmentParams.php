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
class CreateClientAppointmentParams extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\CreateClientAppointmentParamsSmbToolType>
   */
  #[JsonProperty('smb_tool_type')]
  public ?string $smbToolType;

  /**
   * @param array{
   *   smbToolType?: ?value-of<\ElevenLabs\Types\CreateClientAppointmentParamsSmbToolType>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->smbToolType = $values['smbToolType'] ?? 'create_client_appointment';

    if (array_key_exists('smbToolType', $values)) {
      $this->_dirtyFields['smb_tool_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->smbToolType !== null) {
      $parts[] = [
        'name' => 'smb_tool_type',
        'contents' => $this->smbToolType
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
