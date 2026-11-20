<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class PolicyConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * IANA timezone the calling periods are read in.
   */
  #[JsonProperty('timezone')]
  public ?string $timezone;

  #[JsonProperty('retry')]
  public ?\ElevenLabs\Types\RetryPolicy $retry;

  /**
   * @var \ElevenLabs\Types\CallingPeriod[]|null
   * The weekly windows calls may be placed in.
   */
  #[JsonProperty('calling_periods'), ArrayType([\ElevenLabs\Types\CallingPeriod::class])]
  public ?array $callingPeriods;

  /**
   * @var \ElevenLabs\Types\DateOverride[]|null
   * Local dates in `timezone` whose calling windows replace `calling_periods`. Date ranges may not overlap.
   */
  #[JsonProperty('date_overrides'), ArrayType([\ElevenLabs\Types\DateOverride::class])]
  public ?array $dateOverrides;

  /**
   * The agent's data collection items that steer follow-up calls. Each defaults
   * to the built-in item for its purpose; `null` turns it off.
   */
  #[JsonProperty('data_collection')]
  public ?\ElevenLabs\Types\DataCollectionConfig $dataCollection;

  /**
   * Which `campaign__` dynamic variables follow-up calls get.
   */
  #[JsonProperty('followup_context')]
  public ?\ElevenLabs\Types\FollowupContextPolicy $followupContext;

  /**
   * @param array{
   *   timezone?: ?string,
   *   retry?: ?\ElevenLabs\Types\RetryPolicy,
   *   callingPeriods?: \ElevenLabs\Types\CallingPeriod[]|null,
   *   dateOverrides?: \ElevenLabs\Types\DateOverride[]|null,
   *   dataCollection?: ?\ElevenLabs\Types\DataCollectionConfig,
   *   followupContext?: ?\ElevenLabs\Types\FollowupContextPolicy,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->timezone = $values['timezone'] ?? null;
    $this->retry = $values['retry'] ?? null;
    $this->callingPeriods = $values['callingPeriods'] ?? null;
    $this->dateOverrides = $values['dateOverrides'] ?? null;
    $this->dataCollection = $values['dataCollection'] ?? null;
    $this->followupContext = $values['followupContext'] ?? null;

    if (array_key_exists('timezone', $values)) {
      $this->_dirtyFields['timezone'] = true;
    }
    if (array_key_exists('retry', $values)) {
      $this->_dirtyFields['retry'] = true;
    }
    if (array_key_exists('callingPeriods', $values)) {
      $this->_dirtyFields['calling_periods'] = true;
    }
    if (array_key_exists('dateOverrides', $values)) {
      $this->_dirtyFields['date_overrides'] = true;
    }
    if (array_key_exists('dataCollection', $values)) {
      $this->_dirtyFields['data_collection'] = true;
    }
    if (array_key_exists('followupContext', $values)) {
      $this->_dirtyFields['followup_context'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->timezone !== null) {
      $parts[] = [
        'name' => 'timezone',
        'contents' => $this->timezone
      ];
    }

    if ($this->retry !== null) {
      $parts[] = [
        'name' => 'retry',
        'contents' => json_encode($this->retry),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->callingPeriods !== null) {
      $parts[] = [
        'name' => 'calling_periods',
        'contents' => json_encode($this->callingPeriods),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dateOverrides !== null) {
      $parts[] = [
        'name' => 'date_overrides',
        'contents' => json_encode($this->dateOverrides),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dataCollection !== null) {
      $parts[] = [
        'name' => 'data_collection',
        'contents' => json_encode($this->dataCollection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->followupContext !== null) {
      $parts[] = [
        'name' => 'followup_context',
        'contents' => json_encode($this->followupContext),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->retry?->validate();
    foreach ($this->callingPeriods ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->callingPeriods, 'calling_periods', minItems: 1);
    foreach ($this->dateOverrides ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->dateOverrides, 'date_overrides', maxItems: 100);
    $this->dataCollection?->validate();
    $this->followupContext?->validate();
  }
}
