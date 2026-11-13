<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\KnowledgeBaseDependentType;

class GetAgentsDocumentsRequest extends JsonSerializableType
{
  /**
   * @var ?value-of<KnowledgeBaseDependentType> $dependentType Type of dependent agents to return.
   */
  public ?string $dependentType;

  /**
   * @var ?int $pageSize How many documents to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   dependentType?: ?value-of<KnowledgeBaseDependentType>,
   *   pageSize?: ?int,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->dependentType = $values['dependentType'] ?? null;
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
      'dependentType' => $data['dependent_type'] ?? null,
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
    if ($this->dependentType !== null) {
      $result['dependent_type'] = $this->dependentType;
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
