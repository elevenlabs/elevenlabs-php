<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A receptionist.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionCustomerFacingAgentResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the ElevenLabs agent behind this receptionist.
   */
  #[JsonProperty('agent_id')]
  public ?string $agentId;

  #[JsonProperty('config')]
  public ?\ElevenLabs\Types\ReceptionCustomerFacingConfigOutput $config;

  /**
   * Unix timestamp when this receptionist was deactivated. None when active.
   */
  #[JsonProperty('deactivated_at_unix')]
  public ?int $deactivatedAtUnix;

  /**
   * @var ?value-of<\ElevenLabs\Types\ReceptionCustomerFacingAgentDeactivationReason>
   * Why this receptionist was deactivated. None when active.
   */
  #[JsonProperty('deactivation_reason')]
  public ?string $deactivationReason;

  /**
   * Display name of the receptionist.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * False when the receptionist's underlying agent was deleted; it cannot take calls until it is set up again.
   */
  #[JsonProperty('agent_exists')]
  public ?bool $agentExists;

  /**
   * Whether this receptionist can configure and use transfer rules.
   */
  #[JsonProperty('is_transfer_allowed')]
  public ?bool $isTransferAllowed;

  /**
   * How the website widget looks. Null when the agent is missing. Unset labels follow the receptionist's language.
   */
  #[JsonProperty('widget')]
  public ?\ElevenLabs\Types\ReceptionWidgetAppearance $widget;

  /**
   * Whether the receptionist is active. Inactive receptionists take no live calls.
   */
  #[JsonProperty('is_active')]
  public ?bool $isActive;

  /**
   * @param array{
   *   agentId?: ?string,
   *   config?: ?\ElevenLabs\Types\ReceptionCustomerFacingConfigOutput,
   *   deactivatedAtUnix?: ?int,
   *   deactivationReason?: ?value-of<\ElevenLabs\Types\ReceptionCustomerFacingAgentDeactivationReason>,
   *   name?: ?string,
   *   agentExists?: ?bool,
   *   isTransferAllowed?: ?bool,
   *   widget?: ?\ElevenLabs\Types\ReceptionWidgetAppearance,
   *   isActive?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->agentId = $values['agentId'] ?? null;
    $this->config = $values['config'] ?? null;
    $this->deactivatedAtUnix = $values['deactivatedAtUnix'] ?? null;
    $this->deactivationReason = $values['deactivationReason'] ?? null;
    $this->name = $values['name'] ?? null;
    $this->agentExists = $values['agentExists'] ?? null;
    $this->isTransferAllowed = $values['isTransferAllowed'] ?? null;
    $this->widget = $values['widget'] ?? null;
    $this->isActive = $values['isActive'] ?? null;

    if (array_key_exists('agentId', $values)) {
      $this->_dirtyFields['agent_id'] = true;
    }
    if (array_key_exists('config', $values)) {
      $this->_dirtyFields['config'] = true;
    }
    if (array_key_exists('deactivatedAtUnix', $values)) {
      $this->_dirtyFields['deactivated_at_unix'] = true;
    }
    if (array_key_exists('deactivationReason', $values)) {
      $this->_dirtyFields['deactivation_reason'] = true;
    }
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('agentExists', $values)) {
      $this->_dirtyFields['agent_exists'] = true;
    }
    if (array_key_exists('isTransferAllowed', $values)) {
      $this->_dirtyFields['is_transfer_allowed'] = true;
    }
    if (array_key_exists('widget', $values)) {
      $this->_dirtyFields['widget'] = true;
    }
    if (array_key_exists('isActive', $values)) {
      $this->_dirtyFields['is_active'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->agentId !== null) {
      $parts[] = [
        'name' => 'agent_id',
        'contents' => $this->agentId
      ];
    }

    if ($this->config !== null) {
      $parts[] = [
        'name' => 'config',
        'contents' => json_encode($this->config),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->deactivatedAtUnix !== null) {
      $parts[] = [
        'name' => 'deactivated_at_unix',
        'contents' => (string) $this->deactivatedAtUnix
      ];
    }

    if ($this->deactivationReason !== null) {
      $parts[] = [
        'name' => 'deactivation_reason',
        'contents' => $this->deactivationReason
      ];
    }

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->agentExists !== null) {
      $parts[] = [
        'name' => 'agent_exists',
        'contents' => $this->agentExists ? 'true' : 'false'
      ];
    }

    if ($this->isTransferAllowed !== null) {
      $parts[] = [
        'name' => 'is_transfer_allowed',
        'contents' => $this->isTransferAllowed ? 'true' : 'false'
      ];
    }

    if ($this->widget !== null) {
      $parts[] = [
        'name' => 'widget',
        'contents' => json_encode($this->widget),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->isActive !== null) {
      $parts[] = [
        'name' => 'is_active',
        'contents' => $this->isActive ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->config?->validate();
    $this->widget?->validate();
  }
}
