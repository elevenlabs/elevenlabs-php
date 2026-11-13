<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Detailed response model for a batch call including all recipients.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BatchCallDetailedResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('phone_number_id', required: true)]
  public ?string $phoneNumberId;

  /**
   * @var ?value-of<\ElevenLabs\Types\TelephonyProvider>
   */
  #[JsonProperty('phone_provider', required: true)]
  public ?string $phoneProvider;

  #[JsonProperty('whatsapp_params', required: true)]
  public ?\ElevenLabs\Types\BatchCallWhatsAppParams $whatsappParams;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('branch_id', required: true)]
  public ?string $branchId;

  #[JsonProperty('environment', required: true)]
  public ?string $environment;

  #[JsonProperty('created_at_unix', required: true)]
  public int $createdAtUnix;

  #[JsonProperty('scheduled_time_unix', required: true)]
  public int $scheduledTimeUnix;

  #[JsonProperty('timezone', required: true)]
  public ?string $timezone;

  #[JsonProperty('total_calls_dispatched', required: true)]
  public int $totalCallsDispatched;

  #[JsonProperty('total_calls_scheduled', required: true)]
  public int $totalCallsScheduled;

  #[JsonProperty('total_calls_finished', required: true)]
  public int $totalCallsFinished;

  #[JsonProperty('last_updated_at_unix', required: true)]
  public int $lastUpdatedAtUnix;

  /**
   * @var value-of<\ElevenLabs\Types\BatchCallStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  #[JsonProperty('retry_count', required: true)]
  public int $retryCount;

  #[JsonProperty('telephony_call_config', required: true)]
  public \ElevenLabs\Types\TelephonyCallConfigOutput $telephonyCallConfig;

  /**
   * Maximum number of simultaneous calls for this batch. When set, dispatch is governed by this limit rather than workspace/agent capacity percentages.
   */
  #[JsonProperty('target_concurrency_limit', required: true)]
  public ?int $targetConcurrencyLimit;

  #[JsonProperty('agent_name', required: true)]
  public string $agentName;

  #[JsonProperty('branch_name', required: true)]
  public ?string $branchName;

  /**
   * @var \ElevenLabs\Types\OutboundCallRecipientResponseModel[]
   */
  #[
    JsonProperty('recipients', required: true),
    ArrayType([\ElevenLabs\Types\OutboundCallRecipientResponseModel::class])
  ]
  public array $recipients;

  /**
   * @param array{
   *   id: string,
   *   phoneNumberId: ?string,
   *   phoneProvider: ?value-of<\ElevenLabs\Types\TelephonyProvider>,
   *   whatsappParams: ?\ElevenLabs\Types\BatchCallWhatsAppParams,
   *   name: string,
   *   agentId: string,
   *   branchId: ?string,
   *   environment: ?string,
   *   createdAtUnix: int,
   *   scheduledTimeUnix: int,
   *   timezone: ?string,
   *   totalCallsDispatched: int,
   *   totalCallsScheduled: int,
   *   totalCallsFinished: int,
   *   lastUpdatedAtUnix: int,
   *   status: value-of<\ElevenLabs\Types\BatchCallStatus>,
   *   retryCount: int,
   *   telephonyCallConfig: \ElevenLabs\Types\TelephonyCallConfigOutput,
   *   targetConcurrencyLimit: ?int,
   *   agentName: string,
   *   branchName: ?string,
   *   recipients: \ElevenLabs\Types\OutboundCallRecipientResponseModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->phoneNumberId = $values['phoneNumberId'];
    $this->phoneProvider = $values['phoneProvider'];
    $this->whatsappParams = $values['whatsappParams'];
    $this->name = $values['name'];
    $this->agentId = $values['agentId'];
    $this->branchId = $values['branchId'];
    $this->environment = $values['environment'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->scheduledTimeUnix = $values['scheduledTimeUnix'];
    $this->timezone = $values['timezone'];
    $this->totalCallsDispatched = $values['totalCallsDispatched'];
    $this->totalCallsScheduled = $values['totalCallsScheduled'];
    $this->totalCallsFinished = $values['totalCallsFinished'];
    $this->lastUpdatedAtUnix = $values['lastUpdatedAtUnix'];
    $this->status = $values['status'];
    $this->retryCount = $values['retryCount'];
    $this->telephonyCallConfig = $values['telephonyCallConfig'];
    $this->targetConcurrencyLimit = $values['targetConcurrencyLimit'];
    $this->agentName = $values['agentName'];
    $this->branchName = $values['branchName'];
    $this->recipients = $values['recipients'];

    $this->_dirtyFields = [
      'id' => true,
      'phone_number_id' => true,
      'phone_provider' => true,
      'whatsapp_params' => true,
      'name' => true,
      'agent_id' => true,
      'branch_id' => true,
      'environment' => true,
      'created_at_unix' => true,
      'scheduled_time_unix' => true,
      'timezone' => true,
      'total_calls_dispatched' => true,
      'total_calls_scheduled' => true,
      'total_calls_finished' => true,
      'last_updated_at_unix' => true,
      'status' => true,
      'retry_count' => true,
      'telephony_call_config' => true,
      'target_concurrency_limit' => true,
      'agent_name' => true,
      'branch_name' => true,
      'recipients' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'phone_number_id',
      'contents' => $this->phoneNumberId
    ];

    $parts[] = [
      'name' => 'phone_provider',
      'contents' => $this->phoneProvider
    ];

    $parts[] = [
      'name' => 'whatsapp_params',
      'contents' => json_encode($this->whatsappParams),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'branch_id',
      'contents' => $this->branchId
    ];

    $parts[] = [
      'name' => 'environment',
      'contents' => $this->environment
    ];

    $parts[] = [
      'name' => 'created_at_unix',
      'contents' => (string) $this->createdAtUnix
    ];

    $parts[] = [
      'name' => 'scheduled_time_unix',
      'contents' => (string) $this->scheduledTimeUnix
    ];

    $parts[] = [
      'name' => 'timezone',
      'contents' => $this->timezone
    ];

    $parts[] = [
      'name' => 'total_calls_dispatched',
      'contents' => (string) $this->totalCallsDispatched
    ];

    $parts[] = [
      'name' => 'total_calls_scheduled',
      'contents' => (string) $this->totalCallsScheduled
    ];

    $parts[] = [
      'name' => 'total_calls_finished',
      'contents' => (string) $this->totalCallsFinished
    ];

    $parts[] = [
      'name' => 'last_updated_at_unix',
      'contents' => (string) $this->lastUpdatedAtUnix
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'retry_count',
      'contents' => (string) $this->retryCount
    ];

    $parts[] = [
      'name' => 'telephony_call_config',
      'contents' => json_encode($this->telephonyCallConfig),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'target_concurrency_limit',
      'contents' => (string) $this->targetConcurrencyLimit
    ];

    $parts[] = [
      'name' => 'agent_name',
      'contents' => $this->agentName
    ];

    $parts[] = [
      'name' => 'branch_name',
      'contents' => $this->branchName
    ];

    $parts[] = [
      'name' => 'recipients',
      'contents' => json_encode($this->recipients),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->whatsappParams?->validate();
    $this->telephonyCallConfig->validate();
    Validator::validateNumber($this->targetConcurrencyLimit, 'target_concurrency_limit', min: 1);
    foreach ($this->recipients as $item) {
      $item->validate();
    }
  }
}
