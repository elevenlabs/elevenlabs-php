<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns\Attention\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListAttentionRequest extends JsonSerializableType
{
  /**
   * @var ?string $campaignId Only this campaign's items.
   */
  public ?string $campaignId;

  /**
   * @var ?bool $includeResolved Include items that are already resolved.
   */
  public ?bool $includeResolved;

  /**
   * @var ?int $pageSize How many items to return at most.
   */
  public ?int $pageSize;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   campaignId?: ?string,
   *   includeResolved?: ?bool,
   *   pageSize?: ?int,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->campaignId = $values['campaignId'] ?? null;
    $this->includeResolved = $values['includeResolved'] ?? null;
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
      'campaignId' => $data['campaign_id'] ?? null,
      'includeResolved' => $data['include_resolved'] ?? null,
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
    if ($this->campaignId !== null) {
      $result['campaign_id'] = $this->campaignId;
    }
    if ($this->includeResolved !== null) {
      $result['include_resolved'] = $this->includeResolved;
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
