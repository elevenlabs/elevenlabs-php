<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Branches\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class PreviewMergeBranchesRequest extends JsonSerializableType
{
  /**
   * @var string $targetBranchId The ID of the target branch to merge into.
   */
  public string $targetBranchId;

  /**
   * @var ?bool $force When true, source branch changes always win conflicts regardless of timestamps
   */
  public ?bool $force;

  /**
   * @var ?bool $includeProcedureGeneratedWorkflowElements Whether to include the workflow nodes and edges generated from structured procedures. When false, the workflow contains only authored elements.
   */
  public ?bool $includeProcedureGeneratedWorkflowElements;

  /**
   * @param array{
   *   targetBranchId: string,
   *   force?: ?bool,
   *   includeProcedureGeneratedWorkflowElements?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->targetBranchId = $values['targetBranchId'];
    $this->force = $values['force'] ?? null;
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
      'targetBranchId' => $data['target_branch_id'],
      'force' => $data['force'] ?? null,
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
    $result['target_branch_id'] = $this->targetBranchId;
    if ($this->force !== null) {
      $result['force'] = $this->force;
    }
    if ($this->includeProcedureGeneratedWorkflowElements !== null) {
      $result['include_procedure_generated_workflow_elements'] =
        $this->includeProcedureGeneratedWorkflowElements;
    }
    return $result;
  }
}
