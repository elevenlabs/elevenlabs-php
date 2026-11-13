<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Deployments\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListDeploymentsRequest extends JsonSerializableType
{
  /**
   * @var ?int $page Page number, starting at 1
   */
  public ?int $page;

  /**
   * @var ?int $pageSize How many results at most should be returned
   */
  public ?int $pageSize;

  /**
   * @param array{
   *   page?: ?int,
   *   pageSize?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->page = $values['page'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'page' => $data['page'] ?? null,
      'pageSize' => $data['page_size'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->page !== null) {
      $result['page'] = $this->page;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    return $result;
  }
}
