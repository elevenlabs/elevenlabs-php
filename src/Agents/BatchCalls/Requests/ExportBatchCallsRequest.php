<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\BatchCalls\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ExportBatchCallsRequest extends JsonSerializableType
{
  /**
   * @var ?int $limit Only export the first N recipients; used to preview the columns. Omit to export every recipient.
   */
  public ?int $limit;

  /**
   * @param array{
   *   limit?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->limit = $values['limit'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'limit' => $data['limit'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->limit !== null) {
      $result['limit'] = $this->limit;
    }
    return $result;
  }
}
