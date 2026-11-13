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
class ConversationHistoryAnalysisCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

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
   * @var \ElevenLabs\Types\ConversationHistoryEvaluationCriteriaResultCommonModel[]|null
   */
  #[
    JsonProperty('evaluation_criteria_results_list'),
    ArrayType([\ElevenLabs\Types\ConversationHistoryEvaluationCriteriaResultCommonModel::class])
  ]
  public ?array $evaluationCriteriaResultsList;

  /**
   * @var \ElevenLabs\Types\DataCollectionResultCommonModel[]|null
   */
  #[
    JsonProperty('data_collection_results_list'),
    ArrayType([\ElevenLabs\Types\DataCollectionResultCommonModel::class])
  ]
  public ?array $dataCollectionResultsList;

  /**
   * @var value-of<\ElevenLabs\Types\EvaluationSuccessResult>
   */
  #[JsonProperty('call_successful', required: true)]
  public string $callSuccessful;

  #[JsonProperty('call_success_score')]
  public ?float $callSuccessScore;

  #[JsonProperty('transcript_summary', required: true)]
  public string $transcriptSummary;

  #[JsonProperty('call_summary_title')]
  public ?string $callSummaryTitle;

  /**
   * @var \ElevenLabs\Types\ScopedAnalysisResult[]|null
   */
  #[JsonProperty('scoped'), ArrayType([\ElevenLabs\Types\ScopedAnalysisResult::class])]
  public ?array $scoped;

  /**
   * @param array{
   *   callSuccessful: value-of<\ElevenLabs\Types\EvaluationSuccessResult>,
   *   transcriptSummary: string,
   *   evaluationCriteriaResults?: array<string, \ElevenLabs\Types\ConversationHistoryEvaluationCriteriaResultCommonModel>|null,
   *   dataCollectionResults?: array<string, \ElevenLabs\Types\DataCollectionResultCommonModel>|null,
   *   evaluationCriteriaResultsList?: \ElevenLabs\Types\ConversationHistoryEvaluationCriteriaResultCommonModel[]|null,
   *   dataCollectionResultsList?: \ElevenLabs\Types\DataCollectionResultCommonModel[]|null,
   *   callSuccessScore?: ?float,
   *   callSummaryTitle?: ?string,
   *   scoped?: \ElevenLabs\Types\ScopedAnalysisResult[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->evaluationCriteriaResults = $values['evaluationCriteriaResults'] ?? null;
    $this->dataCollectionResults = $values['dataCollectionResults'] ?? null;
    $this->evaluationCriteriaResultsList = $values['evaluationCriteriaResultsList'] ?? null;
    $this->dataCollectionResultsList = $values['dataCollectionResultsList'] ?? null;
    $this->callSuccessful = $values['callSuccessful'];
    $this->callSuccessScore = $values['callSuccessScore'] ?? null;
    $this->transcriptSummary = $values['transcriptSummary'];
    $this->callSummaryTitle = $values['callSummaryTitle'] ?? null;
    $this->scoped = $values['scoped'] ?? null;

    $this->_dirtyFields = [
      'call_successful' => true,
      'transcript_summary' => true
    ];
    if (array_key_exists('evaluationCriteriaResults', $values)) {
      $this->_dirtyFields['evaluation_criteria_results'] = true;
    }
    if (array_key_exists('dataCollectionResults', $values)) {
      $this->_dirtyFields['data_collection_results'] = true;
    }
    if (array_key_exists('evaluationCriteriaResultsList', $values)) {
      $this->_dirtyFields['evaluation_criteria_results_list'] = true;
    }
    if (array_key_exists('dataCollectionResultsList', $values)) {
      $this->_dirtyFields['data_collection_results_list'] = true;
    }
    if (array_key_exists('callSuccessScore', $values)) {
      $this->_dirtyFields['call_success_score'] = true;
    }
    if (array_key_exists('callSummaryTitle', $values)) {
      $this->_dirtyFields['call_summary_title'] = true;
    }
    if (array_key_exists('scoped', $values)) {
      $this->_dirtyFields['scoped'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
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

    if ($this->evaluationCriteriaResultsList !== null) {
      $parts[] = [
        'name' => 'evaluation_criteria_results_list',
        'contents' => json_encode($this->evaluationCriteriaResultsList),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dataCollectionResultsList !== null) {
      $parts[] = [
        'name' => 'data_collection_results_list',
        'contents' => json_encode($this->dataCollectionResultsList),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'call_successful',
      'contents' => $this->callSuccessful
    ];

    if ($this->callSuccessScore !== null) {
      $parts[] = [
        'name' => 'call_success_score',
        'contents' => (string) $this->callSuccessScore
      ];
    }

    $parts[] = [
      'name' => 'transcript_summary',
      'contents' => $this->transcriptSummary
    ];

    if ($this->callSummaryTitle !== null) {
      $parts[] = [
        'name' => 'call_summary_title',
        'contents' => $this->callSummaryTitle
      ];
    }

    if ($this->scoped !== null) {
      $parts[] = [
        'name' => 'scoped',
        'contents' => json_encode($this->scoped),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->evaluationCriteriaResultsList ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->dataCollectionResultsList ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->scoped ?? [] as $item) {
      $item->validate();
    }
  }
}
