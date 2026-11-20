<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A single customer-facing receptionist agent.
 *
 * A workspace can have multiple of these. Each entry owns its own ConvAI
 * agent id and full ``CustomerFacingConfig`` (voice, language, first message,
 * system tool toggles, agent rules, transfer rules).
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionCustomerFacingAgent extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the ElevenLabs agent behind this receptionist.
   */
  #[JsonProperty('agent_id')]
  public ?string $agentId;

  #[JsonProperty('config')]
  public ?\ElevenLabs\Types\ReceptionCustomerFacingConfigInput $config;

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
   * @param array{
   *   agentId?: ?string,
   *   config?: ?\ElevenLabs\Types\ReceptionCustomerFacingConfigInput,
   *   deactivatedAtUnix?: ?int,
   *   deactivationReason?: ?value-of<\ElevenLabs\Types\ReceptionCustomerFacingAgentDeactivationReason>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->agentId = $values['agentId'] ?? null;
    $this->config = $values['config'] ?? null;
    $this->deactivatedAtUnix = $values['deactivatedAtUnix'] ?? null;
    $this->deactivationReason = $values['deactivationReason'] ?? null;

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

    return $parts;
  }

  public function validate(): void
  {
    $this->config?->validate();
  }
}
