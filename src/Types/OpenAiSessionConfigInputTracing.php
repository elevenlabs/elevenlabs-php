<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Discriminated union type (oneOf) representing exactly one of multiple possible types.
 *
 * This class implements a type-safe union where the value can be exactly one of the
 * defined variant types. It provides factory methods for construction, type-checking
 * methods, safe and throwing getters, and pattern matching for exhaustive handling.
 *
 * The oneOf pattern enforces that only one type can be present at a time, unlike anyOf
 * which allows multiple types simultaneously.
 */
class OpenAiSessionConfigInputTracing extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\OpenAiSessionConfigInputTracing1|\ElevenLabs\Types\OpenAiTracingConfiguration The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\OpenAiSessionConfigInputTracing1|\ElevenLabs\Types\OpenAiTracingConfiguration $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a OpenAiSessionConfigInputTracing instance containing a \ElevenLabs\Types\OpenAiSessionConfigInputTracing1
   */
  public static function openAiSessionConfigInputTracing1(
    \ElevenLabs\Types\OpenAiSessionConfigInputTracing1 $openAiSessionConfigInputTracing1
  ): self {
    return new self($openAiSessionConfigInputTracing1, 0);
  }

  /**
   * Create a OpenAiSessionConfigInputTracing instance containing a \ElevenLabs\Types\OpenAiTracingConfiguration
   */
  public static function openAiTracingConfiguration(
    \ElevenLabs\Types\OpenAiTracingConfiguration $openAiTracingConfiguration
  ): self {
    return new self($openAiTracingConfiguration, 1);
  }

  // Type checking methods
  /**
   * Check if this OpenAiSessionConfigInputTracing contains a \ElevenLabs\Types\OpenAiSessionConfigInputTracing1
   */
  public function isOpenAiSessionConfigInputTracing1(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this OpenAiSessionConfigInputTracing contains a \ElevenLabs\Types\OpenAiTracingConfiguration
   */
  public function isOpenAiTracingConfiguration(): bool
  {
    return $this->typeIndex === 1;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\OpenAiSessionConfigInputTracing1 value
   * @throws \RuntimeException if this OpenAiSessionConfigInputTracing does not contain a \ElevenLabs\Types\OpenAiSessionConfigInputTracing1
   */
  public function asOpenAiSessionConfigInputTracing1(): \ElevenLabs\Types\OpenAiSessionConfigInputTracing1
  {
    if (!$this->isOpenAiSessionConfigInputTracing1()) {
      throw new \RuntimeException(
        'OpenAiSessionConfigInputTracing does not contain \ElevenLabs\Types\OpenAiSessionConfigInputTracing1'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\OpenAiTracingConfiguration value
   * @throws \RuntimeException if this OpenAiSessionConfigInputTracing does not contain a \ElevenLabs\Types\OpenAiTracingConfiguration
   */
  public function asOpenAiTracingConfiguration(): \ElevenLabs\Types\OpenAiTracingConfiguration
  {
    if (!$this->isOpenAiTracingConfiguration()) {
      throw new \RuntimeException(
        'OpenAiSessionConfigInputTracing does not contain \ElevenLabs\Types\OpenAiTracingConfiguration'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\OpenAiSessionConfigInputTracing1 value
   * @return \ElevenLabs\Types\OpenAiSessionConfigInputTracing1|null Returns the value if this OpenAiSessionConfigInputTracing contains a \ElevenLabs\Types\OpenAiSessionConfigInputTracing1, null otherwise
   */
  public function tryAsOpenAiSessionConfigInputTracing1(): ?\ElevenLabs\Types\OpenAiSessionConfigInputTracing1
  {
    return $this->isOpenAiSessionConfigInputTracing1() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\OpenAiTracingConfiguration value
   * @return \ElevenLabs\Types\OpenAiTracingConfiguration|null Returns the value if this OpenAiSessionConfigInputTracing contains a \ElevenLabs\Types\OpenAiTracingConfiguration, null otherwise
   */
  public function tryAsOpenAiTracingConfiguration(): ?\ElevenLabs\Types\OpenAiTracingConfiguration
  {
    return $this->isOpenAiTracingConfiguration() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\OpenAiSessionConfigInputTracing1): T $onOpenAiSessionConfigInputTracing1
   * @param callable(\ElevenLabs\Types\OpenAiTracingConfiguration): T $onOpenAiTracingConfiguration
   * @return T
   */
  public function match(
    callable $onOpenAiSessionConfigInputTracing1,
    callable $onOpenAiTracingConfiguration
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onOpenAiSessionConfigInputTracing1($this->value),
      1 => $onOpenAiTracingConfiguration($this->value),
      default => throw new \UnexpectedValueException("Unknown type index: $this->typeIndex")
    };
  }

  /**
   * Deserialize from data - try each type in order
   * @param mixed $data
   * @return self
   * @throws \InvalidArgumentException if data doesn't match any type
   */
  public static function fromArray(mixed $data): self
  {
    // Best-match-wins: collect every variant that fromArray() accepted,
    // score each by how many of the input keys it actually consumed
    // (looked up via the per-instance _dirtyFields populated by the
    // variant's own fromArray), then keep the highest-scoring one. Ties
    // break to the first-declared variant because PHP's usort is stable
    // when compared values are equal and we visit variants in order.
    // This is what makes oneOf with overlapping schemas (e.g. Cat & Dog
    // both have `name`, only Cat has `color`) pick the right variant
    // when discriminating fields are present.
    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    if (is_string($data) || is_int($data)) {
      $enumValue = \ElevenLabs\Types\OpenAiSessionConfigInputTracing1::tryFrom($data);
      if ($enumValue !== null) {
        $candidates[] = ['instance' => $enumValue, 'idx' => 0, 'score' => 1];
      }
    }

    try {
      $candidate = \ElevenLabs\Types\OpenAiTracingConfiguration::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = is_array($data) ? count($data) : 0 - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OpenAiTracingConfiguration didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any OpenAiSessionConfigInputTracing type'
      );
    }
    $best = $candidates[0];
    foreach ($candidates as $candidate) {
      if ($candidate['score'] > $best['score']) {
        $best = $candidate;
      }
    }
    return new self($best['instance'], $best['idx']);
  }

  /**
   * Serialize to JSON - returns the serialized inner value
   */
  public function jsonSerialize(): mixed
  {
    if ($this->value instanceof \BackedEnum) {
      return $this->value->value;
    }
    if (!($this->value instanceof \JsonSerializable)) {
      return $this->value;
    }
    return $this->value->jsonSerialize();
  }
}
