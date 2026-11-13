<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Identifies an agent as part of the SMB product.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AgentSmbMetadata extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\SmbAgentType>
   */
  #[JsonProperty('agent_type', required: true)]
  public string $agentType;

  /**
   * True for pre-signup onboarding agents that have not yet been transferred to a user workspace.
   */
  #[JsonProperty('is_ephemeral')]
  public ?bool $isEphemeral;

  /**
   * Hash of the SMB data+code inputs this agent was last regenerated against; the conversation-start drift gate. None (unstamped) regenerates once on the next conversation.
   */
  #[JsonProperty('source_fingerprint')]
  public ?string $sourceFingerprint;

  /**
   * @param array{
   *   agentType: value-of<\ElevenLabs\Types\SmbAgentType>,
   *   isEphemeral?: ?bool,
   *   sourceFingerprint?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentType = $values['agentType'];
    $this->isEphemeral = $values['isEphemeral'] ?? null;
    $this->sourceFingerprint = $values['sourceFingerprint'] ?? null;

    $this->_dirtyFields = [
      'agent_type' => true
    ];
    if (array_key_exists('isEphemeral', $values)) {
      $this->_dirtyFields['is_ephemeral'] = true;
    }
    if (array_key_exists('sourceFingerprint', $values)) {
      $this->_dirtyFields['source_fingerprint'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_type',
      'contents' => $this->agentType
    ];

    if ($this->isEphemeral !== null) {
      $parts[] = [
        'name' => 'is_ephemeral',
        'contents' => $this->isEphemeral ? 'true' : 'false'
      ];
    }

    if ($this->sourceFingerprint !== null) {
      $parts[] = [
        'name' => 'source_fingerprint',
        'contents' => $this->sourceFingerprint
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
