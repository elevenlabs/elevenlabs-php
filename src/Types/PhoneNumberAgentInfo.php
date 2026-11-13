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
class PhoneNumberAgentInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the agent
   */
  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * The name of the agent
   */
  #[JsonProperty('agent_name', required: true)]
  public string $agentName;

  /**
   * Environment to use for resolving environment variables on calls to this number.
   */
  #[JsonProperty('environment')]
  public ?string $environment;

  /**
   * Agent branch to use for calls to this number.
   */
  #[JsonProperty('branch_id')]
  public ?string $branchId;

  /**
   * @param array{
   *   agentId: string,
   *   agentName: string,
   *   environment?: ?string,
   *   branchId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->agentName = $values['agentName'];
    $this->environment = $values['environment'] ?? null;
    $this->branchId = $values['branchId'] ?? null;

    $this->_dirtyFields = [
      'agent_id' => true,
      'agent_name' => true
    ];
    if (array_key_exists('environment', $values)) {
      $this->_dirtyFields['environment'] = true;
    }
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'agent_name',
      'contents' => $this->agentName
    ];

    if ($this->environment !== null) {
      $parts[] = [
        'name' => 'environment',
        'contents' => $this->environment
      ];
    }

    if ($this->branchId !== null) {
      $parts[] = [
        'name' => 'branch_id',
        'contents' => $this->branchId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
