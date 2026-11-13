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
class GetScheduleParams extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\GetScheduleParamsSmbToolType>
   */
  #[JsonProperty('smb_tool_type')]
  public ?string $smbToolType;

  #[JsonProperty('include_location_filter')]
  public ?bool $includeLocationFilter;

  /**
   * @param array{
   *   smbToolType?: ?value-of<\ElevenLabs\Types\GetScheduleParamsSmbToolType>,
   *   includeLocationFilter?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->smbToolType = $values['smbToolType'] ?? 'get_schedule';
    $this->includeLocationFilter = $values['includeLocationFilter'] ?? null;

    if (array_key_exists('smbToolType', $values)) {
      $this->_dirtyFields['smb_tool_type'] = true;
    }
    if (array_key_exists('includeLocationFilter', $values)) {
      $this->_dirtyFields['include_location_filter'] = true;
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

    if ($this->includeLocationFilter !== null) {
      $parts[] = [
        'name' => 'include_location_filter',
        'contents' => $this->includeLocationFilter ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
