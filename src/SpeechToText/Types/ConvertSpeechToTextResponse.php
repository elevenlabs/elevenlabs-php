<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechToText\Types;

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
class ConvertSpeechToTextResponse extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\SpeechToTextChunkResponseModel|\ElevenLabs\Types\MultichannelSpeechToTextResponseModel|\ElevenLabs\Types\SpeechToTextWebhookResponseModel The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\SpeechToTextChunkResponseModel|\ElevenLabs\Types\MultichannelSpeechToTextResponseModel|\ElevenLabs\Types\SpeechToTextWebhookResponseModel $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a ConvertSpeechToTextResponse instance containing a \ElevenLabs\Types\SpeechToTextChunkResponseModel
   */
  public static function speechToTextChunkResponseModel(
    \ElevenLabs\Types\SpeechToTextChunkResponseModel $speechToTextChunkResponseModel
  ): self {
    return new self($speechToTextChunkResponseModel, 0);
  }

  /**
   * Create a ConvertSpeechToTextResponse instance containing a \ElevenLabs\Types\MultichannelSpeechToTextResponseModel
   */
  public static function multichannelSpeechToTextResponseModel(
    \ElevenLabs\Types\MultichannelSpeechToTextResponseModel $multichannelSpeechToTextResponseModel
  ): self {
    return new self($multichannelSpeechToTextResponseModel, 1);
  }

  /**
   * Create a ConvertSpeechToTextResponse instance containing a \ElevenLabs\Types\SpeechToTextWebhookResponseModel
   */
  public static function speechToTextWebhookResponseModel(
    \ElevenLabs\Types\SpeechToTextWebhookResponseModel $speechToTextWebhookResponseModel
  ): self {
    return new self($speechToTextWebhookResponseModel, 2);
  }

  // Type checking methods
  /**
   * Check if this ConvertSpeechToTextResponse contains a \ElevenLabs\Types\SpeechToTextChunkResponseModel
   */
  public function isSpeechToTextChunkResponseModel(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ConvertSpeechToTextResponse contains a \ElevenLabs\Types\MultichannelSpeechToTextResponseModel
   */
  public function isMultichannelSpeechToTextResponseModel(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ConvertSpeechToTextResponse contains a \ElevenLabs\Types\SpeechToTextWebhookResponseModel
   */
  public function isSpeechToTextWebhookResponseModel(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\SpeechToTextChunkResponseModel value
   * @throws \RuntimeException if this ConvertSpeechToTextResponse does not contain a \ElevenLabs\Types\SpeechToTextChunkResponseModel
   */
  public function asSpeechToTextChunkResponseModel(): \ElevenLabs\Types\SpeechToTextChunkResponseModel
  {
    if (!$this->isSpeechToTextChunkResponseModel()) {
      throw new \RuntimeException(
        'ConvertSpeechToTextResponse does not contain \ElevenLabs\Types\SpeechToTextChunkResponseModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\MultichannelSpeechToTextResponseModel value
   * @throws \RuntimeException if this ConvertSpeechToTextResponse does not contain a \ElevenLabs\Types\MultichannelSpeechToTextResponseModel
   */
  public function asMultichannelSpeechToTextResponseModel(): \ElevenLabs\Types\MultichannelSpeechToTextResponseModel
  {
    if (!$this->isMultichannelSpeechToTextResponseModel()) {
      throw new \RuntimeException(
        'ConvertSpeechToTextResponse does not contain \ElevenLabs\Types\MultichannelSpeechToTextResponseModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SpeechToTextWebhookResponseModel value
   * @throws \RuntimeException if this ConvertSpeechToTextResponse does not contain a \ElevenLabs\Types\SpeechToTextWebhookResponseModel
   */
  public function asSpeechToTextWebhookResponseModel(): \ElevenLabs\Types\SpeechToTextWebhookResponseModel
  {
    if (!$this->isSpeechToTextWebhookResponseModel()) {
      throw new \RuntimeException(
        'ConvertSpeechToTextResponse does not contain \ElevenLabs\Types\SpeechToTextWebhookResponseModel'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\SpeechToTextChunkResponseModel value
   * @return \ElevenLabs\Types\SpeechToTextChunkResponseModel|null Returns the value if this ConvertSpeechToTextResponse contains a \ElevenLabs\Types\SpeechToTextChunkResponseModel, null otherwise
   */
  public function tryAsSpeechToTextChunkResponseModel(): ?\ElevenLabs\Types\SpeechToTextChunkResponseModel
  {
    return $this->isSpeechToTextChunkResponseModel() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\MultichannelSpeechToTextResponseModel value
   * @return \ElevenLabs\Types\MultichannelSpeechToTextResponseModel|null Returns the value if this ConvertSpeechToTextResponse contains a \ElevenLabs\Types\MultichannelSpeechToTextResponseModel, null otherwise
   */
  public function tryAsMultichannelSpeechToTextResponseModel(): ?\ElevenLabs\Types\MultichannelSpeechToTextResponseModel
  {
    return $this->isMultichannelSpeechToTextResponseModel() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SpeechToTextWebhookResponseModel value
   * @return \ElevenLabs\Types\SpeechToTextWebhookResponseModel|null Returns the value if this ConvertSpeechToTextResponse contains a \ElevenLabs\Types\SpeechToTextWebhookResponseModel, null otherwise
   */
  public function tryAsSpeechToTextWebhookResponseModel(): ?\ElevenLabs\Types\SpeechToTextWebhookResponseModel
  {
    return $this->isSpeechToTextWebhookResponseModel() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\SpeechToTextChunkResponseModel): T $onSpeechToTextChunkResponseModel
   * @param callable(\ElevenLabs\Types\MultichannelSpeechToTextResponseModel): T $onMultichannelSpeechToTextResponseModel
   * @param callable(\ElevenLabs\Types\SpeechToTextWebhookResponseModel): T $onSpeechToTextWebhookResponseModel
   * @return T
   */
  public function match(
    callable $onSpeechToTextChunkResponseModel,
    callable $onMultichannelSpeechToTextResponseModel,
    callable $onSpeechToTextWebhookResponseModel
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onSpeechToTextChunkResponseModel($this->value),
      1 => $onMultichannelSpeechToTextResponseModel($this->value),
      2 => $onSpeechToTextWebhookResponseModel($this->value),
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
      $candidate = \ElevenLabs\Types\SpeechToTextChunkResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SpeechToTextChunkResponseModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\MultichannelSpeechToTextResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\MultichannelSpeechToTextResponseModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SpeechToTextWebhookResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SpeechToTextWebhookResponseModel didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any ConvertSpeechToTextResponse type'
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
