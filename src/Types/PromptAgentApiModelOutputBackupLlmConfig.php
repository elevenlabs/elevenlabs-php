<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Configuration for backup LLM cascading. Can be disabled, use system defaults, or specify custom order.
 */
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
class PromptAgentApiModelOutputBackupLlmConfig extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $preference;

  /**
   * @var \ElevenLabs\Types\BackupLlmDefault|\ElevenLabs\Types\BackupLlmDisabled|\ElevenLabs\Types\BackupLlmOverride|array<string, mixed> The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /** The type index of a payload whose discriminator names no variant this SDK knows. */
  private const UNKNOWN = -1;

  /**
   * Whether the payload's discriminator named a variant this SDK does not know (a variant added to
   * the API after this SDK was generated). Its raw payload is kept, as Fern's `_unknown` variant does.
   *
   * Underscore-prefixed because a union may legitimately have a variant NAMED `unknown`, whose own
   * accessors are `isUnknown()`/`asUnknown()`. Declaring both is a fatal `Cannot redeclare` and the
   * class cannot load at all. The prefix matches Fern's `_unknown` sentinel and Java's
   * `_isUnknown()`/`_getUnknown()`, and a variant accessor is always `isX`/`asX`, never `_isX` --
   * so the two can never collide whatever a spec calls its variants.
   */
  public function _isUnknown(): bool
  {
    return $this->typeIndex === self::UNKNOWN;
  }

  /**
   * @return array<string, mixed> The raw payload of an unknown variant
   * @throws \RuntimeException if this PromptAgentApiModelOutputBackupLlmConfig holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'PromptAgentApiModelOutputBackupLlmConfig does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\BackupLlmDefault|\ElevenLabs\Types\BackupLlmDisabled|\ElevenLabs\Types\BackupLlmOverride|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->preference = match ($typeIndex) {
      0 => 'default',
      1 => 'disabled',
      2 => 'override',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a PromptAgentApiModelOutputBackupLlmConfig instance containing a \ElevenLabs\Types\BackupLlmDefault
   */
  public static function default(\ElevenLabs\Types\BackupLlmDefault $default): self
  {
    return new self($default, 0);
  }

  /**
   * Create a PromptAgentApiModelOutputBackupLlmConfig instance containing a \ElevenLabs\Types\BackupLlmDisabled
   */
  public static function disabled(\ElevenLabs\Types\BackupLlmDisabled $disabled): self
  {
    return new self($disabled, 1);
  }

  /**
   * Create a PromptAgentApiModelOutputBackupLlmConfig instance containing a \ElevenLabs\Types\BackupLlmOverride
   */
  public static function override(\ElevenLabs\Types\BackupLlmOverride $override): self
  {
    return new self($override, 2);
  }

  // Type checking methods
  /**
   * Check if this PromptAgentApiModelOutputBackupLlmConfig contains a \ElevenLabs\Types\BackupLlmDefault
   */
  public function isDefault_(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this PromptAgentApiModelOutputBackupLlmConfig contains a \ElevenLabs\Types\BackupLlmDisabled
   */
  public function isDisabled(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this PromptAgentApiModelOutputBackupLlmConfig contains a \ElevenLabs\Types\BackupLlmOverride
   */
  public function isOverride(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\BackupLlmDefault value
   * @throws \RuntimeException if this PromptAgentApiModelOutputBackupLlmConfig does not contain a \ElevenLabs\Types\BackupLlmDefault
   */
  public function asDefault_(): \ElevenLabs\Types\BackupLlmDefault
  {
    if (!$this->isDefault_()) {
      throw new \RuntimeException(
        'PromptAgentApiModelOutputBackupLlmConfig does not contain \ElevenLabs\Types\BackupLlmDefault'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\BackupLlmDisabled value
   * @throws \RuntimeException if this PromptAgentApiModelOutputBackupLlmConfig does not contain a \ElevenLabs\Types\BackupLlmDisabled
   */
  public function asDisabled(): \ElevenLabs\Types\BackupLlmDisabled
  {
    if (!$this->isDisabled()) {
      throw new \RuntimeException(
        'PromptAgentApiModelOutputBackupLlmConfig does not contain \ElevenLabs\Types\BackupLlmDisabled'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\BackupLlmOverride value
   * @throws \RuntimeException if this PromptAgentApiModelOutputBackupLlmConfig does not contain a \ElevenLabs\Types\BackupLlmOverride
   */
  public function asOverride(): \ElevenLabs\Types\BackupLlmOverride
  {
    if (!$this->isOverride()) {
      throw new \RuntimeException(
        'PromptAgentApiModelOutputBackupLlmConfig does not contain \ElevenLabs\Types\BackupLlmOverride'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\BackupLlmDefault value
   * @return \ElevenLabs\Types\BackupLlmDefault|null Returns the value if this PromptAgentApiModelOutputBackupLlmConfig contains a \ElevenLabs\Types\BackupLlmDefault, null otherwise
   */
  public function tryAsDefault_(): ?\ElevenLabs\Types\BackupLlmDefault
  {
    return $this->isDefault_() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\BackupLlmDisabled value
   * @return \ElevenLabs\Types\BackupLlmDisabled|null Returns the value if this PromptAgentApiModelOutputBackupLlmConfig contains a \ElevenLabs\Types\BackupLlmDisabled, null otherwise
   */
  public function tryAsDisabled(): ?\ElevenLabs\Types\BackupLlmDisabled
  {
    return $this->isDisabled() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\BackupLlmOverride value
   * @return \ElevenLabs\Types\BackupLlmOverride|null Returns the value if this PromptAgentApiModelOutputBackupLlmConfig contains a \ElevenLabs\Types\BackupLlmOverride, null otherwise
   */
  public function tryAsOverride(): ?\ElevenLabs\Types\BackupLlmOverride
  {
    return $this->isOverride() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\BackupLlmDefault): T $onDefault_
   * @param callable(\ElevenLabs\Types\BackupLlmDisabled): T $onDisabled
   * @param callable(\ElevenLabs\Types\BackupLlmOverride): T $onOverride
   * @return T
   */
  public function match(callable $onDefault_, callable $onDisabled, callable $onOverride): mixed
  {
    return match ($this->typeIndex) {
      0 => $onDefault_($this->value),
      1 => $onDisabled($this->value),
      2 => $onOverride($this->value),
      default => throw new \UnexpectedValueException("Unknown type index: $this->typeIndex")
    };
  }

  /**
   * Deserialize from data - try each type in order
   * @param array<string, mixed> $data
   * @return self
   * @throws \InvalidArgumentException if data doesn't match any type
   */
  public static function fromArray(array $data): self
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
    // The payload's own discriminator value picks the variant. Scoring alone ties whenever two
    // members have the same shape and differ only in that constant, and the first would win.
    if (is_array($data) && isset($data['preference']) && is_string($data['preference'])) {
      switch ($data['preference']) {
        case 'default':
          return new self(\ElevenLabs\Types\BackupLlmDefault::fromArray($data), 0);
        case 'disabled':
          return new self(\ElevenLabs\Types\BackupLlmDisabled::fromArray($data), 1);
        case 'override':
          return new self(\ElevenLabs\Types\BackupLlmOverride::fromArray($data), 2);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\BackupLlmDefault::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BackupLlmDefault didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\BackupLlmDisabled::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BackupLlmDisabled didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\BackupLlmOverride::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BackupLlmOverride didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any PromptAgentApiModelOutputBackupLlmConfig type'
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
   *
   * @return array<mixed>
   */
  public function jsonSerialize(): array
  {
    if ($this->_isUnknown()) {
      return $this->_asUnknown();
    }
    return $this->value->jsonSerialize();
  }
}
