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
class GetTestsSummariesByIdsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\UnitTestSummaryResponseModel>
   * Dictionary mapping test IDs to their summary information
   */
  #[
    JsonProperty('tests', required: true),
    ArrayType(['string' => \ElevenLabs\Types\UnitTestSummaryResponseModel::class])
  ]
  public array $tests;

  /**
   * @param array{
   *   tests: array<string, \ElevenLabs\Types\UnitTestSummaryResponseModel>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->tests = $values['tests'];

    $this->_dirtyFields = [
      'tests' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tests',
      'contents' => json_encode($this->tests),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
