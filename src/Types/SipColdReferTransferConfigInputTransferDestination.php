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
class SipColdReferTransferConfigInputTransferDestination extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\PhoneDestinationInput|\ElevenLabs\Types\SipUriDestinationInput|\ElevenLabs\Types\PhoneDynamicVariableDestinationInput|\ElevenLabs\Types\SipUriDynamicVariableDestinationInput|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this SipColdReferTransferConfigInputTransferDestination holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'SipColdReferTransferConfigInputTransferDestination does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\PhoneDestinationInput|\ElevenLabs\Types\SipUriDestinationInput|\ElevenLabs\Types\PhoneDynamicVariableDestinationInput|\ElevenLabs\Types\SipUriDynamicVariableDestinationInput|array<string, mixed> $value
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
   * Create a SipColdReferTransferConfigInputTransferDestination instance containing a \ElevenLabs\Types\PhoneDestinationInput
   */
  public static function phone(\ElevenLabs\Types\PhoneDestinationInput $phone): self
  {
    return new self($phone, 0);
  }

  /**
   * Create a SipColdReferTransferConfigInputTransferDestination instance containing a \ElevenLabs\Types\SipUriDestinationInput
   */
  public static function sipUri(\ElevenLabs\Types\SipUriDestinationInput $sipUri): self
  {
    return new self($sipUri, 1);
  }

  /**
   * Create a SipColdReferTransferConfigInputTransferDestination instance containing a \ElevenLabs\Types\PhoneDynamicVariableDestinationInput
   */
  public static function phoneDynamicVariable(
    \ElevenLabs\Types\PhoneDynamicVariableDestinationInput $phoneDynamicVariable
  ): self {
    return new self($phoneDynamicVariable, 2);
  }

  /**
   * Create a SipColdReferTransferConfigInputTransferDestination instance containing a \ElevenLabs\Types\SipUriDynamicVariableDestinationInput
   */
  public static function sipUriDynamicVariable(
    \ElevenLabs\Types\SipUriDynamicVariableDestinationInput $sipUriDynamicVariable
  ): self {
    return new self($sipUriDynamicVariable, 3);
  }

  // Type checking methods
  /**
   * Check if this SipColdReferTransferConfigInputTransferDestination contains a \ElevenLabs\Types\PhoneDestinationInput
   */
  public function isPhone(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this SipColdReferTransferConfigInputTransferDestination contains a \ElevenLabs\Types\SipUriDestinationInput
   */
  public function isSipUri(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this SipColdReferTransferConfigInputTransferDestination contains a \ElevenLabs\Types\PhoneDynamicVariableDestinationInput
   */
  public function isPhoneDynamicVariable(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this SipColdReferTransferConfigInputTransferDestination contains a \ElevenLabs\Types\SipUriDynamicVariableDestinationInput
   */
  public function isSipUriDynamicVariable(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\PhoneDestinationInput value
   * @throws \RuntimeException if this SipColdReferTransferConfigInputTransferDestination does not contain a \ElevenLabs\Types\PhoneDestinationInput
   */
  public function asPhone(): \ElevenLabs\Types\PhoneDestinationInput
  {
    if (!$this->isPhone()) {
      throw new \RuntimeException(
        'SipColdReferTransferConfigInputTransferDestination does not contain \ElevenLabs\Types\PhoneDestinationInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SipUriDestinationInput value
   * @throws \RuntimeException if this SipColdReferTransferConfigInputTransferDestination does not contain a \ElevenLabs\Types\SipUriDestinationInput
   */
  public function asSipUri(): \ElevenLabs\Types\SipUriDestinationInput
  {
    if (!$this->isSipUri()) {
      throw new \RuntimeException(
        'SipColdReferTransferConfigInputTransferDestination does not contain \ElevenLabs\Types\SipUriDestinationInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\PhoneDynamicVariableDestinationInput value
   * @throws \RuntimeException if this SipColdReferTransferConfigInputTransferDestination does not contain a \ElevenLabs\Types\PhoneDynamicVariableDestinationInput
   */
  public function asPhoneDynamicVariable(): \ElevenLabs\Types\PhoneDynamicVariableDestinationInput
  {
    if (!$this->isPhoneDynamicVariable()) {
      throw new \RuntimeException(
        'SipColdReferTransferConfigInputTransferDestination does not contain \ElevenLabs\Types\PhoneDynamicVariableDestinationInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SipUriDynamicVariableDestinationInput value
   * @throws \RuntimeException if this SipColdReferTransferConfigInputTransferDestination does not contain a \ElevenLabs\Types\SipUriDynamicVariableDestinationInput
   */
  public function asSipUriDynamicVariable(): \ElevenLabs\Types\SipUriDynamicVariableDestinationInput
  {
    if (!$this->isSipUriDynamicVariable()) {
      throw new \RuntimeException(
        'SipColdReferTransferConfigInputTransferDestination does not contain \ElevenLabs\Types\SipUriDynamicVariableDestinationInput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\PhoneDestinationInput value
   * @return \ElevenLabs\Types\PhoneDestinationInput|null Returns the value if this SipColdReferTransferConfigInputTransferDestination contains a \ElevenLabs\Types\PhoneDestinationInput, null otherwise
   */
  public function tryAsPhone(): ?\ElevenLabs\Types\PhoneDestinationInput
  {
    return $this->isPhone() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SipUriDestinationInput value
   * @return \ElevenLabs\Types\SipUriDestinationInput|null Returns the value if this SipColdReferTransferConfigInputTransferDestination contains a \ElevenLabs\Types\SipUriDestinationInput, null otherwise
   */
  public function tryAsSipUri(): ?\ElevenLabs\Types\SipUriDestinationInput
  {
    return $this->isSipUri() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\PhoneDynamicVariableDestinationInput value
   * @return \ElevenLabs\Types\PhoneDynamicVariableDestinationInput|null Returns the value if this SipColdReferTransferConfigInputTransferDestination contains a \ElevenLabs\Types\PhoneDynamicVariableDestinationInput, null otherwise
   */
  public function tryAsPhoneDynamicVariable(): ?\ElevenLabs\Types\PhoneDynamicVariableDestinationInput
  {
    return $this->isPhoneDynamicVariable() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SipUriDynamicVariableDestinationInput value
   * @return \ElevenLabs\Types\SipUriDynamicVariableDestinationInput|null Returns the value if this SipColdReferTransferConfigInputTransferDestination contains a \ElevenLabs\Types\SipUriDynamicVariableDestinationInput, null otherwise
   */
  public function tryAsSipUriDynamicVariable(): ?\ElevenLabs\Types\SipUriDynamicVariableDestinationInput
  {
    return $this->isSipUriDynamicVariable() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\PhoneDestinationInput): T $onPhone
   * @param callable(\ElevenLabs\Types\SipUriDestinationInput): T $onSipUri
   * @param callable(\ElevenLabs\Types\PhoneDynamicVariableDestinationInput): T $onPhoneDynamicVariable
   * @param callable(\ElevenLabs\Types\SipUriDynamicVariableDestinationInput): T $onSipUriDynamicVariable
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
          return new self(\ElevenLabs\Types\PhoneDestinationInput::fromArray($data), 0);
        case 'phone_dynamic_variable':
          return new self(
            \ElevenLabs\Types\PhoneDynamicVariableDestinationInput::fromArray($data),
            2
          );
        case 'sip_uri':
          return new self(\ElevenLabs\Types\SipUriDestinationInput::fromArray($data), 1);
        case 'sip_uri_dynamic_variable':
          return new self(
            \ElevenLabs\Types\SipUriDynamicVariableDestinationInput::fromArray($data),
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
      $candidate = \ElevenLabs\Types\PhoneDestinationInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PhoneDestinationInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SipUriDestinationInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SipUriDestinationInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\PhoneDynamicVariableDestinationInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PhoneDynamicVariableDestinationInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SipUriDynamicVariableDestinationInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SipUriDynamicVariableDestinationInput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any SipColdReferTransferConfigInputTransferDestination type'
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
