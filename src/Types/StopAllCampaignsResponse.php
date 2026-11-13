<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class StopAllCampaignsResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   */
  #[JsonProperty('stopped_campaign_ids', required: true), ArrayType(['string'])]
  public array $stoppedCampaignIds;

  /**
   * @var string[]
   * Campaigns whose calls already placed are still finishing.
   */
  #[JsonProperty('stopping_campaign_ids', required: true), ArrayType(['string'])]
  public array $stoppingCampaignIds;

  /**
   * @param array{
   *   stoppedCampaignIds: string[],
   *   stoppingCampaignIds: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->stoppedCampaignIds = $values['stoppedCampaignIds'];
    $this->stoppingCampaignIds = $values['stoppingCampaignIds'];

    $this->_dirtyFields = [
      'stopped_campaign_ids' => true,
      'stopping_campaign_ids' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->stoppedCampaignIds as $item) {
      $parts[] = [
        'name' => 'stopped_campaign_ids',
        'contents' => $item
      ];
    }

    foreach ($this->stoppingCampaignIds as $item) {
      $parts[] = [
        'name' => 'stopping_campaign_ids',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
