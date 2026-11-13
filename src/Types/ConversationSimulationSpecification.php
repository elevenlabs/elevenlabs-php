<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * A specification that will be used to simulate a conversation between an agent and an AI user.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationSimulationSpecification extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('simulated_user_config', required: true)]
  public \ElevenLabs\Types\AgentConfig $simulatedUserConfig;

  /**
   * @var array<string, \ElevenLabs\Types\ToolMockConfig>|null
   */
  #[
    JsonProperty('tool_mock_config'),
    ArrayType(['string' => \ElevenLabs\Types\ToolMockConfig::class])
  ]
  public ?array $toolMockConfig;

  /**
   * @var \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelInput[]|null
   * A partial conversation history to start the simulation from. If empty, simulation starts fresh.
   */
  #[
    JsonProperty('partial_conversation_history'),
    ArrayType([\ElevenLabs\Types\ConversationHistoryTranscriptCommonModelInput::class])
  ]
  public ?array $partialConversationHistory;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('dynamic_variables'), ArrayType(['string' => 'mixed'])]
  public ?array $dynamicVariables;

  /**
   * @param array{
   *   simulatedUserConfig: \ElevenLabs\Types\AgentConfig,
   *   toolMockConfig?: array<string, \ElevenLabs\Types\ToolMockConfig>|null,
   *   partialConversationHistory?: \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelInput[]|null,
   *   dynamicVariables?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->simulatedUserConfig = $values['simulatedUserConfig'];
    $this->toolMockConfig = $values['toolMockConfig'] ?? null;
    $this->partialConversationHistory = $values['partialConversationHistory'] ?? null;
    $this->dynamicVariables = $values['dynamicVariables'] ?? null;

    $this->_dirtyFields = [
      'simulated_user_config' => true
    ];
    if (array_key_exists('toolMockConfig', $values)) {
      $this->_dirtyFields['tool_mock_config'] = true;
    }
    if (array_key_exists('partialConversationHistory', $values)) {
      $this->_dirtyFields['partial_conversation_history'] = true;
    }
    if (array_key_exists('dynamicVariables', $values)) {
      $this->_dirtyFields['dynamic_variables'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'simulated_user_config',
      'contents' => json_encode($this->simulatedUserConfig),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->toolMockConfig !== null) {
      $parts[] = [
        'name' => 'tool_mock_config',
        'contents' => json_encode($this->toolMockConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->partialConversationHistory !== null) {
      $parts[] = [
        'name' => 'partial_conversation_history',
        'contents' => json_encode($this->partialConversationHistory),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dynamicVariables !== null) {
      $parts[] = [
        'name' => 'dynamic_variables',
        'contents' => json_encode($this->dynamicVariables),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->simulatedUserConfig->validate();
    foreach ($this->partialConversationHistory ?? [] as $item) {
      $item->validate();
    }
  }
}
