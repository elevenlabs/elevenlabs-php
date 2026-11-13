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
class VideoGenerationRequest extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $modelId;

  /**
   * @var \ElevenLabs\Types\CreatifyAuroraRequest|\ElevenLabs\Types\Veo31Request|\ElevenLabs\Types\Veo31FastRequest|\ElevenLabs\Types\BytedanceSeedance2Request|\ElevenLabs\Types\BytedanceSeedance2FastRequest|\ElevenLabs\Types\BytedanceSeedance2MiniRequest|\ElevenLabs\Types\BytedanceSeedance25Request|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this VideoGenerationRequest holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('VideoGenerationRequest does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\CreatifyAuroraRequest|\ElevenLabs\Types\Veo31Request|\ElevenLabs\Types\Veo31FastRequest|\ElevenLabs\Types\BytedanceSeedance2Request|\ElevenLabs\Types\BytedanceSeedance2FastRequest|\ElevenLabs\Types\BytedanceSeedance2MiniRequest|\ElevenLabs\Types\BytedanceSeedance25Request|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->modelId = match ($typeIndex) {
      0 => 'creatify-aurora',
      1 => 'veo-3.1-generate-001',
      2 => 'veo-3.1-fast-generate-001',
      3 => 'bytedance-seedance-v2',
      4 => 'bytedance-seedance-v2-fast',
      5 => 'bytedance-seedance-v2-mini',
      6 => 'bytedance-seedance-v2.5',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a VideoGenerationRequest instance containing a \ElevenLabs\Types\CreatifyAuroraRequest
   */
  public static function creatifyAurora(
    \ElevenLabs\Types\CreatifyAuroraRequest $creatifyAurora
  ): self {
    return new self($creatifyAurora, 0);
  }

  /**
   * Create a VideoGenerationRequest instance containing a \ElevenLabs\Types\Veo31Request
   */
  public static function veo3_1Generate001(\ElevenLabs\Types\Veo31Request $veo3_1Generate001): self
  {
    return new self($veo3_1Generate001, 1);
  }

  /**
   * Create a VideoGenerationRequest instance containing a \ElevenLabs\Types\Veo31FastRequest
   */
  public static function veo3_1FastGenerate001(
    \ElevenLabs\Types\Veo31FastRequest $veo3_1FastGenerate001
  ): self {
    return new self($veo3_1FastGenerate001, 2);
  }

  /**
   * Create a VideoGenerationRequest instance containing a \ElevenLabs\Types\BytedanceSeedance2Request
   */
  public static function bytedanceSeedanceV2(
    \ElevenLabs\Types\BytedanceSeedance2Request $bytedanceSeedanceV2
  ): self {
    return new self($bytedanceSeedanceV2, 3);
  }

  /**
   * Create a VideoGenerationRequest instance containing a \ElevenLabs\Types\BytedanceSeedance2FastRequest
   */
  public static function bytedanceSeedanceV2Fast(
    \ElevenLabs\Types\BytedanceSeedance2FastRequest $bytedanceSeedanceV2Fast
  ): self {
    return new self($bytedanceSeedanceV2Fast, 4);
  }

  /**
   * Create a VideoGenerationRequest instance containing a \ElevenLabs\Types\BytedanceSeedance2MiniRequest
   */
  public static function bytedanceSeedanceV2Mini(
    \ElevenLabs\Types\BytedanceSeedance2MiniRequest $bytedanceSeedanceV2Mini
  ): self {
    return new self($bytedanceSeedanceV2Mini, 5);
  }

  /**
   * Create a VideoGenerationRequest instance containing a \ElevenLabs\Types\BytedanceSeedance25Request
   */
  public static function bytedanceSeedanceV2_5(
    \ElevenLabs\Types\BytedanceSeedance25Request $bytedanceSeedanceV2_5
  ): self {
    return new self($bytedanceSeedanceV2_5, 6);
  }

  // Type checking methods
  /**
   * Check if this VideoGenerationRequest contains a \ElevenLabs\Types\CreatifyAuroraRequest
   */
  public function isCreatifyAurora(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this VideoGenerationRequest contains a \ElevenLabs\Types\Veo31Request
   */
  public function isVeo3_1Generate001(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this VideoGenerationRequest contains a \ElevenLabs\Types\Veo31FastRequest
   */
  public function isVeo3_1FastGenerate001(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this VideoGenerationRequest contains a \ElevenLabs\Types\BytedanceSeedance2Request
   */
  public function isBytedanceSeedanceV2(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this VideoGenerationRequest contains a \ElevenLabs\Types\BytedanceSeedance2FastRequest
   */
  public function isBytedanceSeedanceV2Fast(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this VideoGenerationRequest contains a \ElevenLabs\Types\BytedanceSeedance2MiniRequest
   */
  public function isBytedanceSeedanceV2Mini(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this VideoGenerationRequest contains a \ElevenLabs\Types\BytedanceSeedance25Request
   */
  public function isBytedanceSeedanceV2_5(): bool
  {
    return $this->typeIndex === 6;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\CreatifyAuroraRequest value
   * @throws \RuntimeException if this VideoGenerationRequest does not contain a \ElevenLabs\Types\CreatifyAuroraRequest
   */
  public function asCreatifyAurora(): \ElevenLabs\Types\CreatifyAuroraRequest
  {
    if (!$this->isCreatifyAurora()) {
      throw new \RuntimeException(
        'VideoGenerationRequest does not contain \ElevenLabs\Types\CreatifyAuroraRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\Veo31Request value
   * @throws \RuntimeException if this VideoGenerationRequest does not contain a \ElevenLabs\Types\Veo31Request
   */
  public function asVeo3_1Generate001(): \ElevenLabs\Types\Veo31Request
  {
    if (!$this->isVeo3_1Generate001()) {
      throw new \RuntimeException(
        'VideoGenerationRequest does not contain \ElevenLabs\Types\Veo31Request'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\Veo31FastRequest value
   * @throws \RuntimeException if this VideoGenerationRequest does not contain a \ElevenLabs\Types\Veo31FastRequest
   */
  public function asVeo3_1FastGenerate001(): \ElevenLabs\Types\Veo31FastRequest
  {
    if (!$this->isVeo3_1FastGenerate001()) {
      throw new \RuntimeException(
        'VideoGenerationRequest does not contain \ElevenLabs\Types\Veo31FastRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\BytedanceSeedance2Request value
   * @throws \RuntimeException if this VideoGenerationRequest does not contain a \ElevenLabs\Types\BytedanceSeedance2Request
   */
  public function asBytedanceSeedanceV2(): \ElevenLabs\Types\BytedanceSeedance2Request
  {
    if (!$this->isBytedanceSeedanceV2()) {
      throw new \RuntimeException(
        'VideoGenerationRequest does not contain \ElevenLabs\Types\BytedanceSeedance2Request'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\BytedanceSeedance2FastRequest value
   * @throws \RuntimeException if this VideoGenerationRequest does not contain a \ElevenLabs\Types\BytedanceSeedance2FastRequest
   */
  public function asBytedanceSeedanceV2Fast(): \ElevenLabs\Types\BytedanceSeedance2FastRequest
  {
    if (!$this->isBytedanceSeedanceV2Fast()) {
      throw new \RuntimeException(
        'VideoGenerationRequest does not contain \ElevenLabs\Types\BytedanceSeedance2FastRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\BytedanceSeedance2MiniRequest value
   * @throws \RuntimeException if this VideoGenerationRequest does not contain a \ElevenLabs\Types\BytedanceSeedance2MiniRequest
   */
  public function asBytedanceSeedanceV2Mini(): \ElevenLabs\Types\BytedanceSeedance2MiniRequest
  {
    if (!$this->isBytedanceSeedanceV2Mini()) {
      throw new \RuntimeException(
        'VideoGenerationRequest does not contain \ElevenLabs\Types\BytedanceSeedance2MiniRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\BytedanceSeedance25Request value
   * @throws \RuntimeException if this VideoGenerationRequest does not contain a \ElevenLabs\Types\BytedanceSeedance25Request
   */
  public function asBytedanceSeedanceV2_5(): \ElevenLabs\Types\BytedanceSeedance25Request
  {
    if (!$this->isBytedanceSeedanceV2_5()) {
      throw new \RuntimeException(
        'VideoGenerationRequest does not contain \ElevenLabs\Types\BytedanceSeedance25Request'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\CreatifyAuroraRequest value
   * @return \ElevenLabs\Types\CreatifyAuroraRequest|null Returns the value if this VideoGenerationRequest contains a \ElevenLabs\Types\CreatifyAuroraRequest, null otherwise
   */
  public function tryAsCreatifyAurora(): ?\ElevenLabs\Types\CreatifyAuroraRequest
  {
    return $this->isCreatifyAurora() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\Veo31Request value
   * @return \ElevenLabs\Types\Veo31Request|null Returns the value if this VideoGenerationRequest contains a \ElevenLabs\Types\Veo31Request, null otherwise
   */
  public function tryAsVeo3_1Generate001(): ?\ElevenLabs\Types\Veo31Request
  {
    return $this->isVeo3_1Generate001() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\Veo31FastRequest value
   * @return \ElevenLabs\Types\Veo31FastRequest|null Returns the value if this VideoGenerationRequest contains a \ElevenLabs\Types\Veo31FastRequest, null otherwise
   */
  public function tryAsVeo3_1FastGenerate001(): ?\ElevenLabs\Types\Veo31FastRequest
  {
    return $this->isVeo3_1FastGenerate001() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\BytedanceSeedance2Request value
   * @return \ElevenLabs\Types\BytedanceSeedance2Request|null Returns the value if this VideoGenerationRequest contains a \ElevenLabs\Types\BytedanceSeedance2Request, null otherwise
   */
  public function tryAsBytedanceSeedanceV2(): ?\ElevenLabs\Types\BytedanceSeedance2Request
  {
    return $this->isBytedanceSeedanceV2() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\BytedanceSeedance2FastRequest value
   * @return \ElevenLabs\Types\BytedanceSeedance2FastRequest|null Returns the value if this VideoGenerationRequest contains a \ElevenLabs\Types\BytedanceSeedance2FastRequest, null otherwise
   */
  public function tryAsBytedanceSeedanceV2Fast(): ?\ElevenLabs\Types\BytedanceSeedance2FastRequest
  {
    return $this->isBytedanceSeedanceV2Fast() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\BytedanceSeedance2MiniRequest value
   * @return \ElevenLabs\Types\BytedanceSeedance2MiniRequest|null Returns the value if this VideoGenerationRequest contains a \ElevenLabs\Types\BytedanceSeedance2MiniRequest, null otherwise
   */
  public function tryAsBytedanceSeedanceV2Mini(): ?\ElevenLabs\Types\BytedanceSeedance2MiniRequest
  {
    return $this->isBytedanceSeedanceV2Mini() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\BytedanceSeedance25Request value
   * @return \ElevenLabs\Types\BytedanceSeedance25Request|null Returns the value if this VideoGenerationRequest contains a \ElevenLabs\Types\BytedanceSeedance25Request, null otherwise
   */
  public function tryAsBytedanceSeedanceV2_5(): ?\ElevenLabs\Types\BytedanceSeedance25Request
  {
    return $this->isBytedanceSeedanceV2_5() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\CreatifyAuroraRequest): T $onCreatifyAurora
   * @param callable(\ElevenLabs\Types\Veo31Request): T $onVeo3_1Generate001
   * @param callable(\ElevenLabs\Types\Veo31FastRequest): T $onVeo3_1FastGenerate001
   * @param callable(\ElevenLabs\Types\BytedanceSeedance2Request): T $onBytedanceSeedanceV2
   * @param callable(\ElevenLabs\Types\BytedanceSeedance2FastRequest): T $onBytedanceSeedanceV2Fast
   * @param callable(\ElevenLabs\Types\BytedanceSeedance2MiniRequest): T $onBytedanceSeedanceV2Mini
   * @param callable(\ElevenLabs\Types\BytedanceSeedance25Request): T $onBytedanceSeedanceV2_5
   * @return T
   */
  public function match(
    callable $onCreatifyAurora,
    callable $onVeo3_1Generate001,
    callable $onVeo3_1FastGenerate001,
    callable $onBytedanceSeedanceV2,
    callable $onBytedanceSeedanceV2Fast,
    callable $onBytedanceSeedanceV2Mini,
    callable $onBytedanceSeedanceV2_5
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onCreatifyAurora($this->value),
      1 => $onVeo3_1Generate001($this->value),
      2 => $onVeo3_1FastGenerate001($this->value),
      3 => $onBytedanceSeedanceV2($this->value),
      4 => $onBytedanceSeedanceV2Fast($this->value),
      5 => $onBytedanceSeedanceV2Mini($this->value),
      6 => $onBytedanceSeedanceV2_5($this->value),
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
    if (is_array($data) && isset($data['model_id']) && is_string($data['model_id'])) {
      switch ($data['model_id']) {
        case 'bytedance-seedance-v2':
          return new self(\ElevenLabs\Types\BytedanceSeedance2Request::fromArray($data), 3);
        case 'bytedance-seedance-v2-fast':
          return new self(\ElevenLabs\Types\BytedanceSeedance2FastRequest::fromArray($data), 4);
        case 'bytedance-seedance-v2-mini':
          return new self(\ElevenLabs\Types\BytedanceSeedance2MiniRequest::fromArray($data), 5);
        case 'bytedance-seedance-v2.5':
          return new self(\ElevenLabs\Types\BytedanceSeedance25Request::fromArray($data), 6);
        case 'creatify-aurora':
          return new self(\ElevenLabs\Types\CreatifyAuroraRequest::fromArray($data), 0);
        case 'veo-3.1-fast-generate-001':
          return new self(\ElevenLabs\Types\Veo31FastRequest::fromArray($data), 2);
        case 'veo-3.1-generate-001':
          return new self(\ElevenLabs\Types\Veo31Request::fromArray($data), 1);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\CreatifyAuroraRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreatifyAuroraRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\Veo31Request::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Veo31Request didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\Veo31FastRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Veo31FastRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\BytedanceSeedance2Request::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BytedanceSeedance2Request didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\BytedanceSeedance2FastRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BytedanceSeedance2FastRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\BytedanceSeedance2MiniRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BytedanceSeedance2MiniRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\BytedanceSeedance25Request::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BytedanceSeedance25Request didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any VideoGenerationRequest type');
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
