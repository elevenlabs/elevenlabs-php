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
class ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails|\ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails|\ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails|\ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails|\ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails|\ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails|\ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'webhook',
      1 => 'client',
      2 => 'mcp',
      3 => 'api_integration_webhook',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails instance containing a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails
   */
  public static function webhook(
    \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails $webhook
  ): self {
    return new self($webhook, 0);
  }

  /**
   * Create a ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails instance containing a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails
   */
  public static function client(
    \ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails $client
  ): self {
    return new self($client, 1);
  }

  /**
   * Create a ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails instance containing a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails
   */
  public static function mcp(
    \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails $mcp
  ): self {
    return new self($mcp, 2);
  }

  /**
   * Create a ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails instance containing a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput
   */
  public static function apiIntegrationWebhook(
    \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput $apiIntegrationWebhook
  ): self {
    return new self($apiIntegrationWebhook, 3);
  }

  // Type checking methods
  /**
   * Check if this ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails contains a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails
   */
  public function isWebhook(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails contains a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails
   */
  public function isClient(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails contains a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails
   */
  public function isMcp(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails contains a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput
   */
  public function isApiIntegrationWebhook(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails value
   * @throws \RuntimeException if this ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails does not contain a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails
   */
  public function asWebhook(): \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails
  {
    if (!$this->isWebhook()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails does not contain \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails value
   * @throws \RuntimeException if this ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails does not contain a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails
   */
  public function asClient(): \ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails
  {
    if (!$this->isClient()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails does not contain \ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails value
   * @throws \RuntimeException if this ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails does not contain a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails
   */
  public function asMcp(): \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails
  {
    if (!$this->isMcp()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails does not contain \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput value
   * @throws \RuntimeException if this ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails does not contain a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput
   */
  public function asApiIntegrationWebhook(): \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput
  {
    if (!$this->isApiIntegrationWebhook()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails does not contain \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails value
   * @return \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails|null Returns the value if this ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails contains a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails, null otherwise
   */
  public function tryAsWebhook(): ?\ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails
  {
    return $this->isWebhook() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails value
   * @return \ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails|null Returns the value if this ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails contains a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails, null otherwise
   */
  public function tryAsClient(): ?\ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails
  {
    return $this->isClient() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails value
   * @return \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails|null Returns the value if this ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails contains a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails, null otherwise
   */
  public function tryAsMcp(): ?\ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails
  {
    return $this->isMcp() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput value
   * @return \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput|null Returns the value if this ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails contains a \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput, null otherwise
   */
  public function tryAsApiIntegrationWebhook(): ?\ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput
  {
    return $this->isApiIntegrationWebhook() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails): T $onWebhook
   * @param callable(\ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails): T $onClient
   * @param callable(\ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails): T $onMcp
   * @param callable(\ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput): T $onApiIntegrationWebhook
   * @return T
   */
  public function match(
    callable $onWebhook,
    callable $onClient,
    callable $onMcp,
    callable $onApiIntegrationWebhook
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onWebhook($this->value),
      1 => $onClient($this->value),
      2 => $onMcp($this->value),
      3 => $onApiIntegrationWebhook($this->value),
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
        case 'api_integration_webhook':
          return new self(
            \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput::fromArray(
              $data
            ),
            3
          );
        case 'client':
          return new self(
            \ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails::fromArray($data),
            1
          );
        case 'mcp':
          return new self(
            \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails::fromArray($data),
            2
          );
        case 'webhook':
          return new self(
            \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails::fromArray($data),
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
      $candidate = \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails::fromArray(
        $data
      );
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails::fromArray(
        $data
      );
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistoryTranscriptToolCallClientDetails didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails::fromArray(
        $data
      );
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput::fromArray(
        $data
      );
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any ConversationHistoryTranscriptToolCallCommonModelOutputToolDetails type'
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
