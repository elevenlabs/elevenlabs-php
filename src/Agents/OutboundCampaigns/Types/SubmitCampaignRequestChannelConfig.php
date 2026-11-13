<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns\Types;

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
class SubmitCampaignRequestChannelConfig extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $channel;

  /**
   * @var \ElevenLabs\Types\PhoneChannelConfigInput|\ElevenLabs\Types\SubmitWhatsAppChannelConfig|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this SubmitCampaignRequestChannelConfig holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'SubmitCampaignRequestChannelConfig does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\PhoneChannelConfigInput|\ElevenLabs\Types\SubmitWhatsAppChannelConfig|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->channel = match ($typeIndex) {
      0 => 'phone',
      1 => 'whatsapp',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a SubmitCampaignRequestChannelConfig instance containing a \ElevenLabs\Types\PhoneChannelConfigInput
   */
  public static function phone(\ElevenLabs\Types\PhoneChannelConfigInput $phone): self
  {
    return new self($phone, 0);
  }

  /**
   * Create a SubmitCampaignRequestChannelConfig instance containing a \ElevenLabs\Types\SubmitWhatsAppChannelConfig
   */
  public static function whatsapp(\ElevenLabs\Types\SubmitWhatsAppChannelConfig $whatsapp): self
  {
    return new self($whatsapp, 1);
  }

  // Type checking methods
  /**
   * Check if this SubmitCampaignRequestChannelConfig contains a \ElevenLabs\Types\PhoneChannelConfigInput
   */
  public function isPhone(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this SubmitCampaignRequestChannelConfig contains a \ElevenLabs\Types\SubmitWhatsAppChannelConfig
   */
  public function isWhatsapp(): bool
  {
    return $this->typeIndex === 1;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\PhoneChannelConfigInput value
   * @throws \RuntimeException if this SubmitCampaignRequestChannelConfig does not contain a \ElevenLabs\Types\PhoneChannelConfigInput
   */
  public function asPhone(): \ElevenLabs\Types\PhoneChannelConfigInput
  {
    if (!$this->isPhone()) {
      throw new \RuntimeException(
        'SubmitCampaignRequestChannelConfig does not contain \ElevenLabs\Types\PhoneChannelConfigInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubmitWhatsAppChannelConfig value
   * @throws \RuntimeException if this SubmitCampaignRequestChannelConfig does not contain a \ElevenLabs\Types\SubmitWhatsAppChannelConfig
   */
  public function asWhatsapp(): \ElevenLabs\Types\SubmitWhatsAppChannelConfig
  {
    if (!$this->isWhatsapp()) {
      throw new \RuntimeException(
        'SubmitCampaignRequestChannelConfig does not contain \ElevenLabs\Types\SubmitWhatsAppChannelConfig'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\PhoneChannelConfigInput value
   * @return \ElevenLabs\Types\PhoneChannelConfigInput|null Returns the value if this SubmitCampaignRequestChannelConfig contains a \ElevenLabs\Types\PhoneChannelConfigInput, null otherwise
   */
  public function tryAsPhone(): ?\ElevenLabs\Types\PhoneChannelConfigInput
  {
    return $this->isPhone() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubmitWhatsAppChannelConfig value
   * @return \ElevenLabs\Types\SubmitWhatsAppChannelConfig|null Returns the value if this SubmitCampaignRequestChannelConfig contains a \ElevenLabs\Types\SubmitWhatsAppChannelConfig, null otherwise
   */
  public function tryAsWhatsapp(): ?\ElevenLabs\Types\SubmitWhatsAppChannelConfig
  {
    return $this->isWhatsapp() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\PhoneChannelConfigInput): T $onPhone
   * @param callable(\ElevenLabs\Types\SubmitWhatsAppChannelConfig): T $onWhatsapp
   * @return T
   */
  public function match(callable $onPhone, callable $onWhatsapp): mixed
  {
    return match ($this->typeIndex) {
      0 => $onPhone($this->value),
      1 => $onWhatsapp($this->value),
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
    if (is_array($data) && isset($data['channel']) && is_string($data['channel'])) {
      switch ($data['channel']) {
        case 'phone':
          return new self(\ElevenLabs\Types\PhoneChannelConfigInput::fromArray($data), 0);
        case 'whatsapp':
          return new self(\ElevenLabs\Types\SubmitWhatsAppChannelConfig::fromArray($data), 1);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\PhoneChannelConfigInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PhoneChannelConfigInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubmitWhatsAppChannelConfig::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubmitWhatsAppChannelConfig didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any SubmitCampaignRequestChannelConfig type'
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
