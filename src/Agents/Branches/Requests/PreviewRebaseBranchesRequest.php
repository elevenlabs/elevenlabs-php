<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Branches\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class PreviewRebaseBranchesRequest extends JsonSerializableType
{
  /**
   * @var ?string $sourceBranchId The ID of the branch to pull changes from. Defaults to the agent's main branch.
   */
  public ?string $sourceBranchId;

  /**
   * @var ?bool $includeProcedureGeneratedWorkflowElements Whether to include the workflow nodes and edges generated from structured procedures. When false, the workflow contains only authored elements.
   */
  public ?bool $includeProcedureGeneratedWorkflowElements;

  /**
   * @param array{
   *   sourceBranchId?: ?string,
   *   includeProcedureGeneratedWorkflowElements?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->sourceBranchId = $values['sourceBranchId'] ?? null;
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
      'sourceBranchId' => $data['source_branch_id'] ?? null,
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
    if ($this->sourceBranchId !== null) {
      $result['source_branch_id'] = $this->sourceBranchId;
    }
    if ($this->includeProcedureGeneratedWorkflowElements !== null) {
      $result['include_procedure_generated_workflow_elements'] =
        $this->includeProcedureGeneratedWorkflowElements;
    }
    return $result;
  }
}
