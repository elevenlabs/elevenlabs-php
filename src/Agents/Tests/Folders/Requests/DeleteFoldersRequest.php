<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tests\Folders\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class DeleteFoldersRequest extends JsonSerializableType
{
  /**
   * @var ?bool $force Force delete. Required for deleting non-empty folders.
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
