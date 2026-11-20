<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\BusinessProfile\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Fields to change on the business profile.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionUpdateAgentInfoRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * Name of the business.
   */
  #[JsonProperty('business_name')]
  public ?string $businessName;

  /**
   * ISO 3166-1 alpha-2 country code where the business is based (e.g. 'US', 'PL', 'DE').
   */
  #[JsonProperty('business_country')]
  public ?string $businessCountry;

  /**
   * What the business does, given to the receptionist.
   */
  #[JsonProperty('business_description')]
  public ?string $businessDescription;

  /**
   * IANA timezone of the business.
   */
  #[JsonProperty('timezone')]
  public ?string $timezone;

  /**
   * @var ?value-of<\ElevenLabs\Reception\BusinessProfile\Types\ReceptionUpdateAgentInfoRequestCurrency>
   * Currency code for all prices (ISO 4217)
   */
  #[JsonProperty('currency')]
  public ?string $currency;

  #[JsonProperty('operating_hours')]
  public ?\ElevenLabs\Types\WorkingHours $operatingHours;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolCallSoundType>
   * Ambient sound played while any receptionist runs a tool (e.g. checking availability or looking up a client), filling the silence callers would otherwise hear. One sound for the whole workspace, because custom webhook and MCP tools are shared by every receptionist. Off when null.
   */
  #[JsonProperty('tool_call_sound')]
  public ?string $toolCallSound;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   businessName?: ?string,
   *   businessCountry?: ?string,
   *   businessDescription?: ?string,
   *   timezone?: ?string,
   *   currency?: ?value-of<\ElevenLabs\Reception\BusinessProfile\Types\ReceptionUpdateAgentInfoRequestCurrency>,
   *   operatingHours?: ?\ElevenLabs\Types\WorkingHours,
   *   toolCallSound?: ?value-of<\ElevenLabs\Types\ToolCallSoundType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->businessName = $values['businessName'] ?? null;
    $this->businessCountry = $values['businessCountry'] ?? null;
    $this->businessDescription = $values['businessDescription'] ?? null;
    $this->timezone = $values['timezone'] ?? null;
    $this->currency = $values['currency'] ?? null;
    $this->operatingHours = $values['operatingHours'] ?? null;
    $this->toolCallSound = $values['toolCallSound'] ?? null;

    if (array_key_exists('businessName', $values)) {
      $this->_dirtyFields['business_name'] = true;
    }
    if (array_key_exists('businessCountry', $values)) {
      $this->_dirtyFields['business_country'] = true;
    }
    if (array_key_exists('businessDescription', $values)) {
      $this->_dirtyFields['business_description'] = true;
    }
    if (array_key_exists('timezone', $values)) {
      $this->_dirtyFields['timezone'] = true;
    }
    if (array_key_exists('currency', $values)) {
      $this->_dirtyFields['currency'] = true;
    }
    if (array_key_exists('operatingHours', $values)) {
      $this->_dirtyFields['operating_hours'] = true;
    }
    if (array_key_exists('toolCallSound', $values)) {
      $this->_dirtyFields['tool_call_sound'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->businessName !== null) {
      $parts[] = [
        'name' => 'business_name',
        'contents' => $this->businessName
      ];
    }

    if ($this->businessCountry !== null) {
      $parts[] = [
        'name' => 'business_country',
        'contents' => $this->businessCountry
      ];
    }

    if ($this->businessDescription !== null) {
      $parts[] = [
        'name' => 'business_description',
        'contents' => $this->businessDescription
      ];
    }

    if ($this->timezone !== null) {
      $parts[] = [
        'name' => 'timezone',
        'contents' => $this->timezone
      ];
    }

    if ($this->currency !== null) {
      $parts[] = [
        'name' => 'currency',
        'contents' => $this->currency
      ];
    }

    if ($this->operatingHours !== null) {
      $parts[] = [
        'name' => 'operating_hours',
        'contents' => json_encode($this->operatingHours),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->toolCallSound !== null) {
      $parts[] = [
        'name' => 'tool_call_sound',
        'contents' => $this->toolCallSound
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->operatingHours?->validate();
  }
}
