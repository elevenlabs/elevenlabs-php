<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;
use DateTime;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkspaceAnalyticsQueryResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   */
  #[JsonProperty('columns', required: true), ArrayType(['string'])]
  public array $columns;

  /**
   * @var array<value-of<\ElevenLabs\Types\WorkspaceAnalyticsQueryResponseModelColumnTypesItem>>
   */
  #[JsonProperty('column_types', required: true), ArrayType(['string'])]
  public array $columnTypes;

  /**
   * @var ((string|int|float|bool|DateTime)[])[]
   */
  #[
    JsonProperty('rows', required: true),
    ArrayType([[new Union('string', 'integer', 'float', 'bool', 'datetime')]])
  ]
  public array $rows;

  /**
   * @var array<value-of<\ElevenLabs\Types\ColumnUnit>>
   */
  #[JsonProperty('column_units', required: true), ArrayType(['string'])]
  public array $columnUnits;

  /**
   * @param array{
   *   columns: string[],
   *   columnTypes: array<value-of<\ElevenLabs\Types\WorkspaceAnalyticsQueryResponseModelColumnTypesItem>>,
   *   rows: ((string|int|float|bool|DateTime)[])[],
   *   columnUnits: array<value-of<\ElevenLabs\Types\ColumnUnit>>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->columns = $values['columns'];
    $this->columnTypes = $values['columnTypes'];
    $this->rows = $values['rows'];
    $this->columnUnits = $values['columnUnits'];

    $this->_dirtyFields = [
      'columns' => true,
      'column_types' => true,
      'rows' => true,
      'column_units' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->columns as $item) {
      $parts[] = [
        'name' => 'columns',
        'contents' => $item
      ];
    }

    foreach ($this->columnTypes as $item) {
      $parts[] = [
        'name' => 'column_types',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'rows',
      'contents' => json_encode($this->rows),
      'headers' => ['Content-Type' => 'application/json']
    ];

    foreach ($this->columnUnits as $item) {
      $parts[] = [
        'name' => 'column_units',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
