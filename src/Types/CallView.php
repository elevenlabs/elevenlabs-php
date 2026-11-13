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
class CallView extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('intent_id', required: true)]
  public string $intentId;

  #[JsonProperty('lead_id', required: true)]
  public string $leadId;

  /**
   * @var value-of<\ElevenLabs\Types\CampaignConversationType>
   */
  #[JsonProperty('intent_type', required: true)]
  public string $intentType;

  /**
   * `1` for the first call and `+1` per retry of it; unset for callbacks, redirects and their retries.
   */
  #[JsonProperty('cold_attempt', required: true)]
  public ?int $coldAttempt;

  /**
   * @var value-of<\ElevenLabs\Types\CallStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  #[JsonProperty('phone_number', required: true)]
  public string $phoneNumber;

  /**
   * When the call is due to be placed.
   */
  #[JsonProperty('scheduled_time_unix', required: true)]
  public int $scheduledTimeUnix;

  #[JsonProperty('conversation_id', required: true)]
  public ?string $conversationId;

  /**
   * @var ?value-of<\ElevenLabs\Types\BatchCallRecipientStatus>
   * The call's final dialing status, set once it ends.
   */
  #[JsonProperty('outcome', required: true)]
  public ?string $outcome;

  /**
   * @var ?value-of<\ElevenLabs\Types\CallResult>
   * How the call ended.
   */
  #[JsonProperty('call_result', required: true)]
  public ?string $callResult;

  /**
   * When the call ended.
   */
  #[JsonProperty('outcome_at_unix', required: true)]
  public ?int $outcomeAtUnix;

  /**
   * @var ?value-of<\ElevenLabs\Types\DecisionDisposition>
   * What the campaign did after the call, such as queue a retry or a callback, or finish the lead.
   */
  #[JsonProperty('decision_disposition', required: true)]
  public ?string $decisionDisposition;

  /**
   * @var array<string, mixed>|null
   * Data collection results this call copied into the lead's dynamic variables for later calls, with secrets redacted.
   */
  #[JsonProperty('collected_dynamic_variables'), ArrayType(['string' => 'mixed'])]
  public ?array $collectedDynamicVariables;

  /**
   * The message's delivery; set on message campaigns.
   */
  #[JsonProperty('delivery')]
  public ?\ElevenLabs\Types\LeadDeliveryView $delivery;

  /**
   * @param array{
   *   intentId: string,
   *   leadId: string,
   *   intentType: value-of<\ElevenLabs\Types\CampaignConversationType>,
   *   coldAttempt: ?int,
   *   status: value-of<\ElevenLabs\Types\CallStatus>,
   *   phoneNumber: string,
   *   scheduledTimeUnix: int,
   *   conversationId: ?string,
   *   outcome: ?value-of<\ElevenLabs\Types\BatchCallRecipientStatus>,
   *   callResult: ?value-of<\ElevenLabs\Types\CallResult>,
   *   outcomeAtUnix: ?int,
   *   decisionDisposition: ?value-of<\ElevenLabs\Types\DecisionDisposition>,
   *   collectedDynamicVariables?: array<string, mixed>|null,
   *   delivery?: ?\ElevenLabs\Types\LeadDeliveryView,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->intentId = $values['intentId'];
    $this->leadId = $values['leadId'];
    $this->intentType = $values['intentType'];
    $this->coldAttempt = $values['coldAttempt'];
    $this->status = $values['status'];
    $this->phoneNumber = $values['phoneNumber'];
    $this->scheduledTimeUnix = $values['scheduledTimeUnix'];
    $this->conversationId = $values['conversationId'];
    $this->outcome = $values['outcome'];
    $this->callResult = $values['callResult'];
    $this->outcomeAtUnix = $values['outcomeAtUnix'];
    $this->decisionDisposition = $values['decisionDisposition'];
    $this->collectedDynamicVariables = $values['collectedDynamicVariables'] ?? null;
    $this->delivery = $values['delivery'] ?? null;

    $this->_dirtyFields = [
      'intent_id' => true,
      'lead_id' => true,
      'intent_type' => true,
      'cold_attempt' => true,
      'status' => true,
      'phone_number' => true,
      'scheduled_time_unix' => true,
      'conversation_id' => true,
      'outcome' => true,
      'call_result' => true,
      'outcome_at_unix' => true,
      'decision_disposition' => true
    ];
    if (array_key_exists('collectedDynamicVariables', $values)) {
      $this->_dirtyFields['collected_dynamic_variables'] = true;
    }
    if (array_key_exists('delivery', $values)) {
      $this->_dirtyFields['delivery'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'intent_id',
      'contents' => $this->intentId
    ];

    $parts[] = [
      'name' => 'lead_id',
      'contents' => $this->leadId
    ];

    $parts[] = [
      'name' => 'intent_type',
      'contents' => $this->intentType
    ];

    $parts[] = [
      'name' => 'cold_attempt',
      'contents' => (string) $this->coldAttempt
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'phone_number',
      'contents' => $this->phoneNumber
    ];

    $parts[] = [
      'name' => 'scheduled_time_unix',
      'contents' => (string) $this->scheduledTimeUnix
    ];

    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

    $parts[] = [
      'name' => 'outcome',
      'contents' => $this->outcome
    ];

    $parts[] = [
      'name' => 'call_result',
      'contents' => $this->callResult
    ];

    $parts[] = [
      'name' => 'outcome_at_unix',
      'contents' => (string) $this->outcomeAtUnix
    ];

    $parts[] = [
      'name' => 'decision_disposition',
      'contents' => $this->decisionDisposition
    ];

    if ($this->collectedDynamicVariables !== null) {
      $parts[] = [
        'name' => 'collected_dynamic_variables',
        'contents' => json_encode($this->collectedDynamicVariables),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

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
