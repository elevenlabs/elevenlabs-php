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
class ScopedAnalysisResult extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AnalysisScope>
   */
  #[JsonProperty('scope', required: true)]
  public string $scope;

  #[JsonProperty('source_agent_id', required: true)]
  public string $sourceAgentId;

  /**
   * Branch of the agent for this scoped block; disambiguates repeated agent_id.
   */
  #[JsonProperty('source_branch_id')]
  public ?string $sourceBranchId;

  /**
   * @var array<string, \ElevenLabs\Types\ConversationHistoryEvaluationCriteriaResultCommonModel>|null
   */
  #[
    JsonProperty('evaluation_criteria_results'),
    ArrayType([
      'string' => \ElevenLabs\Types\ConversationHistoryEvaluationCriteriaResultCommonModel::class
    ])
  ]
  public ?array $evaluationCriteriaResults;

  /**
   * @var array<string, \ElevenLabs\Types\DataCollectionResultCommonModel>|null
   */
  #[
    JsonProperty('data_collection_results'),
    ArrayType(['string' => \ElevenLabs\Types\DataCollectionResultCommonModel::class])
  ]
  public ?array $dataCollectionResults;

  /**
   * @var value-of<\ElevenLabs\Types\EvaluationSuccessResult>
   */
  #[JsonProperty('successful', required: true)]
  public string $successful;

  #[JsonProperty('success_score')]
  public ?float $successScore;

  /**
   * @param array{
   *   scope: value-of<\ElevenLabs\Types\AnalysisScope>,
   *   sourceAgentId: string,
   *   successful: value-of<\ElevenLabs\Types\EvaluationSuccessResult>,
   *   sourceBranchId?: ?string,
   *   evaluationCriteriaResults?: array<string, \ElevenLabs\Types\ConversationHistoryEvaluationCriteriaResultCommonModel>|null,
   *   dataCollectionResults?: array<string, \ElevenLabs\Types\DataCollectionResultCommonModel>|null,
   *   successScore?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->scope = $values['scope'];
    $this->sourceAgentId = $values['sourceAgentId'];
    $this->sourceBranchId = $values['sourceBranchId'] ?? null;
    $this->evaluationCriteriaResults = $values['evaluationCriteriaResults'] ?? null;
    $this->dataCollectionResults = $values['dataCollectionResults'] ?? null;
    $this->successful = $values['successful'];
    $this->successScore = $values['successScore'] ?? null;

    $this->_dirtyFields = [
      'scope' => true,
      'source_agent_id' => true,
      'successful' => true
    ];
    if (array_key_exists('sourceBranchId', $values)) {
      $this->_dirtyFields['source_branch_id'] = true;
    }
    if (array_key_exists('evaluationCriteriaResults', $values)) {
      $this->_dirtyFields['evaluation_criteria_results'] = true;
    }
    if (array_key_exists('dataCollectionResults', $values)) {
      $this->_dirtyFields['data_collection_results'] = true;
    }
    if (array_key_exists('successScore', $values)) {
      $this->_dirtyFields['success_score'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'scope',
      'contents' => $this->scope
    ];

    $parts[] = [
      'name' => 'source_agent_id',
      'contents' => $this->sourceAgentId
    ];

    if ($this->sourceBranchId !== null) {
      $parts[] = [
        'name' => 'source_branch_id',
        'contents' => $this->sourceBranchId
      ];
    }

    if ($this->evaluationCriteriaResults !== null) {
      $parts[] = [
        'name' => 'evaluation_criteria_results',
        'contents' => json_encode($this->evaluationCriteriaResults),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dataCollectionResults !== null) {
      $parts[] = [
        'name' => 'data_collection_results',
        'contents' => json_encode($this->dataCollectionResults),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'successful',
      'contents' => $this->successful
    ];

    if ($this->successScore !== null) {
      $parts[] = [
        'name' => 'success_score',
        'contents' => (string) $this->successScore
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
