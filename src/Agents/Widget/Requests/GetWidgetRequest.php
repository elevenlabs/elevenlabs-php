<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Widget\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetWidgetRequest extends JsonSerializableType
{
  /**
   * @var ?string $conversationSignature An expiring token that enables a websocket conversation to start. These can be generated for an agent using the /v1/convai/conversation/get_signed_url endpoint
   */
  public ?string $conversationSignature;

  /**
   * @param array{
   *   conversationSignature?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->conversationSignature = $values['conversationSignature'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'conversationSignature' => $data['conversation_signature'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->conversationSignature !== null) {
      $result['conversation_signature'] = $this->conversationSignature;
    }
    return $result;
  }
}
