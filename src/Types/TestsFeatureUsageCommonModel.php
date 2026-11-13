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
class TestsFeatureUsageCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('enabled')]
  public ?bool $enabled;

  #[JsonProperty('tests_ran_after_last_modification')]
  public ?bool $testsRanAfterLastModification;

  #[JsonProperty('tests_ran_in_last_7_days')]
  public ?bool $testsRanInLast7Days;

  /**
   * @param array{
   *   enabled?: ?bool,
   *   testsRanAfterLastModification?: ?bool,
   *   testsRanInLast7Days?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enabled = $values['enabled'] ?? null;
    $this->testsRanAfterLastModification = $values['testsRanAfterLastModification'] ?? null;
    $this->testsRanInLast7Days = $values['testsRanInLast7Days'] ?? null;

    if (array_key_exists('enabled', $values)) {
      $this->_dirtyFields['enabled'] = true;
    }
    if (array_key_exists('testsRanAfterLastModification', $values)) {
      $this->_dirtyFields['tests_ran_after_last_modification'] = true;
    }
    if (array_key_exists('testsRanInLast7Days', $values)) {
      $this->_dirtyFields['tests_ran_in_last_7_days'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->enabled !== null) {
      $parts[] = [
        'name' => 'enabled',
        'contents' => $this->enabled ? 'true' : 'false'
      ];
    }

    if ($this->testsRanAfterLastModification !== null) {
      $parts[] = [
        'name' => 'tests_ran_after_last_modification',
        'contents' => $this->testsRanAfterLastModification ? 'true' : 'false'
      ];
    }

    if ($this->testsRanInLast7Days !== null) {
      $parts[] = [
        'name' => 'tests_ran_in_last_7_days',
        'contents' => $this->testsRanInLast7Days ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
