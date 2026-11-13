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
class SuppressLeadResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('campaign_id', required: true)]
  public string $campaignId;

  #[JsonProperty('lead_id', required: true)]
  public string $leadId;

  /**
   * Whether a call already handed off for dialing may still go through.
   */
  #[JsonProperty('has_calls_in_flight', required: true)]
  public bool $hasCallsInFlight;

  /**
   * @param array{
   *   campaignId: string,
   *   leadId: string,
   *   hasCallsInFlight: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->campaignId = $values['campaignId'];
    $this->leadId = $values['leadId'];
    $this->hasCallsInFlight = $values['hasCallsInFlight'];

    $this->_dirtyFields = [
      'campaign_id' => true,
      'lead_id' => true,
      'has_calls_in_flight' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'campaign_id',
      'contents' => $this->campaignId
    ];

    $parts[] = [
      'name' => 'lead_id',
      'contents' => $this->leadId
    ];

    $parts[] = [
      'name' => 'has_calls_in_flight',
      'contents' => $this->hasCallsInFlight ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
