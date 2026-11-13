<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\PhoneNumbers\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UpdatePhoneNumberRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_id')]
  public ?string $agentId;

  #[JsonProperty('label')]
  public ?string $label;

  #[JsonProperty('inbound_trunk_config')]
  public ?\ElevenLabs\Types\InboundSipTrunkConfigRequestModel $inboundTrunkConfig;

  #[JsonProperty('outbound_trunk_config')]
  public ?\ElevenLabs\Types\OutboundSipTrunkConfigRequestModel $outboundTrunkConfig;

  /**
   * @var ?value-of<\ElevenLabs\Types\LivekitStackType>
   */
  #[JsonProperty('livekit_stack')]
  public ?string $livekitStack;

  #[JsonProperty('store_sip_messages')]
  public ?bool $storeSipMessages;

  /**
   * Environment to use for resolving environment variables on calls to this number.
   */
  #[JsonProperty('environment')]
  public ?string $environment;

  /**
   * Agent branch to use for calls to this number.
   */
  #[JsonProperty('branch_id')]
  public ?string $branchId;

  /**
   * @param array{
   *   agentId?: ?string,
   *   label?: ?string,
   *   inboundTrunkConfig?: ?\ElevenLabs\Types\InboundSipTrunkConfigRequestModel,
   *   outboundTrunkConfig?: ?\ElevenLabs\Types\OutboundSipTrunkConfigRequestModel,
   *   livekitStack?: ?value-of<\ElevenLabs\Types\LivekitStackType>,
   *   storeSipMessages?: ?bool,
   *   environment?: ?string,
   *   branchId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->agentId = $values['agentId'] ?? null;
    $this->label = $values['label'] ?? null;
    $this->inboundTrunkConfig = $values['inboundTrunkConfig'] ?? null;
    $this->outboundTrunkConfig = $values['outboundTrunkConfig'] ?? null;
    $this->livekitStack = $values['livekitStack'] ?? null;
    $this->storeSipMessages = $values['storeSipMessages'] ?? null;
    $this->environment = $values['environment'] ?? null;
    $this->branchId = $values['branchId'] ?? null;

    if (array_key_exists('agentId', $values)) {
      $this->_dirtyFields['agent_id'] = true;
    }
    if (array_key_exists('label', $values)) {
      $this->_dirtyFields['label'] = true;
    }
    if (array_key_exists('inboundTrunkConfig', $values)) {
      $this->_dirtyFields['inbound_trunk_config'] = true;
    }
    if (array_key_exists('outboundTrunkConfig', $values)) {
      $this->_dirtyFields['outbound_trunk_config'] = true;
    }
    if (array_key_exists('livekitStack', $values)) {
      $this->_dirtyFields['livekit_stack'] = true;
    }
    if (array_key_exists('storeSipMessages', $values)) {
      $this->_dirtyFields['store_sip_messages'] = true;
    }
    if (array_key_exists('environment', $values)) {
      $this->_dirtyFields['environment'] = true;
    }
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->agentId !== null) {
      $parts[] = [
        'name' => 'agent_id',
        'contents' => $this->agentId
      ];
    }

    if ($this->label !== null) {
      $parts[] = [
        'name' => 'label',
        'contents' => $this->label
      ];
    }

    if ($this->inboundTrunkConfig !== null) {
      $parts[] = [
        'name' => 'inbound_trunk_config',
        'contents' => json_encode($this->inboundTrunkConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->outboundTrunkConfig !== null) {
      $parts[] = [
        'name' => 'outbound_trunk_config',
        'contents' => json_encode($this->outboundTrunkConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->livekitStack !== null) {
      $parts[] = [
        'name' => 'livekit_stack',
        'contents' => $this->livekitStack
      ];
    }

    if ($this->storeSipMessages !== null) {
      $parts[] = [
        'name' => 'store_sip_messages',
        'contents' => $this->storeSipMessages ? 'true' : 'false'
      ];
    }

    if ($this->environment !== null) {
      $parts[] = [
        'name' => 'environment',
        'contents' => $this->environment
      ];
    }

    if ($this->branchId !== null) {
      $parts[] = [
        'name' => 'branch_id',
        'contents' => $this->branchId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->inboundTrunkConfig?->validate();
    $this->outboundTrunkConfig?->validate();
  }
}
