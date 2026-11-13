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
class AgentAnalysisItemsOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AgentAnalysisItemsOutputEvaluationCriteriaItem[]|null
   */
  #[
    JsonProperty('evaluation_criteria'),
    ArrayType([\ElevenLabs\Types\AgentAnalysisItemsOutputEvaluationCriteriaItem::class])
  ]
  public ?array $evaluationCriteria;

  /**
   * @var \ElevenLabs\Types\AgentAnalysisItemsOutputDataCollectionItem[]|null
   */
  #[
    JsonProperty('data_collection'),
    ArrayType([\ElevenLabs\Types\AgentAnalysisItemsOutputDataCollectionItem::class])
  ]
  public ?array $dataCollection;

  /**
   * @param array{
   *   evaluationCriteria?: \ElevenLabs\Types\AgentAnalysisItemsOutputEvaluationCriteriaItem[]|null,
   *   dataCollection?: \ElevenLabs\Types\AgentAnalysisItemsOutputDataCollectionItem[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->evaluationCriteria = $values['evaluationCriteria'] ?? null;
    $this->dataCollection = $values['dataCollection'] ?? null;

    if (array_key_exists('evaluationCriteria', $values)) {
      $this->_dirtyFields['evaluation_criteria'] = true;
    }
    if (array_key_exists('dataCollection', $values)) {
      $this->_dirtyFields['data_collection'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->evaluationCriteria !== null) {
      $parts[] = [
        'name' => 'evaluation_criteria',
        'contents' => json_encode($this->evaluationCriteria),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dataCollection !== null) {
      $parts[] = [
        'name' => 'data_collection',
        'contents' => json_encode($this->dataCollection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
