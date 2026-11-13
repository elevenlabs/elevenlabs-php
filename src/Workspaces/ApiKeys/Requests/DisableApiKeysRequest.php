<?php

declare(strict_types=1);

namespace ElevenLabs\Workspaces\ApiKeys\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class DisableApiKeysRequest extends JsonSerializableType
{
  /**
   * @var string $apiKeyName Must be set to `self` to disable the API key used to authenticate this request. Required as an explicit confirmation to avoid accidentally disabling the wrong key.
   */
  public string $apiKeyName;

  /**
   * @param array{
   *   apiKeyName: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->apiKeyName = $values['apiKeyName'];
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'apiKeyName' => $data['api_key_name']
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    $result['api_key_name'] = $this->apiKeyName;
    return $result;
  }
}
