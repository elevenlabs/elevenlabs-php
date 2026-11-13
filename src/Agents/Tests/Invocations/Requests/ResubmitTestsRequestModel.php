<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tests\Invocations\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ResubmitTestsRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * List of test run IDs to resubmit
   */
  #[JsonProperty('test_run_ids', required: true), ArrayType(['string'])]
  public array $testRunIds;

  /**
   * Configuration overrides to use for testing. If not provided, the agent's default configuration will be used.
   */
  #[JsonProperty('agent_config_override')]
  public ?\ElevenLabs\Types\AdhocAgentConfigOverrideForTestRequestModel $agentConfigOverride;

  /**
   * Agent ID to resubmit tests for
   */
  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * ID of the branch to run the tests on. If not provided, the tests will be run on the agent's main branch.
   */
  #[JsonProperty('branch_id')]
  public ?string $branchId;

  /**
   * @param array{
   *   testRunIds: string[],
   *   agentId: string,
   *   agentConfigOverride?: ?\ElevenLabs\Types\AdhocAgentConfigOverrideForTestRequestModel,
   *   branchId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->testRunIds = $values['testRunIds'];
    $this->agentConfigOverride = $values['agentConfigOverride'] ?? null;
    $this->agentId = $values['agentId'];
    $this->branchId = $values['branchId'] ?? null;

    $this->_dirtyFields = [
      'test_run_ids' => true,
      'agent_id' => true
    ];
    if (array_key_exists('agentConfigOverride', $values)) {
      $this->_dirtyFields['agent_config_override'] = true;
    }
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->testRunIds as $item) {
      $parts[] = [
        'name' => 'test_run_ids',
        'contents' => $item
      ];
    }

    if ($this->agentConfigOverride !== null) {
      $parts[] = [
        'name' => 'agent_config_override',
        'contents' => json_encode($this->agentConfigOverride),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

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
    Validator::validateArray($this->testRunIds, 'test_run_ids', minItems: 1, maxItems: 5000);
    $this->agentConfigOverride?->validate();
  }
}
