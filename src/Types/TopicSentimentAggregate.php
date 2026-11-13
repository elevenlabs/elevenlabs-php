<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TopicSentimentAggregate extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('sentiment')]
  public ?\ElevenLabs\Types\NumericDistributionAggregate $sentiment;

  #[JsonProperty('frustration')]
  public ?\ElevenLabs\Types\NumericDistributionAggregate $frustration;

  #[JsonProperty('positive_count')]
  public ?int $positiveCount;

  #[JsonProperty('neutral_count')]
  public ?int $neutralCount;

  #[JsonProperty('negative_count')]
  public ?int $negativeCount;

  /**
   * @param array{
   *   sentiment?: ?\ElevenLabs\Types\NumericDistributionAggregate,
   *   frustration?: ?\ElevenLabs\Types\NumericDistributionAggregate,
   *   positiveCount?: ?int,
   *   neutralCount?: ?int,
   *   negativeCount?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->sentiment = $values['sentiment'] ?? null;
    $this->frustration = $values['frustration'] ?? null;
    $this->positiveCount = $values['positiveCount'] ?? null;
    $this->neutralCount = $values['neutralCount'] ?? null;
    $this->negativeCount = $values['negativeCount'] ?? null;

    if (array_key_exists('sentiment', $values)) {
      $this->_dirtyFields['sentiment'] = true;
    }
    if (array_key_exists('frustration', $values)) {
      $this->_dirtyFields['frustration'] = true;
    }
    if (array_key_exists('positiveCount', $values)) {
      $this->_dirtyFields['positive_count'] = true;
    }
    if (array_key_exists('neutralCount', $values)) {
      $this->_dirtyFields['neutral_count'] = true;
    }
    if (array_key_exists('negativeCount', $values)) {
      $this->_dirtyFields['negative_count'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->sentiment !== null) {
      $parts[] = [
        'name' => 'sentiment',
        'contents' => json_encode($this->sentiment),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->frustration !== null) {
      $parts[] = [
        'name' => 'frustration',
        'contents' => json_encode($this->frustration),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->positiveCount !== null) {
      $parts[] = [
        'name' => 'positive_count',
        'contents' => (string) $this->positiveCount
      ];
    }

    if ($this->neutralCount !== null) {
      $parts[] = [
        'name' => 'neutral_count',
        'contents' => (string) $this->neutralCount
      ];
    }

    if ($this->negativeCount !== null) {
      $parts[] = [
        'name' => 'negative_count',
        'contents' => (string) $this->negativeCount
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->sentiment?->validate();
    $this->frustration?->validate();
  }
}
