<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tools\Executions\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetExecutionsRequest extends JsonSerializableType
{
  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @var ?int $pageSize How many documents to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?bool $isError Filter by error status. If not provided, returns all executions.
   */
  public ?bool $isError;

  /**
   * @var ?string $agentId Filter by agent ID.
   */
  public ?string $agentId;

  /**
   * @var ?string $branchId Filter by agent branch ID.
   */
  public ?string $branchId;

  /**
   * @var ?float $startTime Filter executions from this Unix timestamp (inclusive).
   */
  public ?float $startTime;

  /**
   * @var ?float $endTime Filter executions until this Unix timestamp (inclusive).
   */
  public ?float $endTime;

  /**
   * @param array{
   *   cursor?: ?string,
   *   pageSize?: ?int,
   *   isError?: ?bool,
   *   agentId?: ?string,
   *   branchId?: ?string,
   *   startTime?: ?float,
   *   endTime?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->cursor = $values['cursor'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->isError = $values['isError'] ?? null;
    $this->agentId = $values['agentId'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->startTime = $values['startTime'] ?? null;
    $this->endTime = $values['endTime'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'cursor' => $data['cursor'] ?? null,
      'pageSize' => $data['page_size'] ?? null,
      'isError' => $data['is_error'] ?? null,
      'agentId' => $data['agent_id'] ?? null,
      'branchId' => $data['branch_id'] ?? null,
      'startTime' => $data['start_time'] ?? null,
      'endTime' => $data['end_time'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->isError !== null) {
      $result['is_error'] = $this->isError;
    }
    if ($this->agentId !== null) {
      $result['agent_id'] = $this->agentId;
    }
    if ($this->branchId !== null) {
      $result['branch_id'] = $this->branchId;
    }
    if ($this->startTime !== null) {
      $result['start_time'] = $this->startTime;
    }
    if ($this->endTime !== null) {
      $result['end_time'] = $this->endTime;
    }
    return $result;
  }
}
