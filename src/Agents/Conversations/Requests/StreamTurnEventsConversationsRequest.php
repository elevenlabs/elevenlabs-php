<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class StreamTurnEventsConversationsRequest extends JsonSerializableType
{
  /**
   * @var ?string $lastEventId
   */
  public ?string $lastEventId;

  /**
   * @param array{
   *   lastEventId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->lastEventId = $values['lastEventId'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'lastEventId' => $data['Last-Event-ID'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->lastEventId !== null) {
      $result['Last-Event-ID'] = $this->lastEventId;
    }
    return $result;
  }
}
