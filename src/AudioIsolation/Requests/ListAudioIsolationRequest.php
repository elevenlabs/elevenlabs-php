<?php

declare(strict_types=1);

namespace ElevenLabs\AudioIsolation\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListAudioIsolationRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize How many history items to return at maximum. Defaults to 100.
   */
  public ?int $pageSize;

  /**
   * @var ?int $page Page number for search pagination (1-based). Only used when search is provided.
   */
  public ?int $page;

  /**
   * @var ?string $search Optional search term used for filtering audio isolation history (title/text).
   */
  public ?string $search;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   page?: ?int,
   *   search?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->page = $values['page'] ?? null;
    $this->search = $values['search'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'pageSize' => $data['page_size'] ?? null,
      'page' => $data['page'] ?? null,
      'search' => $data['search'] ?? null
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
    if ($this->page !== null) {
      $result['page'] = $this->page;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    return $result;
  }
}
