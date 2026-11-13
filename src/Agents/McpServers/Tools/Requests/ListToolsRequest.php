<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\McpServers\Tools\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListToolsRequest extends JsonSerializableType
{
  /**
   * @var ?string $environment Environment whose values are used when the MCP server URL, headers, or auth connection reference environment variables. Mirrors the environment a conversation would run in; defaults to production.
   */
  public ?string $environment;

  /**
   * @param array{
   *   environment?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->environment = $values['environment'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'environment' => $data['environment'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->environment !== null) {
      $result['environment'] = $this->environment;
    }
    return $result;
  }
}
