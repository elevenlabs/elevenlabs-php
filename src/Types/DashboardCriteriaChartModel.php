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
class DashboardCriteriaChartModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\DashboardCriteriaChartModelType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('criteria_id', required: true)]
  public string $criteriaId;

  /**
   * @param array{
   *   name: string,
   *   criteriaId: string,
   *   type?: ?value-of<\ElevenLabs\Types\DashboardCriteriaChartModelType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->type = $values['type'] ?? 'criteria';
    $this->criteriaId = $values['criteriaId'];

    $this->_dirtyFields = [
      'name' => true,
      'criteria_id' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'criteria_id',
      'contents' => $this->criteriaId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
