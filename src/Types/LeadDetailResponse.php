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
class LeadDetailResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('lead_id', required: true)]
  public string $leadId;

  /**
   * The `id` given to this recipient when the campaign was created.
   */
  #[JsonProperty('recipient_id', required: true)]
  public ?string $recipientId;

  /**
   * The number the lead's next call dials. It changes when the lead moves on to another listed number or the contact asks to be called on a different one.
   */
  #[JsonProperty('phone_number', required: true)]
  public string $phoneNumber;

  /**
   * @var string[]|null
   * The lead's listed numbers, in calling order.
   */
  #[JsonProperty('phone_numbers'), ArrayType(['string'])]
  public ?array $phoneNumbers;

  /**
   * The position in `phone_numbers` of the number being called.
   */
  #[JsonProperty('phone_numbers_index', required: true)]
  public int $phoneNumbersIndex;

  /**
   * The contact's identity: the `user_id` submitted in `conversation_initiation_client_data`, else the lead's phone number.
   */
  #[JsonProperty('user_id', required: true)]
  public string $userId;

  /**
   * Calls placed, counted against the policy's `max_total_calls`.
   */
  #[JsonProperty('attempt_count', required: true)]
  public int $attemptCount;

  /**
   * Failed calls to the current number; resets on a new number.
   */
  #[JsonProperty('failure_count', required: true)]
  public int $failureCount;

  /**
   * Callbacks the contact asked for.
   */
  #[JsonProperty('callback_count', required: true)]
  public int $callbackCount;

  /**
   * Times the contact asked to be called on another number.
   */
  #[JsonProperty('redirect_count', required: true)]
  public int $redirectCount;

  /**
   * Set when the contact asked not to be called, the lead was removed, or the campaign stopped. The lead isn't called again.
   */
  #[JsonProperty('do_not_call', required: true)]
  public bool $doNotCall;

  /**
   * @var ?value-of<\ElevenLabs\Types\TerminalDisposition>
   * Why the lead won't be called again; unset while it may be.
   */
  #[JsonProperty('terminal_disposition', required: true)]
  public ?string $terminalDisposition;

  /**
   * When the lead joined the campaign; unset on older leads.
   */
  #[JsonProperty('created_at_unix', required: true)]
  public ?int $createdAtUnix;

  #[JsonProperty('updated_at_unix', required: true)]
  public int $updatedAtUnix;

  /**
   * @var array<string, mixed>
   * The dynamic variables submitted for the lead, with secrets redacted.
   */
  #[JsonProperty('dynamic_variables', required: true), ArrayType(['string' => 'mixed'])]
  public array $dynamicVariables;

  #[JsonProperty('overrides', required: true)]
  public \ElevenLabs\Types\FlattenedConfigOverrides $overrides;

  /**
   * The lead's latest message delivery; set on message campaigns.
   */
  #[JsonProperty('delivery')]
  public ?\ElevenLabs\Types\LeadDeliveryView $delivery;

  /**
   * @param array{
   *   leadId: string,
   *   recipientId: ?string,
   *   phoneNumber: string,
   *   phoneNumbersIndex: int,
   *   userId: string,
   *   attemptCount: int,
   *   failureCount: int,
   *   callbackCount: int,
   *   redirectCount: int,
   *   doNotCall: bool,
   *   terminalDisposition: ?value-of<\ElevenLabs\Types\TerminalDisposition>,
   *   createdAtUnix: ?int,
   *   updatedAtUnix: int,
   *   dynamicVariables: array<string, mixed>,
   *   overrides: \ElevenLabs\Types\FlattenedConfigOverrides,
   *   phoneNumbers?: string[]|null,
   *   delivery?: ?\ElevenLabs\Types\LeadDeliveryView,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->leadId = $values['leadId'];
    $this->recipientId = $values['recipientId'];
    $this->phoneNumber = $values['phoneNumber'];
    $this->phoneNumbers = $values['phoneNumbers'] ?? null;
    $this->phoneNumbersIndex = $values['phoneNumbersIndex'];
    $this->userId = $values['userId'];
    $this->attemptCount = $values['attemptCount'];
    $this->failureCount = $values['failureCount'];
    $this->callbackCount = $values['callbackCount'];
    $this->redirectCount = $values['redirectCount'];
    $this->doNotCall = $values['doNotCall'];
    $this->terminalDisposition = $values['terminalDisposition'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->updatedAtUnix = $values['updatedAtUnix'];
    $this->dynamicVariables = $values['dynamicVariables'];
    $this->overrides = $values['overrides'];
    $this->delivery = $values['delivery'] ?? null;

    $this->_dirtyFields = [
      'lead_id' => true,
      'recipient_id' => true,
      'phone_number' => true,
      'phone_numbers_index' => true,
      'user_id' => true,
      'attempt_count' => true,
      'failure_count' => true,
      'callback_count' => true,
      'redirect_count' => true,
      'do_not_call' => true,
      'terminal_disposition' => true,
      'created_at_unix' => true,
      'updated_at_unix' => true,
      'dynamic_variables' => true,
      'overrides' => true
    ];
    if (array_key_exists('phoneNumbers', $values)) {
      $this->_dirtyFields['phone_numbers'] = true;
    }
    if (array_key_exists('delivery', $values)) {
      $this->_dirtyFields['delivery'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'lead_id',
      'contents' => $this->leadId
    ];

    $parts[] = [
      'name' => 'recipient_id',
      'contents' => $this->recipientId
    ];

    $parts[] = [
      'name' => 'phone_number',
      'contents' => $this->phoneNumber
    ];

    if ($this->phoneNumbers !== null) {
      foreach ($this->phoneNumbers ?? [] as $item) {
        $parts[] = [
          'name' => 'phone_numbers',
          'contents' => $item
        ];
      }
    }

    $parts[] = [
      'name' => 'phone_numbers_index',
      'contents' => (string) $this->phoneNumbersIndex
    ];

    $parts[] = [
      'name' => 'user_id',
      'contents' => $this->userId
    ];

    $parts[] = [
      'name' => 'attempt_count',
      'contents' => (string) $this->attemptCount
    ];

    $parts[] = [
      'name' => 'failure_count',
      'contents' => (string) $this->failureCount
    ];

    $parts[] = [
      'name' => 'callback_count',
      'contents' => (string) $this->callbackCount
    ];

    $parts[] = [
      'name' => 'redirect_count',
      'contents' => (string) $this->redirectCount
    ];

    $parts[] = [
      'name' => 'do_not_call',
      'contents' => $this->doNotCall ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'terminal_disposition',
      'contents' => $this->terminalDisposition
    ];

    $parts[] = [
      'name' => 'created_at_unix',
      'contents' => (string) $this->createdAtUnix
    ];

    $parts[] = [
      'name' => 'updated_at_unix',
      'contents' => (string) $this->updatedAtUnix
    ];

    $parts[] = [
      'name' => 'dynamic_variables',
      'contents' => json_encode($this->dynamicVariables),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'overrides',
      'contents' => json_encode($this->overrides),
      'headers' => ['Content-Type' => 'application/json']
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
    $this->overrides->validate();
    $this->delivery?->validate();
  }
}
