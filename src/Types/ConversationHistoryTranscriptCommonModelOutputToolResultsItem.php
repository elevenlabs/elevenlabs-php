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
class ConversationHistoryTranscriptCommonModelOutputToolResultsItem extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel|\ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput|\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput|\ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel|\ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput|\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput|\ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a ConversationHistoryTranscriptCommonModelOutputToolResultsItem instance containing a \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel
   */
  public static function conversationHistoryTranscriptOtherToolsResultCommonModel(
    \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel $conversationHistoryTranscriptOtherToolsResultCommonModel
  ): self {
    return new self($conversationHistoryTranscriptOtherToolsResultCommonModel, 0);
  }

  /**
   * Create a ConversationHistoryTranscriptCommonModelOutputToolResultsItem instance containing a \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput
   */
  public static function conversationHistoryTranscriptSystemToolResultCommonModelOutput(
    \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput $conversationHistoryTranscriptSystemToolResultCommonModelOutput
  ): self {
    return new self($conversationHistoryTranscriptSystemToolResultCommonModelOutput, 1);
  }

  /**
   * Create a ConversationHistoryTranscriptCommonModelOutputToolResultsItem instance containing a \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput
   */
  public static function conversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput(
    \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput $conversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput
  ): self {
    return new self(
      $conversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput,
      2
    );
  }

  /**
   * Create a ConversationHistoryTranscriptCommonModelOutputToolResultsItem instance containing a \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput
   */
  public static function conversationHistoryTranscriptWorkflowToolsResultCommonModelOutput(
    \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput $conversationHistoryTranscriptWorkflowToolsResultCommonModelOutput
  ): self {
    return new self($conversationHistoryTranscriptWorkflowToolsResultCommonModelOutput, 3);
  }

  // Type checking methods
  /**
   * Check if this ConversationHistoryTranscriptCommonModelOutputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel
   */
  public function isConversationHistoryTranscriptOtherToolsResultCommonModel(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ConversationHistoryTranscriptCommonModelOutputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput
   */
  public function isConversationHistoryTranscriptSystemToolResultCommonModelOutput(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ConversationHistoryTranscriptCommonModelOutputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput
   */
  public function isConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ConversationHistoryTranscriptCommonModelOutputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput
   */
  public function isConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptCommonModelOutputToolResultsItem does not contain a \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel
   */
  public function asConversationHistoryTranscriptOtherToolsResultCommonModel(): \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel
  {
    if (!$this->isConversationHistoryTranscriptOtherToolsResultCommonModel()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptCommonModelOutputToolResultsItem does not contain \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput value
   * @throws \RuntimeException if this ConversationHistoryTranscriptCommonModelOutputToolResultsItem does not contain a \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput
   */
  public function asConversationHistoryTranscriptSystemToolResultCommonModelOutput(): \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput
  {
    if (!$this->isConversationHistoryTranscriptSystemToolResultCommonModelOutput()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptCommonModelOutputToolResultsItem does not contain \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput value
   * @throws \RuntimeException if this ConversationHistoryTranscriptCommonModelOutputToolResultsItem does not contain a \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput
   */
  public function asConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput(): \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput
  {
    if (
      !$this->isConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput()
    ) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptCommonModelOutputToolResultsItem does not contain \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput value
   * @throws \RuntimeException if this ConversationHistoryTranscriptCommonModelOutputToolResultsItem does not contain a \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput
   */
  public function asConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput(): \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput
  {
    if (!$this->isConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptCommonModelOutputToolResultsItem does not contain \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel value
   * @return \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel|null Returns the value if this ConversationHistoryTranscriptCommonModelOutputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel, null otherwise
   */
  public function tryAsConversationHistoryTranscriptOtherToolsResultCommonModel(): ?\ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel
  {
    return $this->isConversationHistoryTranscriptOtherToolsResultCommonModel()
      ? $this->value
      : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput value
   * @return \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput|null Returns the value if this ConversationHistoryTranscriptCommonModelOutputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput, null otherwise
   */
  public function tryAsConversationHistoryTranscriptSystemToolResultCommonModelOutput(): ?\ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput
  {
    return $this->isConversationHistoryTranscriptSystemToolResultCommonModelOutput()
      ? $this->value
      : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput value
   * @return \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput|null Returns the value if this ConversationHistoryTranscriptCommonModelOutputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput, null otherwise
   */
  public function tryAsConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput(): ?\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput
  {
    return $this->isConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput()
      ? $this->value
      : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput value
   * @return \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput|null Returns the value if this ConversationHistoryTranscriptCommonModelOutputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput, null otherwise
   */
  public function tryAsConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput(): ?\ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput
  {
    return $this->isConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput()
      ? $this->value
      : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel): T $onConversationHistoryTranscriptOtherToolsResultCommonModel
   * @param callable(\ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput): T $onConversationHistoryTranscriptSystemToolResultCommonModelOutput
   * @param callable(\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput): T $onConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput
   * @param callable(\ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput): T $onConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput
   * @return T
   */
  public function match(
    callable $onConversationHistoryTranscriptOtherToolsResultCommonModel,
    callable $onConversationHistoryTranscriptSystemToolResultCommonModelOutput,
    callable $onConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput,
    callable $onConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onConversationHistoryTranscriptOtherToolsResultCommonModel($this->value),
      1 => $onConversationHistoryTranscriptSystemToolResultCommonModelOutput($this->value),
      2 => $onConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput(
        $this->value
      ),
      3 => $onConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput($this->value),
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
      $candidate = \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel::fromArray(
        $data
      );
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput::fromArray(
        $data
      );
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput::fromArray(
        $data
      );
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput::fromArray(
        $data
      );
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any ConversationHistoryTranscriptCommonModelOutputToolResultsItem type'
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
    return $this->value->jsonSerialize();
  }
}
