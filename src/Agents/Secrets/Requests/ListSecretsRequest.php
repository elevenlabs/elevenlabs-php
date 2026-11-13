<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Secrets\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListSecretsRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize How many documents to return at maximum. Can not exceed 100. If not provided, returns all secrets.
   */
  public ?int $pageSize;

  /**
   * @var ?int $dependencyLimit Maximum number of dependent resources (tools, agents, phone numbers) to return per secret. Can not exceed 100.
   */
  public ?int $dependencyLimit;

  /**
   * @var ?string $search If specified, returns only secrets whose names start with this string.
   */
  public ?string $search;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   dependencyLimit?: ?int,
   *   search?: ?string,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->dependencyLimit = $values['dependencyLimit'] ?? null;
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
      'dependencyLimit' => $data['dependency_limit'] ?? null,
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
    if ($this->dependencyLimit !== null) {
      $result['dependency_limit'] = $this->dependencyLimit;
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
