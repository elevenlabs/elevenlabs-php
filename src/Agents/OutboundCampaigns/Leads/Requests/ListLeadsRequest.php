<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns\Leads\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Agents\OutboundCampaigns\Leads\Types\ListLeadsRequestStatus;

class ListLeadsRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize How many items to return at most.
   */
  public ?int $pageSize;

  /**
   * @var ?string $search Only leads whose ID, user ID or phone number contains this text.
   */
  public ?string $search;

  /**
   * @var ?value-of<ListLeadsRequestStatus> $status `in_progress` for leads still being called, `finished` for leads that won't be called again.
   */
  public ?string $status;

  /**
   * @var ?array $disposition Only leads that finished in one of these ways.
   */
  public ?array $disposition;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   search?: ?string,
   *   status?: ?value-of<ListLeadsRequestStatus>,
   *   disposition?: ?array,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->search = $values['search'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->disposition = $values['disposition'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'pageSize' => $data['page_size'] ?? null,
      'search' => $data['search'] ?? null,
      'status' => $data['status'] ?? null,
      'disposition' => $data['disposition'] ?? null,
      'cursor' => $data['cursor'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    if ($this->status !== null) {
      $result['status'] = $this->status;
    }
    if ($this->disposition !== null) {
      $result['disposition'] = $this->disposition;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
