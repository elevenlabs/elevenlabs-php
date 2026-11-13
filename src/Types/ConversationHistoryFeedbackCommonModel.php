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
class ConversationHistoryFeedbackCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationFeedbackType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var ?value-of<\ElevenLabs\Types\UserFeedbackScore>
   */
  #[JsonProperty('overall_score')]
  public ?string $overallScore;

  #[JsonProperty('likes')]
  public ?int $likes;

  #[JsonProperty('dislikes')]
  public ?int $dislikes;

  #[JsonProperty('rating')]
  public ?int $rating;

  #[JsonProperty('comment')]
  public ?string $comment;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\ConversationFeedbackType>,
   *   overallScore?: ?value-of<\ElevenLabs\Types\UserFeedbackScore>,
   *   likes?: ?int,
   *   dislikes?: ?int,
   *   rating?: ?int,
   *   comment?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? null;
    $this->overallScore = $values['overallScore'] ?? null;
    $this->likes = $values['likes'] ?? null;
    $this->dislikes = $values['dislikes'] ?? null;
    $this->rating = $values['rating'] ?? null;
    $this->comment = $values['comment'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('overallScore', $values)) {
      $this->_dirtyFields['overall_score'] = true;
    }
    if (array_key_exists('likes', $values)) {
      $this->_dirtyFields['likes'] = true;
    }
    if (array_key_exists('dislikes', $values)) {
      $this->_dirtyFields['dislikes'] = true;
    }
    if (array_key_exists('rating', $values)) {
      $this->_dirtyFields['rating'] = true;
    }
    if (array_key_exists('comment', $values)) {
      $this->_dirtyFields['comment'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->overallScore !== null) {
      $parts[] = [
        'name' => 'overall_score',
        'contents' => $this->overallScore
      ];
    }

    if ($this->likes !== null) {
      $parts[] = [
        'name' => 'likes',
        'contents' => (string) $this->likes
      ];
    }

    if ($this->dislikes !== null) {
      $parts[] = [
        'name' => 'dislikes',
        'contents' => (string) $this->dislikes
      ];
    }

    if ($this->rating !== null) {
      $parts[] = [
        'name' => 'rating',
        'contents' => (string) $this->rating
      ];
    }

    if ($this->comment !== null) {
      $parts[] = [
        'name' => 'comment',
        'contents' => $this->comment
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
