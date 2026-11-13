<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Agents\OutboundCampaigns\Types\ListOutboundCampaignsRequestMode;
use ElevenLabs\Types\OutboundChannel;

class ListOutboundCampaignsRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize How many items to return at most.
   */
  public ?int $pageSize;

  /**
   * @var ?array $status Only campaigns in one of these statuses.
   */
  public ?array $status;

  /**
   * @var ?string $agentId Only campaigns run by this agent.
   */
  public ?string $agentId;

  /**
   * @var ?value-of<OutboundChannel> $channel Only campaigns on this channel.
   */
  public ?string $channel;

  /**
   * @var ?value-of<ListOutboundCampaignsRequestMode> $mode Only voice or only message campaigns.
   */
  public ?string $mode;

  /**
   * @var ?string $search Only campaigns whose name contains this text.
   */
  public ?string $search;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   status?: ?array,
   *   agentId?: ?string,
   *   channel?: ?value-of<OutboundChannel>,
   *   mode?: ?value-of<ListOutboundCampaignsRequestMode>,
   *   search?: ?string,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->agentId = $values['agentId'] ?? null;
    $this->channel = $values['channel'] ?? null;
    $this->mode = $values['mode'] ?? null;
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
      'pageSize' => $data['page_size'] ?? null,
      'status' => $data['status'] ?? null,
      'agentId' => $data['agent_id'] ?? null,
      'channel' => $data['channel'] ?? null,
      'mode' => $data['mode'] ?? null,
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
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->status !== null) {
      $result['status'] = $this->status;
    }
    if ($this->agentId !== null) {
      $result['agent_id'] = $this->agentId;
    }
    if ($this->channel !== null) {
      $result['channel'] = $this->channel;
    }
    if ($this->mode !== null) {
      $result['mode'] = $this->mode;
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
