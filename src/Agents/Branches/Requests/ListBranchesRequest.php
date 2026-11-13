<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Branches\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListBranchesRequest extends JsonSerializableType
{
  /**
   * @var ?bool $includeArchived Whether archived branches should be included
   */
  public ?bool $includeArchived;

  /**
   * @var ?int $limit How many results at most should be returned
   */
  public ?int $limit;

  /**
   * @var ?bool $includeCommitStatus Whether to compute how far each branch has diverged from main (commits_ahead/commits_behind). This walks the version DAG of every branch, so it is slow on agents with long histories and is off by default, leaving those fields null.
   */
  public ?bool $includeCommitStatus;

  /**
   * @param array{
   *   includeArchived?: ?bool,
   *   limit?: ?int,
   *   includeCommitStatus?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->includeArchived = $values['includeArchived'] ?? null;
    $this->limit = $values['limit'] ?? null;
    $this->includeCommitStatus = $values['includeCommitStatus'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'includeArchived' => $data['include_archived'] ?? null,
      'limit' => $data['limit'] ?? null,
      'includeCommitStatus' => $data['include_commit_status'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->includeArchived !== null) {
      $result['include_archived'] = $this->includeArchived;
    }
    if ($this->limit !== null) {
      $result['limit'] = $this->limit;
    }
    if ($this->includeCommitStatus !== null) {
      $result['include_commit_status'] = $this->includeCommitStatus;
    }
    return $result;
  }
}
