<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Products\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListProductsRequest extends JsonSerializableType
{
  /**
   * @var ?string $group Only products filed under the group with this label.
   */
  public ?string $group;

  /**
   * @var ?bool $isActive Only active (`true`) or inactive (`false`) products.
   */
  public ?bool $isActive;

  /**
   * @var string $xiWorkspaceId The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * @param array{
   *   group?: ?string,
   *   isActive?: ?bool,
   *   xiWorkspaceId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->group = $values['group'] ?? null;
    $this->isActive = $values['isActive'] ?? null;
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'group' => $data['group'] ?? null,
      'isActive' => $data['is_active'] ?? null,
      'xiWorkspaceId' => $data['xi-workspace-id']
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->group !== null) {
      $result['group'] = $this->group;
    }
    if ($this->isActive !== null) {
      $result['is_active'] = $this->isActive;
    }
    $result['xi-workspace-id'] = $this->xiWorkspaceId;
    return $result;
  }
}
