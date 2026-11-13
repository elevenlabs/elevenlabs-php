<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Drafts\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class DeleteDraftsRequest extends JsonSerializableType
{
  /**
   * @var string $branchId The ID of the agent branch to use
   */
  public string $branchId;

  /**
   * @param array{
   *   branchId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->branchId = $values['branchId'];
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'branchId' => $data['branch_id']
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    $result['branch_id'] = $this->branchId;
    return $result;
  }
}
