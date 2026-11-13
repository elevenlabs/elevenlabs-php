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
class ConversationHistoryBatchCallModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('batch_call_id', required: true)]
  public string $batchCallId;

  #[JsonProperty('batch_call_recipient_id', required: true)]
  public string $batchCallRecipientId;

  #[JsonProperty('campaign')]
  public ?\ElevenLabs\Types\BatchCallingCampaignInformation $campaign;

  /**
   * @param array{
   *   batchCallId: string,
   *   batchCallRecipientId: string,
   *   campaign?: ?\ElevenLabs\Types\BatchCallingCampaignInformation,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->batchCallId = $values['batchCallId'];
    $this->batchCallRecipientId = $values['batchCallRecipientId'];
    $this->campaign = $values['campaign'] ?? null;

    $this->_dirtyFields = [
      'batch_call_id' => true,
      'batch_call_recipient_id' => true
    ];
    if (array_key_exists('campaign', $values)) {
      $this->_dirtyFields['campaign'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'batch_call_id',
      'contents' => $this->batchCallId
    ];

    $parts[] = [
      'name' => 'batch_call_recipient_id',
      'contents' => $this->batchCallRecipientId
    ];

    if ($this->campaign !== null) {
      $parts[] = [
        'name' => 'campaign',
        'contents' => json_encode($this->campaign),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->campaign?->validate();
  }
}
