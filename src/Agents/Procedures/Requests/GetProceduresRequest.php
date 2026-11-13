<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Procedures\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetProceduresRequest extends JsonSerializableType
{
  /**
   * @var ?string $versionId The version ID to retrieve. If omitted, returns the version at branch HEAD.
   */
  public ?string $versionId;

  /**
   * @var ?string $agentVersionId The agent version ID to retrieve the procedure for.
   */
  public ?string $agentVersionId;

  /**
   * @param array{
   *   versionId?: ?string,
   *   agentVersionId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->versionId = $values['versionId'] ?? null;
    $this->agentVersionId = $values['agentVersionId'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'versionId' => $data['version_id'] ?? null,
      'agentVersionId' => $data['agent_version_id'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->versionId !== null) {
      $result['version_id'] = $this->versionId;
    }
    if ($this->agentVersionId !== null) {
      $result['agent_version_id'] = $this->agentVersionId;
    }
    return $result;
  }
}
