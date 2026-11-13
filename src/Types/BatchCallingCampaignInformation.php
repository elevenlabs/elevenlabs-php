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
class BatchCallingCampaignInformation extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('campaign_id', required: true)]
  public string $campaignId;

  #[JsonProperty('campaign_lead_id', required: true)]
  public string $campaignLeadId;

  #[JsonProperty('cold_attempt')]
  public ?int $coldAttempt;

  /**
   * @var ?value-of<\ElevenLabs\Types\CampaignConversationType>
   */
  #[JsonProperty('conversation_type')]
  public ?string $conversationType;

  /**
   * @param array{
   *   campaignId: string,
   *   campaignLeadId: string,
   *   coldAttempt?: ?int,
   *   conversationType?: ?value-of<\ElevenLabs\Types\CampaignConversationType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->campaignId = $values['campaignId'];
    $this->campaignLeadId = $values['campaignLeadId'];
    $this->coldAttempt = $values['coldAttempt'] ?? null;
    $this->conversationType = $values['conversationType'] ?? null;

    $this->_dirtyFields = [
      'campaign_id' => true,
      'campaign_lead_id' => true
    ];
    if (array_key_exists('coldAttempt', $values)) {
      $this->_dirtyFields['cold_attempt'] = true;
    }
    if (array_key_exists('conversationType', $values)) {
      $this->_dirtyFields['conversation_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'campaign_id',
      'contents' => $this->campaignId
    ];

    $parts[] = [
      'name' => 'campaign_lead_id',
      'contents' => $this->campaignLeadId
    ];

    if ($this->coldAttempt !== null) {
      $parts[] = [
        'name' => 'cold_attempt',
        'contents' => (string) $this->coldAttempt
      ];
    }

    if ($this->conversationType !== null) {
      $parts[] = [
        'name' => 'conversation_type',
        'contents' => $this->conversationType
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
