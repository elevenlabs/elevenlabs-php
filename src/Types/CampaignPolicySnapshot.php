<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The policy the campaign took when it was created, laid out like a submitted `policy`.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CampaignPolicySnapshot extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('timezone', required: true)]
  public string $timezone;

  #[JsonProperty('retry', required: true)]
  public \ElevenLabs\Types\RetryPolicy $retry;

  /**
   * @var \ElevenLabs\Types\CallingPeriodPolicy[]
   */
  #[
    JsonProperty('calling_periods', required: true),
    ArrayType([\ElevenLabs\Types\CallingPeriodPolicy::class])
  ]
  public array $callingPeriods;

  #[JsonProperty('data_collection', required: true)]
  public \ElevenLabs\Types\DataCollectionPolicy $dataCollection;

  /**
   * Which `campaign__` dynamic variables follow-up calls get.
   */
  #[JsonProperty('followup_context', required: true)]
  public \ElevenLabs\Types\FollowupContextPolicy $followupContext;

  /**
   * @param array{
   *   timezone: string,
   *   retry: \ElevenLabs\Types\RetryPolicy,
   *   callingPeriods: \ElevenLabs\Types\CallingPeriodPolicy[],
   *   dataCollection: \ElevenLabs\Types\DataCollectionPolicy,
   *   followupContext: \ElevenLabs\Types\FollowupContextPolicy,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->timezone = $values['timezone'];
    $this->retry = $values['retry'];
    $this->callingPeriods = $values['callingPeriods'];
    $this->dataCollection = $values['dataCollection'];
    $this->followupContext = $values['followupContext'];

    $this->_dirtyFields = [
      'timezone' => true,
      'retry' => true,
      'calling_periods' => true,
      'data_collection' => true,
      'followup_context' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'timezone',
      'contents' => $this->timezone
    ];

    $parts[] = [
      'name' => 'retry',
      'contents' => json_encode($this->retry),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'calling_periods',
      'contents' => json_encode($this->callingPeriods),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'data_collection',
      'contents' => json_encode($this->dataCollection),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'followup_context',
      'contents' => json_encode($this->followupContext),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->retry->validate();
    foreach ($this->callingPeriods as $item) {
      $item->validate();
    }
    $this->dataCollection->validate();
    $this->followupContext->validate();
  }
}
