<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Procedures\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListProceduresRequest extends JsonSerializableType
{
  /**
   * @var ?string $agentVersionId The agent version ID to retrieve the procedure for.
   */
  public ?string $agentVersionId;

  /**
   * @param array{
   *   agentVersionId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->agentVersionId = $values['agentVersionId'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'agentVersionId' => $data['agent_version_id'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->agentVersionId !== null) {
      $result['agent_version_id'] = $this->agentVersionId;
    }
    return $result;
  }
}
