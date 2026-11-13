<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class DeleteDocumentsRequest extends JsonSerializableType
{
  /**
   * @var ?bool $force If set to true, the document or folder will be deleted regardless of whether it is used by any agents and it will be removed from the dependent agents. For non-empty folders, this will also delete all child documents and folders.
   */
  public ?bool $force;

  /**
   * @param array{
   *   force?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->force = $values['force'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'force' => $data['force'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->force !== null) {
      $result['force'] = $this->force;
    }
    return $result;
  }
}
