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
class CampaignResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('campaign_id', required: true)]
  public string $campaignId;

  /**
   * The campaign's name.
   */
  #[JsonProperty('call_name', required: true)]
  public string $callName;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('channel_config', required: true)]
  public \ElevenLabs\Types\CampaignResponseChannelConfig $channelConfig;

  /**
   * @var value-of<\ElevenLabs\Types\CampaignStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * The policy the campaign took when it was created, laid out like a submitted `policy`.
   */
  #[JsonProperty('policy', required: true)]
  public \ElevenLabs\Types\CampaignPolicySnapshot $policy;

  /**
   * @var value-of<\ElevenLabs\Types\CampaignVariant>
   */
  #[JsonProperty('variant', required: true)]
  public string $variant;

  /**
   * @var ?value-of<\ElevenLabs\Types\CampaignSource>
   * Whether the campaign was created in the app or through the API.
   */
  #[JsonProperty('source', required: true)]
  public ?string $source;

  #[JsonProperty('created_at_unix', required: true)]
  public int $createdAtUnix;

  /**
   * When the campaign starts calling; unset to start once created.
   */
  #[JsonProperty('scheduled_time_unix', required: true)]
  public ?int $scheduledTimeUnix;

  #[JsonProperty('updated_at_unix', required: true)]
  public int $updatedAtUnix;

  /**
   * The agent branch the campaign calls with.
   */
  #[JsonProperty('branch_id', required: true)]
  public ?string $branchId;

  /**
   * The environment the agent's environment variables resolve in.
   */
  #[JsonProperty('environment', required: true)]
  public ?string $environment;

  /**
   * The most calls the campaign places at once.
   */
  #[JsonProperty('target_concurrency_limit', required: true)]
  public ?int $targetConcurrencyLimit;

  /**
   * @var value-of<\ElevenLabs\Types\OutboundChannel>
   */
  #[JsonProperty('channel', required: true)]
  public string $channel;

  /**
   * @var value-of<\ElevenLabs\Types\OutboundMode>
   */
  #[JsonProperty('mode', required: true)]
  public string $mode;

  #[JsonProperty('counts', required: true)]
  public \ElevenLabs\Types\CampaignSummaryCounts $counts;

  #[JsonProperty('agent_name', required: true)]
  public string $agentName;

  /**
   * @param array{
   *   campaignId: string,
   *   callName: string,
   *   agentId: string,
   *   channelConfig: \ElevenLabs\Types\CampaignResponseChannelConfig,
   *   status: value-of<\ElevenLabs\Types\CampaignStatus>,
   *   policy: \ElevenLabs\Types\CampaignPolicySnapshot,
   *   variant: value-of<\ElevenLabs\Types\CampaignVariant>,
   *   source: ?value-of<\ElevenLabs\Types\CampaignSource>,
   *   createdAtUnix: int,
   *   scheduledTimeUnix: ?int,
   *   updatedAtUnix: int,
   *   branchId: ?string,
   *   environment: ?string,
   *   targetConcurrencyLimit: ?int,
   *   channel: value-of<\ElevenLabs\Types\OutboundChannel>,
   *   mode: value-of<\ElevenLabs\Types\OutboundMode>,
   *   counts: \ElevenLabs\Types\CampaignSummaryCounts,
   *   agentName: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->campaignId = $values['campaignId'];
    $this->callName = $values['callName'];
    $this->agentId = $values['agentId'];
    $this->channelConfig = $values['channelConfig'];
    $this->status = $values['status'];
    $this->policy = $values['policy'];
    $this->variant = $values['variant'];
    $this->source = $values['source'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->scheduledTimeUnix = $values['scheduledTimeUnix'];
    $this->updatedAtUnix = $values['updatedAtUnix'];
    $this->branchId = $values['branchId'];
    $this->environment = $values['environment'];
    $this->targetConcurrencyLimit = $values['targetConcurrencyLimit'];
    $this->channel = $values['channel'];
    $this->mode = $values['mode'];
    $this->counts = $values['counts'];
    $this->agentName = $values['agentName'];

    $this->_dirtyFields = [
      'campaign_id' => true,
      'call_name' => true,
      'agent_id' => true,
      'channel_config' => true,
      'status' => true,
      'policy' => true,
      'variant' => true,
      'source' => true,
      'created_at_unix' => true,
      'scheduled_time_unix' => true,
      'updated_at_unix' => true,
      'branch_id' => true,
      'environment' => true,
      'target_concurrency_limit' => true,
      'channel' => true,
      'mode' => true,
      'counts' => true,
      'agent_name' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'campaign_id',
      'contents' => $this->campaignId
    ];

    $parts[] = [
      'name' => 'call_name',
      'contents' => $this->callName
    ];

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'channel_config',
      'contents' => json_encode($this->channelConfig),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'policy',
      'contents' => json_encode($this->policy),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'variant',
      'contents' => $this->variant
    ];

    $parts[] = [
      'name' => 'source',
      'contents' => $this->source
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
      'name' => 'updated_at_unix',
      'contents' => (string) $this->updatedAtUnix
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
      'name' => 'target_concurrency_limit',
      'contents' => (string) $this->targetConcurrencyLimit
    ];

    $parts[] = [
      'name' => 'channel',
      'contents' => $this->channel
    ];

    $parts[] = [
      'name' => 'mode',
      'contents' => $this->mode
    ];

    $parts[] = [
      'name' => 'counts',
      'contents' => json_encode($this->counts),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'agent_name',
      'contents' => $this->agentName
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->policy->validate();
    $this->counts->validate();
  }
}
