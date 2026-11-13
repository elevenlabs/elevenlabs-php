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
class CampaignResponseChannelConfig extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $channel;

  /**
   * @var \ElevenLabs\Types\PhoneChannelConfigOutput|\ElevenLabs\Types\WhatsAppChannelConfig|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this CampaignResponseChannelConfig holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'CampaignResponseChannelConfig does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\PhoneChannelConfigOutput|\ElevenLabs\Types\WhatsAppChannelConfig|array<string, mixed> $value
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
   * Create a CampaignResponseChannelConfig instance containing a \ElevenLabs\Types\PhoneChannelConfigOutput
   */
  public static function phone(\ElevenLabs\Types\PhoneChannelConfigOutput $phone): self
  {
    return new self($phone, 0);
  }

  /**
   * Create a CampaignResponseChannelConfig instance containing a \ElevenLabs\Types\WhatsAppChannelConfig
   */
  public static function whatsapp(\ElevenLabs\Types\WhatsAppChannelConfig $whatsapp): self
  {
    return new self($whatsapp, 1);
  }

  // Type checking methods
  /**
   * Check if this CampaignResponseChannelConfig contains a \ElevenLabs\Types\PhoneChannelConfigOutput
   */
  public function isPhone(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this CampaignResponseChannelConfig contains a \ElevenLabs\Types\WhatsAppChannelConfig
   */
  public function isWhatsapp(): bool
  {
    return $this->typeIndex === 1;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\PhoneChannelConfigOutput value
   * @throws \RuntimeException if this CampaignResponseChannelConfig does not contain a \ElevenLabs\Types\PhoneChannelConfigOutput
   */
  public function asPhone(): \ElevenLabs\Types\PhoneChannelConfigOutput
  {
    if (!$this->isPhone()) {
      throw new \RuntimeException(
        'CampaignResponseChannelConfig does not contain \ElevenLabs\Types\PhoneChannelConfigOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WhatsAppChannelConfig value
   * @throws \RuntimeException if this CampaignResponseChannelConfig does not contain a \ElevenLabs\Types\WhatsAppChannelConfig
   */
  public function asWhatsapp(): \ElevenLabs\Types\WhatsAppChannelConfig
  {
    if (!$this->isWhatsapp()) {
      throw new \RuntimeException(
        'CampaignResponseChannelConfig does not contain \ElevenLabs\Types\WhatsAppChannelConfig'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\PhoneChannelConfigOutput value
   * @return \ElevenLabs\Types\PhoneChannelConfigOutput|null Returns the value if this CampaignResponseChannelConfig contains a \ElevenLabs\Types\PhoneChannelConfigOutput, null otherwise
   */
  public function tryAsPhone(): ?\ElevenLabs\Types\PhoneChannelConfigOutput
  {
    return $this->isPhone() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WhatsAppChannelConfig value
   * @return \ElevenLabs\Types\WhatsAppChannelConfig|null Returns the value if this CampaignResponseChannelConfig contains a \ElevenLabs\Types\WhatsAppChannelConfig, null otherwise
   */
  public function tryAsWhatsapp(): ?\ElevenLabs\Types\WhatsAppChannelConfig
  {
    return $this->isWhatsapp() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\PhoneChannelConfigOutput): T $onPhone
   * @param callable(\ElevenLabs\Types\WhatsAppChannelConfig): T $onWhatsapp
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
          return new self(\ElevenLabs\Types\PhoneChannelConfigOutput::fromArray($data), 0);
        case 'whatsapp':
          return new self(\ElevenLabs\Types\WhatsAppChannelConfig::fromArray($data), 1);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\PhoneChannelConfigOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PhoneChannelConfigOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WhatsAppChannelConfig::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WhatsAppChannelConfig didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any CampaignResponseChannelConfig type'
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
