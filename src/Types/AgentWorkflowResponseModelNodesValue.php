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
class AgentWorkflowResponseModelNodesValue extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\WorkflowStartNodeModelOutput|\ElevenLabs\Types\WorkflowEndNodeModelOutput|\ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput|\ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput|\ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput|\ElevenLabs\Types\WorkflowToolNodeModelOutput|\ElevenLabs\Types\WorkflowSayNodeModelOutput|\ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this AgentWorkflowResponseModelNodesValue holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'AgentWorkflowResponseModelNodesValue does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\WorkflowStartNodeModelOutput|\ElevenLabs\Types\WorkflowEndNodeModelOutput|\ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput|\ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput|\ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput|\ElevenLabs\Types\WorkflowToolNodeModelOutput|\ElevenLabs\Types\WorkflowSayNodeModelOutput|\ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'start',
      1 => 'end',
      2 => 'phone_number',
      3 => 'override_agent',
      4 => 'standalone_agent',
      5 => 'tool',
      6 => 'say',
      7 => 'update_state',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a AgentWorkflowResponseModelNodesValue instance containing a \ElevenLabs\Types\WorkflowStartNodeModelOutput
   */
  public static function start(\ElevenLabs\Types\WorkflowStartNodeModelOutput $start): self
  {
    return new self($start, 0);
  }

  /**
   * Create a AgentWorkflowResponseModelNodesValue instance containing a \ElevenLabs\Types\WorkflowEndNodeModelOutput
   */
  public static function end(\ElevenLabs\Types\WorkflowEndNodeModelOutput $end): self
  {
    return new self($end, 1);
  }

  /**
   * Create a AgentWorkflowResponseModelNodesValue instance containing a \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput
   */
  public static function phoneNumber(
    \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput $phoneNumber
  ): self {
    return new self($phoneNumber, 2);
  }

  /**
   * Create a AgentWorkflowResponseModelNodesValue instance containing a \ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput
   */
  public static function overrideAgent(
    \ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput $overrideAgent
  ): self {
    return new self($overrideAgent, 3);
  }

  /**
   * Create a AgentWorkflowResponseModelNodesValue instance containing a \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput
   */
  public static function standaloneAgent(
    \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput $standaloneAgent
  ): self {
    return new self($standaloneAgent, 4);
  }

  /**
   * Create a AgentWorkflowResponseModelNodesValue instance containing a \ElevenLabs\Types\WorkflowToolNodeModelOutput
   */
  public static function tool(\ElevenLabs\Types\WorkflowToolNodeModelOutput $tool): self
  {
    return new self($tool, 5);
  }

  /**
   * Create a AgentWorkflowResponseModelNodesValue instance containing a \ElevenLabs\Types\WorkflowSayNodeModelOutput
   */
  public static function say(\ElevenLabs\Types\WorkflowSayNodeModelOutput $say): self
  {
    return new self($say, 6);
  }

  /**
   * Create a AgentWorkflowResponseModelNodesValue instance containing a \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput
   */
  public static function updateState(
    \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput $updateState
  ): self {
    return new self($updateState, 7);
  }

  // Type checking methods
  /**
   * Check if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowStartNodeModelOutput
   */
  public function isStart(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowEndNodeModelOutput
   */
  public function isEnd(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput
   */
  public function isPhoneNumber(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput
   */
  public function isOverrideAgent(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput
   */
  public function isStandaloneAgent(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowToolNodeModelOutput
   */
  public function isTool(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowSayNodeModelOutput
   */
  public function isSay(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput
   */
  public function isUpdateState(): bool
  {
    return $this->typeIndex === 7;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\WorkflowStartNodeModelOutput value
   * @throws \RuntimeException if this AgentWorkflowResponseModelNodesValue does not contain a \ElevenLabs\Types\WorkflowStartNodeModelOutput
   */
  public function asStart(): \ElevenLabs\Types\WorkflowStartNodeModelOutput
  {
    if (!$this->isStart()) {
      throw new \RuntimeException(
        'AgentWorkflowResponseModelNodesValue does not contain \ElevenLabs\Types\WorkflowStartNodeModelOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowEndNodeModelOutput value
   * @throws \RuntimeException if this AgentWorkflowResponseModelNodesValue does not contain a \ElevenLabs\Types\WorkflowEndNodeModelOutput
   */
  public function asEnd(): \ElevenLabs\Types\WorkflowEndNodeModelOutput
  {
    if (!$this->isEnd()) {
      throw new \RuntimeException(
        'AgentWorkflowResponseModelNodesValue does not contain \ElevenLabs\Types\WorkflowEndNodeModelOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput value
   * @throws \RuntimeException if this AgentWorkflowResponseModelNodesValue does not contain a \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput
   */
  public function asPhoneNumber(): \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput
  {
    if (!$this->isPhoneNumber()) {
      throw new \RuntimeException(
        'AgentWorkflowResponseModelNodesValue does not contain \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput value
   * @throws \RuntimeException if this AgentWorkflowResponseModelNodesValue does not contain a \ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput
   */
  public function asOverrideAgent(): \ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput
  {
    if (!$this->isOverrideAgent()) {
      throw new \RuntimeException(
        'AgentWorkflowResponseModelNodesValue does not contain \ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput value
   * @throws \RuntimeException if this AgentWorkflowResponseModelNodesValue does not contain a \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput
   */
  public function asStandaloneAgent(): \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput
  {
    if (!$this->isStandaloneAgent()) {
      throw new \RuntimeException(
        'AgentWorkflowResponseModelNodesValue does not contain \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowToolNodeModelOutput value
   * @throws \RuntimeException if this AgentWorkflowResponseModelNodesValue does not contain a \ElevenLabs\Types\WorkflowToolNodeModelOutput
   */
  public function asTool(): \ElevenLabs\Types\WorkflowToolNodeModelOutput
  {
    if (!$this->isTool()) {
      throw new \RuntimeException(
        'AgentWorkflowResponseModelNodesValue does not contain \ElevenLabs\Types\WorkflowToolNodeModelOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowSayNodeModelOutput value
   * @throws \RuntimeException if this AgentWorkflowResponseModelNodesValue does not contain a \ElevenLabs\Types\WorkflowSayNodeModelOutput
   */
  public function asSay(): \ElevenLabs\Types\WorkflowSayNodeModelOutput
  {
    if (!$this->isSay()) {
      throw new \RuntimeException(
        'AgentWorkflowResponseModelNodesValue does not contain \ElevenLabs\Types\WorkflowSayNodeModelOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput value
   * @throws \RuntimeException if this AgentWorkflowResponseModelNodesValue does not contain a \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput
   */
  public function asUpdateState(): \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput
  {
    if (!$this->isUpdateState()) {
      throw new \RuntimeException(
        'AgentWorkflowResponseModelNodesValue does not contain \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\WorkflowStartNodeModelOutput value
   * @return \ElevenLabs\Types\WorkflowStartNodeModelOutput|null Returns the value if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowStartNodeModelOutput, null otherwise
   */
  public function tryAsStart(): ?\ElevenLabs\Types\WorkflowStartNodeModelOutput
  {
    return $this->isStart() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowEndNodeModelOutput value
   * @return \ElevenLabs\Types\WorkflowEndNodeModelOutput|null Returns the value if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowEndNodeModelOutput, null otherwise
   */
  public function tryAsEnd(): ?\ElevenLabs\Types\WorkflowEndNodeModelOutput
  {
    return $this->isEnd() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput value
   * @return \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput|null Returns the value if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput, null otherwise
   */
  public function tryAsPhoneNumber(): ?\ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput
  {
    return $this->isPhoneNumber() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput value
   * @return \ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput|null Returns the value if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput, null otherwise
   */
  public function tryAsOverrideAgent(): ?\ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput
  {
    return $this->isOverrideAgent() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput value
   * @return \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput|null Returns the value if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput, null otherwise
   */
  public function tryAsStandaloneAgent(): ?\ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput
  {
    return $this->isStandaloneAgent() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowToolNodeModelOutput value
   * @return \ElevenLabs\Types\WorkflowToolNodeModelOutput|null Returns the value if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowToolNodeModelOutput, null otherwise
   */
  public function tryAsTool(): ?\ElevenLabs\Types\WorkflowToolNodeModelOutput
  {
    return $this->isTool() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowSayNodeModelOutput value
   * @return \ElevenLabs\Types\WorkflowSayNodeModelOutput|null Returns the value if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowSayNodeModelOutput, null otherwise
   */
  public function tryAsSay(): ?\ElevenLabs\Types\WorkflowSayNodeModelOutput
  {
    return $this->isSay() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput value
   * @return \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput|null Returns the value if this AgentWorkflowResponseModelNodesValue contains a \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput, null otherwise
   */
  public function tryAsUpdateState(): ?\ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput
  {
    return $this->isUpdateState() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\WorkflowStartNodeModelOutput): T $onStart
   * @param callable(\ElevenLabs\Types\WorkflowEndNodeModelOutput): T $onEnd
   * @param callable(\ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput): T $onPhoneNumber
   * @param callable(\ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput): T $onOverrideAgent
   * @param callable(\ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput): T $onStandaloneAgent
   * @param callable(\ElevenLabs\Types\WorkflowToolNodeModelOutput): T $onTool
   * @param callable(\ElevenLabs\Types\WorkflowSayNodeModelOutput): T $onSay
   * @param callable(\ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput): T $onUpdateState
   * @return T
   */
  public function match(
    callable $onStart,
    callable $onEnd,
    callable $onPhoneNumber,
    callable $onOverrideAgent,
    callable $onStandaloneAgent,
    callable $onTool,
    callable $onSay,
    callable $onUpdateState
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onStart($this->value),
      1 => $onEnd($this->value),
      2 => $onPhoneNumber($this->value),
      3 => $onOverrideAgent($this->value),
      4 => $onStandaloneAgent($this->value),
      5 => $onTool($this->value),
      6 => $onSay($this->value),
      7 => $onUpdateState($this->value),
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
    if (is_array($data) && isset($data['type']) && is_string($data['type'])) {
      switch ($data['type']) {
        case 'end':
          return new self(\ElevenLabs\Types\WorkflowEndNodeModelOutput::fromArray($data), 1);
        case 'override_agent':
          return new self(
            \ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput::fromArray($data),
            3
          );
        case 'phone_number':
          return new self(
            \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput::fromArray($data),
            2
          );
        case 'standalone_agent':
          return new self(
            \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput::fromArray($data),
            4
          );
        case 'start':
          return new self(\ElevenLabs\Types\WorkflowStartNodeModelOutput::fromArray($data), 0);
        case 'tool':
          return new self(\ElevenLabs\Types\WorkflowToolNodeModelOutput::fromArray($data), 5);
        case 'say':
          return new self(\ElevenLabs\Types\WorkflowSayNodeModelOutput::fromArray($data), 6);
        case 'update_state':
          return new self(
            \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput::fromArray($data),
            7
          );
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\WorkflowStartNodeModelOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowStartNodeModelOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowEndNodeModelOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowEndNodeModelOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowToolNodeModelOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowToolNodeModelOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowSayNodeModelOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowSayNodeModelOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowUpdateStateNodeModelOutput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any AgentWorkflowResponseModelNodesValue type'
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
