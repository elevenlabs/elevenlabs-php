<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents\Summaries\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetSummariesRequest extends JsonSerializableType
{
  /**
   * @var ?array $documentIds The ids of knowledge base documents.
   */
  public ?array $documentIds;

  /**
   * @param array{
   *   documentIds?: ?array,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->documentIds = $values['documentIds'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'documentIds' => $data['document_ids'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->documentIds !== null) {
      $result['document_ids'] = $this->documentIds;
    }
    return $result;
  }
}
