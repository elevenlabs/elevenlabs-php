<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Receptionists\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListReceptionistsRequest extends JsonSerializableType
{
  /**
   * @var string $xiWorkspaceId The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'xiWorkspaceId' => $data['xi-workspace-id']
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    $result['xi-workspace-id'] = $this->xiWorkspaceId;
    return $result;
  }
}
