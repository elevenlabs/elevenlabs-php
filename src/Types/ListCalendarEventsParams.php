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
class ListCalendarEventsParams extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ListCalendarEventsParamsSmbToolType>
   */
  #[JsonProperty('smb_tool_type')]
  public ?string $smbToolType;

  #[JsonProperty('include_cancelled')]
  public ?bool $includeCancelled;

  /**
   * @param array{
   *   smbToolType?: ?value-of<\ElevenLabs\Types\ListCalendarEventsParamsSmbToolType>,
   *   includeCancelled?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->smbToolType = $values['smbToolType'] ?? 'list_calendar_events';
    $this->includeCancelled = $values['includeCancelled'] ?? null;

    if (array_key_exists('smbToolType', $values)) {
      $this->_dirtyFields['smb_tool_type'] = true;
    }
    if (array_key_exists('includeCancelled', $values)) {
      $this->_dirtyFields['include_cancelled'] = true;
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

    if ($this->includeCancelled !== null) {
      $parts[] = [
        'name' => 'include_cancelled',
        'contents' => $this->includeCancelled ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
