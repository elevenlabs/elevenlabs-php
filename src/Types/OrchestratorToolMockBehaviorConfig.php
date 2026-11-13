<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Orchestrator-side config: tools are identified by resolved names.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class OrchestratorToolMockBehaviorConfig extends JsonSerializableType
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
   * Tool names to mock. Only used when mocking_strategy is 'selected'.
   */
  #[JsonProperty('mocked_tool_names'), ArrayType(['string'])]
  public ?array $mockedToolNames;

  /**
   * @param array{
   *   mockingStrategy?: ?value-of<\ElevenLabs\Types\MockingStrategy>,
   *   fallbackStrategy?: ?value-of<\ElevenLabs\Types\MockNoMatchBehavior>,
   *   mockedToolNames?: string[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->mockingStrategy = $values['mockingStrategy'] ?? null;
    $this->fallbackStrategy = $values['fallbackStrategy'] ?? null;
    $this->mockedToolNames = $values['mockedToolNames'] ?? null;

    if (array_key_exists('mockingStrategy', $values)) {
      $this->_dirtyFields['mocking_strategy'] = true;
    }
    if (array_key_exists('fallbackStrategy', $values)) {
      $this->_dirtyFields['fallback_strategy'] = true;
    }
    if (array_key_exists('mockedToolNames', $values)) {
      $this->_dirtyFields['mocked_tool_names'] = true;
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

    if ($this->mockedToolNames !== null) {
      foreach ($this->mockedToolNames ?? [] as $item) {
        $parts[] = [
          'name' => 'mocked_tool_names',
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
