<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The business profile, with the current time in the business's timezone.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionAgentInfoResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

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
   * @var ?value-of<\ElevenLabs\Types\ReceptionAgentInfoResponseCurrency>
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
   * ID of the business profile.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * When the business profile was created, as a Unix timestamp in seconds.
   */
  #[JsonProperty('created_at_unix', required: true)]
  public int $createdAtUnix;

  /**
   * When the business profile was last updated, as a Unix timestamp in seconds.
   */
  #[JsonProperty('updated_at_unix', required: true)]
  public int $updatedAtUnix;

  #[JsonProperty('workspace_now')]
  public ?\ElevenLabs\Types\WorkspaceNow $workspaceNow;

  /**
   * @param array{
   *   id: string,
   *   createdAtUnix: int,
   *   updatedAtUnix: int,
   *   businessName?: ?string,
   *   businessCountry?: ?string,
   *   businessDescription?: ?string,
   *   timezone?: ?string,
   *   currency?: ?value-of<\ElevenLabs\Types\ReceptionAgentInfoResponseCurrency>,
   *   operatingHours?: ?\ElevenLabs\Types\WorkingHours,
   *   toolCallSound?: ?value-of<\ElevenLabs\Types\ToolCallSoundType>,
   *   workspaceNow?: ?\ElevenLabs\Types\WorkspaceNow,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->businessName = $values['businessName'] ?? null;
    $this->businessCountry = $values['businessCountry'] ?? null;
    $this->businessDescription = $values['businessDescription'] ?? null;
    $this->timezone = $values['timezone'] ?? null;
    $this->currency = $values['currency'] ?? null;
    $this->operatingHours = $values['operatingHours'] ?? null;
    $this->toolCallSound = $values['toolCallSound'] ?? null;
    $this->id = $values['id'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->updatedAtUnix = $values['updatedAtUnix'];
    $this->workspaceNow = $values['workspaceNow'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'created_at_unix' => true,
      'updated_at_unix' => true
    ];
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
    if (array_key_exists('workspaceNow', $values)) {
      $this->_dirtyFields['workspace_now'] = true;
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

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'created_at_unix',
      'contents' => (string) $this->createdAtUnix
    ];

    $parts[] = [
      'name' => 'updated_at_unix',
      'contents' => (string) $this->updatedAtUnix
    ];

    if ($this->workspaceNow !== null) {
      $parts[] = [
        'name' => 'workspace_now',
        'contents' => json_encode($this->workspaceNow),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->operatingHours?->validate();
    $this->workspaceNow?->validate();
  }
}
