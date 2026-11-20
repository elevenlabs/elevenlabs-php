<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Types;

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
class SendConversationMessageStreamRequestInputItem extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\UserMessageInputItem|\ElevenLabs\Types\ClientToolResultItem|\ElevenLabs\Types\ContextualUpdateInputItem|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this SendConversationMessageStreamRequestInputItem holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'SendConversationMessageStreamRequestInputItem does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\UserMessageInputItem|\ElevenLabs\Types\ClientToolResultItem|\ElevenLabs\Types\ContextualUpdateInputItem|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'user_message',
      1 => 'client_tool_result',
      2 => 'contextual_update',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a SendConversationMessageStreamRequestInputItem instance containing a \ElevenLabs\Types\UserMessageInputItem
   */
  public static function userMessage(\ElevenLabs\Types\UserMessageInputItem $userMessage): self
  {
    return new self($userMessage, 0);
  }

  /**
   * Create a SendConversationMessageStreamRequestInputItem instance containing a \ElevenLabs\Types\ClientToolResultItem
   */
  public static function clientToolResult(
    \ElevenLabs\Types\ClientToolResultItem $clientToolResult
  ): self {
    return new self($clientToolResult, 1);
  }

  /**
   * Create a SendConversationMessageStreamRequestInputItem instance containing a \ElevenLabs\Types\ContextualUpdateInputItem
   */
  public static function contextualUpdate(
    \ElevenLabs\Types\ContextualUpdateInputItem $contextualUpdate
  ): self {
    return new self($contextualUpdate, 2);
  }

  // Type checking methods
  /**
   * Check if this SendConversationMessageStreamRequestInputItem contains a \ElevenLabs\Types\UserMessageInputItem
   */
  public function isUserMessage(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this SendConversationMessageStreamRequestInputItem contains a \ElevenLabs\Types\ClientToolResultItem
   */
  public function isClientToolResult(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this SendConversationMessageStreamRequestInputItem contains a \ElevenLabs\Types\ContextualUpdateInputItem
   */
  public function isContextualUpdate(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\UserMessageInputItem value
   * @throws \RuntimeException if this SendConversationMessageStreamRequestInputItem does not contain a \ElevenLabs\Types\UserMessageInputItem
   */
  public function asUserMessage(): \ElevenLabs\Types\UserMessageInputItem
  {
    if (!$this->isUserMessage()) {
      throw new \RuntimeException(
        'SendConversationMessageStreamRequestInputItem does not contain \ElevenLabs\Types\UserMessageInputItem'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ClientToolResultItem value
   * @throws \RuntimeException if this SendConversationMessageStreamRequestInputItem does not contain a \ElevenLabs\Types\ClientToolResultItem
   */
  public function asClientToolResult(): \ElevenLabs\Types\ClientToolResultItem
  {
    if (!$this->isClientToolResult()) {
      throw new \RuntimeException(
        'SendConversationMessageStreamRequestInputItem does not contain \ElevenLabs\Types\ClientToolResultItem'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ContextualUpdateInputItem value
   * @throws \RuntimeException if this SendConversationMessageStreamRequestInputItem does not contain a \ElevenLabs\Types\ContextualUpdateInputItem
   */
  public function asContextualUpdate(): \ElevenLabs\Types\ContextualUpdateInputItem
  {
    if (!$this->isContextualUpdate()) {
      throw new \RuntimeException(
        'SendConversationMessageStreamRequestInputItem does not contain \ElevenLabs\Types\ContextualUpdateInputItem'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\UserMessageInputItem value
   * @return \ElevenLabs\Types\UserMessageInputItem|null Returns the value if this SendConversationMessageStreamRequestInputItem contains a \ElevenLabs\Types\UserMessageInputItem, null otherwise
   */
  public function tryAsUserMessage(): ?\ElevenLabs\Types\UserMessageInputItem
  {
    return $this->isUserMessage() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ClientToolResultItem value
   * @return \ElevenLabs\Types\ClientToolResultItem|null Returns the value if this SendConversationMessageStreamRequestInputItem contains a \ElevenLabs\Types\ClientToolResultItem, null otherwise
   */
  public function tryAsClientToolResult(): ?\ElevenLabs\Types\ClientToolResultItem
  {
    return $this->isClientToolResult() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ContextualUpdateInputItem value
   * @return \ElevenLabs\Types\ContextualUpdateInputItem|null Returns the value if this SendConversationMessageStreamRequestInputItem contains a \ElevenLabs\Types\ContextualUpdateInputItem, null otherwise
   */
  public function tryAsContextualUpdate(): ?\ElevenLabs\Types\ContextualUpdateInputItem
  {
    return $this->isContextualUpdate() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\UserMessageInputItem): T $onUserMessage
   * @param callable(\ElevenLabs\Types\ClientToolResultItem): T $onClientToolResult
   * @param callable(\ElevenLabs\Types\ContextualUpdateInputItem): T $onContextualUpdate
   * @return T
   */
  public function match(
    callable $onUserMessage,
    callable $onClientToolResult,
    callable $onContextualUpdate
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onUserMessage($this->value),
      1 => $onClientToolResult($this->value),
      2 => $onContextualUpdate($this->value),
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
        case 'client_tool_result':
          return new self(\ElevenLabs\Types\ClientToolResultItem::fromArray($data), 1);
        case 'contextual_update':
          return new self(\ElevenLabs\Types\ContextualUpdateInputItem::fromArray($data), 2);
        case 'user_message':
          return new self(\ElevenLabs\Types\UserMessageInputItem::fromArray($data), 0);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\UserMessageInputItem::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UserMessageInputItem didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ClientToolResultItem::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ClientToolResultItem didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ContextualUpdateInputItem::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ContextualUpdateInputItem didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any SendConversationMessageStreamRequestInputItem type'
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
