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
class GetWhatsAppAccountResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('business_account_id', required: true)]
  public string $businessAccountId;

  #[JsonProperty('phone_number_id', required: true)]
  public string $phoneNumberId;

  #[JsonProperty('business_account_name', required: true)]
  public string $businessAccountName;

  #[JsonProperty('phone_number_name', required: true)]
  public string $phoneNumberName;

  #[JsonProperty('phone_number', required: true)]
  public string $phoneNumber;

  /**
   * @var ?value-of<\ElevenLabs\Types\WhatsAppAccountType>
   */
  #[JsonProperty('account_type')]
  public ?string $accountType;

  #[JsonProperty('assigned_agent_id')]
  public ?string $assignedAgentId;

  #[JsonProperty('enable_messaging')]
  public ?bool $enableMessaging;

  #[JsonProperty('enable_audio_message_response')]
  public ?bool $enableAudioMessageResponse;

  #[JsonProperty('enable_typing_indicator')]
  public ?bool $enableTypingIndicator;

  #[JsonProperty('assigned_agent_name', required: true)]
  public ?string $assignedAgentName;

  #[JsonProperty('is_token_expired')]
  public ?bool $isTokenExpired;

  /**
   * @param array{
   *   businessAccountId: string,
   *   phoneNumberId: string,
   *   businessAccountName: string,
   *   phoneNumberName: string,
   *   phoneNumber: string,
   *   assignedAgentName: ?string,
   *   accountType?: ?value-of<\ElevenLabs\Types\WhatsAppAccountType>,
   *   assignedAgentId?: ?string,
   *   enableMessaging?: ?bool,
   *   enableAudioMessageResponse?: ?bool,
   *   enableTypingIndicator?: ?bool,
   *   isTokenExpired?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->businessAccountId = $values['businessAccountId'];
    $this->phoneNumberId = $values['phoneNumberId'];
    $this->businessAccountName = $values['businessAccountName'];
    $this->phoneNumberName = $values['phoneNumberName'];
    $this->phoneNumber = $values['phoneNumber'];
    $this->accountType = $values['accountType'] ?? null;
    $this->assignedAgentId = $values['assignedAgentId'] ?? null;
    $this->enableMessaging = $values['enableMessaging'] ?? null;
    $this->enableAudioMessageResponse = $values['enableAudioMessageResponse'] ?? null;
    $this->enableTypingIndicator = $values['enableTypingIndicator'] ?? null;
    $this->assignedAgentName = $values['assignedAgentName'];
    $this->isTokenExpired = $values['isTokenExpired'] ?? null;

    $this->_dirtyFields = [
      'business_account_id' => true,
      'phone_number_id' => true,
      'business_account_name' => true,
      'phone_number_name' => true,
      'phone_number' => true,
      'assigned_agent_name' => true
    ];
    if (array_key_exists('accountType', $values)) {
      $this->_dirtyFields['account_type'] = true;
    }
    if (array_key_exists('assignedAgentId', $values)) {
      $this->_dirtyFields['assigned_agent_id'] = true;
    }
    if (array_key_exists('enableMessaging', $values)) {
      $this->_dirtyFields['enable_messaging'] = true;
    }
    if (array_key_exists('enableAudioMessageResponse', $values)) {
      $this->_dirtyFields['enable_audio_message_response'] = true;
    }
    if (array_key_exists('enableTypingIndicator', $values)) {
      $this->_dirtyFields['enable_typing_indicator'] = true;
    }
    if (array_key_exists('isTokenExpired', $values)) {
      $this->_dirtyFields['is_token_expired'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'business_account_id',
      'contents' => $this->businessAccountId
    ];

    $parts[] = [
      'name' => 'phone_number_id',
      'contents' => $this->phoneNumberId
    ];

    $parts[] = [
      'name' => 'business_account_name',
      'contents' => $this->businessAccountName
    ];

    $parts[] = [
      'name' => 'phone_number_name',
      'contents' => $this->phoneNumberName
    ];

    $parts[] = [
      'name' => 'phone_number',
      'contents' => $this->phoneNumber
    ];

    if ($this->accountType !== null) {
      $parts[] = [
        'name' => 'account_type',
        'contents' => $this->accountType
      ];
    }

    if ($this->assignedAgentId !== null) {
      $parts[] = [
        'name' => 'assigned_agent_id',
        'contents' => $this->assignedAgentId
      ];
    }

    if ($this->enableMessaging !== null) {
      $parts[] = [
        'name' => 'enable_messaging',
        'contents' => $this->enableMessaging ? 'true' : 'false'
      ];
    }

    if ($this->enableAudioMessageResponse !== null) {
      $parts[] = [
        'name' => 'enable_audio_message_response',
        'contents' => $this->enableAudioMessageResponse ? 'true' : 'false'
      ];
    }

    if ($this->enableTypingIndicator !== null) {
      $parts[] = [
        'name' => 'enable_typing_indicator',
        'contents' => $this->enableTypingIndicator ? 'true' : 'false'
      ];
    }

    $parts[] = [
      'name' => 'assigned_agent_name',
      'contents' => $this->assignedAgentName
    ];

    if ($this->isTokenExpired !== null) {
      $parts[] = [
        'name' => 'is_token_expired',
        'contents' => $this->isTokenExpired ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
