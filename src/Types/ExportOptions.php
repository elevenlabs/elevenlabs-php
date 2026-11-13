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
class ExportOptions extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $format;

  /**
   * @var \ElevenLabs\Types\SegmentedJsonExportOptions|\ElevenLabs\Types\DocxExportOptions|\ElevenLabs\Types\PdfExportOptions|\ElevenLabs\Types\TxtExportOptions|\ElevenLabs\Types\HtmlExportOptions|\ElevenLabs\Types\SrtExportOptions|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this ExportOptions holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('ExportOptions does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\SegmentedJsonExportOptions|\ElevenLabs\Types\DocxExportOptions|\ElevenLabs\Types\PdfExportOptions|\ElevenLabs\Types\TxtExportOptions|\ElevenLabs\Types\HtmlExportOptions|\ElevenLabs\Types\SrtExportOptions|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->format = match ($typeIndex) {
      0 => 'segmented_json',
      1 => 'docx',
      2 => 'pdf',
      3 => 'txt',
      4 => 'html',
      5 => 'srt',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a ExportOptions instance containing a \ElevenLabs\Types\SegmentedJsonExportOptions
   */
  public static function segmentedJson(
    \ElevenLabs\Types\SegmentedJsonExportOptions $segmentedJson
  ): self {
    return new self($segmentedJson, 0);
  }

  /**
   * Create a ExportOptions instance containing a \ElevenLabs\Types\DocxExportOptions
   */
  public static function docx(\ElevenLabs\Types\DocxExportOptions $docx): self
  {
    return new self($docx, 1);
  }

  /**
   * Create a ExportOptions instance containing a \ElevenLabs\Types\PdfExportOptions
   */
  public static function pdf(\ElevenLabs\Types\PdfExportOptions $pdf): self
  {
    return new self($pdf, 2);
  }

  /**
   * Create a ExportOptions instance containing a \ElevenLabs\Types\TxtExportOptions
   */
  public static function txt(\ElevenLabs\Types\TxtExportOptions $txt): self
  {
    return new self($txt, 3);
  }

  /**
   * Create a ExportOptions instance containing a \ElevenLabs\Types\HtmlExportOptions
   */
  public static function html(\ElevenLabs\Types\HtmlExportOptions $html): self
  {
    return new self($html, 4);
  }

  /**
   * Create a ExportOptions instance containing a \ElevenLabs\Types\SrtExportOptions
   */
  public static function srt(\ElevenLabs\Types\SrtExportOptions $srt): self
  {
    return new self($srt, 5);
  }

  // Type checking methods
  /**
   * Check if this ExportOptions contains a \ElevenLabs\Types\SegmentedJsonExportOptions
   */
  public function isSegmentedJson(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ExportOptions contains a \ElevenLabs\Types\DocxExportOptions
   */
  public function isDocx(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ExportOptions contains a \ElevenLabs\Types\PdfExportOptions
   */
  public function isPdf(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ExportOptions contains a \ElevenLabs\Types\TxtExportOptions
   */
  public function isTxt(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this ExportOptions contains a \ElevenLabs\Types\HtmlExportOptions
   */
  public function isHtml(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this ExportOptions contains a \ElevenLabs\Types\SrtExportOptions
   */
  public function isSrt(): bool
  {
    return $this->typeIndex === 5;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\SegmentedJsonExportOptions value
   * @throws \RuntimeException if this ExportOptions does not contain a \ElevenLabs\Types\SegmentedJsonExportOptions
   */
  public function asSegmentedJson(): \ElevenLabs\Types\SegmentedJsonExportOptions
  {
    if (!$this->isSegmentedJson()) {
      throw new \RuntimeException(
        'ExportOptions does not contain \ElevenLabs\Types\SegmentedJsonExportOptions'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DocxExportOptions value
   * @throws \RuntimeException if this ExportOptions does not contain a \ElevenLabs\Types\DocxExportOptions
   */
  public function asDocx(): \ElevenLabs\Types\DocxExportOptions
  {
    if (!$this->isDocx()) {
      throw new \RuntimeException(
        'ExportOptions does not contain \ElevenLabs\Types\DocxExportOptions'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\PdfExportOptions value
   * @throws \RuntimeException if this ExportOptions does not contain a \ElevenLabs\Types\PdfExportOptions
   */
  public function asPdf(): \ElevenLabs\Types\PdfExportOptions
  {
    if (!$this->isPdf()) {
      throw new \RuntimeException(
        'ExportOptions does not contain \ElevenLabs\Types\PdfExportOptions'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TxtExportOptions value
   * @throws \RuntimeException if this ExportOptions does not contain a \ElevenLabs\Types\TxtExportOptions
   */
  public function asTxt(): \ElevenLabs\Types\TxtExportOptions
  {
    if (!$this->isTxt()) {
      throw new \RuntimeException(
        'ExportOptions does not contain \ElevenLabs\Types\TxtExportOptions'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\HtmlExportOptions value
   * @throws \RuntimeException if this ExportOptions does not contain a \ElevenLabs\Types\HtmlExportOptions
   */
  public function asHtml(): \ElevenLabs\Types\HtmlExportOptions
  {
    if (!$this->isHtml()) {
      throw new \RuntimeException(
        'ExportOptions does not contain \ElevenLabs\Types\HtmlExportOptions'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SrtExportOptions value
   * @throws \RuntimeException if this ExportOptions does not contain a \ElevenLabs\Types\SrtExportOptions
   */
  public function asSrt(): \ElevenLabs\Types\SrtExportOptions
  {
    if (!$this->isSrt()) {
      throw new \RuntimeException(
        'ExportOptions does not contain \ElevenLabs\Types\SrtExportOptions'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\SegmentedJsonExportOptions value
   * @return \ElevenLabs\Types\SegmentedJsonExportOptions|null Returns the value if this ExportOptions contains a \ElevenLabs\Types\SegmentedJsonExportOptions, null otherwise
   */
  public function tryAsSegmentedJson(): ?\ElevenLabs\Types\SegmentedJsonExportOptions
  {
    return $this->isSegmentedJson() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DocxExportOptions value
   * @return \ElevenLabs\Types\DocxExportOptions|null Returns the value if this ExportOptions contains a \ElevenLabs\Types\DocxExportOptions, null otherwise
   */
  public function tryAsDocx(): ?\ElevenLabs\Types\DocxExportOptions
  {
    return $this->isDocx() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\PdfExportOptions value
   * @return \ElevenLabs\Types\PdfExportOptions|null Returns the value if this ExportOptions contains a \ElevenLabs\Types\PdfExportOptions, null otherwise
   */
  public function tryAsPdf(): ?\ElevenLabs\Types\PdfExportOptions
  {
    return $this->isPdf() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TxtExportOptions value
   * @return \ElevenLabs\Types\TxtExportOptions|null Returns the value if this ExportOptions contains a \ElevenLabs\Types\TxtExportOptions, null otherwise
   */
  public function tryAsTxt(): ?\ElevenLabs\Types\TxtExportOptions
  {
    return $this->isTxt() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\HtmlExportOptions value
   * @return \ElevenLabs\Types\HtmlExportOptions|null Returns the value if this ExportOptions contains a \ElevenLabs\Types\HtmlExportOptions, null otherwise
   */
  public function tryAsHtml(): ?\ElevenLabs\Types\HtmlExportOptions
  {
    return $this->isHtml() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SrtExportOptions value
   * @return \ElevenLabs\Types\SrtExportOptions|null Returns the value if this ExportOptions contains a \ElevenLabs\Types\SrtExportOptions, null otherwise
   */
  public function tryAsSrt(): ?\ElevenLabs\Types\SrtExportOptions
  {
    return $this->isSrt() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\SegmentedJsonExportOptions): T $onSegmentedJson
   * @param callable(\ElevenLabs\Types\DocxExportOptions): T $onDocx
   * @param callable(\ElevenLabs\Types\PdfExportOptions): T $onPdf
   * @param callable(\ElevenLabs\Types\TxtExportOptions): T $onTxt
   * @param callable(\ElevenLabs\Types\HtmlExportOptions): T $onHtml
   * @param callable(\ElevenLabs\Types\SrtExportOptions): T $onSrt
   * @return T
   */
  public function match(
    callable $onSegmentedJson,
    callable $onDocx,
    callable $onPdf,
    callable $onTxt,
    callable $onHtml,
    callable $onSrt
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onSegmentedJson($this->value),
      1 => $onDocx($this->value),
      2 => $onPdf($this->value),
      3 => $onTxt($this->value),
      4 => $onHtml($this->value),
      5 => $onSrt($this->value),
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
    if (is_array($data) && isset($data['format']) && is_string($data['format'])) {
      switch ($data['format']) {
        case 'docx':
          return new self(\ElevenLabs\Types\DocxExportOptions::fromArray($data), 1);
        case 'html':
          return new self(\ElevenLabs\Types\HtmlExportOptions::fromArray($data), 4);
        case 'pdf':
          return new self(\ElevenLabs\Types\PdfExportOptions::fromArray($data), 2);
        case 'segmented_json':
          return new self(\ElevenLabs\Types\SegmentedJsonExportOptions::fromArray($data), 0);
        case 'srt':
          return new self(\ElevenLabs\Types\SrtExportOptions::fromArray($data), 5);
        case 'txt':
          return new self(\ElevenLabs\Types\TxtExportOptions::fromArray($data), 3);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\SegmentedJsonExportOptions::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SegmentedJsonExportOptions didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DocxExportOptions::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DocxExportOptions didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\PdfExportOptions::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PdfExportOptions didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TxtExportOptions::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TxtExportOptions didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\HtmlExportOptions::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\HtmlExportOptions didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SrtExportOptions::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SrtExportOptions didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any ExportOptions type');
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
