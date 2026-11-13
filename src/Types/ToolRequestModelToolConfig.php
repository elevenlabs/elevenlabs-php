<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Configuration for the tool
 */
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
class ToolRequestModelToolConfig extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\WebhookToolConfigInput|\ElevenLabs\Types\ClientToolConfigInput|\ElevenLabs\Types\SystemToolConfigInput|mixed|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this ToolRequestModelToolConfig holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('ToolRequestModelToolConfig does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\WebhookToolConfigInput|\ElevenLabs\Types\ClientToolConfigInput|\ElevenLabs\Types\SystemToolConfigInput|mixed|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'webhook',
      1 => 'client',
      2 => 'system',
      3 => 'mcp',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a ToolRequestModelToolConfig instance containing a \ElevenLabs\Types\WebhookToolConfigInput
   */
  public static function webhook(\ElevenLabs\Types\WebhookToolConfigInput $webhook): self
  {
    return new self($webhook, 0);
  }

  /**
   * Create a ToolRequestModelToolConfig instance containing a \ElevenLabs\Types\ClientToolConfigInput
   */
  public static function client(\ElevenLabs\Types\ClientToolConfigInput $client): self
  {
    return new self($client, 1);
  }

  /**
   * Create a ToolRequestModelToolConfig instance containing a \ElevenLabs\Types\SystemToolConfigInput
   */
  public static function system(\ElevenLabs\Types\SystemToolConfigInput $system): self
  {
    return new self($system, 2);
  }

  /**
   * Create a ToolRequestModelToolConfig instance containing a mixed
   */
  public static function mcp(mixed $mcp): self
  {
    return new self($mcp, 3);
  }

  // Type checking methods
  /**
   * Check if this ToolRequestModelToolConfig contains a \ElevenLabs\Types\WebhookToolConfigInput
   */
  public function isWebhook(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ToolRequestModelToolConfig contains a \ElevenLabs\Types\ClientToolConfigInput
   */
  public function isClient(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ToolRequestModelToolConfig contains a \ElevenLabs\Types\SystemToolConfigInput
   */
  public function isSystem(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ToolRequestModelToolConfig contains a mixed
   */
  public function isMcp(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\WebhookToolConfigInput value
   * @throws \RuntimeException if this ToolRequestModelToolConfig does not contain a \ElevenLabs\Types\WebhookToolConfigInput
   */
  public function asWebhook(): \ElevenLabs\Types\WebhookToolConfigInput
  {
    if (!$this->isWebhook()) {
      throw new \RuntimeException(
        'ToolRequestModelToolConfig does not contain \ElevenLabs\Types\WebhookToolConfigInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ClientToolConfigInput value
   * @throws \RuntimeException if this ToolRequestModelToolConfig does not contain a \ElevenLabs\Types\ClientToolConfigInput
   */
  public function asClient(): \ElevenLabs\Types\ClientToolConfigInput
  {
    if (!$this->isClient()) {
      throw new \RuntimeException(
        'ToolRequestModelToolConfig does not contain \ElevenLabs\Types\ClientToolConfigInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SystemToolConfigInput value
   * @throws \RuntimeException if this ToolRequestModelToolConfig does not contain a \ElevenLabs\Types\SystemToolConfigInput
   */
  public function asSystem(): \ElevenLabs\Types\SystemToolConfigInput
  {
    if (!$this->isSystem()) {
      throw new \RuntimeException(
        'ToolRequestModelToolConfig does not contain \ElevenLabs\Types\SystemToolConfigInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the mixed value
   * @throws \RuntimeException if this ToolRequestModelToolConfig does not contain a mixed
   */
  public function asMcp(): mixed
  {
    if (!$this->isMcp()) {
      throw new \RuntimeException('ToolRequestModelToolConfig does not contain mixed');
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\WebhookToolConfigInput value
   * @return \ElevenLabs\Types\WebhookToolConfigInput|null Returns the value if this ToolRequestModelToolConfig contains a \ElevenLabs\Types\WebhookToolConfigInput, null otherwise
   */
  public function tryAsWebhook(): ?\ElevenLabs\Types\WebhookToolConfigInput
  {
    return $this->isWebhook() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ClientToolConfigInput value
   * @return \ElevenLabs\Types\ClientToolConfigInput|null Returns the value if this ToolRequestModelToolConfig contains a \ElevenLabs\Types\ClientToolConfigInput, null otherwise
   */
  public function tryAsClient(): ?\ElevenLabs\Types\ClientToolConfigInput
  {
    return $this->isClient() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SystemToolConfigInput value
   * @return \ElevenLabs\Types\SystemToolConfigInput|null Returns the value if this ToolRequestModelToolConfig contains a \ElevenLabs\Types\SystemToolConfigInput, null otherwise
   */
  public function tryAsSystem(): ?\ElevenLabs\Types\SystemToolConfigInput
  {
    return $this->isSystem() ? $this->value : null;
  }

  /**
   * Try to get the mixed value
   * @return mixed Returns the value if this ToolRequestModelToolConfig contains a mixed, null otherwise
   */
  public function tryAsMcp(): mixed
  {
    return $this->isMcp() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\WebhookToolConfigInput): T $onWebhook
   * @param callable(\ElevenLabs\Types\ClientToolConfigInput): T $onClient
   * @param callable(\ElevenLabs\Types\SystemToolConfigInput): T $onSystem
   * @param callable(mixed): T $onMcp
   * @return T
   */
  public function match(
    callable $onWebhook,
    callable $onClient,
    callable $onSystem,
    callable $onMcp
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onWebhook($this->value),
      1 => $onClient($this->value),
      2 => $onSystem($this->value),
      3 => $onMcp($this->value),
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
        case 'client':
          return new self(\ElevenLabs\Types\ClientToolConfigInput::fromArray($data), 1);
        case 'mcp':
          return new self($data, 3);
        case 'system':
          return new self(\ElevenLabs\Types\SystemToolConfigInput::fromArray($data), 2);
        case 'webhook':
          return new self(\ElevenLabs\Types\WebhookToolConfigInput::fromArray($data), 0);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\WebhookToolConfigInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WebhookToolConfigInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ClientToolConfigInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ClientToolConfigInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SystemToolConfigInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SystemToolConfigInput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any ToolRequestModelToolConfig type'
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
    if (!($this->value instanceof \JsonSerializable)) {
      return $this->value;
    }
    return $this->value->jsonSerialize();
  }
}
