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
class PhoneNumberTransferTransferDestination extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\PhoneNumberTransferDestination|\ElevenLabs\Types\SipUriTransferDestination|\ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination|\ElevenLabs\Types\SipUriDynamicVariableTransferDestination|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this PhoneNumberTransferTransferDestination holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'PhoneNumberTransferTransferDestination does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\PhoneNumberTransferDestination|\ElevenLabs\Types\SipUriTransferDestination|\ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination|\ElevenLabs\Types\SipUriDynamicVariableTransferDestination|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'phone',
      1 => 'sip_uri',
      2 => 'phone_dynamic_variable',
      3 => 'sip_uri_dynamic_variable',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a PhoneNumberTransferTransferDestination instance containing a \ElevenLabs\Types\PhoneNumberTransferDestination
   */
  public static function phone(\ElevenLabs\Types\PhoneNumberTransferDestination $phone): self
  {
    return new self($phone, 0);
  }

  /**
   * Create a PhoneNumberTransferTransferDestination instance containing a \ElevenLabs\Types\SipUriTransferDestination
   */
  public static function sipUri(\ElevenLabs\Types\SipUriTransferDestination $sipUri): self
  {
    return new self($sipUri, 1);
  }

  /**
   * Create a PhoneNumberTransferTransferDestination instance containing a \ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination
   */
  public static function phoneDynamicVariable(
    \ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination $phoneDynamicVariable
  ): self {
    return new self($phoneDynamicVariable, 2);
  }

  /**
   * Create a PhoneNumberTransferTransferDestination instance containing a \ElevenLabs\Types\SipUriDynamicVariableTransferDestination
   */
  public static function sipUriDynamicVariable(
    \ElevenLabs\Types\SipUriDynamicVariableTransferDestination $sipUriDynamicVariable
  ): self {
    return new self($sipUriDynamicVariable, 3);
  }

  // Type checking methods
  /**
   * Check if this PhoneNumberTransferTransferDestination contains a \ElevenLabs\Types\PhoneNumberTransferDestination
   */
  public function isPhone(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this PhoneNumberTransferTransferDestination contains a \ElevenLabs\Types\SipUriTransferDestination
   */
  public function isSipUri(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this PhoneNumberTransferTransferDestination contains a \ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination
   */
  public function isPhoneDynamicVariable(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this PhoneNumberTransferTransferDestination contains a \ElevenLabs\Types\SipUriDynamicVariableTransferDestination
   */
  public function isSipUriDynamicVariable(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\PhoneNumberTransferDestination value
   * @throws \RuntimeException if this PhoneNumberTransferTransferDestination does not contain a \ElevenLabs\Types\PhoneNumberTransferDestination
   */
  public function asPhone(): \ElevenLabs\Types\PhoneNumberTransferDestination
  {
    if (!$this->isPhone()) {
      throw new \RuntimeException(
        'PhoneNumberTransferTransferDestination does not contain \ElevenLabs\Types\PhoneNumberTransferDestination'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SipUriTransferDestination value
   * @throws \RuntimeException if this PhoneNumberTransferTransferDestination does not contain a \ElevenLabs\Types\SipUriTransferDestination
   */
  public function asSipUri(): \ElevenLabs\Types\SipUriTransferDestination
  {
    if (!$this->isSipUri()) {
      throw new \RuntimeException(
        'PhoneNumberTransferTransferDestination does not contain \ElevenLabs\Types\SipUriTransferDestination'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination value
   * @throws \RuntimeException if this PhoneNumberTransferTransferDestination does not contain a \ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination
   */
  public function asPhoneDynamicVariable(): \ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination
  {
    if (!$this->isPhoneDynamicVariable()) {
      throw new \RuntimeException(
        'PhoneNumberTransferTransferDestination does not contain \ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SipUriDynamicVariableTransferDestination value
   * @throws \RuntimeException if this PhoneNumberTransferTransferDestination does not contain a \ElevenLabs\Types\SipUriDynamicVariableTransferDestination
   */
  public function asSipUriDynamicVariable(): \ElevenLabs\Types\SipUriDynamicVariableTransferDestination
  {
    if (!$this->isSipUriDynamicVariable()) {
      throw new \RuntimeException(
        'PhoneNumberTransferTransferDestination does not contain \ElevenLabs\Types\SipUriDynamicVariableTransferDestination'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\PhoneNumberTransferDestination value
   * @return \ElevenLabs\Types\PhoneNumberTransferDestination|null Returns the value if this PhoneNumberTransferTransferDestination contains a \ElevenLabs\Types\PhoneNumberTransferDestination, null otherwise
   */
  public function tryAsPhone(): ?\ElevenLabs\Types\PhoneNumberTransferDestination
  {
    return $this->isPhone() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SipUriTransferDestination value
   * @return \ElevenLabs\Types\SipUriTransferDestination|null Returns the value if this PhoneNumberTransferTransferDestination contains a \ElevenLabs\Types\SipUriTransferDestination, null otherwise
   */
  public function tryAsSipUri(): ?\ElevenLabs\Types\SipUriTransferDestination
  {
    return $this->isSipUri() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination value
   * @return \ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination|null Returns the value if this PhoneNumberTransferTransferDestination contains a \ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination, null otherwise
   */
  public function tryAsPhoneDynamicVariable(): ?\ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination
  {
    return $this->isPhoneDynamicVariable() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SipUriDynamicVariableTransferDestination value
   * @return \ElevenLabs\Types\SipUriDynamicVariableTransferDestination|null Returns the value if this PhoneNumberTransferTransferDestination contains a \ElevenLabs\Types\SipUriDynamicVariableTransferDestination, null otherwise
   */
  public function tryAsSipUriDynamicVariable(): ?\ElevenLabs\Types\SipUriDynamicVariableTransferDestination
  {
    return $this->isSipUriDynamicVariable() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\PhoneNumberTransferDestination): T $onPhone
   * @param callable(\ElevenLabs\Types\SipUriTransferDestination): T $onSipUri
   * @param callable(\ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination): T $onPhoneDynamicVariable
   * @param callable(\ElevenLabs\Types\SipUriDynamicVariableTransferDestination): T $onSipUriDynamicVariable
   * @return T
   */
  public function match(
    callable $onPhone,
    callable $onSipUri,
    callable $onPhoneDynamicVariable,
    callable $onSipUriDynamicVariable
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onPhone($this->value),
      1 => $onSipUri($this->value),
      2 => $onPhoneDynamicVariable($this->value),
      3 => $onSipUriDynamicVariable($this->value),
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
        case 'phone':
          return new self(\ElevenLabs\Types\PhoneNumberTransferDestination::fromArray($data), 0);
        case 'phone_dynamic_variable':
          return new self(
            \ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination::fromArray($data),
            2
          );
        case 'sip_uri':
          return new self(\ElevenLabs\Types\SipUriTransferDestination::fromArray($data), 1);
        case 'sip_uri_dynamic_variable':
          return new self(
            \ElevenLabs\Types\SipUriDynamicVariableTransferDestination::fromArray($data),
            3
          );
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\PhoneNumberTransferDestination::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PhoneNumberTransferDestination didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SipUriTransferDestination::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SipUriTransferDestination didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination::fromArray(
        $data
      );
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PhoneNumberDynamicVariableTransferDestination didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SipUriDynamicVariableTransferDestination::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SipUriDynamicVariableTransferDestination didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any PhoneNumberTransferTransferDestination type'
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
