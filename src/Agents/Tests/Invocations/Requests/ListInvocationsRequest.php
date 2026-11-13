<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tests\Invocations\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListInvocationsRequest extends JsonSerializableType
{
  /**
   * @var ?string $agentId Filter by agent ID
   */
  public ?string $agentId;

  /**
   * @var ?string $branchId Filter by branch ID
   */
  public ?string $branchId;

  /**
   * @var ?string $createdByUserId Filter by test run creator user ID
   */
  public ?string $createdByUserId;

  /**
   * @var ?string $testId Filter to invocations that include a run of this test id
   */
  public ?string $testId;

  /**
   * @var ?int $startTime Inclusive lower bound on created_at, in unix seconds
   */
  public ?int $startTime;

  /**
   * @var ?int $endTime Inclusive upper bound on created_at, in unix seconds
   */
  public ?int $endTime;

  /**
   * @var ?string $versionId Filter by the agent version the tests ran against
   */
  public ?string $versionId;

  /**
   * @var ?int $pageSize How many Tests to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?string $search Search query to filter tests and folders by name.
   */
  public ?string $search;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   agentId?: ?string,
   *   branchId?: ?string,
   *   createdByUserId?: ?string,
   *   testId?: ?string,
   *   startTime?: ?int,
   *   endTime?: ?int,
   *   versionId?: ?string,
   *   pageSize?: ?int,
   *   search?: ?string,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->agentId = $values['agentId'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->createdByUserId = $values['createdByUserId'] ?? null;
    $this->testId = $values['testId'] ?? null;
    $this->startTime = $values['startTime'] ?? null;
    $this->endTime = $values['endTime'] ?? null;
    $this->versionId = $values['versionId'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->search = $values['search'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'agentId' => $data['agent_id'] ?? null,
      'branchId' => $data['branch_id'] ?? null,
      'createdByUserId' => $data['created_by_user_id'] ?? null,
      'testId' => $data['test_id'] ?? null,
      'startTime' => $data['start_time'] ?? null,
      'endTime' => $data['end_time'] ?? null,
      'versionId' => $data['version_id'] ?? null,
      'pageSize' => $data['page_size'] ?? null,
      'search' => $data['search'] ?? null,
      'cursor' => $data['cursor'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->agentId !== null) {
      $result['agent_id'] = $this->agentId;
    }
    if ($this->branchId !== null) {
      $result['branch_id'] = $this->branchId;
    }
    if ($this->createdByUserId !== null) {
      $result['created_by_user_id'] = $this->createdByUserId;
    }
    if ($this->testId !== null) {
      $result['test_id'] = $this->testId;
    }
    if ($this->startTime !== null) {
      $result['start_time'] = $this->startTime;
    }
    if ($this->endTime !== null) {
      $result['end_time'] = $this->endTime;
    }
    if ($this->versionId !== null) {
      $result['version_id'] = $this->versionId;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
