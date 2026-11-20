<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A tier's prices and the limits shown on its tier card.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ResellerTierEconomics extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * What one month is sold for.
   */
  #[JsonProperty('monthly_price_usd', required: true)]
  public float $monthlyPriceUsd;

  /**
   * What a year up front is sold for. Null for the trial.
   */
  #[JsonProperty('annual_price_usd', required: true)]
  public ?float $annualPriceUsd;

  /**
   * Phone minutes included each month. A web minute draws half a minute, a chat message a tenth.
   */
  #[JsonProperty('included_minutes_per_month', required: true)]
  public float $includedMinutesPerMonth;

  /**
   * Charged per minute past the included ones. Null for the trial.
   */
  #[JsonProperty('overage_price_per_minute_usd', required: true)]
  public ?float $overagePricePerMinuteUsd;

  /**
   * Phone numbers a workspace on this tier can hold at once.
   */
  #[JsonProperty('max_phone_numbers', required: true)]
  public int $maxPhoneNumbers;

  /**
   * Calls a workspace on this tier can take at the same time.
   */
  #[JsonProperty('concurrent_calls', required: true)]
  public int $concurrentCalls;

  /**
   * Business locations a workspace on this tier can have active.
   */
  #[JsonProperty('max_active_locations', required: true)]
  public int $maxActiveLocations;

  /**
   * Receptionists a workspace on this tier can have active.
   */
  #[JsonProperty('max_customer_facing_agents', required: true)]
  public int $maxCustomerFacingAgents;

  /**
   * Team members a workspace on this tier can have, counting pending invites.
   */
  #[JsonProperty('max_team_members', required: true)]
  public int $maxTeamMembers;

  /**
   * Messages the owner can send the Assistant each day.
   */
  #[JsonProperty('assistant_daily_messages', required: true)]
  public int $assistantDailyMessages;

  /**
   * @param array{
   *   monthlyPriceUsd: float,
   *   annualPriceUsd: ?float,
   *   includedMinutesPerMonth: float,
   *   overagePricePerMinuteUsd: ?float,
   *   maxPhoneNumbers: int,
   *   concurrentCalls: int,
   *   maxActiveLocations: int,
   *   maxCustomerFacingAgents: int,
   *   maxTeamMembers: int,
   *   assistantDailyMessages: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->monthlyPriceUsd = $values['monthlyPriceUsd'];
    $this->annualPriceUsd = $values['annualPriceUsd'];
    $this->includedMinutesPerMonth = $values['includedMinutesPerMonth'];
    $this->overagePricePerMinuteUsd = $values['overagePricePerMinuteUsd'];
    $this->maxPhoneNumbers = $values['maxPhoneNumbers'];
    $this->concurrentCalls = $values['concurrentCalls'];
    $this->maxActiveLocations = $values['maxActiveLocations'];
    $this->maxCustomerFacingAgents = $values['maxCustomerFacingAgents'];
    $this->maxTeamMembers = $values['maxTeamMembers'];
    $this->assistantDailyMessages = $values['assistantDailyMessages'];

    $this->_dirtyFields = [
      'monthly_price_usd' => true,
      'annual_price_usd' => true,
      'included_minutes_per_month' => true,
      'overage_price_per_minute_usd' => true,
      'max_phone_numbers' => true,
      'concurrent_calls' => true,
      'max_active_locations' => true,
      'max_customer_facing_agents' => true,
      'max_team_members' => true,
      'assistant_daily_messages' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'monthly_price_usd',
      'contents' => (string) $this->monthlyPriceUsd
    ];

    $parts[] = [
      'name' => 'annual_price_usd',
      'contents' => (string) $this->annualPriceUsd
    ];

    $parts[] = [
      'name' => 'included_minutes_per_month',
      'contents' => (string) $this->includedMinutesPerMonth
    ];

    $parts[] = [
      'name' => 'overage_price_per_minute_usd',
      'contents' => (string) $this->overagePricePerMinuteUsd
    ];

    $parts[] = [
      'name' => 'max_phone_numbers',
      'contents' => (string) $this->maxPhoneNumbers
    ];

    $parts[] = [
      'name' => 'concurrent_calls',
      'contents' => (string) $this->concurrentCalls
    ];

    $parts[] = [
      'name' => 'max_active_locations',
      'contents' => (string) $this->maxActiveLocations
    ];

    $parts[] = [
      'name' => 'max_customer_facing_agents',
      'contents' => (string) $this->maxCustomerFacingAgents
    ];

    $parts[] = [
      'name' => 'max_team_members',
      'contents' => (string) $this->maxTeamMembers
    ];

    $parts[] = [
      'name' => 'assistant_daily_messages',
      'contents' => (string) $this->assistantDailyMessages
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
