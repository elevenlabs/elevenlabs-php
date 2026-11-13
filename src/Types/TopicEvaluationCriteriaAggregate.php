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
class TopicEvaluationCriteriaAggregate extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('criteria_id', required: true)]
  public string $criteriaId;

  #[JsonProperty('success_count')]
  public ?int $successCount;

  #[JsonProperty('failure_count')]
  public ?int $failureCount;

  #[JsonProperty('unknown_count')]
  public ?int $unknownCount;

  /**
   * @param array{
   *   criteriaId: string,
   *   successCount?: ?int,
   *   failureCount?: ?int,
   *   unknownCount?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->criteriaId = $values['criteriaId'];
    $this->successCount = $values['successCount'] ?? null;
    $this->failureCount = $values['failureCount'] ?? null;
    $this->unknownCount = $values['unknownCount'] ?? null;

    $this->_dirtyFields = [
      'criteria_id' => true
    ];
    if (array_key_exists('successCount', $values)) {
      $this->_dirtyFields['success_count'] = true;
    }
    if (array_key_exists('failureCount', $values)) {
      $this->_dirtyFields['failure_count'] = true;
    }
    if (array_key_exists('unknownCount', $values)) {
      $this->_dirtyFields['unknown_count'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'criteria_id',
      'contents' => $this->criteriaId
    ];

    if ($this->successCount !== null) {
      $parts[] = [
        'name' => 'success_count',
        'contents' => (string) $this->successCount
      ];
    }

    if ($this->failureCount !== null) {
      $parts[] = [
        'name' => 'failure_count',
        'contents' => (string) $this->failureCount
      ];
    }

    if ($this->unknownCount !== null) {
      $parts[] = [
        'name' => 'unknown_count',
        'contents' => (string) $this->unknownCount
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
