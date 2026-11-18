<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

use ElevenLabs\AgentWorkflows\Destination;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\PhoneNumberTransferPostDialDigits;
use ElevenLabs\Types\SearchStrategy;
use ElevenLabs\Types\SystemToolConfigInput;
use ElevenLabs\Types\TransferTypeEnum;
use ElevenLabs\Types\UuiTransferConfig;

/**
 * A built-in tool the agent runs itself, such as ending the call or transferring it. Its `name`
 * defaults to its `system_tool_type`, and its description is left out so the API uses its own;
 * set either with `options()`.
 *
 *     use ElevenLabs\AgentTools\SystemTool;
 *     use ElevenLabs\AgentWorkflows\Destination;
 *
 *     $transfer = SystemTool::transferToNumber()
 *         ->transfer('Caller asks for billing', Destination::phone('+15551234567'))
 *         ->transfer('Caller asks for a manager', Destination::sipVariable('manager_sip'), transferType: 'sip_refer');
 *
 * Hand-written (see `.fernignore`), mirroring the tool builder in the Python/TS SDKs.
 */
final class SystemTool extends Tool
{
  private const PHONE_TRANSFER_OPTIONS = [
    'transferType',
    'customSipHeaders',
    'sipReferPlayDialtone',
    'uui',
    'postDialDigits',
  ];
  private const AGENT_TRANSFER_OPTIONS = [
    'delayMs',
    'transferMessage',
    'enableTransferredAgentFirstMessage',
    'preserveClientTtsOverrides',
    'preserveVoiceSettings',
  ];

  /**
   * @internal Use the static constructors or {@see Tool::fromJson()}.
   * @param array<string, mixed> $config
   * @param array<string, mixed> $params The `params` fields other than `system_tool_type`.
   */
  public function __construct(private string $systemToolType, array $config, private array $params)
  {
    parent::__construct($config);
  }

  /** Lets the agent end the call. */
  public static function endCall(): self
  {
    return self::create('end_call', []);
  }

  /**
   * Lets the agent stay quiet when the user asks for a moment. `$waitTimeoutSecs` is how long to
   * wait before the agent checks in; -1 waits for the user.
   */
  public static function skipTurn(?int $waitTimeoutSecs = null): self
  {
    return self::create('skip_turn', ['wait_timeout_secs' => $waitTimeoutSecs]);
  }

  /** Lets the agent switch language. `$onlyAtConversationStart` limits it to the first two user turns. */
  public static function languageDetection(?bool $onlyAtConversationStart = null): self
  {
    return self::create('language_detection', ['only_at_conversation_start' => $onlyAtConversationStart]);
  }

  /**
   * Lets the agent play keypad tones, for phone menus. `$useOutOfBandDtmf` sends them as RTP
   * events instead of in-band audio (SIP trunk numbers only); `$suppressTurnAfterDtmf` keeps the
   * agent quiet afterwards, so speech doesn't confuse an IVR.
   */
  public static function playKeypadTouchTone(?bool $useOutOfBandDtmf = null, ?bool $suppressTurnAfterDtmf = null): self
  {
    return self::create('play_keypad_touch_tone', [
      'use_out_of_band_dtmf' => $useOutOfBandDtmf,
      'suppress_turn_after_dtmf' => $suppressTurnAfterDtmf,
    ]);
  }

  /** Lets the agent detect voicemail and leave `$voicemailMessage`, or hang up if there is none. */
  public static function voicemailDetection(?string $voicemailMessage = null): self
  {
    return self::create('voicemail_detection', ['voicemail_message' => $voicemailMessage]);
  }

  /**
   * Lets the agent search its knowledge base.
   *
   * @param list<SearchStrategy|string>|null $enabledStrategies
   */
  public static function knowledgeBase(?array $enabledStrategies = null): self
  {
    return self::create('knowledge_base', [
      'enabled_strategies' => $enabledStrategies === null ? null : array_values($enabledStrategies),
    ]);
  }

  /**
   * Lets the agent transfer the call to a phone number or SIP URI. Add destinations with
   * `transfer()`. `$enableClientMessage` plays a message to the caller while they wait.
   */
  public static function transferToNumber(?bool $enableClientMessage = null): self
  {
    return self::create('transfer_to_number', ['enable_client_message' => $enableClientMessage, 'transfers' => []]);
  }

  /** Lets the agent hand the conversation to another agent. Add destinations with `transfer()`. */
  public static function transferToAgent(): self
  {
    return self::create('transfer_to_agent', ['transfers' => []]);
  }

  public function kind(): string
  {
    return 'system';
  }

  /** The API's `system_tool_type`, e.g. `"end_call"`. */
  public function systemToolType(): string
  {
    return $this->systemToolType;
  }

