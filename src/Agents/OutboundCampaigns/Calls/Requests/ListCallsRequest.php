<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns\Calls\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\CallStatus;
use ElevenLabs\Agents\OutboundCampaigns\Calls\Types\ListCallsRequestStage;

class ListCallsRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize How many items to return at most.
   */
  public ?int $pageSize;

  /**
   * @var ?string $leadId Only this lead's calls.
   */
  public ?string $leadId;

  /**
   * @var ?value-of<CallStatus> $status Only calls in this status.
   */
  public ?string $status;

  /**
   * @var ?array $callResult Only calls that ended in one of these results.
   */
  public ?array $callResult;

  /**
   * @var ?value-of<ListCallsRequestStage> $stage Only messages at this delivery stage. Message campaigns only.
   */
  public ?string $stage;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   leadId?: ?string,
   *   status?: ?value-of<CallStatus>,
   *   callResult?: ?array,
   *   stage?: ?value-of<ListCallsRequestStage>,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->leadId = $values['leadId'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->callResult = $values['callResult'] ?? null;
    $this->stage = $values['stage'] ?? null;
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
      'leadId' => $data['lead_id'] ?? null,
      'status' => $data['status'] ?? null,
      'callResult' => $data['call_result'] ?? null,
      'stage' => $data['stage'] ?? null,
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
    if ($this->leadId !== null) {
      $result['lead_id'] = $this->leadId;
    }
    if ($this->status !== null) {
      $result['status'] = $this->status;
    }
    if ($this->callResult !== null) {
      $result['call_result'] = $this->callResult;
    }
    if ($this->stage !== null) {
      $result['stage'] = $this->stage;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
