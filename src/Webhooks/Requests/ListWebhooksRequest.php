<?php

declare(strict_types=1);

namespace ElevenLabs\Webhooks\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListWebhooksRequest extends JsonSerializableType
{
  /**
   * @var ?bool $includeUsages Whether to include active usages of the webhook, only usable by admins
   */
  public ?bool $includeUsages;

  /**
   * @param array{
   *   includeUsages?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->includeUsages = $values['includeUsages'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'includeUsages' => $data['include_usages'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->includeUsages !== null) {
      $result['include_usages'] = $this->includeUsages;
    }
    return $result;
  }
}
