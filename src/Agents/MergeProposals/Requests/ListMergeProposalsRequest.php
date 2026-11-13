<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\MergeProposals\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\MergeProposalStatus;

class ListMergeProposalsRequest extends JsonSerializableType
{
  /**
   * @var ?value-of<MergeProposalStatus> $status Only return proposals with this status.
   */
  public ?string $status;

  /**
   * @var ?string $sourceBranchId Only return proposals with this source branch.
   */
  public ?string $sourceBranchId;

  /**
   * @var ?string $targetBranchId Only return proposals with this target branch.
   */
  public ?string $targetBranchId;

  /**
   * @var ?string $search Case-insensitive substring match over title and description.
   */
  public ?string $search;

  /**
   * @var ?int $pageSize How many results at most should be returned
   */
  public ?int $pageSize;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   status?: ?value-of<MergeProposalStatus>,
   *   sourceBranchId?: ?string,
   *   targetBranchId?: ?string,
   *   search?: ?string,
   *   pageSize?: ?int,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->status = $values['status'] ?? null;
    $this->sourceBranchId = $values['sourceBranchId'] ?? null;
    $this->targetBranchId = $values['targetBranchId'] ?? null;
    $this->search = $values['search'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'status' => $data['status'] ?? null,
      'sourceBranchId' => $data['source_branch_id'] ?? null,
      'targetBranchId' => $data['target_branch_id'] ?? null,
      'search' => $data['search'] ?? null,
      'pageSize' => $data['page_size'] ?? null,
      'cursor' => $data['cursor'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->status !== null) {
      $result['status'] = $this->status;
    }
    if ($this->sourceBranchId !== null) {
      $result['source_branch_id'] = $this->sourceBranchId;
    }
    if ($this->targetBranchId !== null) {
      $result['target_branch_id'] = $this->targetBranchId;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
