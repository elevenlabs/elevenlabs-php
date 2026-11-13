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
class EndProcedureToolResultErrorModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\EndProcedureToolResultErrorModelResultType>
   */
  #[JsonProperty('result_type')]
  public ?string $resultType;

  /**
   * @var value-of<\ElevenLabs\Types\EndProcedureToolErrorStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  #[JsonProperty('procedure_id')]
  public ?string $procedureId;

  #[JsonProperty('message', required: true)]
  public string $message;

  /**
   * @param array{
   *   status: value-of<\ElevenLabs\Types\EndProcedureToolErrorStatus>,
   *   message: string,
   *   resultType?: ?value-of<\ElevenLabs\Types\EndProcedureToolResultErrorModelResultType>,
   *   procedureId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resultType = $values['resultType'] ?? 'end_procedure_error';
    $this->status = $values['status'];
    $this->procedureId = $values['procedureId'] ?? null;
    $this->message = $values['message'];

    $this->_dirtyFields = [
      'status' => true,
      'message' => true
    ];
    if (array_key_exists('resultType', $values)) {
      $this->_dirtyFields['result_type'] = true;
    }
    if (array_key_exists('procedureId', $values)) {
      $this->_dirtyFields['procedure_id'] = true;
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

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    if ($this->procedureId !== null) {
      $parts[] = [
        'name' => 'procedure_id',
        'contents' => $this->procedureId
      ];
    }

    $parts[] = [
      'name' => 'message',
      'contents' => $this->message
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
