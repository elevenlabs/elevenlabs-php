<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Agents\Conversations\Types\GetConversationsRequestFormat;

class GetConversationsRequest extends JsonSerializableType
{
  /**
   * @var ?value-of<GetConversationsRequestFormat> $format Response format. Defaults to 'json'. Set to 'opentelemetry' for an OTLP-compatible trace payload using the same structure as the post-call webhook.
   */
  public ?string $format;

  /**
   * @param array{
   *   format?: ?value-of<GetConversationsRequestFormat>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->format = $values['format'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'format' => $data['format'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->format !== null) {
      $result['format'] = $this->format;
    }
    return $result;
  }
}
