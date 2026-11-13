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
class GetClientAppointmentsParams extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('include_cancelled')]
  public ?bool $includeCancelled;

  /**
   * @var ?value-of<\ElevenLabs\Types\GetClientAppointmentsParamsSmbToolType>
   */
  #[JsonProperty('smb_tool_type')]
  public ?string $smbToolType;

  /**
   * @param array{
   *   includeCancelled?: ?bool,
   *   smbToolType?: ?value-of<\ElevenLabs\Types\GetClientAppointmentsParamsSmbToolType>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->includeCancelled = $values['includeCancelled'] ?? null;
    $this->smbToolType = $values['smbToolType'] ?? 'get_client_appointments';

    if (array_key_exists('includeCancelled', $values)) {
      $this->_dirtyFields['include_cancelled'] = true;
    }
    if (array_key_exists('smbToolType', $values)) {
      $this->_dirtyFields['smb_tool_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->includeCancelled !== null) {
      $parts[] = [
        'name' => 'include_cancelled',
        'contents' => $this->includeCancelled ? 'true' : 'false'
      ];
    }

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
