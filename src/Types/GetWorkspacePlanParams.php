<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Read the workspace's current Reception plan and its hard limits.
 *
 * Call this before answering any plan, pricing, trial, or limit question so
 * the assistant stops guessing (e.g. telling a paying owner they're on the
 * trial, or hallucinating concurrent-call / receptionist / voice-cloning
 * caps). The tool exposes only the shape of the plan — a display name;
 * whether it's trial / paid / untiered; the entitlement caps (max
 * receptionists, phone numbers, active locations, team members, concurrent
 * calls, voice-cloning quota) alongside the current counts; and whether
 * there's a payment issue. It deliberately does NOT return list prices or
 * dollar amounts, nor the trial / renewal end date: pricing and renewal
 * dates are a product decision and live in the Settings > Billing plan
 * picker.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class GetWorkspacePlanParams extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\GetWorkspacePlanParamsSmbToolType>
   */
  #[JsonProperty('smb_tool_type')]
  public ?string $smbToolType;

  /**
   * @param array{
   *   smbToolType?: ?value-of<\ElevenLabs\Types\GetWorkspacePlanParamsSmbToolType>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->smbToolType = $values['smbToolType'] ?? 'get_workspace_plan';

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
