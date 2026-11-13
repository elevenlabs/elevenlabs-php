<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns\Requests;

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
class SubmitCampaignRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The campaign's name.
   */
  #[JsonProperty('call_name', required: true)]
  public string $callName;

  /**
   * The agent that places the calls.
   */
  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * @var \ElevenLabs\Types\SubmitCampaignRecipient[]
   * Who to call. Each recipient becomes a lead of the campaign.
   */
  #[
    JsonProperty('recipients', required: true),
    ArrayType([\ElevenLabs\Types\SubmitCampaignRecipient::class])
  ]
  public array $recipients;

  /**
   * When to start calling; omit to start now. Calls still wait for the next calling window.
   */
  #[JsonProperty('scheduled_time_unix')]
  public ?int $scheduledTimeUnix;

  /**
   * IANA timezone to read the calling windows in, overriding the policy's.
   */
  #[JsonProperty('timezone')]
  public ?string $timezone;

  /**
   * The agent branch to call with.
   */
  #[JsonProperty('branch_id')]
  public ?string $branchId;

  /**
   * The environment to resolve the agent's environment variables in.
   */
  #[JsonProperty('environment')]
  public ?string $environment;

  /**
   * The most calls to place at once.
   */
  #[JsonProperty('target_concurrency_limit')]
  public ?int $targetConcurrencyLimit;

  /**
   * Makes the request safe to retry: a repeat with the same key returns the campaign it created.
   */
  #[JsonProperty('idempotency_key')]
  public ?string $idempotencyKey;

  /**
   * Policy to snapshot onto the campaign. When set, it wins over the workspace default and any per-agent override; when omitted, the workspace configuration must exist and supplies the policy.
   */
  #[JsonProperty('policy')]
  public ?\ElevenLabs\Types\PolicyConfigInput $policy;

  /**
   * @var ?value-of<\ElevenLabs\Types\CampaignVariant>
   * `simple` runs one attempt per recipient with always-on calling windows and nothing collected, and cannot be combined with `policy`. `advanced` uses `policy` or the workspace configuration, and is the default for phone campaigns.
   */
  #[JsonProperty('variant')]
  public ?string $variant;

  #[JsonProperty('channel_config', required: true)]
  public \ElevenLabs\Agents\OutboundCampaigns\Types\SubmitCampaignRequestChannelConfig $channelConfig;

  /**
   * @param array{
   *   callName: string,
   *   agentId: string,
   *   recipients: \ElevenLabs\Types\SubmitCampaignRecipient[],
   *   channelConfig: \ElevenLabs\Agents\OutboundCampaigns\Types\SubmitCampaignRequestChannelConfig,
   *   scheduledTimeUnix?: ?int,
   *   timezone?: ?string,
   *   branchId?: ?string,
   *   environment?: ?string,
   *   targetConcurrencyLimit?: ?int,
   *   idempotencyKey?: ?string,
   *   policy?: ?\ElevenLabs\Types\PolicyConfigInput,
   *   variant?: ?value-of<\ElevenLabs\Types\CampaignVariant>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->callName = $values['callName'];
    $this->agentId = $values['agentId'];
    $this->recipients = $values['recipients'];
    $this->scheduledTimeUnix = $values['scheduledTimeUnix'] ?? null;
    $this->timezone = $values['timezone'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->environment = $values['environment'] ?? null;
    $this->targetConcurrencyLimit = $values['targetConcurrencyLimit'] ?? null;
    $this->idempotencyKey = $values['idempotencyKey'] ?? null;
    $this->policy = $values['policy'] ?? null;
    $this->variant = $values['variant'] ?? null;
    $this->channelConfig = $values['channelConfig'];

    $this->_dirtyFields = [
      'call_name' => true,
      'agent_id' => true,
      'recipients' => true,
      'channel_config' => true
    ];
    if (array_key_exists('scheduledTimeUnix', $values)) {
      $this->_dirtyFields['scheduled_time_unix'] = true;
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
    if (array_key_exists('targetConcurrencyLimit', $values)) {
      $this->_dirtyFields['target_concurrency_limit'] = true;
    }
    if (array_key_exists('idempotencyKey', $values)) {
      $this->_dirtyFields['idempotency_key'] = true;
    }
    if (array_key_exists('policy', $values)) {
      $this->_dirtyFields['policy'] = true;
    }
    if (array_key_exists('variant', $values)) {
      $this->_dirtyFields['variant'] = true;
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

    if ($this->targetConcurrencyLimit !== null) {
      $parts[] = [
        'name' => 'target_concurrency_limit',
        'contents' => (string) $this->targetConcurrencyLimit
      ];
    }

    if ($this->idempotencyKey !== null) {
      $parts[] = [
        'name' => 'idempotency_key',
        'contents' => $this->idempotencyKey
      ];
    }

    if ($this->policy !== null) {
      $parts[] = [
        'name' => 'policy',
        'contents' => json_encode($this->policy),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->variant !== null) {
      $parts[] = [
        'name' => 'variant',
        'contents' => $this->variant
      ];
    }

    $parts[] = [
      'name' => 'channel_config',
      'contents' => json_encode($this->channelConfig),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->callName, 'call_name', minLength: 1, maxLength: 256);
    Validator::validateString($this->agentId, 'agent_id', minLength: 1, maxLength: 256);
    foreach ($this->recipients as $item) {
      $item->validate();
    }
    Validator::validateArray($this->recipients, 'recipients', minItems: 1, maxItems: 10000);
    Validator::validateNumber($this->scheduledTimeUnix, 'scheduled_time_unix', min: 0);
    Validator::validateString($this->branchId, 'branch_id', maxLength: 256);
    Validator::validateString($this->environment, 'environment', maxLength: 256);
    Validator::validateNumber($this->targetConcurrencyLimit, 'target_concurrency_limit', min: 1);
    Validator::validateString(
      $this->idempotencyKey,
      'idempotency_key',
      minLength: 1,
      maxLength: 256
    );
    $this->policy?->validate();
  }
}
