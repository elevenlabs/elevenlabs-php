<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Services\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\ReceptionServiceKind;

class ListServicesRequest extends JsonSerializableType
{
  /**
   * @var ?string $staffId Only services this staff member performs.
   */
  public ?string $staffId;

  /**
   * @var ?string $assetId Only services that book this asset.
   */
  public ?string $assetId;

  /**
   * @var ?bool $isActive Only active (`true`) or inactive (`false`) services.
   */
  public ?bool $isActive;

  /**
   * @var ?value-of<ReceptionServiceKind> $kind Only services of this kind.
   */
  public ?string $kind;

  /**
   * @var string $xiWorkspaceId The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * @param array{
   *   staffId?: ?string,
   *   assetId?: ?string,
   *   isActive?: ?bool,
   *   kind?: ?value-of<ReceptionServiceKind>,
   *   xiWorkspaceId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->staffId = $values['staffId'] ?? null;
    $this->assetId = $values['assetId'] ?? null;
    $this->isActive = $values['isActive'] ?? null;
    $this->kind = $values['kind'] ?? null;
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'staffId' => $data['staff_id'] ?? null,
      'assetId' => $data['asset_id'] ?? null,
      'isActive' => $data['is_active'] ?? null,
      'kind' => $data['kind'] ?? null,
      'xiWorkspaceId' => $data['xi-workspace-id']
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->staffId !== null) {
      $result['staff_id'] = $this->staffId;
    }
    if ($this->assetId !== null) {
      $result['asset_id'] = $this->assetId;
    }
    if ($this->isActive !== null) {
      $result['is_active'] = $this->isActive;
    }
    if ($this->kind !== null) {
      $result['kind'] = $this->kind;
    }
    $result['xi-workspace-id'] = $this->xiWorkspaceId;
    return $result;
  }
}
