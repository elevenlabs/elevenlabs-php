<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents\Types;

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
class GetDocumentsResponse extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel|\ElevenLabs\Types\GetKnowledgeBaseFileResponseModel|\ElevenLabs\Types\GetKnowledgeBaseTextResponseModel|\ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this GetDocumentsResponse holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('GetDocumentsResponse does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel|\ElevenLabs\Types\GetKnowledgeBaseFileResponseModel|\ElevenLabs\Types\GetKnowledgeBaseTextResponseModel|\ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel|array<string, mixed> $value
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
   * Create a GetDocumentsResponse instance containing a \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel
   */
  public static function url(\ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel $url): self
  {
    return new self($url, 0);
  }

  /**
   * Create a GetDocumentsResponse instance containing a \ElevenLabs\Types\GetKnowledgeBaseFileResponseModel
   */
  public static function file(\ElevenLabs\Types\GetKnowledgeBaseFileResponseModel $file): self
  {
    return new self($file, 1);
  }

  /**
   * Create a GetDocumentsResponse instance containing a \ElevenLabs\Types\GetKnowledgeBaseTextResponseModel
   */
  public static function text(\ElevenLabs\Types\GetKnowledgeBaseTextResponseModel $text): self
  {
    return new self($text, 2);
  }

  /**
   * Create a GetDocumentsResponse instance containing a \ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel
   */
  public static function folder(\ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel $folder): self
  {
    return new self($folder, 3);
  }

  // Type checking methods
  /**
   * Check if this GetDocumentsResponse contains a \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel
   */
  public function isUrl(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this GetDocumentsResponse contains a \ElevenLabs\Types\GetKnowledgeBaseFileResponseModel
   */
  public function isFile(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this GetDocumentsResponse contains a \ElevenLabs\Types\GetKnowledgeBaseTextResponseModel
   */
  public function isText(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this GetDocumentsResponse contains a \ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel
   */
  public function isFolder(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel value
   * @throws \RuntimeException if this GetDocumentsResponse does not contain a \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel
   */
  public function asUrl(): \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel
  {
    if (!$this->isUrl()) {
      throw new \RuntimeException(
        'GetDocumentsResponse does not contain \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetKnowledgeBaseFileResponseModel value
   * @throws \RuntimeException if this GetDocumentsResponse does not contain a \ElevenLabs\Types\GetKnowledgeBaseFileResponseModel
   */
  public function asFile(): \ElevenLabs\Types\GetKnowledgeBaseFileResponseModel
  {
    if (!$this->isFile()) {
      throw new \RuntimeException(
        'GetDocumentsResponse does not contain \ElevenLabs\Types\GetKnowledgeBaseFileResponseModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetKnowledgeBaseTextResponseModel value
   * @throws \RuntimeException if this GetDocumentsResponse does not contain a \ElevenLabs\Types\GetKnowledgeBaseTextResponseModel
   */
  public function asText(): \ElevenLabs\Types\GetKnowledgeBaseTextResponseModel
  {
    if (!$this->isText()) {
      throw new \RuntimeException(
        'GetDocumentsResponse does not contain \ElevenLabs\Types\GetKnowledgeBaseTextResponseModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel value
   * @throws \RuntimeException if this GetDocumentsResponse does not contain a \ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel
   */
  public function asFolder(): \ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel
  {
    if (!$this->isFolder()) {
      throw new \RuntimeException(
        'GetDocumentsResponse does not contain \ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel value
   * @return \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel|null Returns the value if this GetDocumentsResponse contains a \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel, null otherwise
   */
  public function tryAsUrl(): ?\ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel
  {
    return $this->isUrl() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetKnowledgeBaseFileResponseModel value
   * @return \ElevenLabs\Types\GetKnowledgeBaseFileResponseModel|null Returns the value if this GetDocumentsResponse contains a \ElevenLabs\Types\GetKnowledgeBaseFileResponseModel, null otherwise
   */
  public function tryAsFile(): ?\ElevenLabs\Types\GetKnowledgeBaseFileResponseModel
  {
    return $this->isFile() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetKnowledgeBaseTextResponseModel value
   * @return \ElevenLabs\Types\GetKnowledgeBaseTextResponseModel|null Returns the value if this GetDocumentsResponse contains a \ElevenLabs\Types\GetKnowledgeBaseTextResponseModel, null otherwise
   */
  public function tryAsText(): ?\ElevenLabs\Types\GetKnowledgeBaseTextResponseModel
  {
    return $this->isText() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel value
   * @return \ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel|null Returns the value if this GetDocumentsResponse contains a \ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel, null otherwise
   */
  public function tryAsFolder(): ?\ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel
  {
    return $this->isFolder() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel): T $onUrl
   * @param callable(\ElevenLabs\Types\GetKnowledgeBaseFileResponseModel): T $onFile
   * @param callable(\ElevenLabs\Types\GetKnowledgeBaseTextResponseModel): T $onText
   * @param callable(\ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel): T $onFolder
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
        case 'url':
          return new self(\ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel::fromArray($data), 0);
        case 'file':
          return new self(\ElevenLabs\Types\GetKnowledgeBaseFileResponseModel::fromArray($data), 1);
        case 'text':
          return new self(\ElevenLabs\Types\GetKnowledgeBaseTextResponseModel::fromArray($data), 2);
        case 'folder':
          return new self(
            \ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel::fromArray($data),
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
      $candidate = \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetKnowledgeBaseFileResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetKnowledgeBaseFileResponseModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetKnowledgeBaseTextResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetKnowledgeBaseTextResponseModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetKnowledgeBaseFolderResponseModel didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any GetDocumentsResponse type');
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
