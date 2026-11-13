<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

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
class BodySimulatesAConversationV1ConvaiAgentsAgentIdSimulateConversationPost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * A specification that will be used to simulate a conversation between an agent and an AI user.
   */
  #[JsonProperty('simulation_specification', required: true)]
  public \ElevenLabs\Types\ConversationSimulationSpecification $simulationSpecification;

  /**
   * @var \ElevenLabs\Types\PromptEvaluationCriteria[]|null
   * A list of evaluation criteria to test
   */
  #[
    JsonProperty('extra_evaluation_criteria'),
    ArrayType([\ElevenLabs\Types\PromptEvaluationCriteria::class])
  ]
  public ?array $extraEvaluationCriteria;

  /**
   * Maximum number of new turns to generate in the conversation simulation
   */
  #[JsonProperty('new_turns_limit')]
  public ?int $newTurnsLimit;

  /**
   * @param array{
   *   simulationSpecification: \ElevenLabs\Types\ConversationSimulationSpecification,
   *   extraEvaluationCriteria?: \ElevenLabs\Types\PromptEvaluationCriteria[]|null,
   *   newTurnsLimit?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->simulationSpecification = $values['simulationSpecification'];
    $this->extraEvaluationCriteria = $values['extraEvaluationCriteria'] ?? null;
    $this->newTurnsLimit = $values['newTurnsLimit'] ?? null;

    $this->_dirtyFields = [
      'simulation_specification' => true
    ];
    if (array_key_exists('extraEvaluationCriteria', $values)) {
      $this->_dirtyFields['extra_evaluation_criteria'] = true;
    }
    if (array_key_exists('newTurnsLimit', $values)) {
      $this->_dirtyFields['new_turns_limit'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'simulation_specification',
      'contents' => json_encode($this->simulationSpecification),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->extraEvaluationCriteria !== null) {
      $parts[] = [
        'name' => 'extra_evaluation_criteria',
        'contents' => json_encode($this->extraEvaluationCriteria),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->newTurnsLimit !== null) {
      $parts[] = [
        'name' => 'new_turns_limit',
        'contents' => (string) $this->newTurnsLimit
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->simulationSpecification->validate();
    foreach ($this->extraEvaluationCriteria ?? [] as $item) {
      $item->validate();
    }
    Validator::validateNumber($this->newTurnsLimit, 'new_turns_limit', max: 100);
  }
}
