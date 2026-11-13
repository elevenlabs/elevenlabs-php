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
class PauseAllCampaignsResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   */
  #[JsonProperty('paused_campaign_ids', required: true), ArrayType(['string'])]
  public array $pausedCampaignIds;

  /**
   * @param array{
   *   pausedCampaignIds: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->pausedCampaignIds = $values['pausedCampaignIds'];

    $this->_dirtyFields = [
      'paused_campaign_ids' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->pausedCampaignIds as $item) {
      $parts[] = [
        'name' => 'paused_campaign_ids',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
