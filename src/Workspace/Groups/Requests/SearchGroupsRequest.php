<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Groups\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class SearchGroupsRequest extends JsonSerializableType
{
  /**
   * @var string $name Name of the target group.
   */
  public string $name;

  /**
   * @param array{
   *   name: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'name' => $data['name']
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    $result['name'] = $this->name;
    return $result;
  }
}
