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
class ConversationHistoryTranscriptCommonModelInputToolResultsItem extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel|\ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput|\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput|\ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel|\ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput|\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput|\ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a ConversationHistoryTranscriptCommonModelInputToolResultsItem instance containing a \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel
   */
  public static function conversationHistoryTranscriptOtherToolsResultCommonModel(
    \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel $conversationHistoryTranscriptOtherToolsResultCommonModel
  ): self {
    return new self($conversationHistoryTranscriptOtherToolsResultCommonModel, 0);
  }

  /**
   * Create a ConversationHistoryTranscriptCommonModelInputToolResultsItem instance containing a \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput
   */
  public static function conversationHistoryTranscriptSystemToolResultCommonModelInput(
    \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput $conversationHistoryTranscriptSystemToolResultCommonModelInput
  ): self {
    return new self($conversationHistoryTranscriptSystemToolResultCommonModelInput, 1);
  }

  /**
   * Create a ConversationHistoryTranscriptCommonModelInputToolResultsItem instance containing a \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput
   */
  public static function conversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput(
    \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput $conversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput
  ): self {
    return new self(
      $conversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput,
      2
    );
  }

  /**
   * Create a ConversationHistoryTranscriptCommonModelInputToolResultsItem instance containing a \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput
   */
  public static function conversationHistoryTranscriptWorkflowToolsResultCommonModelInput(
    \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput $conversationHistoryTranscriptWorkflowToolsResultCommonModelInput
  ): self {
    return new self($conversationHistoryTranscriptWorkflowToolsResultCommonModelInput, 3);
  }

  // Type checking methods
  /**
   * Check if this ConversationHistoryTranscriptCommonModelInputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel
   */
  public function isConversationHistoryTranscriptOtherToolsResultCommonModel(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ConversationHistoryTranscriptCommonModelInputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput
   */
  public function isConversationHistoryTranscriptSystemToolResultCommonModelInput(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ConversationHistoryTranscriptCommonModelInputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput
   */
  public function isConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ConversationHistoryTranscriptCommonModelInputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput
   */
  public function isConversationHistoryTranscriptWorkflowToolsResultCommonModelInput(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptCommonModelInputToolResultsItem does not contain a \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel
   */
  public function asConversationHistoryTranscriptOtherToolsResultCommonModel(): \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel
  {
    if (!$this->isConversationHistoryTranscriptOtherToolsResultCommonModel()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptCommonModelInputToolResultsItem does not contain \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput value
   * @throws \RuntimeException if this ConversationHistoryTranscriptCommonModelInputToolResultsItem does not contain a \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput
   */
  public function asConversationHistoryTranscriptSystemToolResultCommonModelInput(): \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput
  {
    if (!$this->isConversationHistoryTranscriptSystemToolResultCommonModelInput()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptCommonModelInputToolResultsItem does not contain \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput value
   * @throws \RuntimeException if this ConversationHistoryTranscriptCommonModelInputToolResultsItem does not contain a \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput
   */
  public function asConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput(): \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput
  {
    if (!$this->isConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptCommonModelInputToolResultsItem does not contain \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput value
   * @throws \RuntimeException if this ConversationHistoryTranscriptCommonModelInputToolResultsItem does not contain a \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput
   */
  public function asConversationHistoryTranscriptWorkflowToolsResultCommonModelInput(): \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput
  {
    if (!$this->isConversationHistoryTranscriptWorkflowToolsResultCommonModelInput()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptCommonModelInputToolResultsItem does not contain \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel value
   * @return \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel|null Returns the value if this ConversationHistoryTranscriptCommonModelInputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel, null otherwise
   */
  public function tryAsConversationHistoryTranscriptOtherToolsResultCommonModel(): ?\ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel
  {
    return $this->isConversationHistoryTranscriptOtherToolsResultCommonModel()
      ? $this->value
      : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput value
   * @return \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput|null Returns the value if this ConversationHistoryTranscriptCommonModelInputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput, null otherwise
   */
  public function tryAsConversationHistoryTranscriptSystemToolResultCommonModelInput(): ?\ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput
  {
    return $this->isConversationHistoryTranscriptSystemToolResultCommonModelInput()
      ? $this->value
      : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput value
   * @return \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput|null Returns the value if this ConversationHistoryTranscriptCommonModelInputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput, null otherwise
   */
  public function tryAsConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput(): ?\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput
  {
    return $this->isConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput()
      ? $this->value
      : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput value
   * @return \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput|null Returns the value if this ConversationHistoryTranscriptCommonModelInputToolResultsItem contains a \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput, null otherwise
   */
  public function tryAsConversationHistoryTranscriptWorkflowToolsResultCommonModelInput(): ?\ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput
  {
    return $this->isConversationHistoryTranscriptWorkflowToolsResultCommonModelInput()
      ? $this->value
      : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel): T $onConversationHistoryTranscriptOtherToolsResultCommonModel
   * @param callable(\ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput): T $onConversationHistoryTranscriptSystemToolResultCommonModelInput
   * @param callable(\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput): T $onConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput
   * @param callable(\ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput): T $onConversationHistoryTranscriptWorkflowToolsResultCommonModelInput
   * @return T
   */
  public function match(
    callable $onConversationHistoryTranscriptOtherToolsResultCommonModel,
    callable $onConversationHistoryTranscriptSystemToolResultCommonModelInput,
    callable $onConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput,
    callable $onConversationHistoryTranscriptWorkflowToolsResultCommonModelInput
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onConversationHistoryTranscriptOtherToolsResultCommonModel($this->value),
      1 => $onConversationHistoryTranscriptSystemToolResultCommonModelInput($this->value),
      2 => $onConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput(
        $this->value
      ),
      3 => $onConversationHistoryTranscriptWorkflowToolsResultCommonModelInput($this->value),
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
      $candidate = \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput::fromArray(
        $data
      );
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput::fromArray(
        $data
      );
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput::fromArray(
        $data
      );
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelInput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any ConversationHistoryTranscriptCommonModelInputToolResultsItem type'
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
