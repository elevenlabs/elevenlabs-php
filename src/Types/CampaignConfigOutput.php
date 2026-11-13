<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CampaignConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('policy')]
  public ?\ElevenLabs\Types\PolicyConfigOutput $policy;

  /**
   * @var array<string, \ElevenLabs\Types\AgentPolicyOverrideOutput>|null
   * Overrides of `policy`, keyed by agent ID.
   */
  #[
    JsonProperty('agent_policies'),
    ArrayType(['string' => \ElevenLabs\Types\AgentPolicyOverrideOutput::class])
  ]
  public ?array $agentPolicies;

  /**
   * Overrides for WhatsApp voice campaigns, layered between the workspace policy and an agent's overrides. Sections left out follow WhatsApp voice's built-in defaults.
   */
  #[JsonProperty('whatsapp_voice_policy')]
  public ?\ElevenLabs\Types\AgentPolicyOverrideOutput $whatsappVoicePolicy;

  /**
   * @param array{
   *   policy?: ?\ElevenLabs\Types\PolicyConfigOutput,
   *   agentPolicies?: array<string, \ElevenLabs\Types\AgentPolicyOverrideOutput>|null,
   *   whatsappVoicePolicy?: ?\ElevenLabs\Types\AgentPolicyOverrideOutput,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->policy = $values['policy'] ?? null;
    $this->agentPolicies = $values['agentPolicies'] ?? null;
    $this->whatsappVoicePolicy = $values['whatsappVoicePolicy'] ?? null;

    if (array_key_exists('policy', $values)) {
      $this->_dirtyFields['policy'] = true;
    }
    if (array_key_exists('agentPolicies', $values)) {
      $this->_dirtyFields['agent_policies'] = true;
    }
    if (array_key_exists('whatsappVoicePolicy', $values)) {
      $this->_dirtyFields['whatsapp_voice_policy'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->policy !== null) {
      $parts[] = [
        'name' => 'policy',
        'contents' => json_encode($this->policy),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->agentPolicies !== null) {
      $parts[] = [
        'name' => 'agent_policies',
        'contents' => json_encode($this->agentPolicies),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->whatsappVoicePolicy !== null) {
      $parts[] = [
        'name' => 'whatsapp_voice_policy',
        'contents' => json_encode($this->whatsappVoicePolicy),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->policy?->validate();
    $this->whatsappVoicePolicy?->validate();
  }
}
