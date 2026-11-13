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
class ConversationHistoryMetadataCommonModelPhoneCall extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel|\ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel|\ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this ConversationHistoryMetadataCommonModelPhoneCall holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'ConversationHistoryMetadataCommonModelPhoneCall does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel|\ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel|\ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'twilio',
      1 => 'exotel',
      2 => 'sip_trunking',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a ConversationHistoryMetadataCommonModelPhoneCall instance containing a \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel
   */
  public static function twilio(
    \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel $twilio
  ): self {
    return new self($twilio, 0);
  }

  /**
   * Create a ConversationHistoryMetadataCommonModelPhoneCall instance containing a \ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel
   */
  public static function exotel(
    \ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel $exotel
  ): self {
    return new self($exotel, 1);
  }

  /**
   * Create a ConversationHistoryMetadataCommonModelPhoneCall instance containing a \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel
   */
  public static function sipTrunking(
    \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel $sipTrunking
  ): self {
    return new self($sipTrunking, 2);
  }

  // Type checking methods
  /**
   * Check if this ConversationHistoryMetadataCommonModelPhoneCall contains a \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel
   */
  public function isTwilio(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ConversationHistoryMetadataCommonModelPhoneCall contains a \ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel
   */
  public function isExotel(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ConversationHistoryMetadataCommonModelPhoneCall contains a \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel
   */
  public function isSipTrunking(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel value
   * @throws \RuntimeException if this ConversationHistoryMetadataCommonModelPhoneCall does not contain a \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel
   */
  public function asTwilio(): \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel
  {
    if (!$this->isTwilio()) {
      throw new \RuntimeException(
        'ConversationHistoryMetadataCommonModelPhoneCall does not contain \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel value
   * @throws \RuntimeException if this ConversationHistoryMetadataCommonModelPhoneCall does not contain a \ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel
   */
  public function asExotel(): \ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel
  {
    if (!$this->isExotel()) {
      throw new \RuntimeException(
        'ConversationHistoryMetadataCommonModelPhoneCall does not contain \ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel value
   * @throws \RuntimeException if this ConversationHistoryMetadataCommonModelPhoneCall does not contain a \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel
   */
  public function asSipTrunking(): \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel
  {
    if (!$this->isSipTrunking()) {
      throw new \RuntimeException(
        'ConversationHistoryMetadataCommonModelPhoneCall does not contain \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel value
   * @return \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel|null Returns the value if this ConversationHistoryMetadataCommonModelPhoneCall contains a \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel, null otherwise
   */
  public function tryAsTwilio(): ?\ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel
  {
    return $this->isTwilio() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel value
   * @return \ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel|null Returns the value if this ConversationHistoryMetadataCommonModelPhoneCall contains a \ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel, null otherwise
   */
  public function tryAsExotel(): ?\ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel
  {
    return $this->isExotel() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel value
   * @return \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel|null Returns the value if this ConversationHistoryMetadataCommonModelPhoneCall contains a \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel, null otherwise
   */
  public function tryAsSipTrunking(): ?\ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel
  {
    return $this->isSipTrunking() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel): T $onTwilio
   * @param callable(\ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel): T $onExotel
   * @param callable(\ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel): T $onSipTrunking
   * @return T
   */
  public function match(callable $onTwilio, callable $onExotel, callable $onSipTrunking): mixed
  {
    return match ($this->typeIndex) {
      0 => $onTwilio($this->value),
      1 => $onExotel($this->value),
      2 => $onSipTrunking($this->value),
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
        case 'exotel':
          return new self(
            \ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel::fromArray($data),
            1
          );
        case 'sip_trunking':
          return new self(
            \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel::fromArray($data),
            2
          );
        case 'twilio':
          return new self(
            \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel::fromArray($data),
            0
          );
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistoryExotelPhoneCallModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any ConversationHistoryMetadataCommonModelPhoneCall type'
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
