<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetAgentsRequest extends JsonSerializableType
{
  /**
   * @var ?string $versionId The ID of the agent version to use
   */
  public ?string $versionId;

  /**
   * @var ?string $branchId The ID of the branch to use
   */
  public ?string $branchId;

  /**
   * @var ?bool $includeProcedureGeneratedWorkflowElements Whether to include the workflow nodes and edges generated from structured procedures. When false, the workflow contains only authored elements.
   */
  public ?bool $includeProcedureGeneratedWorkflowElements;

  /**
   * @param array{
   *   versionId?: ?string,
   *   branchId?: ?string,
   *   includeProcedureGeneratedWorkflowElements?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->versionId = $values['versionId'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->includeProcedureGeneratedWorkflowElements =
      $values['includeProcedureGeneratedWorkflowElements'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'versionId' => $data['version_id'] ?? null,
      'branchId' => $data['branch_id'] ?? null,
      'includeProcedureGeneratedWorkflowElements' =>
        $data['include_procedure_generated_workflow_elements'] ?? null
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
    if ($this->branchId !== null) {
      $result['branch_id'] = $this->branchId;
    }
    if ($this->includeProcedureGeneratedWorkflowElements !== null) {
      $result['include_procedure_generated_workflow_elements'] =
        $this->includeProcedureGeneratedWorkflowElements;
    }
    return $result;
  }
}
