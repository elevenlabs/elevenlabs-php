<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Feedback\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationFeedbackRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\UserFeedbackScore>
   * Either 'like' or 'dislike' to indicate the feedback for the conversation.
   */
  #[JsonProperty('feedback')]
  public ?string $feedback;

  /**
   * @param array{
   *   feedback?: ?value-of<\ElevenLabs\Types\UserFeedbackScore>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->feedback = $values['feedback'] ?? null;

    if (array_key_exists('feedback', $values)) {
      $this->_dirtyFields['feedback'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->feedback !== null) {
      $parts[] = [
        'name' => 'feedback',
        'contents' => $this->feedback
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