  /**
   * Adds a destination to a transfer tool. `$condition` is plain text telling the LLM when to
   * transfer there. `transferToNumber()` takes phone and SIP destinations, with `$transferType`,
   * `$customSipHeaders`, `$sipReferPlayDialtone`, `$uui` and `$postDialDigits`; a SIP URI needs
   * `transferType: 'sip_refer'`. `transferToAgent()` takes agent destinations, with the other
   * options. The option names are the workflow builder's `transfer()` ones.
   *
   * @param list<mixed>|null $customSipHeaders
   * @param UuiTransferConfig|array<string, mixed>|null $uui
   * @param PhoneNumberTransferPostDialDigits|array<string, mixed>|null $postDialDigits
   */
  public function transfer(
    string $condition,
    Destination $destination,
    TransferTypeEnum|string|null $transferType = null,
    ?array $customSipHeaders = null,
    ?bool $sipReferPlayDialtone = null,
    UuiTransferConfig|array|null $uui = null,
    PhoneNumberTransferPostDialDigits|array|null $postDialDigits = null,
    ?int $delayMs = null,
    ?string $transferMessage = null,
    ?bool $enableTransferredAgentFirstMessage = null,
    ?bool $preserveClientTtsOverrides = null,
    ?bool $preserveVoiceSettings = null,
  ): self {
    $given = [
      'transferType' => $transferType,
      'customSipHeaders' => $customSipHeaders,
      'sipReferPlayDialtone' => $sipReferPlayDialtone,
      'uui' => $uui,
      'postDialDigits' => $postDialDigits,
      'delayMs' => $delayMs,
      'transferMessage' => $transferMessage,
      'enableTransferredAgentFirstMessage' => $enableTransferredAgentFirstMessage,
      'preserveClientTtsOverrides' => $preserveClientTtsOverrides,
      'preserveVoiceSettings' => $preserveVoiceSettings,
    ];
    $options = array_filter($given, static fn(mixed $value): bool => $value !== null);
    $toNumber = $this->systemToolType === 'transfer_to_number';
    if (!$toNumber && $this->systemToolType !== 'transfer_to_agent') {
      $this->issues[] = ToolIssue::error(
        'invalid_option',
        'transfer',
        "transfer() only applies to transfer tools, not {$this->systemToolType}"
      );
      return $this;
    }
    $model = $destination->toWire();
    if ((($model['type'] ?? null) === 'phone_number') !== $toNumber) {
      $this->issues[] = ToolIssue::error(
        'invalid_destination',
        'transfer',
        $toNumber
          ? "transferToNumber() needs a phone or SIP destination, not an agent (\"{$condition}\")"
          : "transferToAgent() needs an agent destination (\"{$condition}\")"
      );
      return $this;
    }
    $allowed = $toNumber ? self::PHONE_TRANSFER_OPTIONS : self::AGENT_TRANSFER_OPTIONS;
    $settings = [];
    foreach ($options as $key => $value) {
      if (!in_array($key, $allowed, true)) {
        $this->issues[] = ToolIssue::error('invalid_option', $key, "Option \"{$key}\" doesn't apply to {$this->systemToolType}");
        continue;
      }
      $settings[self::snake($key)] = Wire::toWire($value);
    }
    unset($model['type']);
    // A SIP URI held in a dynamic variable resolves to a SIP URI too, so it also needs SIP REFER.
    $target = is_array($model['transfer_destination'] ?? null) ? $model['transfer_destination'] : [];
    $destinationType = $target['type'] ?? null;
    if (
      ($destinationType === 'sip_uri' || $destinationType === 'sip_uri_dynamic_variable')
      && ($settings['transfer_type'] ?? null) !== 'sip_refer'
    ) {
      $this->issues[] = ToolIssue::error(
        'invalid_destination',
        'transfer',
        "A SIP URI destination needs transferType: \"sip_refer\" (\"{$condition}\")"
      );
      return $this;
    }
    $transfers = is_array($this->params['transfers'] ?? null) ? $this->params['transfers'] : [];
    $transfers[] = array_merge($model, $settings, ['condition' => $condition]);
    $this->params['transfers'] = array_values($transfers);
    return $this;
  }

  /**
   * Validates the tool and returns its entry for the agent's `prompt.builtInTools`, for example
   * `new BuiltInToolsInput(['endCall' => SystemTool::endCall()->buildConfig()])`.
   *
   * @param null|callable(ToolIssue): mixed $onWarning
   * @throws ToolValidationError
   */
  public function buildConfig(?callable $onWarning = null): SystemToolConfigInput
  {
    /** @var SystemToolConfigInput */
    return parent::buildConfig($onWarning);
  }

  protected function configModel(array $wire): JsonSerializableType
  {
    return SystemToolConfigInput::fromJson((string) json_encode($wire));
  }

  protected function allowedOptions(): array
  {
    return self::COMMON_OPTIONS;
  }

  protected function validate(): array
  {
    $transfers = $this->params['transfers'] ?? null;
    $isTransfer = $this->systemToolType === 'transfer_to_number' || $this->systemToolType === 'transfer_to_agent';
    if ($isTransfer && (!is_array($transfers) || $transfers === [])) {
      return [ToolIssue::error('no_transfers', 'transfer', "{$this->systemToolType} needs at least one transfer()")];
    }
    return [];
  }

  protected function toWire(): array
  {
    $wire = $this->config;
    $wire['type'] = 'system';
    $wire['params'] = array_merge(['system_tool_type' => $this->systemToolType], $this->params);
    return $wire;
  }

  /**
   * @param array<string, mixed> $params
   */
  private static function create(string $systemToolType, array $params): self
  {
    $set = [];
    foreach ($params as $key => $value) {
      if ($value !== null) {
        $set[$key] = Wire::toWire($value);
      }
    }
    return new self($systemToolType, ['name' => $systemToolType], $set);
  }
}
