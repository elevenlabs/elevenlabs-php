<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class DeleteAgentsRequest extends JsonSerializableType
{
  /**
   * @var ?bool $force If set to true, the agent is deleted even if other agents use it as a subagent, and it is removed from those agents and their branches.
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
