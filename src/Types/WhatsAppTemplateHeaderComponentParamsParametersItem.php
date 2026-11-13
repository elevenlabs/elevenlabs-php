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
class WhatsAppTemplateHeaderComponentParamsParametersItem extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\WhatsAppTemplateTextParam|\ElevenLabs\Types\WhatsAppTemplateImageParam|\ElevenLabs\Types\WhatsAppTemplateDocumentParam|\ElevenLabs\Types\WhatsAppTemplateLocationParam|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this WhatsAppTemplateHeaderComponentParamsParametersItem holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'WhatsAppTemplateHeaderComponentParamsParametersItem does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\WhatsAppTemplateTextParam|\ElevenLabs\Types\WhatsAppTemplateImageParam|\ElevenLabs\Types\WhatsAppTemplateDocumentParam|\ElevenLabs\Types\WhatsAppTemplateLocationParam|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'text',
      1 => 'image',
      2 => 'document',
      3 => 'location',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a WhatsAppTemplateHeaderComponentParamsParametersItem instance containing a \ElevenLabs\Types\WhatsAppTemplateTextParam
   */
  public static function text(\ElevenLabs\Types\WhatsAppTemplateTextParam $text): self
  {
    return new self($text, 0);
  }

  /**
   * Create a WhatsAppTemplateHeaderComponentParamsParametersItem instance containing a \ElevenLabs\Types\WhatsAppTemplateImageParam
   */
  public static function image(\ElevenLabs\Types\WhatsAppTemplateImageParam $image): self
  {
    return new self($image, 1);
  }

  /**
   * Create a WhatsAppTemplateHeaderComponentParamsParametersItem instance containing a \ElevenLabs\Types\WhatsAppTemplateDocumentParam
   */
  public static function document(\ElevenLabs\Types\WhatsAppTemplateDocumentParam $document): self
  {
    return new self($document, 2);
  }

  /**
   * Create a WhatsAppTemplateHeaderComponentParamsParametersItem instance containing a \ElevenLabs\Types\WhatsAppTemplateLocationParam
   */
  public static function location(\ElevenLabs\Types\WhatsAppTemplateLocationParam $location): self
  {
    return new self($location, 3);
  }

  // Type checking methods
  /**
   * Check if this WhatsAppTemplateHeaderComponentParamsParametersItem contains a \ElevenLabs\Types\WhatsAppTemplateTextParam
   */
  public function isText(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this WhatsAppTemplateHeaderComponentParamsParametersItem contains a \ElevenLabs\Types\WhatsAppTemplateImageParam
   */
  public function isImage(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this WhatsAppTemplateHeaderComponentParamsParametersItem contains a \ElevenLabs\Types\WhatsAppTemplateDocumentParam
   */
  public function isDocument(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this WhatsAppTemplateHeaderComponentParamsParametersItem contains a \ElevenLabs\Types\WhatsAppTemplateLocationParam
   */
  public function isLocation(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\WhatsAppTemplateTextParam value
   * @throws \RuntimeException if this WhatsAppTemplateHeaderComponentParamsParametersItem does not contain a \ElevenLabs\Types\WhatsAppTemplateTextParam
   */
  public function asText(): \ElevenLabs\Types\WhatsAppTemplateTextParam
  {
    if (!$this->isText()) {
      throw new \RuntimeException(
        'WhatsAppTemplateHeaderComponentParamsParametersItem does not contain \ElevenLabs\Types\WhatsAppTemplateTextParam'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WhatsAppTemplateImageParam value
   * @throws \RuntimeException if this WhatsAppTemplateHeaderComponentParamsParametersItem does not contain a \ElevenLabs\Types\WhatsAppTemplateImageParam
   */
  public function asImage(): \ElevenLabs\Types\WhatsAppTemplateImageParam
  {
    if (!$this->isImage()) {
      throw new \RuntimeException(
        'WhatsAppTemplateHeaderComponentParamsParametersItem does not contain \ElevenLabs\Types\WhatsAppTemplateImageParam'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WhatsAppTemplateDocumentParam value
   * @throws \RuntimeException if this WhatsAppTemplateHeaderComponentParamsParametersItem does not contain a \ElevenLabs\Types\WhatsAppTemplateDocumentParam
   */
  public function asDocument(): \ElevenLabs\Types\WhatsAppTemplateDocumentParam
  {
    if (!$this->isDocument()) {
      throw new \RuntimeException(
        'WhatsAppTemplateHeaderComponentParamsParametersItem does not contain \ElevenLabs\Types\WhatsAppTemplateDocumentParam'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WhatsAppTemplateLocationParam value
   * @throws \RuntimeException if this WhatsAppTemplateHeaderComponentParamsParametersItem does not contain a \ElevenLabs\Types\WhatsAppTemplateLocationParam
   */
  public function asLocation(): \ElevenLabs\Types\WhatsAppTemplateLocationParam
  {
    if (!$this->isLocation()) {
      throw new \RuntimeException(
        'WhatsAppTemplateHeaderComponentParamsParametersItem does not contain \ElevenLabs\Types\WhatsAppTemplateLocationParam'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\WhatsAppTemplateTextParam value
   * @return \ElevenLabs\Types\WhatsAppTemplateTextParam|null Returns the value if this WhatsAppTemplateHeaderComponentParamsParametersItem contains a \ElevenLabs\Types\WhatsAppTemplateTextParam, null otherwise
   */
  public function tryAsText(): ?\ElevenLabs\Types\WhatsAppTemplateTextParam
  {
    return $this->isText() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WhatsAppTemplateImageParam value
   * @return \ElevenLabs\Types\WhatsAppTemplateImageParam|null Returns the value if this WhatsAppTemplateHeaderComponentParamsParametersItem contains a \ElevenLabs\Types\WhatsAppTemplateImageParam, null otherwise
   */
  public function tryAsImage(): ?\ElevenLabs\Types\WhatsAppTemplateImageParam
  {
    return $this->isImage() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WhatsAppTemplateDocumentParam value
   * @return \ElevenLabs\Types\WhatsAppTemplateDocumentParam|null Returns the value if this WhatsAppTemplateHeaderComponentParamsParametersItem contains a \ElevenLabs\Types\WhatsAppTemplateDocumentParam, null otherwise
   */
  public function tryAsDocument(): ?\ElevenLabs\Types\WhatsAppTemplateDocumentParam
  {
    return $this->isDocument() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WhatsAppTemplateLocationParam value
   * @return \ElevenLabs\Types\WhatsAppTemplateLocationParam|null Returns the value if this WhatsAppTemplateHeaderComponentParamsParametersItem contains a \ElevenLabs\Types\WhatsAppTemplateLocationParam, null otherwise
   */
  public function tryAsLocation(): ?\ElevenLabs\Types\WhatsAppTemplateLocationParam
  {
    return $this->isLocation() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\WhatsAppTemplateTextParam): T $onText
   * @param callable(\ElevenLabs\Types\WhatsAppTemplateImageParam): T $onImage
   * @param callable(\ElevenLabs\Types\WhatsAppTemplateDocumentParam): T $onDocument
   * @param callable(\ElevenLabs\Types\WhatsAppTemplateLocationParam): T $onLocation
   * @return T
   */
  public function match(
    callable $onText,
    callable $onImage,
    callable $onDocument,
    callable $onLocation
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onText($this->value),
      1 => $onImage($this->value),
      2 => $onDocument($this->value),
      3 => $onLocation($this->value),
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
        case 'document':
          return new self(\ElevenLabs\Types\WhatsAppTemplateDocumentParam::fromArray($data), 2);
        case 'image':
          return new self(\ElevenLabs\Types\WhatsAppTemplateImageParam::fromArray($data), 1);
        case 'location':
          return new self(\ElevenLabs\Types\WhatsAppTemplateLocationParam::fromArray($data), 3);
        case 'text':
          return new self(\ElevenLabs\Types\WhatsAppTemplateTextParam::fromArray($data), 0);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\WhatsAppTemplateTextParam::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WhatsAppTemplateTextParam didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WhatsAppTemplateImageParam::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WhatsAppTemplateImageParam didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WhatsAppTemplateDocumentParam::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WhatsAppTemplateDocumentParam didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WhatsAppTemplateLocationParam::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WhatsAppTemplateLocationParam didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any WhatsAppTemplateHeaderComponentParamsParametersItem type'
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
