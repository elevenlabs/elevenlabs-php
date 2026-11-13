<?php

declare(strict_types=1);

namespace ElevenLabs\Productions\Orders\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use DateTime;
use ElevenLabs\Utils\Serializer;

class ListOrdersRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize Maximum number of orders to return per page.
   */
  public ?int $pageSize;

  /**
   * @var ?int $offset Number of orders to skip for pagination.
   */
  public ?int $offset;

  /**
   * @var ?array $status Filter orders by one or more statuses.
   */
  public ?array $status;

  /**
   * @var ?DateTime $startDate Filter orders created on or after this date.
   */
  public ?DateTime $startDate;

  /**
   * @var ?DateTime $endDate Filter orders created on or before this date.
   */
  public ?DateTime $endDate;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   offset?: ?int,
   *   status?: ?array,
   *   startDate?: ?DateTime,
   *   endDate?: ?DateTime,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->offset = $values['offset'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->startDate = $values['startDate'] ?? null;
    $this->endDate = $values['endDate'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'pageSize' => $data['page_size'] ?? null,
      'offset' => $data['offset'] ?? null,
      'status' => $data['status'] ?? null,
      'startDate' => isset($data['start_date'])
        ? Serializer::deserializeDateTime($data['start_date'])
        : null,
      'endDate' => isset($data['end_date'])
        ? Serializer::deserializeDateTime($data['end_date'])
        : null
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
    if ($this->offset !== null) {
      $result['offset'] = $this->offset;
    }
    if ($this->status !== null) {
      $result['status'] = $this->status;
    }
    if ($this->startDate !== null) {
      $result['start_date'] = Serializer::serializeDateTime($this->startDate);
    }
    if ($this->endDate !== null) {
      $result['end_date'] = Serializer::serializeDateTime($this->endDate);
    }
    return $result;
  }
}
