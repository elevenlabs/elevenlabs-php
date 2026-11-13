<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Projects\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetProjectsRequest extends JsonSerializableType
{
  /**
   * @var ?string $shareId The share ID of the project
   */
  public ?string $shareId;

  /**
   * @param array{
   *   shareId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->shareId = $values['shareId'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'shareId' => $data['share_id'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->shareId !== null) {
      $result['share_id'] = $this->shareId;
    }
    return $result;
  }
}
