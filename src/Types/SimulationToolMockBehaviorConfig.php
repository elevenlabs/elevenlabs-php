<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Simulation/preview-side config: tools are identified by IDs, resolved to names at runtime.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SimulationToolMockBehaviorConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\MockingStrategy>
   */
  #[JsonProperty('mocking_strategy')]
  public ?string $mockingStrategy;

  /**
   * @var ?value-of<\ElevenLabs\Types\MockNoMatchBehavior>
   */
  #[JsonProperty('fallback_strategy')]
  public ?string $fallbackStrategy;

  /**
   * @var string[]|null
   * Tool IDs to mock. Resolved to tool names before being passed to the orchestrator.
   */
  #[JsonProperty('mocked_tool_ids'), ArrayType(['string'])]
  public ?array $mockedToolIds;

  /**
   * @param array{
   *   mockingStrategy?: ?value-of<\ElevenLabs\Types\MockingStrategy>,
   *   fallbackStrategy?: ?value-of<\ElevenLabs\Types\MockNoMatchBehavior>,
   *   mockedToolIds?: string[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->mockingStrategy = $values['mockingStrategy'] ?? null;
    $this->fallbackStrategy = $values['fallbackStrategy'] ?? null;
    $this->mockedToolIds = $values['mockedToolIds'] ?? null;

    if (array_key_exists('mockingStrategy', $values)) {
      $this->_dirtyFields['mocking_strategy'] = true;
    }
    if (array_key_exists('fallbackStrategy', $values)) {
      $this->_dirtyFields['fallback_strategy'] = true;
    }
    if (array_key_exists('mockedToolIds', $values)) {
      $this->_dirtyFields['mocked_tool_ids'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->mockingStrategy !== null) {
      $parts[] = [
        'name' => 'mocking_strategy',
        'contents' => $this->mockingStrategy
      ];
    }

    if ($this->fallbackStrategy !== null) {
      $parts[] = [
        'name' => 'fallback_strategy',
        'contents' => $this->fallbackStrategy
      ];
    }

    if ($this->mockedToolIds !== null) {
      foreach ($this->mockedToolIds ?? [] as $item) {
        $parts[] = [
          'name' => 'mocked_tool_ids',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
