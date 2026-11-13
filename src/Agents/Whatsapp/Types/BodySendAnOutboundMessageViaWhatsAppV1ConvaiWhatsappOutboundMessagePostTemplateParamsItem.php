<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Whatsapp\Types;

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
class BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem
  extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams|\ElevenLabs\Types\WhatsAppTemplateBodyComponentParams|\ElevenLabs\Types\WhatsAppTemplateButtonComponentParams|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams|\ElevenLabs\Types\WhatsAppTemplateBodyComponentParams|\ElevenLabs\Types\WhatsAppTemplateButtonComponentParams|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'header',
      1 => 'body',
      2 => 'button',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem instance containing a \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams
   */
  public static function header(
    \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams $header
  ): self {
    return new self($header, 0);
  }

  /**
   * Create a BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem instance containing a \ElevenLabs\Types\WhatsAppTemplateBodyComponentParams
   */
  public static function body(\ElevenLabs\Types\WhatsAppTemplateBodyComponentParams $body): self
  {
    return new self($body, 1);
  }

  /**
   * Create a BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem instance containing a \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams
   */
  public static function button(
    \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams $button
  ): self {
    return new self($button, 2);
  }

  // Type checking methods
  /**
   * Check if this BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem contains a \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams
   */
  public function isHeader(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem contains a \ElevenLabs\Types\WhatsAppTemplateBodyComponentParams
   */
  public function isBody(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem contains a \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams
   */
  public function isButton(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams value
   * @throws \RuntimeException if this BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem does not contain a \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams
   */
  public function asHeader(): \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams
  {
    if (!$this->isHeader()) {
      throw new \RuntimeException(
        'BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem does not contain \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WhatsAppTemplateBodyComponentParams value
   * @throws \RuntimeException if this BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem does not contain a \ElevenLabs\Types\WhatsAppTemplateBodyComponentParams
   */
  public function asBody(): \ElevenLabs\Types\WhatsAppTemplateBodyComponentParams
  {
    if (!$this->isBody()) {
      throw new \RuntimeException(
        'BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem does not contain \ElevenLabs\Types\WhatsAppTemplateBodyComponentParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams value
   * @throws \RuntimeException if this BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem does not contain a \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams
   */
  public function asButton(): \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams
  {
    if (!$this->isButton()) {
      throw new \RuntimeException(
        'BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem does not contain \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams value
   * @return \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams|null Returns the value if this BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem contains a \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams, null otherwise
   */
  public function tryAsHeader(): ?\ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams
  {
    return $this->isHeader() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WhatsAppTemplateBodyComponentParams value
   * @return \ElevenLabs\Types\WhatsAppTemplateBodyComponentParams|null Returns the value if this BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem contains a \ElevenLabs\Types\WhatsAppTemplateBodyComponentParams, null otherwise
   */
  public function tryAsBody(): ?\ElevenLabs\Types\WhatsAppTemplateBodyComponentParams
  {
    return $this->isBody() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams value
   * @return \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams|null Returns the value if this BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem contains a \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams, null otherwise
   */
  public function tryAsButton(): ?\ElevenLabs\Types\WhatsAppTemplateButtonComponentParams
  {
    return $this->isButton() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams): T $onHeader
   * @param callable(\ElevenLabs\Types\WhatsAppTemplateBodyComponentParams): T $onBody
   * @param callable(\ElevenLabs\Types\WhatsAppTemplateButtonComponentParams): T $onButton
   * @return T
   */
  public function match(callable $onHeader, callable $onBody, callable $onButton): mixed
  {
    return match ($this->typeIndex) {
      0 => $onHeader($this->value),
      1 => $onBody($this->value),
      2 => $onButton($this->value),
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
        case 'body':
          return new self(
            \ElevenLabs\Types\WhatsAppTemplateBodyComponentParams::fromArray($data),
            1
          );
        case 'button':
          return new self(
            \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams::fromArray($data),
            2
          );
        case 'header':
          return new self(
            \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams::fromArray($data),
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
      $candidate = \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WhatsAppTemplateBodyComponentParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WhatsAppTemplateBodyComponentParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem type'
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
