<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

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
class ReceptionCustomerFacingConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('additional_instructions')]
  public ?string $additionalInstructions;

  /**
   * @var string[]|null
   * Personality traits for the receptionist, e.g. `['professional', 'concise']`.
   */
  #[JsonProperty('tone_traits'), ArrayType(['string'])]
  public ?array $toneTraits;

  /**
   * @var string[]|null
   * Details the agent should always try to collect from callers (presets + custom labels, e.g. ['full name', 'phone number']).
   */
  #[JsonProperty('details_to_collect'), ArrayType(['string'])]
  public ?array $detailsToCollect;

  /**
   * @var ?value-of<\ElevenLabs\Types\Llm>
   * Model the receptionist runs on. Null uses the default.
   */
  #[JsonProperty('llm')]
  public ?string $llm;

  /**
   * @var ?value-of<\ElevenLabs\Types\LlmReasoningEffort>
   * Reasoning effort for the receptionist's model, up to `medium` and only among the efforts the model supports. Null uses the model's default.
   */
  #[JsonProperty('reasoning_effort')]
  public ?string $reasoningEffort;

  /**
   * When true, the whole knowledge base is given to the receptionist up front instead of searched on each turn. Faster, but only for small knowledge bases; larger ones are still searched.
   */
  #[JsonProperty('disable_rag')]
  public ?bool $disableRag;

  /**
   * Filter out far-field human speech before transcription.
   */
  #[JsonProperty('background_voice_detection')]
  public ?bool $backgroundVoiceDetection;

  /**
   * @var ?value-of<\ElevenLabs\Types\ReceptionTurnEagerness>
   * How quickly the receptionist decides the caller has finished speaking.
   */
  #[JsonProperty('turn_eagerness')]
  public ?string $turnEagerness;

  /**
   * ElevenLabs voice ID
   */
  #[JsonProperty('voice_id')]
  public ?string $voiceId;

  #[JsonProperty('language')]
  public ?string $language;

  /**
   * @var string[]|null
   * Additional language codes the agent can communicate in
   */
  #[JsonProperty('additional_languages'), ArrayType(['string'])]
  public ?array $additionalLanguages;

  /**
   * The first message the agent says when starting a conversation
   */
  #[JsonProperty('first_message')]
  public ?string $firstMessage;

  /**
   * @var ?value-of<\ElevenLabs\Types\FirstMessageMode>
   * How the receptionist's greeting plays.
   */
  #[JsonProperty('first_message_mode')]
  public ?string $firstMessageMode;

  /**
   * Allow the end_call system tool during conversations.
   */
  #[JsonProperty('enable_end_call_tool')]
  public ?bool $enableEndCallTool;

  /**
   * Allow the skip_turn system tool during conversations.
   */
  #[JsonProperty('enable_skip_turn_tool')]
  public ?bool $enableSkipTurnTool;

  /**
   * Allow the play_keypad_touch_tone (DTMF) system tool during conversations. When enabled, the receptionist can play touch-tone digits on a live call to navigate automated phone menus or answer carrier prompts such as a 'press 1 to accept' call-screening step.
   */
  #[JsonProperty('enable_play_keypad_touch_tone_tool')]
  public ?bool $enablePlayKeypadTouchToneTool;

  /**
   * @var \ElevenLabs\Types\AgentRule[]|null
   * Behavioral rules this agent must follow.
   */
  #[JsonProperty('agent_rules'), ArrayType([\ElevenLabs\Types\AgentRule::class])]
  public ?array $agentRules;

  /**
   * @var \ElevenLabs\Types\ReceptionTransferRule[]|null
   * Phone numbers this agent can transfer calls to.
   */
  #[JsonProperty('transfer_rules'), ArrayType([\ElevenLabs\Types\ReceptionTransferRule::class])]
  public ?array $transferRules;

  /**
   * Show the business's own number, rather than the caller's, as the caller ID on transferred calls.
   */
  #[JsonProperty('hide_caller_number_on_transfers')]
  public ?bool $hideCallerNumberOnTransfers;

  /**
   * Keep recording after a call is transferred and add that audio to the call recording.
   */
  #[JsonProperty('record_after_transfers')]
  public ?bool $recordAfterTransfers;

  /**
   * @var \ElevenLabs\Types\ReceptionProcedure[]|null
   * Standard operating procedures (SOPs) this agent can run on calls.
   */
  #[JsonProperty('procedures'), ArrayType([\ElevenLabs\Types\ReceptionProcedure::class])]
  public ?array $procedures;

  /**
   * When enabled, the receptionist may only look up or modify appointments and client records tied to the caller's verified phone number.
   */
  #[JsonProperty('enable_secure_mode')]
  public ?bool $enableSecureMode;

  /**
   * When enabled, inbound calls to US numbers are screened before the receptionist answers: calls whose caller ID failed carrier (STIR/SHAKEN) verification are rejected, and unknown callers whose caller ID the carrier could not vouch for must press a key to be connected.
   */
  #[JsonProperty('enable_spam_protection')]
  public ?bool $enableSpamProtection;

  /**
   * @param array{
   *   additionalInstructions?: ?string,
   *   toneTraits?: string[]|null,
   *   detailsToCollect?: string[]|null,
   *   llm?: ?value-of<\ElevenLabs\Types\Llm>,
   *   reasoningEffort?: ?value-of<\ElevenLabs\Types\LlmReasoningEffort>,
   *   disableRag?: ?bool,
   *   backgroundVoiceDetection?: ?bool,
   *   turnEagerness?: ?value-of<\ElevenLabs\Types\ReceptionTurnEagerness>,
   *   voiceId?: ?string,
   *   language?: ?string,
   *   additionalLanguages?: string[]|null,
   *   firstMessage?: ?string,
   *   firstMessageMode?: ?value-of<\ElevenLabs\Types\FirstMessageMode>,
   *   enableEndCallTool?: ?bool,
   *   enableSkipTurnTool?: ?bool,
   *   enablePlayKeypadTouchToneTool?: ?bool,
   *   agentRules?: \ElevenLabs\Types\AgentRule[]|null,
   *   transferRules?: \ElevenLabs\Types\ReceptionTransferRule[]|null,
   *   hideCallerNumberOnTransfers?: ?bool,
   *   recordAfterTransfers?: ?bool,
   *   procedures?: \ElevenLabs\Types\ReceptionProcedure[]|null,
   *   enableSecureMode?: ?bool,
   *   enableSpamProtection?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->additionalInstructions = $values['additionalInstructions'] ?? null;
    $this->toneTraits = $values['toneTraits'] ?? null;
    $this->detailsToCollect = $values['detailsToCollect'] ?? null;
    $this->llm = $values['llm'] ?? null;
    $this->reasoningEffort = $values['reasoningEffort'] ?? null;
    $this->disableRag = $values['disableRag'] ?? null;
    $this->backgroundVoiceDetection = $values['backgroundVoiceDetection'] ?? null;
    $this->turnEagerness = $values['turnEagerness'] ?? null;
    $this->voiceId = $values['voiceId'] ?? null;
    $this->language = $values['language'] ?? null;
    $this->additionalLanguages = $values['additionalLanguages'] ?? null;
    $this->firstMessage = $values['firstMessage'] ?? null;
    $this->firstMessageMode = $values['firstMessageMode'] ?? null;
    $this->enableEndCallTool = $values['enableEndCallTool'] ?? null;
    $this->enableSkipTurnTool = $values['enableSkipTurnTool'] ?? null;
    $this->enablePlayKeypadTouchToneTool = $values['enablePlayKeypadTouchToneTool'] ?? null;
    $this->agentRules = $values['agentRules'] ?? null;
    $this->transferRules = $values['transferRules'] ?? null;
    $this->hideCallerNumberOnTransfers = $values['hideCallerNumberOnTransfers'] ?? null;
    $this->recordAfterTransfers = $values['recordAfterTransfers'] ?? null;
    $this->procedures = $values['procedures'] ?? null;
    $this->enableSecureMode = $values['enableSecureMode'] ?? null;
    $this->enableSpamProtection = $values['enableSpamProtection'] ?? null;

    if (array_key_exists('additionalInstructions', $values)) {
      $this->_dirtyFields['additional_instructions'] = true;
    }
    if (array_key_exists('toneTraits', $values)) {
      $this->_dirtyFields['tone_traits'] = true;
    }
    if (array_key_exists('detailsToCollect', $values)) {
      $this->_dirtyFields['details_to_collect'] = true;
    }
    if (array_key_exists('llm', $values)) {
      $this->_dirtyFields['llm'] = true;
    }
    if (array_key_exists('reasoningEffort', $values)) {
      $this->_dirtyFields['reasoning_effort'] = true;
    }
    if (array_key_exists('disableRag', $values)) {
      $this->_dirtyFields['disable_rag'] = true;
    }
    if (array_key_exists('backgroundVoiceDetection', $values)) {
      $this->_dirtyFields['background_voice_detection'] = true;
    }
    if (array_key_exists('turnEagerness', $values)) {
      $this->_dirtyFields['turn_eagerness'] = true;
    }
    if (array_key_exists('voiceId', $values)) {
      $this->_dirtyFields['voice_id'] = true;
    }
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
    if (array_key_exists('additionalLanguages', $values)) {
      $this->_dirtyFields['additional_languages'] = true;
    }
    if (array_key_exists('firstMessage', $values)) {
      $this->_dirtyFields['first_message'] = true;
    }
    if (array_key_exists('firstMessageMode', $values)) {
      $this->_dirtyFields['first_message_mode'] = true;
    }
    if (array_key_exists('enableEndCallTool', $values)) {
      $this->_dirtyFields['enable_end_call_tool'] = true;
    }
    if (array_key_exists('enableSkipTurnTool', $values)) {
      $this->_dirtyFields['enable_skip_turn_tool'] = true;
    }
    if (array_key_exists('enablePlayKeypadTouchToneTool', $values)) {
      $this->_dirtyFields['enable_play_keypad_touch_tone_tool'] = true;
    }
    if (array_key_exists('agentRules', $values)) {
      $this->_dirtyFields['agent_rules'] = true;
    }
    if (array_key_exists('transferRules', $values)) {
      $this->_dirtyFields['transfer_rules'] = true;
    }
    if (array_key_exists('hideCallerNumberOnTransfers', $values)) {
      $this->_dirtyFields['hide_caller_number_on_transfers'] = true;
    }
    if (array_key_exists('recordAfterTransfers', $values)) {
      $this->_dirtyFields['record_after_transfers'] = true;
    }
    if (array_key_exists('procedures', $values)) {
      $this->_dirtyFields['procedures'] = true;
    }
    if (array_key_exists('enableSecureMode', $values)) {
      $this->_dirtyFields['enable_secure_mode'] = true;
    }
    if (array_key_exists('enableSpamProtection', $values)) {
      $this->_dirtyFields['enable_spam_protection'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->additionalInstructions !== null) {
      $parts[] = [
        'name' => 'additional_instructions',
        'contents' => $this->additionalInstructions
      ];
    }

    if ($this->toneTraits !== null) {
      foreach ($this->toneTraits ?? [] as $item) {
        $parts[] = [
          'name' => 'tone_traits',
          'contents' => $item
        ];
      }
    }

    if ($this->detailsToCollect !== null) {
      foreach ($this->detailsToCollect ?? [] as $item) {
        $parts[] = [
          'name' => 'details_to_collect',
          'contents' => $item
        ];
      }
    }

    if ($this->llm !== null) {
      $parts[] = [
        'name' => 'llm',
        'contents' => $this->llm
      ];
    }

    if ($this->reasoningEffort !== null) {
      $parts[] = [
        'name' => 'reasoning_effort',
        'contents' => $this->reasoningEffort
      ];
    }

    if ($this->disableRag !== null) {
      $parts[] = [
        'name' => 'disable_rag',
        'contents' => $this->disableRag ? 'true' : 'false'
      ];
    }

    if ($this->backgroundVoiceDetection !== null) {
      $parts[] = [
        'name' => 'background_voice_detection',
        'contents' => $this->backgroundVoiceDetection ? 'true' : 'false'
      ];
    }

    if ($this->turnEagerness !== null) {
      $parts[] = [
        'name' => 'turn_eagerness',
        'contents' => $this->turnEagerness
      ];
    }

    if ($this->voiceId !== null) {
      $parts[] = [
        'name' => 'voice_id',
        'contents' => $this->voiceId
      ];
    }

    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language
      ];
    }

    if ($this->additionalLanguages !== null) {
      foreach ($this->additionalLanguages ?? [] as $item) {
        $parts[] = [
          'name' => 'additional_languages',
          'contents' => $item
        ];
      }
    }

    if ($this->firstMessage !== null) {
      $parts[] = [
        'name' => 'first_message',
        'contents' => $this->firstMessage
      ];
    }

    if ($this->firstMessageMode !== null) {
      $parts[] = [
        'name' => 'first_message_mode',
        'contents' => $this->firstMessageMode
      ];
    }

    if ($this->enableEndCallTool !== null) {
      $parts[] = [
        'name' => 'enable_end_call_tool',
        'contents' => $this->enableEndCallTool ? 'true' : 'false'
      ];
    }

    if ($this->enableSkipTurnTool !== null) {
      $parts[] = [
        'name' => 'enable_skip_turn_tool',
        'contents' => $this->enableSkipTurnTool ? 'true' : 'false'
      ];
    }

    if ($this->enablePlayKeypadTouchToneTool !== null) {
      $parts[] = [
        'name' => 'enable_play_keypad_touch_tone_tool',
        'contents' => $this->enablePlayKeypadTouchToneTool ? 'true' : 'false'
      ];
    }

    if ($this->agentRules !== null) {
      $parts[] = [
        'name' => 'agent_rules',
        'contents' => json_encode($this->agentRules),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->transferRules !== null) {
      $parts[] = [
        'name' => 'transfer_rules',
        'contents' => json_encode($this->transferRules),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->hideCallerNumberOnTransfers !== null) {
      $parts[] = [
        'name' => 'hide_caller_number_on_transfers',
        'contents' => $this->hideCallerNumberOnTransfers ? 'true' : 'false'
      ];
    }

    if ($this->recordAfterTransfers !== null) {
      $parts[] = [
        'name' => 'record_after_transfers',
        'contents' => $this->recordAfterTransfers ? 'true' : 'false'
      ];
    }

    if ($this->procedures !== null) {
      $parts[] = [
        'name' => 'procedures',
        'contents' => json_encode($this->procedures),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->enableSecureMode !== null) {
      $parts[] = [
        'name' => 'enable_secure_mode',
        'contents' => $this->enableSecureMode ? 'true' : 'false'
      ];
    }

    if ($this->enableSpamProtection !== null) {
      $parts[] = [
        'name' => 'enable_spam_protection',
        'contents' => $this->enableSpamProtection ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->toneTraits, 'tone_traits', maxItems: 20);
    Validator::validateArray($this->detailsToCollect, 'details_to_collect', maxItems: 30);
    foreach ($this->agentRules ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->agentRules, 'agent_rules', maxItems: 50);
    foreach ($this->transferRules ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->transferRules, 'transfer_rules', maxItems: 100);
    foreach ($this->procedures ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->procedures, 'procedures', maxItems: 20);
  }
}
