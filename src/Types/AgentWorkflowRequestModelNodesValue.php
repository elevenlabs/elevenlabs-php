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
class AgentWorkflowRequestModelNodesValue extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\WorkflowStartNodeModelInput|\ElevenLabs\Types\WorkflowEndNodeModelInput|\ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput|\ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput|\ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput|\ElevenLabs\Types\WorkflowToolNodeModelInput|\ElevenLabs\Types\WorkflowSayNodeModelInput|\ElevenLabs\Types\WorkflowUpdateStateNodeModelInput|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this AgentWorkflowRequestModelNodesValue holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'AgentWorkflowRequestModelNodesValue does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\WorkflowStartNodeModelInput|\ElevenLabs\Types\WorkflowEndNodeModelInput|\ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput|\ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput|\ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput|\ElevenLabs\Types\WorkflowToolNodeModelInput|\ElevenLabs\Types\WorkflowSayNodeModelInput|\ElevenLabs\Types\WorkflowUpdateStateNodeModelInput|array<string, mixed> $value
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
   * Create a AgentWorkflowRequestModelNodesValue instance containing a \ElevenLabs\Types\WorkflowStartNodeModelInput
   */
  public static function start(\ElevenLabs\Types\WorkflowStartNodeModelInput $start): self
  {
    return new self($start, 0);
  }

  /**
   * Create a AgentWorkflowRequestModelNodesValue instance containing a \ElevenLabs\Types\WorkflowEndNodeModelInput
   */
  public static function end(\ElevenLabs\Types\WorkflowEndNodeModelInput $end): self
  {
    return new self($end, 1);
  }

  /**
   * Create a AgentWorkflowRequestModelNodesValue instance containing a \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput
   */
  public static function phoneNumber(
    \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput $phoneNumber
  ): self {
    return new self($phoneNumber, 2);
  }

  /**
   * Create a AgentWorkflowRequestModelNodesValue instance containing a \ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput
   */
  public static function overrideAgent(
    \ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput $overrideAgent
  ): self {
    return new self($overrideAgent, 3);
  }

  /**
   * Create a AgentWorkflowRequestModelNodesValue instance containing a \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput
   */
  public static function standaloneAgent(
    \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput $standaloneAgent
  ): self {
    return new self($standaloneAgent, 4);
  }

  /**
   * Create a AgentWorkflowRequestModelNodesValue instance containing a \ElevenLabs\Types\WorkflowToolNodeModelInput
   */
  public static function tool(\ElevenLabs\Types\WorkflowToolNodeModelInput $tool): self
  {
    return new self($tool, 5);
  }

  /**
   * Create a AgentWorkflowRequestModelNodesValue instance containing a \ElevenLabs\Types\WorkflowSayNodeModelInput
   */
  public static function say(\ElevenLabs\Types\WorkflowSayNodeModelInput $say): self
  {
    return new self($say, 6);
  }

  /**
   * Create a AgentWorkflowRequestModelNodesValue instance containing a \ElevenLabs\Types\WorkflowUpdateStateNodeModelInput
   */
  public static function updateState(
    \ElevenLabs\Types\WorkflowUpdateStateNodeModelInput $updateState
  ): self {
    return new self($updateState, 7);
  }

  // Type checking methods
  /**
   * Check if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowStartNodeModelInput
   */
  public function isStart(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowEndNodeModelInput
   */
  public function isEnd(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput
   */
  public function isPhoneNumber(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput
   */
  public function isOverrideAgent(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput
   */
  public function isStandaloneAgent(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowToolNodeModelInput
   */
  public function isTool(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowSayNodeModelInput
   */
  public function isSay(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowUpdateStateNodeModelInput
   */
  public function isUpdateState(): bool
  {
    return $this->typeIndex === 7;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\WorkflowStartNodeModelInput value
   * @throws \RuntimeException if this AgentWorkflowRequestModelNodesValue does not contain a \ElevenLabs\Types\WorkflowStartNodeModelInput
   */
  public function asStart(): \ElevenLabs\Types\WorkflowStartNodeModelInput
  {
    if (!$this->isStart()) {
      throw new \RuntimeException(
        'AgentWorkflowRequestModelNodesValue does not contain \ElevenLabs\Types\WorkflowStartNodeModelInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowEndNodeModelInput value
   * @throws \RuntimeException if this AgentWorkflowRequestModelNodesValue does not contain a \ElevenLabs\Types\WorkflowEndNodeModelInput
   */
  public function asEnd(): \ElevenLabs\Types\WorkflowEndNodeModelInput
  {
    if (!$this->isEnd()) {
      throw new \RuntimeException(
        'AgentWorkflowRequestModelNodesValue does not contain \ElevenLabs\Types\WorkflowEndNodeModelInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput value
   * @throws \RuntimeException if this AgentWorkflowRequestModelNodesValue does not contain a \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput
   */
  public function asPhoneNumber(): \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput
  {
    if (!$this->isPhoneNumber()) {
      throw new \RuntimeException(
        'AgentWorkflowRequestModelNodesValue does not contain \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput value
   * @throws \RuntimeException if this AgentWorkflowRequestModelNodesValue does not contain a \ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput
   */
  public function asOverrideAgent(): \ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput
  {
    if (!$this->isOverrideAgent()) {
      throw new \RuntimeException(
        'AgentWorkflowRequestModelNodesValue does not contain \ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput value
   * @throws \RuntimeException if this AgentWorkflowRequestModelNodesValue does not contain a \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput
   */
  public function asStandaloneAgent(): \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput
  {
    if (!$this->isStandaloneAgent()) {
      throw new \RuntimeException(
        'AgentWorkflowRequestModelNodesValue does not contain \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowToolNodeModelInput value
   * @throws \RuntimeException if this AgentWorkflowRequestModelNodesValue does not contain a \ElevenLabs\Types\WorkflowToolNodeModelInput
   */
  public function asTool(): \ElevenLabs\Types\WorkflowToolNodeModelInput
  {
    if (!$this->isTool()) {
      throw new \RuntimeException(
        'AgentWorkflowRequestModelNodesValue does not contain \ElevenLabs\Types\WorkflowToolNodeModelInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowSayNodeModelInput value
   * @throws \RuntimeException if this AgentWorkflowRequestModelNodesValue does not contain a \ElevenLabs\Types\WorkflowSayNodeModelInput
   */
  public function asSay(): \ElevenLabs\Types\WorkflowSayNodeModelInput
  {
    if (!$this->isSay()) {
      throw new \RuntimeException(
        'AgentWorkflowRequestModelNodesValue does not contain \ElevenLabs\Types\WorkflowSayNodeModelInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowUpdateStateNodeModelInput value
   * @throws \RuntimeException if this AgentWorkflowRequestModelNodesValue does not contain a \ElevenLabs\Types\WorkflowUpdateStateNodeModelInput
   */
  public function asUpdateState(): \ElevenLabs\Types\WorkflowUpdateStateNodeModelInput
  {
    if (!$this->isUpdateState()) {
      throw new \RuntimeException(
        'AgentWorkflowRequestModelNodesValue does not contain \ElevenLabs\Types\WorkflowUpdateStateNodeModelInput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\WorkflowStartNodeModelInput value
   * @return \ElevenLabs\Types\WorkflowStartNodeModelInput|null Returns the value if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowStartNodeModelInput, null otherwise
   */
  public function tryAsStart(): ?\ElevenLabs\Types\WorkflowStartNodeModelInput
  {
    return $this->isStart() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowEndNodeModelInput value
   * @return \ElevenLabs\Types\WorkflowEndNodeModelInput|null Returns the value if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowEndNodeModelInput, null otherwise
   */
  public function tryAsEnd(): ?\ElevenLabs\Types\WorkflowEndNodeModelInput
  {
    return $this->isEnd() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput value
   * @return \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput|null Returns the value if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput, null otherwise
   */
  public function tryAsPhoneNumber(): ?\ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput
  {
    return $this->isPhoneNumber() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput value
   * @return \ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput|null Returns the value if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput, null otherwise
   */
  public function tryAsOverrideAgent(): ?\ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput
  {
    return $this->isOverrideAgent() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput value
   * @return \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput|null Returns the value if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput, null otherwise
   */
  public function tryAsStandaloneAgent(): ?\ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput
  {
    return $this->isStandaloneAgent() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowToolNodeModelInput value
   * @return \ElevenLabs\Types\WorkflowToolNodeModelInput|null Returns the value if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowToolNodeModelInput, null otherwise
   */
  public function tryAsTool(): ?\ElevenLabs\Types\WorkflowToolNodeModelInput
  {
    return $this->isTool() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowSayNodeModelInput value
   * @return \ElevenLabs\Types\WorkflowSayNodeModelInput|null Returns the value if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowSayNodeModelInput, null otherwise
   */
  public function tryAsSay(): ?\ElevenLabs\Types\WorkflowSayNodeModelInput
  {
    return $this->isSay() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowUpdateStateNodeModelInput value
   * @return \ElevenLabs\Types\WorkflowUpdateStateNodeModelInput|null Returns the value if this AgentWorkflowRequestModelNodesValue contains a \ElevenLabs\Types\WorkflowUpdateStateNodeModelInput, null otherwise
   */
  public function tryAsUpdateState(): ?\ElevenLabs\Types\WorkflowUpdateStateNodeModelInput
  {
    return $this->isUpdateState() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\WorkflowStartNodeModelInput): T $onStart
   * @param callable(\ElevenLabs\Types\WorkflowEndNodeModelInput): T $onEnd
   * @param callable(\ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput): T $onPhoneNumber
   * @param callable(\ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput): T $onOverrideAgent
   * @param callable(\ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput): T $onStandaloneAgent
   * @param callable(\ElevenLabs\Types\WorkflowToolNodeModelInput): T $onTool
   * @param callable(\ElevenLabs\Types\WorkflowSayNodeModelInput): T $onSay
   * @param callable(\ElevenLabs\Types\WorkflowUpdateStateNodeModelInput): T $onUpdateState
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
          return new self(\ElevenLabs\Types\WorkflowEndNodeModelInput::fromArray($data), 1);
        case 'override_agent':
          return new self(
            \ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput::fromArray($data),
            3
          );
        case 'phone_number':
          return new self(\ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput::fromArray($data), 2);
        case 'standalone_agent':
          return new self(
            \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput::fromArray($data),
            4
          );
        case 'start':
          return new self(\ElevenLabs\Types\WorkflowStartNodeModelInput::fromArray($data), 0);
        case 'tool':
          return new self(\ElevenLabs\Types\WorkflowToolNodeModelInput::fromArray($data), 5);
        case 'say':
          return new self(\ElevenLabs\Types\WorkflowSayNodeModelInput::fromArray($data), 6);
        case 'update_state':
          return new self(\ElevenLabs\Types\WorkflowUpdateStateNodeModelInput::fromArray($data), 7);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\WorkflowStartNodeModelInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowStartNodeModelInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowEndNodeModelInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowEndNodeModelInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowOverrideAgentNodeModelInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowToolNodeModelInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowToolNodeModelInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowSayNodeModelInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowSayNodeModelInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowUpdateStateNodeModelInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowUpdateStateNodeModelInput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any AgentWorkflowRequestModelNodesValue type'
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
