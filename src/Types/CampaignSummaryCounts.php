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
class CampaignSummaryCounts extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('leads', required: true)]
  public int $leads;

  /**
   * Leads that won't be called again.
   */
  #[JsonProperty('terminal_leads', required: true)]
  public int $terminalLeads;

  /**
   * Attention items not yet resolved.
   */
  #[JsonProperty('open_attention', required: true)]
  public int $openAttention;

  /**
   * How many messages reached each stage; set when getting one message campaign.
   */
  #[JsonProperty('delivery')]
  public ?\ElevenLabs\Types\RecipientDeliveryCounts $delivery;

  /**
   * @param array{
   *   leads: int,
   *   terminalLeads: int,
   *   openAttention: int,
   *   delivery?: ?\ElevenLabs\Types\RecipientDeliveryCounts,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->leads = $values['leads'];
    $this->terminalLeads = $values['terminalLeads'];
    $this->openAttention = $values['openAttention'];
    $this->delivery = $values['delivery'] ?? null;

    $this->_dirtyFields = [
      'leads' => true,
      'terminal_leads' => true,
      'open_attention' => true
    ];
    if (array_key_exists('delivery', $values)) {
      $this->_dirtyFields['delivery'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'leads',
      'contents' => (string) $this->leads
    ];

    $parts[] = [
      'name' => 'terminal_leads',
      'contents' => (string) $this->terminalLeads
    ];

    $parts[] = [
      'name' => 'open_attention',
      'contents' => (string) $this->openAttention
    ];

    if ($this->delivery !== null) {
      $parts[] = [
        'name' => 'delivery',
        'contents' => json_encode($this->delivery),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->delivery?->validate();
  }
}
