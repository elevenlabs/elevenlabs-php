<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Requests;

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
class RunAgentTestsRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Optional name for the test invocation.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * @var \ElevenLabs\Types\SingleTestRunRequestModel[]
   * List of tests to run on the agent
   */
  #[
    JsonProperty('tests', required: true),
    ArrayType([\ElevenLabs\Types\SingleTestRunRequestModel::class])
  ]
  public array $tests;

  /**
   * Configuration overrides to use for testing. If not provided, the agent's default configuration will be used.
   */
  #[JsonProperty('agent_config_override')]
  public ?\ElevenLabs\Types\AdhocAgentConfigOverrideForTestRequestModel $agentConfigOverride;

  /**
   * ID of the branch to run the tests on. If not provided, the tests will be run on the agent's main branch.
   */
  #[JsonProperty('branch_id')]
  public ?string $branchId;

  /**
   * Number of times to run each test. When greater than 1, results are grouped and summarized.
   */
  #[JsonProperty('repeat_count')]
  public ?int $repeatCount;

  /**
   * @param array{
   *   tests: \ElevenLabs\Types\SingleTestRunRequestModel[],
   *   name?: ?string,
   *   agentConfigOverride?: ?\ElevenLabs\Types\AdhocAgentConfigOverrideForTestRequestModel,
   *   branchId?: ?string,
   *   repeatCount?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'] ?? null;
    $this->tests = $values['tests'];
    $this->agentConfigOverride = $values['agentConfigOverride'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->repeatCount = $values['repeatCount'] ?? null;

    $this->_dirtyFields = [
      'tests' => true
    ];
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('agentConfigOverride', $values)) {
      $this->_dirtyFields['agent_config_override'] = true;
    }
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
    if (array_key_exists('repeatCount', $values)) {
      $this->_dirtyFields['repeat_count'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    $parts[] = [
      'name' => 'tests',
      'contents' => json_encode($this->tests),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->agentConfigOverride !== null) {
      $parts[] = [
        'name' => 'agent_config_override',
        'contents' => json_encode($this->agentConfigOverride),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->branchId !== null) {
      $parts[] = [
        'name' => 'branch_id',
        'contents' => $this->branchId
      ];
    }

    if ($this->repeatCount !== null) {
      $parts[] = [
        'name' => 'repeat_count',
        'contents' => (string) $this->repeatCount
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', minLength: 1, maxLength: 256);
    foreach ($this->tests as $item) {
      $item->validate();
    }
    Validator::validateArray($this->tests, 'tests', minItems: 1, maxItems: 5000);
    $this->agentConfigOverride?->validate();
    Validator::validateNumber($this->repeatCount, 'repeat_count', min: 1, max: 50);
  }
}
