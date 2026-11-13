<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\PhoneNumbers\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\TelephonyProvider;

class ListPhoneNumbersRequest extends JsonSerializableType
{
  /**
   * @var ?value-of<TelephonyProvider> $provider Filter by telephony provider
   */
  public ?string $provider;

  /**
   * @var ?string $agentId Filter by assigned agent ID
   */
  public ?string $agentId;

  /**
   * @var ?string $branchId Filter by assigned branch ID
   */
  public ?string $branchId;

  /**
   * @param array{
   *   provider?: ?value-of<TelephonyProvider>,
   *   agentId?: ?string,
   *   branchId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->provider = $values['provider'] ?? null;
    $this->agentId = $values['agentId'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'provider' => $data['provider'] ?? null,
      'agentId' => $data['agent_id'] ?? null,
      'branchId' => $data['branch_id'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->provider !== null) {
      $result['provider'] = $this->provider;
    }
    if ($this->agentId !== null) {
      $result['agent_id'] = $this->agentId;
    }
    if ($this->branchId !== null) {
      $result['branch_id'] = $this->branchId;
    }
    return $result;
  }
}
