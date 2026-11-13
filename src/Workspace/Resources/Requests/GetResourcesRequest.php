<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Resources\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\WorkspaceResourceType;

class GetResourcesRequest extends JsonSerializableType
{
  /**
   * @var value-of<WorkspaceResourceType> $resourceType Resource type of the target resource.
   */
  public string $resourceType;

  /**
   * @param array{
   *   resourceType: value-of<WorkspaceResourceType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resourceType = $values['resourceType'];
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'resourceType' => $data['resource_type']
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    $result['resource_type'] = $this->resourceType;
    return $result;
  }
}
