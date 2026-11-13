<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetSummaryConversationsRequest extends JsonSerializableType
{
  /**
   * @var ?int $maxMessages Maximum number of chat message turns to include inline. When the conversation has more than this, the messages are omitted and messages_omitted is set.
   */
  public ?int $maxMessages;

  /**
   * @param array{
   *   maxMessages?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->maxMessages = $values['maxMessages'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'maxMessages' => $data['max_messages'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->maxMessages !== null) {
      $result['max_messages'] = $this->maxMessages;
    }
    return $result;
  }
}
