<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class StartProcedureToolResultSuccessModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\StartProcedureToolResultSuccessModelResultType>
   */
  #[JsonProperty('result_type')]
  public ?string $resultType;

  /**
   * @var ?value-of<\ElevenLabs\Types\StartProcedureToolResultSuccessModelStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  #[JsonProperty('procedure_id', required: true)]
  public string $procedureId;

  #[JsonProperty('procedure_name', required: true)]
  public string $procedureName;

  #[JsonProperty('procedure_entry_workflow_node')]
  public ?string $procedureEntryWorkflowNode;

  #[JsonProperty('procedure_return_workflow_node')]
  public ?string $procedureReturnWorkflowNode;

  #[JsonProperty('message')]
  public ?string $message;

  /**
   * @param array{
   *   procedureId: string,
   *   procedureName: string,
   *   resultType?: ?value-of<\ElevenLabs\Types\StartProcedureToolResultSuccessModelResultType>,
   *   status?: ?value-of<\ElevenLabs\Types\StartProcedureToolResultSuccessModelStatus>,
   *   procedureEntryWorkflowNode?: ?string,
   *   procedureReturnWorkflowNode?: ?string,
   *   message?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resultType = $values['resultType'] ?? 'start_procedure_success';
    $this->status = $values['status'] ?? 'success';
    $this->procedureId = $values['procedureId'];
    $this->procedureName = $values['procedureName'];
    $this->procedureEntryWorkflowNode = $values['procedureEntryWorkflowNode'] ?? null;
    $this->procedureReturnWorkflowNode = $values['procedureReturnWorkflowNode'] ?? null;
    $this->message = $values['message'] ?? null;

    $this->_dirtyFields = [
      'procedure_id' => true,
      'procedure_name' => true
    ];
    if (array_key_exists('resultType', $values)) {
      $this->_dirtyFields['result_type'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('procedureEntryWorkflowNode', $values)) {
      $this->_dirtyFields['procedure_entry_workflow_node'] = true;
    }
    if (array_key_exists('procedureReturnWorkflowNode', $values)) {
      $this->_dirtyFields['procedure_return_workflow_node'] = true;
    }
    if (array_key_exists('message', $values)) {
      $this->_dirtyFields['message'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->resultType !== null) {
      $parts[] = [
        'name' => 'result_type',
        'contents' => $this->resultType
      ];
    }

    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    $parts[] = [
      'name' => 'procedure_id',
      'contents' => $this->procedureId
    ];

    $parts[] = [
      'name' => 'procedure_name',
      'contents' => $this->procedureName
    ];

    if ($this->procedureEntryWorkflowNode !== null) {
      $parts[] = [
        'name' => 'procedure_entry_workflow_node',
        'contents' => $this->procedureEntryWorkflowNode
      ];
    }

    if ($this->procedureReturnWorkflowNode !== null) {
      $parts[] = [
        'name' => 'procedure_return_workflow_node',
        'contents' => $this->procedureReturnWorkflowNode
      ];
    }

    if ($this->message !== null) {
      $parts[] = [
        'name' => 'message',
        'contents' => $this->message
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
