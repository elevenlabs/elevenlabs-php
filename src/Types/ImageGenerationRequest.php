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
class ImageGenerationRequest extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $modelId;

  /**
   * @var \ElevenLabs\Types\GptImage1Request|\ElevenLabs\Types\GptImage15Request|\ElevenLabs\Types\GptImage2Request|\ElevenLabs\Types\GptImage25SunburstRequest|\ElevenLabs\Types\GptImage25FlareRequest|\ElevenLabs\Types\Gemini25FlashImageRequest|\ElevenLabs\Types\Gemini3ProImageRequest|\ElevenLabs\Types\Gemini31FlashImageRequest|\ElevenLabs\Types\Gemini31FlashLiteImageRequest|\ElevenLabs\Types\BytedanceSeedream5LiteRequest|\ElevenLabs\Types\BytedanceSeedream5ProRequest|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this ImageGenerationRequest holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('ImageGenerationRequest does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\GptImage1Request|\ElevenLabs\Types\GptImage15Request|\ElevenLabs\Types\GptImage2Request|\ElevenLabs\Types\GptImage25SunburstRequest|\ElevenLabs\Types\GptImage25FlareRequest|\ElevenLabs\Types\Gemini25FlashImageRequest|\ElevenLabs\Types\Gemini3ProImageRequest|\ElevenLabs\Types\Gemini31FlashImageRequest|\ElevenLabs\Types\Gemini31FlashLiteImageRequest|\ElevenLabs\Types\BytedanceSeedream5LiteRequest|\ElevenLabs\Types\BytedanceSeedream5ProRequest|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->modelId = match ($typeIndex) {
      0 => 'gpt-image-1',
      1 => 'gpt-image-1.5',
      2 => 'gpt-image-2',
      3 => 'gpt-image-2.5-sunburst',
      4 => 'gpt-image-2.5-flare',
      5 => 'gemini-2.5-flash-image',
      6 => 'gemini-3-pro-image',
      7 => 'gemini-3.1-flash-image',
      8 => 'gemini-3.1-flash-lite-image',
      9 => 'bytedance-seedream-5-lite',
      10 => 'bytedance-seedream-5-pro',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a ImageGenerationRequest instance containing a \ElevenLabs\Types\GptImage1Request
   */
  public static function gptImage1(\ElevenLabs\Types\GptImage1Request $gptImage1): self
  {
    return new self($gptImage1, 0);
  }

  /**
   * Create a ImageGenerationRequest instance containing a \ElevenLabs\Types\GptImage15Request
   */
  public static function gptImage1_5(\ElevenLabs\Types\GptImage15Request $gptImage1_5): self
  {
    return new self($gptImage1_5, 1);
  }

  /**
   * Create a ImageGenerationRequest instance containing a \ElevenLabs\Types\GptImage2Request
   */
  public static function gptImage2(\ElevenLabs\Types\GptImage2Request $gptImage2): self
  {
    return new self($gptImage2, 2);
  }

  /**
   * Create a ImageGenerationRequest instance containing a \ElevenLabs\Types\GptImage25SunburstRequest
   */
  public static function gptImage2_5Sunburst(
    \ElevenLabs\Types\GptImage25SunburstRequest $gptImage2_5Sunburst
  ): self {
    return new self($gptImage2_5Sunburst, 3);
  }

  /**
   * Create a ImageGenerationRequest instance containing a \ElevenLabs\Types\GptImage25FlareRequest
   */
  public static function gptImage2_5Flare(
    \ElevenLabs\Types\GptImage25FlareRequest $gptImage2_5Flare
  ): self {
    return new self($gptImage2_5Flare, 4);
  }

  /**
   * Create a ImageGenerationRequest instance containing a \ElevenLabs\Types\Gemini25FlashImageRequest
   */
  public static function gemini2_5FlashImage(
    \ElevenLabs\Types\Gemini25FlashImageRequest $gemini2_5FlashImage
  ): self {
    return new self($gemini2_5FlashImage, 5);
  }

  /**
   * Create a ImageGenerationRequest instance containing a \ElevenLabs\Types\Gemini3ProImageRequest
   */
  public static function gemini3ProImage(
    \ElevenLabs\Types\Gemini3ProImageRequest $gemini3ProImage
  ): self {
    return new self($gemini3ProImage, 6);
  }

  /**
   * Create a ImageGenerationRequest instance containing a \ElevenLabs\Types\Gemini31FlashImageRequest
   */
  public static function gemini3_1FlashImage(
    \ElevenLabs\Types\Gemini31FlashImageRequest $gemini3_1FlashImage
  ): self {
    return new self($gemini3_1FlashImage, 7);
  }

  /**
   * Create a ImageGenerationRequest instance containing a \ElevenLabs\Types\Gemini31FlashLiteImageRequest
   */
  public static function gemini3_1FlashLiteImage(
    \ElevenLabs\Types\Gemini31FlashLiteImageRequest $gemini3_1FlashLiteImage
  ): self {
    return new self($gemini3_1FlashLiteImage, 8);
  }

  /**
   * Create a ImageGenerationRequest instance containing a \ElevenLabs\Types\BytedanceSeedream5LiteRequest
   */
  public static function bytedanceSeedream5Lite(
    \ElevenLabs\Types\BytedanceSeedream5LiteRequest $bytedanceSeedream5Lite
  ): self {
    return new self($bytedanceSeedream5Lite, 9);
  }

  /**
   * Create a ImageGenerationRequest instance containing a \ElevenLabs\Types\BytedanceSeedream5ProRequest
   */
  public static function bytedanceSeedream5Pro(
    \ElevenLabs\Types\BytedanceSeedream5ProRequest $bytedanceSeedream5Pro
  ): self {
    return new self($bytedanceSeedream5Pro, 10);
  }

  // Type checking methods
  /**
   * Check if this ImageGenerationRequest contains a \ElevenLabs\Types\GptImage1Request
   */
  public function isGptImage1(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ImageGenerationRequest contains a \ElevenLabs\Types\GptImage15Request
   */
  public function isGptImage1_5(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ImageGenerationRequest contains a \ElevenLabs\Types\GptImage2Request
   */
  public function isGptImage2(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ImageGenerationRequest contains a \ElevenLabs\Types\GptImage25SunburstRequest
   */
  public function isGptImage2_5Sunburst(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this ImageGenerationRequest contains a \ElevenLabs\Types\GptImage25FlareRequest
   */
  public function isGptImage2_5Flare(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this ImageGenerationRequest contains a \ElevenLabs\Types\Gemini25FlashImageRequest
   */
  public function isGemini2_5FlashImage(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this ImageGenerationRequest contains a \ElevenLabs\Types\Gemini3ProImageRequest
   */
  public function isGemini3ProImage(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this ImageGenerationRequest contains a \ElevenLabs\Types\Gemini31FlashImageRequest
   */
  public function isGemini3_1FlashImage(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this ImageGenerationRequest contains a \ElevenLabs\Types\Gemini31FlashLiteImageRequest
   */
  public function isGemini3_1FlashLiteImage(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this ImageGenerationRequest contains a \ElevenLabs\Types\BytedanceSeedream5LiteRequest
   */
  public function isBytedanceSeedream5Lite(): bool
  {
    return $this->typeIndex === 9;
  }

  /**
   * Check if this ImageGenerationRequest contains a \ElevenLabs\Types\BytedanceSeedream5ProRequest
   */
  public function isBytedanceSeedream5Pro(): bool
  {
    return $this->typeIndex === 10;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\GptImage1Request value
   * @throws \RuntimeException if this ImageGenerationRequest does not contain a \ElevenLabs\Types\GptImage1Request
   */
  public function asGptImage1(): \ElevenLabs\Types\GptImage1Request
  {
    if (!$this->isGptImage1()) {
      throw new \RuntimeException(
        'ImageGenerationRequest does not contain \ElevenLabs\Types\GptImage1Request'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GptImage15Request value
   * @throws \RuntimeException if this ImageGenerationRequest does not contain a \ElevenLabs\Types\GptImage15Request
   */
  public function asGptImage1_5(): \ElevenLabs\Types\GptImage15Request
  {
    if (!$this->isGptImage1_5()) {
      throw new \RuntimeException(
        'ImageGenerationRequest does not contain \ElevenLabs\Types\GptImage15Request'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GptImage2Request value
   * @throws \RuntimeException if this ImageGenerationRequest does not contain a \ElevenLabs\Types\GptImage2Request
   */
  public function asGptImage2(): \ElevenLabs\Types\GptImage2Request
  {
    if (!$this->isGptImage2()) {
      throw new \RuntimeException(
        'ImageGenerationRequest does not contain \ElevenLabs\Types\GptImage2Request'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GptImage25SunburstRequest value
   * @throws \RuntimeException if this ImageGenerationRequest does not contain a \ElevenLabs\Types\GptImage25SunburstRequest
   */
  public function asGptImage2_5Sunburst(): \ElevenLabs\Types\GptImage25SunburstRequest
  {
    if (!$this->isGptImage2_5Sunburst()) {
      throw new \RuntimeException(
        'ImageGenerationRequest does not contain \ElevenLabs\Types\GptImage25SunburstRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GptImage25FlareRequest value
   * @throws \RuntimeException if this ImageGenerationRequest does not contain a \ElevenLabs\Types\GptImage25FlareRequest
   */
  public function asGptImage2_5Flare(): \ElevenLabs\Types\GptImage25FlareRequest
  {
    if (!$this->isGptImage2_5Flare()) {
      throw new \RuntimeException(
        'ImageGenerationRequest does not contain \ElevenLabs\Types\GptImage25FlareRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\Gemini25FlashImageRequest value
   * @throws \RuntimeException if this ImageGenerationRequest does not contain a \ElevenLabs\Types\Gemini25FlashImageRequest
   */
  public function asGemini2_5FlashImage(): \ElevenLabs\Types\Gemini25FlashImageRequest
  {
    if (!$this->isGemini2_5FlashImage()) {
      throw new \RuntimeException(
        'ImageGenerationRequest does not contain \ElevenLabs\Types\Gemini25FlashImageRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\Gemini3ProImageRequest value
   * @throws \RuntimeException if this ImageGenerationRequest does not contain a \ElevenLabs\Types\Gemini3ProImageRequest
   */
  public function asGemini3ProImage(): \ElevenLabs\Types\Gemini3ProImageRequest
  {
    if (!$this->isGemini3ProImage()) {
      throw new \RuntimeException(
        'ImageGenerationRequest does not contain \ElevenLabs\Types\Gemini3ProImageRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\Gemini31FlashImageRequest value
   * @throws \RuntimeException if this ImageGenerationRequest does not contain a \ElevenLabs\Types\Gemini31FlashImageRequest
   */
  public function asGemini3_1FlashImage(): \ElevenLabs\Types\Gemini31FlashImageRequest
  {
    if (!$this->isGemini3_1FlashImage()) {
      throw new \RuntimeException(
        'ImageGenerationRequest does not contain \ElevenLabs\Types\Gemini31FlashImageRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\Gemini31FlashLiteImageRequest value
   * @throws \RuntimeException if this ImageGenerationRequest does not contain a \ElevenLabs\Types\Gemini31FlashLiteImageRequest
   */
  public function asGemini3_1FlashLiteImage(): \ElevenLabs\Types\Gemini31FlashLiteImageRequest
  {
    if (!$this->isGemini3_1FlashLiteImage()) {
      throw new \RuntimeException(
        'ImageGenerationRequest does not contain \ElevenLabs\Types\Gemini31FlashLiteImageRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\BytedanceSeedream5LiteRequest value
   * @throws \RuntimeException if this ImageGenerationRequest does not contain a \ElevenLabs\Types\BytedanceSeedream5LiteRequest
   */
  public function asBytedanceSeedream5Lite(): \ElevenLabs\Types\BytedanceSeedream5LiteRequest
  {
    if (!$this->isBytedanceSeedream5Lite()) {
      throw new \RuntimeException(
        'ImageGenerationRequest does not contain \ElevenLabs\Types\BytedanceSeedream5LiteRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\BytedanceSeedream5ProRequest value
   * @throws \RuntimeException if this ImageGenerationRequest does not contain a \ElevenLabs\Types\BytedanceSeedream5ProRequest
   */
  public function asBytedanceSeedream5Pro(): \ElevenLabs\Types\BytedanceSeedream5ProRequest
  {
    if (!$this->isBytedanceSeedream5Pro()) {
      throw new \RuntimeException(
        'ImageGenerationRequest does not contain \ElevenLabs\Types\BytedanceSeedream5ProRequest'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\GptImage1Request value
   * @return \ElevenLabs\Types\GptImage1Request|null Returns the value if this ImageGenerationRequest contains a \ElevenLabs\Types\GptImage1Request, null otherwise
   */
  public function tryAsGptImage1(): ?\ElevenLabs\Types\GptImage1Request
  {
    return $this->isGptImage1() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GptImage15Request value
   * @return \ElevenLabs\Types\GptImage15Request|null Returns the value if this ImageGenerationRequest contains a \ElevenLabs\Types\GptImage15Request, null otherwise
   */
  public function tryAsGptImage1_5(): ?\ElevenLabs\Types\GptImage15Request
  {
    return $this->isGptImage1_5() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GptImage2Request value
   * @return \ElevenLabs\Types\GptImage2Request|null Returns the value if this ImageGenerationRequest contains a \ElevenLabs\Types\GptImage2Request, null otherwise
   */
  public function tryAsGptImage2(): ?\ElevenLabs\Types\GptImage2Request
  {
    return $this->isGptImage2() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GptImage25SunburstRequest value
   * @return \ElevenLabs\Types\GptImage25SunburstRequest|null Returns the value if this ImageGenerationRequest contains a \ElevenLabs\Types\GptImage25SunburstRequest, null otherwise
   */
  public function tryAsGptImage2_5Sunburst(): ?\ElevenLabs\Types\GptImage25SunburstRequest
  {
    return $this->isGptImage2_5Sunburst() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GptImage25FlareRequest value
   * @return \ElevenLabs\Types\GptImage25FlareRequest|null Returns the value if this ImageGenerationRequest contains a \ElevenLabs\Types\GptImage25FlareRequest, null otherwise
   */
  public function tryAsGptImage2_5Flare(): ?\ElevenLabs\Types\GptImage25FlareRequest
  {
    return $this->isGptImage2_5Flare() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\Gemini25FlashImageRequest value
   * @return \ElevenLabs\Types\Gemini25FlashImageRequest|null Returns the value if this ImageGenerationRequest contains a \ElevenLabs\Types\Gemini25FlashImageRequest, null otherwise
   */
  public function tryAsGemini2_5FlashImage(): ?\ElevenLabs\Types\Gemini25FlashImageRequest
  {
    return $this->isGemini2_5FlashImage() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\Gemini3ProImageRequest value
   * @return \ElevenLabs\Types\Gemini3ProImageRequest|null Returns the value if this ImageGenerationRequest contains a \ElevenLabs\Types\Gemini3ProImageRequest, null otherwise
   */
  public function tryAsGemini3ProImage(): ?\ElevenLabs\Types\Gemini3ProImageRequest
  {
    return $this->isGemini3ProImage() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\Gemini31FlashImageRequest value
   * @return \ElevenLabs\Types\Gemini31FlashImageRequest|null Returns the value if this ImageGenerationRequest contains a \ElevenLabs\Types\Gemini31FlashImageRequest, null otherwise
   */
  public function tryAsGemini3_1FlashImage(): ?\ElevenLabs\Types\Gemini31FlashImageRequest
  {
    return $this->isGemini3_1FlashImage() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\Gemini31FlashLiteImageRequest value
   * @return \ElevenLabs\Types\Gemini31FlashLiteImageRequest|null Returns the value if this ImageGenerationRequest contains a \ElevenLabs\Types\Gemini31FlashLiteImageRequest, null otherwise
   */
  public function tryAsGemini3_1FlashLiteImage(): ?\ElevenLabs\Types\Gemini31FlashLiteImageRequest
  {
    return $this->isGemini3_1FlashLiteImage() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\BytedanceSeedream5LiteRequest value
   * @return \ElevenLabs\Types\BytedanceSeedream5LiteRequest|null Returns the value if this ImageGenerationRequest contains a \ElevenLabs\Types\BytedanceSeedream5LiteRequest, null otherwise
   */
  public function tryAsBytedanceSeedream5Lite(): ?\ElevenLabs\Types\BytedanceSeedream5LiteRequest
  {
    return $this->isBytedanceSeedream5Lite() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\BytedanceSeedream5ProRequest value
   * @return \ElevenLabs\Types\BytedanceSeedream5ProRequest|null Returns the value if this ImageGenerationRequest contains a \ElevenLabs\Types\BytedanceSeedream5ProRequest, null otherwise
   */
  public function tryAsBytedanceSeedream5Pro(): ?\ElevenLabs\Types\BytedanceSeedream5ProRequest
  {
    return $this->isBytedanceSeedream5Pro() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\GptImage1Request): T $onGptImage1
   * @param callable(\ElevenLabs\Types\GptImage15Request): T $onGptImage1_5
   * @param callable(\ElevenLabs\Types\GptImage2Request): T $onGptImage2
   * @param callable(\ElevenLabs\Types\GptImage25SunburstRequest): T $onGptImage2_5Sunburst
   * @param callable(\ElevenLabs\Types\GptImage25FlareRequest): T $onGptImage2_5Flare
   * @param callable(\ElevenLabs\Types\Gemini25FlashImageRequest): T $onGemini2_5FlashImage
   * @param callable(\ElevenLabs\Types\Gemini3ProImageRequest): T $onGemini3ProImage
   * @param callable(\ElevenLabs\Types\Gemini31FlashImageRequest): T $onGemini3_1FlashImage
   * @param callable(\ElevenLabs\Types\Gemini31FlashLiteImageRequest): T $onGemini3_1FlashLiteImage
   * @param callable(\ElevenLabs\Types\BytedanceSeedream5LiteRequest): T $onBytedanceSeedream5Lite
   * @param callable(\ElevenLabs\Types\BytedanceSeedream5ProRequest): T $onBytedanceSeedream5Pro
   * @return T
   */
  public function match(
    callable $onGptImage1,
    callable $onGptImage1_5,
    callable $onGptImage2,
    callable $onGptImage2_5Sunburst,
    callable $onGptImage2_5Flare,
    callable $onGemini2_5FlashImage,
    callable $onGemini3ProImage,
    callable $onGemini3_1FlashImage,
    callable $onGemini3_1FlashLiteImage,
    callable $onBytedanceSeedream5Lite,
    callable $onBytedanceSeedream5Pro
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onGptImage1($this->value),
      1 => $onGptImage1_5($this->value),
      2 => $onGptImage2($this->value),
      3 => $onGptImage2_5Sunburst($this->value),
      4 => $onGptImage2_5Flare($this->value),
      5 => $onGemini2_5FlashImage($this->value),
      6 => $onGemini3ProImage($this->value),
      7 => $onGemini3_1FlashImage($this->value),
      8 => $onGemini3_1FlashLiteImage($this->value),
      9 => $onBytedanceSeedream5Lite($this->value),
      10 => $onBytedanceSeedream5Pro($this->value),
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
        case 'bytedance-seedream-5-lite':
          return new self(\ElevenLabs\Types\BytedanceSeedream5LiteRequest::fromArray($data), 9);
        case 'bytedance-seedream-5-pro':
          return new self(\ElevenLabs\Types\BytedanceSeedream5ProRequest::fromArray($data), 10);
        case 'gemini-2.5-flash-image':
          return new self(\ElevenLabs\Types\Gemini25FlashImageRequest::fromArray($data), 5);
        case 'gemini-3-pro-image':
          return new self(\ElevenLabs\Types\Gemini3ProImageRequest::fromArray($data), 6);
        case 'gemini-3.1-flash-image':
          return new self(\ElevenLabs\Types\Gemini31FlashImageRequest::fromArray($data), 7);
        case 'gemini-3.1-flash-lite-image':
          return new self(\ElevenLabs\Types\Gemini31FlashLiteImageRequest::fromArray($data), 8);
        case 'gpt-image-1':
          return new self(\ElevenLabs\Types\GptImage1Request::fromArray($data), 0);
        case 'gpt-image-1.5':
          return new self(\ElevenLabs\Types\GptImage15Request::fromArray($data), 1);
        case 'gpt-image-2':
          return new self(\ElevenLabs\Types\GptImage2Request::fromArray($data), 2);
        case 'gpt-image-2.5-flare':
          return new self(\ElevenLabs\Types\GptImage25FlareRequest::fromArray($data), 4);
        case 'gpt-image-2.5-sunburst':
          return new self(\ElevenLabs\Types\GptImage25SunburstRequest::fromArray($data), 3);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\GptImage1Request::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GptImage1Request didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GptImage15Request::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GptImage15Request didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GptImage2Request::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GptImage2Request didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GptImage25SunburstRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GptImage25SunburstRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GptImage25FlareRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GptImage25FlareRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\Gemini25FlashImageRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Gemini25FlashImageRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\Gemini3ProImageRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Gemini3ProImageRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\Gemini31FlashImageRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Gemini31FlashImageRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\Gemini31FlashLiteImageRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Gemini31FlashLiteImageRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\BytedanceSeedream5LiteRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BytedanceSeedream5LiteRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\BytedanceSeedream5ProRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 10, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BytedanceSeedream5ProRequest didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any ImageGenerationRequest type');
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
