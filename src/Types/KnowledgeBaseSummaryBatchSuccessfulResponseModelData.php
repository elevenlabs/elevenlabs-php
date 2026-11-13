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
class KnowledgeBaseSummaryBatchSuccessfulResponseModelData extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel|\ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel|\ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel|\ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this KnowledgeBaseSummaryBatchSuccessfulResponseModelData holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'KnowledgeBaseSummaryBatchSuccessfulResponseModelData does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel|\ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel|\ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel|\ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'url',
      1 => 'file',
      2 => 'text',
      3 => 'folder',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a KnowledgeBaseSummaryBatchSuccessfulResponseModelData instance containing a \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel
   */
  public static function url(\ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel $url): self
  {
    return new self($url, 0);
  }

  /**
   * Create a KnowledgeBaseSummaryBatchSuccessfulResponseModelData instance containing a \ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel
   */
  public static function file(
    \ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel $file
  ): self {
    return new self($file, 1);
  }

  /**
   * Create a KnowledgeBaseSummaryBatchSuccessfulResponseModelData instance containing a \ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel
   */
  public static function text(
    \ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel $text
  ): self {
    return new self($text, 2);
  }

  /**
   * Create a KnowledgeBaseSummaryBatchSuccessfulResponseModelData instance containing a \ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel
   */
  public static function folder(
    \ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel $folder
  ): self {
    return new self($folder, 3);
  }

  // Type checking methods
  /**
   * Check if this KnowledgeBaseSummaryBatchSuccessfulResponseModelData contains a \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel
   */
  public function isUrl(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this KnowledgeBaseSummaryBatchSuccessfulResponseModelData contains a \ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel
   */
  public function isFile(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this KnowledgeBaseSummaryBatchSuccessfulResponseModelData contains a \ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel
   */
  public function isText(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this KnowledgeBaseSummaryBatchSuccessfulResponseModelData contains a \ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel
   */
  public function isFolder(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel value
   * @throws \RuntimeException if this KnowledgeBaseSummaryBatchSuccessfulResponseModelData does not contain a \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel
   */
  public function asUrl(): \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel
  {
    if (!$this->isUrl()) {
      throw new \RuntimeException(
        'KnowledgeBaseSummaryBatchSuccessfulResponseModelData does not contain \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel value
   * @throws \RuntimeException if this KnowledgeBaseSummaryBatchSuccessfulResponseModelData does not contain a \ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel
   */
  public function asFile(): \ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel
  {
    if (!$this->isFile()) {
      throw new \RuntimeException(
        'KnowledgeBaseSummaryBatchSuccessfulResponseModelData does not contain \ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel value
   * @throws \RuntimeException if this KnowledgeBaseSummaryBatchSuccessfulResponseModelData does not contain a \ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel
   */
  public function asText(): \ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel
  {
    if (!$this->isText()) {
      throw new \RuntimeException(
        'KnowledgeBaseSummaryBatchSuccessfulResponseModelData does not contain \ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel value
   * @throws \RuntimeException if this KnowledgeBaseSummaryBatchSuccessfulResponseModelData does not contain a \ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel
   */
  public function asFolder(): \ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel
  {
    if (!$this->isFolder()) {
      throw new \RuntimeException(
        'KnowledgeBaseSummaryBatchSuccessfulResponseModelData does not contain \ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel value
   * @return \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel|null Returns the value if this KnowledgeBaseSummaryBatchSuccessfulResponseModelData contains a \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel, null otherwise
   */
  public function tryAsUrl(): ?\ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel
  {
    return $this->isUrl() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel value
   * @return \ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel|null Returns the value if this KnowledgeBaseSummaryBatchSuccessfulResponseModelData contains a \ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel, null otherwise
   */
  public function tryAsFile(): ?\ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel
  {
    return $this->isFile() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel value
   * @return \ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel|null Returns the value if this KnowledgeBaseSummaryBatchSuccessfulResponseModelData contains a \ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel, null otherwise
   */
  public function tryAsText(): ?\ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel
  {
    return $this->isText() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel value
   * @return \ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel|null Returns the value if this KnowledgeBaseSummaryBatchSuccessfulResponseModelData contains a \ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel, null otherwise
   */
  public function tryAsFolder(): ?\ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel
  {
    return $this->isFolder() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel): T $onUrl
   * @param callable(\ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel): T $onFile
   * @param callable(\ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel): T $onText
   * @param callable(\ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel): T $onFolder
   * @return T
   */
  public function match(
    callable $onUrl,
    callable $onFile,
    callable $onText,
    callable $onFolder
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onUrl($this->value),
      1 => $onFile($this->value),
      2 => $onText($this->value),
      3 => $onFolder($this->value),
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
        case 'file':
          return new self(
            \ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel::fromArray($data),
            1
          );
        case 'folder':
          return new self(
            \ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel::fromArray($data),
            3
          );
        case 'text':
          return new self(
            \ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel::fromArray($data),
            2
          );
        case 'url':
          return new self(
            \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel::fromArray($data),
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
      $candidate = \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetKnowledgeBaseSummaryFileResponseModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetKnowledgeBaseSummaryTextResponseModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetKnowledgeBaseSummaryFolderResponseModel didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any KnowledgeBaseSummaryBatchSuccessfulResponseModelData type'
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
