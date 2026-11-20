<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\PhoneNumbers\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Body for attaching a phone number to a different receptionist.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReassignPhoneRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * The receptionist that answers calls to the number from now on.
   */
  #[JsonProperty('customer_facing_agent_id', required: true)]
  public string $customerFacingAgentId;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   customerFacingAgentId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->customerFacingAgentId = $values['customerFacingAgentId'];

    $this->_dirtyFields = [
      'customer_facing_agent_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'customer_facing_agent_id',
      'contents' => $this->customerFacingAgentId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
