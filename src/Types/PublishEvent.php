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
class PublishEvent extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\UserAudioChunk|\ElevenLabs\Types\Feedback|\ElevenLabs\Types\UserMessage|\ElevenLabs\Types\UserActivity|\ElevenLabs\Types\MultimodalMessage|\ElevenLabs\Types\ConversationPong|\ElevenLabs\Types\ClientToolResult|\ElevenLabs\Types\McpToolApprovalResult|\ElevenLabs\Types\ContextualUpdate|\ElevenLabs\Types\ConversationInitiationClientData The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\UserAudioChunk|\ElevenLabs\Types\Feedback|\ElevenLabs\Types\UserMessage|\ElevenLabs\Types\UserActivity|\ElevenLabs\Types\MultimodalMessage|\ElevenLabs\Types\ConversationPong|\ElevenLabs\Types\ClientToolResult|\ElevenLabs\Types\McpToolApprovalResult|\ElevenLabs\Types\ContextualUpdate|\ElevenLabs\Types\ConversationInitiationClientData $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a PublishEvent instance containing a \ElevenLabs\Types\UserAudioChunk
   */
  public static function userAudioChunk(\ElevenLabs\Types\UserAudioChunk $userAudioChunk): self
  {
    return new self($userAudioChunk, 0);
  }

  /**
   * Create a PublishEvent instance containing a \ElevenLabs\Types\Feedback
   */
  public static function feedback(\ElevenLabs\Types\Feedback $feedback): self
  {
    return new self($feedback, 1);
  }

  /**
   * Create a PublishEvent instance containing a \ElevenLabs\Types\UserMessage
   */
  public static function userMessage(\ElevenLabs\Types\UserMessage $userMessage): self
  {
    return new self($userMessage, 2);
  }

  /**
   * Create a PublishEvent instance containing a \ElevenLabs\Types\UserActivity
   */
  public static function userActivity(\ElevenLabs\Types\UserActivity $userActivity): self
  {
    return new self($userActivity, 3);
  }

  /**
   * Create a PublishEvent instance containing a \ElevenLabs\Types\MultimodalMessage
   */
  public static function multimodalMessage(
    \ElevenLabs\Types\MultimodalMessage $multimodalMessage
  ): self {
    return new self($multimodalMessage, 4);
  }

  /**
   * Create a PublishEvent instance containing a \ElevenLabs\Types\ConversationPong
   */
  public static function conversationPong(
    \ElevenLabs\Types\ConversationPong $conversationPong
  ): self {
    return new self($conversationPong, 5);
  }

  /**
   * Create a PublishEvent instance containing a \ElevenLabs\Types\ClientToolResult
   */
  public static function clientToolResult(
    \ElevenLabs\Types\ClientToolResult $clientToolResult
  ): self {
    return new self($clientToolResult, 6);
  }

  /**
   * Create a PublishEvent instance containing a \ElevenLabs\Types\McpToolApprovalResult
   */
  public static function mcpToolApprovalResult(
    \ElevenLabs\Types\McpToolApprovalResult $mcpToolApprovalResult
  ): self {
    return new self($mcpToolApprovalResult, 7);
  }

  /**
   * Create a PublishEvent instance containing a \ElevenLabs\Types\ContextualUpdate
   */
  public static function contextualUpdate(
    \ElevenLabs\Types\ContextualUpdate $contextualUpdate
  ): self {
    return new self($contextualUpdate, 8);
  }

  /**
   * Create a PublishEvent instance containing a \ElevenLabs\Types\ConversationInitiationClientData
   */
  public static function conversationInitiationClientData(
    \ElevenLabs\Types\ConversationInitiationClientData $conversationInitiationClientData
  ): self {
    return new self($conversationInitiationClientData, 9);
  }

  // Type checking methods
  /**
   * Check if this PublishEvent contains a \ElevenLabs\Types\UserAudioChunk
   */
  public function isUserAudioChunk(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this PublishEvent contains a \ElevenLabs\Types\Feedback
   */
  public function isFeedback(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this PublishEvent contains a \ElevenLabs\Types\UserMessage
   */
  public function isUserMessage(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this PublishEvent contains a \ElevenLabs\Types\UserActivity
   */
  public function isUserActivity(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this PublishEvent contains a \ElevenLabs\Types\MultimodalMessage
   */
  public function isMultimodalMessage(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this PublishEvent contains a \ElevenLabs\Types\ConversationPong
   */
  public function isConversationPong(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this PublishEvent contains a \ElevenLabs\Types\ClientToolResult
   */
  public function isClientToolResult(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this PublishEvent contains a \ElevenLabs\Types\McpToolApprovalResult
   */
  public function isMcpToolApprovalResult(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this PublishEvent contains a \ElevenLabs\Types\ContextualUpdate
   */
  public function isContextualUpdate(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this PublishEvent contains a \ElevenLabs\Types\ConversationInitiationClientData
   */
  public function isConversationInitiationClientData(): bool
  {
    return $this->typeIndex === 9;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\UserAudioChunk value
   * @throws \RuntimeException if this PublishEvent does not contain a \ElevenLabs\Types\UserAudioChunk
   */
  public function asUserAudioChunk(): \ElevenLabs\Types\UserAudioChunk
  {
    if (!$this->isUserAudioChunk()) {
      throw new \RuntimeException('PublishEvent does not contain \ElevenLabs\Types\UserAudioChunk');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\Feedback value
   * @throws \RuntimeException if this PublishEvent does not contain a \ElevenLabs\Types\Feedback
   */
  public function asFeedback(): \ElevenLabs\Types\Feedback
  {
    if (!$this->isFeedback()) {
      throw new \RuntimeException('PublishEvent does not contain \ElevenLabs\Types\Feedback');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UserMessage value
   * @throws \RuntimeException if this PublishEvent does not contain a \ElevenLabs\Types\UserMessage
   */
  public function asUserMessage(): \ElevenLabs\Types\UserMessage
  {
    if (!$this->isUserMessage()) {
      throw new \RuntimeException('PublishEvent does not contain \ElevenLabs\Types\UserMessage');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UserActivity value
   * @throws \RuntimeException if this PublishEvent does not contain a \ElevenLabs\Types\UserActivity
   */
  public function asUserActivity(): \ElevenLabs\Types\UserActivity
  {
    if (!$this->isUserActivity()) {
      throw new \RuntimeException('PublishEvent does not contain \ElevenLabs\Types\UserActivity');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\MultimodalMessage value
   * @throws \RuntimeException if this PublishEvent does not contain a \ElevenLabs\Types\MultimodalMessage
   */
  public function asMultimodalMessage(): \ElevenLabs\Types\MultimodalMessage
  {
    if (!$this->isMultimodalMessage()) {
      throw new \RuntimeException(
        'PublishEvent does not contain \ElevenLabs\Types\MultimodalMessage'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationPong value
   * @throws \RuntimeException if this PublishEvent does not contain a \ElevenLabs\Types\ConversationPong
   */
  public function asConversationPong(): \ElevenLabs\Types\ConversationPong
  {
    if (!$this->isConversationPong()) {
      throw new \RuntimeException(
        'PublishEvent does not contain \ElevenLabs\Types\ConversationPong'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ClientToolResult value
   * @throws \RuntimeException if this PublishEvent does not contain a \ElevenLabs\Types\ClientToolResult
   */
  public function asClientToolResult(): \ElevenLabs\Types\ClientToolResult
  {
    if (!$this->isClientToolResult()) {
      throw new \RuntimeException(
        'PublishEvent does not contain \ElevenLabs\Types\ClientToolResult'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\McpToolApprovalResult value
   * @throws \RuntimeException if this PublishEvent does not contain a \ElevenLabs\Types\McpToolApprovalResult
   */
  public function asMcpToolApprovalResult(): \ElevenLabs\Types\McpToolApprovalResult
  {
    if (!$this->isMcpToolApprovalResult()) {
      throw new \RuntimeException(
        'PublishEvent does not contain \ElevenLabs\Types\McpToolApprovalResult'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ContextualUpdate value
   * @throws \RuntimeException if this PublishEvent does not contain a \ElevenLabs\Types\ContextualUpdate
   */
  public function asContextualUpdate(): \ElevenLabs\Types\ContextualUpdate
  {
    if (!$this->isContextualUpdate()) {
      throw new \RuntimeException(
        'PublishEvent does not contain \ElevenLabs\Types\ContextualUpdate'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationInitiationClientData value
   * @throws \RuntimeException if this PublishEvent does not contain a \ElevenLabs\Types\ConversationInitiationClientData
   */
  public function asConversationInitiationClientData(): \ElevenLabs\Types\ConversationInitiationClientData
  {
    if (!$this->isConversationInitiationClientData()) {
      throw new \RuntimeException(
        'PublishEvent does not contain \ElevenLabs\Types\ConversationInitiationClientData'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\UserAudioChunk value
   * @return \ElevenLabs\Types\UserAudioChunk|null Returns the value if this PublishEvent contains a \ElevenLabs\Types\UserAudioChunk, null otherwise
   */
  public function tryAsUserAudioChunk(): ?\ElevenLabs\Types\UserAudioChunk
  {
    return $this->isUserAudioChunk() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\Feedback value
   * @return \ElevenLabs\Types\Feedback|null Returns the value if this PublishEvent contains a \ElevenLabs\Types\Feedback, null otherwise
   */
  public function tryAsFeedback(): ?\ElevenLabs\Types\Feedback
  {
    return $this->isFeedback() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UserMessage value
   * @return \ElevenLabs\Types\UserMessage|null Returns the value if this PublishEvent contains a \ElevenLabs\Types\UserMessage, null otherwise
   */
  public function tryAsUserMessage(): ?\ElevenLabs\Types\UserMessage
  {
    return $this->isUserMessage() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UserActivity value
   * @return \ElevenLabs\Types\UserActivity|null Returns the value if this PublishEvent contains a \ElevenLabs\Types\UserActivity, null otherwise
   */
  public function tryAsUserActivity(): ?\ElevenLabs\Types\UserActivity
  {
    return $this->isUserActivity() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\MultimodalMessage value
   * @return \ElevenLabs\Types\MultimodalMessage|null Returns the value if this PublishEvent contains a \ElevenLabs\Types\MultimodalMessage, null otherwise
   */
  public function tryAsMultimodalMessage(): ?\ElevenLabs\Types\MultimodalMessage
  {
    return $this->isMultimodalMessage() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationPong value
   * @return \ElevenLabs\Types\ConversationPong|null Returns the value if this PublishEvent contains a \ElevenLabs\Types\ConversationPong, null otherwise
   */
  public function tryAsConversationPong(): ?\ElevenLabs\Types\ConversationPong
  {
    return $this->isConversationPong() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ClientToolResult value
   * @return \ElevenLabs\Types\ClientToolResult|null Returns the value if this PublishEvent contains a \ElevenLabs\Types\ClientToolResult, null otherwise
   */
  public function tryAsClientToolResult(): ?\ElevenLabs\Types\ClientToolResult
  {
    return $this->isClientToolResult() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\McpToolApprovalResult value
   * @return \ElevenLabs\Types\McpToolApprovalResult|null Returns the value if this PublishEvent contains a \ElevenLabs\Types\McpToolApprovalResult, null otherwise
   */
  public function tryAsMcpToolApprovalResult(): ?\ElevenLabs\Types\McpToolApprovalResult
  {
    return $this->isMcpToolApprovalResult() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ContextualUpdate value
   * @return \ElevenLabs\Types\ContextualUpdate|null Returns the value if this PublishEvent contains a \ElevenLabs\Types\ContextualUpdate, null otherwise
   */
  public function tryAsContextualUpdate(): ?\ElevenLabs\Types\ContextualUpdate
  {
    return $this->isContextualUpdate() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationInitiationClientData value
   * @return \ElevenLabs\Types\ConversationInitiationClientData|null Returns the value if this PublishEvent contains a \ElevenLabs\Types\ConversationInitiationClientData, null otherwise
   */
  public function tryAsConversationInitiationClientData(): ?\ElevenLabs\Types\ConversationInitiationClientData
  {
    return $this->isConversationInitiationClientData() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\UserAudioChunk): T $onUserAudioChunk
   * @param callable(\ElevenLabs\Types\Feedback): T $onFeedback
   * @param callable(\ElevenLabs\Types\UserMessage): T $onUserMessage
   * @param callable(\ElevenLabs\Types\UserActivity): T $onUserActivity
   * @param callable(\ElevenLabs\Types\MultimodalMessage): T $onMultimodalMessage
   * @param callable(\ElevenLabs\Types\ConversationPong): T $onConversationPong
   * @param callable(\ElevenLabs\Types\ClientToolResult): T $onClientToolResult
   * @param callable(\ElevenLabs\Types\McpToolApprovalResult): T $onMcpToolApprovalResult
   * @param callable(\ElevenLabs\Types\ContextualUpdate): T $onContextualUpdate
   * @param callable(\ElevenLabs\Types\ConversationInitiationClientData): T $onConversationInitiationClientData
   * @return T
   */
  public function match(
    callable $onUserAudioChunk,
    callable $onFeedback,
    callable $onUserMessage,
    callable $onUserActivity,
    callable $onMultimodalMessage,
    callable $onConversationPong,
    callable $onClientToolResult,
    callable $onMcpToolApprovalResult,
    callable $onContextualUpdate,
    callable $onConversationInitiationClientData
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onUserAudioChunk($this->value),
      1 => $onFeedback($this->value),
      2 => $onUserMessage($this->value),
      3 => $onUserActivity($this->value),
      4 => $onMultimodalMessage($this->value),
      5 => $onConversationPong($this->value),
      6 => $onClientToolResult($this->value),
      7 => $onMcpToolApprovalResult($this->value),
      8 => $onContextualUpdate($this->value),
      9 => $onConversationInitiationClientData($this->value),
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
    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\UserAudioChunk::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UserAudioChunk didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\Feedback::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Feedback didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UserMessage::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UserMessage didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UserActivity::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UserActivity didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\MultimodalMessage::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\MultimodalMessage didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationPong::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationPong didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ClientToolResult::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ClientToolResult didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\McpToolApprovalResult::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\McpToolApprovalResult didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ContextualUpdate::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ContextualUpdate didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationInitiationClientData::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationInitiationClientData didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any PublishEvent type');
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
    return $this->value->jsonSerialize();
  }
}
