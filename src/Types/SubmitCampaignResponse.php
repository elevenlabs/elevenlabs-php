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
class SubmitCampaignResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('campaign', required: true)]
  public \ElevenLabs\Types\CampaignResponse $campaign;

  /**
   * False when the request repeated an earlier one and returned its campaign.
   */
  #[JsonProperty('created', required: true)]
  public bool $created;

  /**
   * Whether calling starts right away rather than at the next calling window.
   */
  #[JsonProperty('within_calling_window', required: true)]
  public bool $withinCallingWindow;

  /**
   * @param array{
   *   campaign: \ElevenLabs\Types\CampaignResponse,
   *   created: bool,
   *   withinCallingWindow: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->campaign = $values['campaign'];
    $this->created = $values['created'];
    $this->withinCallingWindow = $values['withinCallingWindow'];

    $this->_dirtyFields = [
      'campaign' => true,
      'created' => true,
      'within_calling_window' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'campaign',
      'contents' => json_encode($this->campaign),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'created',
      'contents' => $this->created ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'within_calling_window',
      'contents' => $this->withinCallingWindow ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->campaign->validate();
  }
}
