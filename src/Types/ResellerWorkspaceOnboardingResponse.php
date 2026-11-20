<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ResellerWorkspaceOnboardingResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('onboarding_completed_at_unix', required: true)]
  public ?int $onboardingCompletedAtUnix;

  /**
   * The receptionist onboarding created or promoted.
   */
  #[JsonProperty('customer_facing_agent_id', required: true)]
  public string $customerFacingAgentId;

  /**
   * @param array{
   *   onboardingCompletedAtUnix: ?int,
   *   customerFacingAgentId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->onboardingCompletedAtUnix = $values['onboardingCompletedAtUnix'];
    $this->customerFacingAgentId = $values['customerFacingAgentId'];

    $this->_dirtyFields = [
      'onboarding_completed_at_unix' => true,
      'customer_facing_agent_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'onboarding_completed_at_unix',
      'contents' => (string) $this->onboardingCompletedAtUnix
    ];

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
