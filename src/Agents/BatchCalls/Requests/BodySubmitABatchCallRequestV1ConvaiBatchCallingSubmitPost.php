<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\BatchCalls\Requests;

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
class BodySubmitABatchCallRequestV1ConvaiBatchCallingSubmitPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('call_name', required: true)]
  public string $callName;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * @var \ElevenLabs\Types\OutboundCallRecipient[]
   */
  #[
    JsonProperty('recipients', required: true),
    ArrayType([\ElevenLabs\Types\OutboundCallRecipient::class])
  ]
  public array $recipients;

  #[JsonProperty('scheduled_time_unix')]
  public ?int $scheduledTimeUnix;

  #[JsonProperty('agent_phone_number_id')]
  public ?string $agentPhoneNumberId;

  #[JsonProperty('whatsapp_params')]
  public ?\ElevenLabs\Types\BatchCallWhatsAppParams $whatsappParams;

  #[JsonProperty('timezone')]
  public ?string $timezone;

  #[JsonProperty('branch_id')]
  public ?string $branchId;

  #[JsonProperty('environment')]
  public ?string $environment;

  #[JsonProperty('telephony_call_config')]
  public ?\ElevenLabs\Types\TelephonyCallConfigInput $telephonyCallConfig;

  /**
   * Maximum number of simultaneous calls for this batch. When set, dispatch is governed by this limit rather than workspace/agent capacity percentages.
   */
  #[JsonProperty('target_concurrency_limit')]
  public ?int $targetConcurrencyLimit;

  /**
   * @param array{
   *   callName: string,
   *   agentId: string,
   *   recipients: \ElevenLabs\Types\OutboundCallRecipient[],
   *   scheduledTimeUnix?: ?int,
   *   agentPhoneNumberId?: ?string,
   *   whatsappParams?: ?\ElevenLabs\Types\BatchCallWhatsAppParams,
   *   timezone?: ?string,
   *   branchId?: ?string,
   *   environment?: ?string,
   *   telephonyCallConfig?: ?\ElevenLabs\Types\TelephonyCallConfigInput,
   *   targetConcurrencyLimit?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->callName = $values['callName'];
    $this->agentId = $values['agentId'];
    $this->recipients = $values['recipients'];
    $this->scheduledTimeUnix = $values['scheduledTimeUnix'] ?? null;
    $this->agentPhoneNumberId = $values['agentPhoneNumberId'] ?? null;
    $this->whatsappParams = $values['whatsappParams'] ?? null;
    $this->timezone = $values['timezone'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->environment = $values['environment'] ?? null;
    $this->telephonyCallConfig = $values['telephonyCallConfig'] ?? null;
    $this->targetConcurrencyLimit = $values['targetConcurrencyLimit'] ?? null;

    $this->_dirtyFields = [
      'call_name' => true,
      'agent_id' => true,
      'recipients' => true
    ];
    if (array_key_exists('scheduledTimeUnix', $values)) {
      $this->_dirtyFields['scheduled_time_unix'] = true;
    }
    if (array_key_exists('agentPhoneNumberId', $values)) {
      $this->_dirtyFields['agent_phone_number_id'] = true;
    }
    if (array_key_exists('whatsappParams', $values)) {
      $this->_dirtyFields['whatsapp_params'] = true;
    }
    if (array_key_exists('timezone', $values)) {
      $this->_dirtyFields['timezone'] = true;
    }
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
    if (array_key_exists('environment', $values)) {
      $this->_dirtyFields['environment'] = true;
    }
    if (array_key_exists('telephonyCallConfig', $values)) {
      $this->_dirtyFields['telephony_call_config'] = true;
    }
    if (array_key_exists('targetConcurrencyLimit', $values)) {
      $this->_dirtyFields['target_concurrency_limit'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'call_name',
      'contents' => $this->callName
    ];

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'recipients',
      'contents' => json_encode($this->recipients),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->scheduledTimeUnix !== null) {
      $parts[] = [
        'name' => 'scheduled_time_unix',
        'contents' => (string) $this->scheduledTimeUnix
      ];
    }

    if ($this->agentPhoneNumberId !== null) {
      $parts[] = [
        'name' => 'agent_phone_number_id',
        'contents' => $this->agentPhoneNumberId
      ];
    }

    if ($this->whatsappParams !== null) {
      $parts[] = [
        'name' => 'whatsapp_params',
        'contents' => json_encode($this->whatsappParams),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->timezone !== null) {
      $parts[] = [
        'name' => 'timezone',
        'contents' => $this->timezone
      ];
    }

    if ($this->branchId !== null) {
      $parts[] = [
        'name' => 'branch_id',
        'contents' => $this->branchId
      ];
    }

    if ($this->environment !== null) {
      $parts[] = [
        'name' => 'environment',
        'contents' => $this->environment
      ];
    }

    if ($this->telephonyCallConfig !== null) {
      $parts[] = [
        'name' => 'telephony_call_config',
        'contents' => json_encode($this->telephonyCallConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->targetConcurrencyLimit !== null) {
      $parts[] = [
        'name' => 'target_concurrency_limit',
        'contents' => (string) $this->targetConcurrencyLimit
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->recipients as $item) {
      $item->validate();
    }
    Validator::validateArray($this->recipients, 'recipients', maxItems: 10000);
    $this->whatsappParams?->validate();
    $this->telephonyCallConfig?->validate();
    Validator::validateNumber($this->targetConcurrencyLimit, 'target_concurrency_limit', min: 1);
  }
}
