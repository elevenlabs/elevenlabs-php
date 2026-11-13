<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Discriminated union type (oneOf) representing exactly one of multiple possible types.
 *
 * This class implements a type-safe union where the value can be exactly one of the
 * defined variant types. It provides factory methods for construction, type-checking
 * methods, safe and throwing getters, and pattern matching for exhaustive handling.
 *
 * The oneOf pattern enforces that only one type can be present at a time, unlike anyOf
 * which allows multiple types simultaneously.
 */
class ConversationHistoryTranscriptSystemToolResultCommonModelInputResult extends
  JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $resultType;

  /**
   * @var \ElevenLabs\Types\EndCallToolResultModel|\ElevenLabs\Types\LanguageDetectionToolResultModel|\ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput|\ElevenLabs\Types\TransferToAgentToolResultErrorModel|\ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel|\ElevenLabs\Types\TransferToNumberResultSipSuccessModel|\ElevenLabs\Types\TransferToNumberResultExotelSuccessModel|\ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel|\ElevenLabs\Types\TransferToNumberResultErrorModel|\ElevenLabs\Types\SkipTurnToolResponseModel|\ElevenLabs\Types\PlayDtmfResultSuccessModel|\ElevenLabs\Types\PlayDtmfResultErrorModel|\ElevenLabs\Types\VoiceMailDetectionResultSuccessModel|\ElevenLabs\Types\TestToolResultModel|\ElevenLabs\Types\KnowledgeBaseRagToolResultModel|\ElevenLabs\Types\KnowledgeBaseToolResultModel|\ElevenLabs\Types\StartProcedureToolResultSuccessModel|\ElevenLabs\Types\StartProcedureToolResultErrorModel|\ElevenLabs\Types\EndProcedureToolResultSuccessModel|\ElevenLabs\Types\EndProcedureToolResultErrorModel|\ElevenLabs\Types\DummyToolResultModel|array<string, mixed> The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /** The type index of a payload whose discriminator names no variant this SDK knows. */
  private const UNKNOWN = -1;

  /**
   * Whether the payload's discriminator named a variant this SDK does not know (a variant added to
   * the API after this SDK was generated). Its raw payload is kept, as Fern's `_unknown` variant does.
   *
   * Underscore-prefixed because a union may legitimately have a variant NAMED `unknown`, whose own
   * accessors are `isUnknown()`/`asUnknown()`. Declaring both is a fatal `Cannot redeclare` and the
   * class cannot load at all. The prefix matches Fern's `_unknown` sentinel and Java's
   * `_isUnknown()`/`_getUnknown()`, and a variant accessor is always `isX`/`asX`, never `_isX` --
   * so the two can never collide whatever a spec calls its variants.
   */
  public function _isUnknown(): bool
  {
    return $this->typeIndex === self::UNKNOWN;
  }

  /**
   * @return array<string, mixed> The raw payload of an unknown variant
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\EndCallToolResultModel|\ElevenLabs\Types\LanguageDetectionToolResultModel|\ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput|\ElevenLabs\Types\TransferToAgentToolResultErrorModel|\ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel|\ElevenLabs\Types\TransferToNumberResultSipSuccessModel|\ElevenLabs\Types\TransferToNumberResultExotelSuccessModel|\ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel|\ElevenLabs\Types\TransferToNumberResultErrorModel|\ElevenLabs\Types\SkipTurnToolResponseModel|\ElevenLabs\Types\PlayDtmfResultSuccessModel|\ElevenLabs\Types\PlayDtmfResultErrorModel|\ElevenLabs\Types\VoiceMailDetectionResultSuccessModel|\ElevenLabs\Types\TestToolResultModel|\ElevenLabs\Types\KnowledgeBaseRagToolResultModel|\ElevenLabs\Types\KnowledgeBaseToolResultModel|\ElevenLabs\Types\StartProcedureToolResultSuccessModel|\ElevenLabs\Types\StartProcedureToolResultErrorModel|\ElevenLabs\Types\EndProcedureToolResultSuccessModel|\ElevenLabs\Types\EndProcedureToolResultErrorModel|\ElevenLabs\Types\DummyToolResultModel|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->resultType = match ($typeIndex) {
      0 => 'end_call_success',
      1 => 'language_detection_success',
      2 => 'transfer_to_agent_success',
      3 => 'transfer_to_agent_error',
      4 => 'transfer_to_number_twilio_success',
      5 => 'transfer_to_number_sip_success',
      6 => 'transfer_to_number_exotel_success',
      7 => 'transfer_to_number_amazon_connect_success',
      8 => 'transfer_to_number_error',
      9 => 'skip_turn_success',
      10 => 'play_dtmf_success',
      11 => 'play_dtmf_error',
      12 => 'voicemail_detection_success',
      13 => 'testing_tool_result',
      14 => 'knowledge_base_rag_success',
      15 => 'knowledge_base_success',
      16 => 'start_procedure_success',
      17 => 'start_procedure_error',
      18 => 'end_procedure_success',
      19 => 'end_procedure_error',
      20 => 'dummy',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\EndCallToolResultModel
   */
  public static function endCallSuccess(
    \ElevenLabs\Types\EndCallToolResultModel $endCallSuccess
  ): self {
    return new self($endCallSuccess, 0);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\LanguageDetectionToolResultModel
   */
  public static function languageDetectionSuccess(
    \ElevenLabs\Types\LanguageDetectionToolResultModel $languageDetectionSuccess
  ): self {
    return new self($languageDetectionSuccess, 1);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput
   */
  public static function transferToAgentSuccess(
    \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput $transferToAgentSuccess
  ): self {
    return new self($transferToAgentSuccess, 2);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\TransferToAgentToolResultErrorModel
   */
  public static function transferToAgentError(
    \ElevenLabs\Types\TransferToAgentToolResultErrorModel $transferToAgentError
  ): self {
    return new self($transferToAgentError, 3);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel
   */
  public static function transferToNumberTwilioSuccess(
    \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel $transferToNumberTwilioSuccess
  ): self {
    return new self($transferToNumberTwilioSuccess, 4);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\TransferToNumberResultSipSuccessModel
   */
  public static function transferToNumberSipSuccess(
    \ElevenLabs\Types\TransferToNumberResultSipSuccessModel $transferToNumberSipSuccess
  ): self {
    return new self($transferToNumberSipSuccess, 5);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel
   */
  public static function transferToNumberExotelSuccess(
    \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel $transferToNumberExotelSuccess
  ): self {
    return new self($transferToNumberExotelSuccess, 6);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel
   */
  public static function transferToNumberAmazonConnectSuccess(
    \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel $transferToNumberAmazonConnectSuccess
  ): self {
    return new self($transferToNumberAmazonConnectSuccess, 7);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\TransferToNumberResultErrorModel
   */
  public static function transferToNumberError(
    \ElevenLabs\Types\TransferToNumberResultErrorModel $transferToNumberError
  ): self {
    return new self($transferToNumberError, 8);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\SkipTurnToolResponseModel
   */
  public static function skipTurnSuccess(
    \ElevenLabs\Types\SkipTurnToolResponseModel $skipTurnSuccess
  ): self {
    return new self($skipTurnSuccess, 9);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\PlayDtmfResultSuccessModel
   */
  public static function playDtmfSuccess(
    \ElevenLabs\Types\PlayDtmfResultSuccessModel $playDtmfSuccess
  ): self {
    return new self($playDtmfSuccess, 10);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\PlayDtmfResultErrorModel
   */
  public static function playDtmfError(
    \ElevenLabs\Types\PlayDtmfResultErrorModel $playDtmfError
  ): self {
    return new self($playDtmfError, 11);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel
   */
  public static function voicemailDetectionSuccess(
    \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel $voicemailDetectionSuccess
  ): self {
    return new self($voicemailDetectionSuccess, 12);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\TestToolResultModel
   */
  public static function testingToolResult(
    \ElevenLabs\Types\TestToolResultModel $testingToolResult
  ): self {
    return new self($testingToolResult, 13);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\KnowledgeBaseRagToolResultModel
   */
  public static function knowledgeBaseRagSuccess(
    \ElevenLabs\Types\KnowledgeBaseRagToolResultModel $knowledgeBaseRagSuccess
  ): self {
    return new self($knowledgeBaseRagSuccess, 14);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\KnowledgeBaseToolResultModel
   */
  public static function knowledgeBaseSuccess(
    \ElevenLabs\Types\KnowledgeBaseToolResultModel $knowledgeBaseSuccess
  ): self {
    return new self($knowledgeBaseSuccess, 15);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\StartProcedureToolResultSuccessModel
   */
  public static function startProcedureSuccess(
    \ElevenLabs\Types\StartProcedureToolResultSuccessModel $startProcedureSuccess
  ): self {
    return new self($startProcedureSuccess, 16);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\StartProcedureToolResultErrorModel
   */
  public static function startProcedureError(
    \ElevenLabs\Types\StartProcedureToolResultErrorModel $startProcedureError
  ): self {
    return new self($startProcedureError, 17);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\EndProcedureToolResultSuccessModel
   */
  public static function endProcedureSuccess(
    \ElevenLabs\Types\EndProcedureToolResultSuccessModel $endProcedureSuccess
  ): self {
    return new self($endProcedureSuccess, 18);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\EndProcedureToolResultErrorModel
   */
  public static function endProcedureError(
    \ElevenLabs\Types\EndProcedureToolResultErrorModel $endProcedureError
  ): self {
    return new self($endProcedureError, 19);
  }

  /**
   * Create a ConversationHistoryTranscriptSystemToolResultCommonModelInputResult instance containing a \ElevenLabs\Types\DummyToolResultModel
   */
  public static function dummy(\ElevenLabs\Types\DummyToolResultModel $dummy): self
  {
    return new self($dummy, 20);
  }

  // Type checking methods
  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\EndCallToolResultModel
   */
  public function isEndCallSuccess(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\LanguageDetectionToolResultModel
   */
  public function isLanguageDetectionSuccess(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput
   */
  public function isTransferToAgentSuccess(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToAgentToolResultErrorModel
   */
  public function isTransferToAgentError(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel
   */
  public function isTransferToNumberTwilioSuccess(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToNumberResultSipSuccessModel
   */
  public function isTransferToNumberSipSuccess(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel
   */
  public function isTransferToNumberExotelSuccess(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel
   */
  public function isTransferToNumberAmazonConnectSuccess(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToNumberResultErrorModel
   */
  public function isTransferToNumberError(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\SkipTurnToolResponseModel
   */
  public function isSkipTurnSuccess(): bool
  {
    return $this->typeIndex === 9;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\PlayDtmfResultSuccessModel
   */
  public function isPlayDtmfSuccess(): bool
  {
    return $this->typeIndex === 10;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\PlayDtmfResultErrorModel
   */
  public function isPlayDtmfError(): bool
  {
    return $this->typeIndex === 11;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel
   */
  public function isVoicemailDetectionSuccess(): bool
  {
    return $this->typeIndex === 12;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TestToolResultModel
   */
  public function isTestingToolResult(): bool
  {
    return $this->typeIndex === 13;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\KnowledgeBaseRagToolResultModel
   */
  public function isKnowledgeBaseRagSuccess(): bool
  {
    return $this->typeIndex === 14;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\KnowledgeBaseToolResultModel
   */
  public function isKnowledgeBaseSuccess(): bool
  {
    return $this->typeIndex === 15;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\StartProcedureToolResultSuccessModel
   */
  public function isStartProcedureSuccess(): bool
  {
    return $this->typeIndex === 16;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\StartProcedureToolResultErrorModel
   */
  public function isStartProcedureError(): bool
  {
    return $this->typeIndex === 17;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\EndProcedureToolResultSuccessModel
   */
  public function isEndProcedureSuccess(): bool
  {
    return $this->typeIndex === 18;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\EndProcedureToolResultErrorModel
   */
  public function isEndProcedureError(): bool
  {
    return $this->typeIndex === 19;
  }

  /**
   * Check if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\DummyToolResultModel
   */
  public function isDummy(): bool
  {
    return $this->typeIndex === 20;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\EndCallToolResultModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\EndCallToolResultModel
   */
  public function asEndCallSuccess(): \ElevenLabs\Types\EndCallToolResultModel
  {
    if (!$this->isEndCallSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\EndCallToolResultModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\LanguageDetectionToolResultModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\LanguageDetectionToolResultModel
   */
  public function asLanguageDetectionSuccess(): \ElevenLabs\Types\LanguageDetectionToolResultModel
  {
    if (!$this->isLanguageDetectionSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\LanguageDetectionToolResultModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput
   */
  public function asTransferToAgentSuccess(): \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput
  {
    if (!$this->isTransferToAgentSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TransferToAgentToolResultErrorModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\TransferToAgentToolResultErrorModel
   */
  public function asTransferToAgentError(): \ElevenLabs\Types\TransferToAgentToolResultErrorModel
  {
    if (!$this->isTransferToAgentError()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\TransferToAgentToolResultErrorModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel
   */
  public function asTransferToNumberTwilioSuccess(): \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel
  {
    if (!$this->isTransferToNumberTwilioSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TransferToNumberResultSipSuccessModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\TransferToNumberResultSipSuccessModel
   */
  public function asTransferToNumberSipSuccess(): \ElevenLabs\Types\TransferToNumberResultSipSuccessModel
  {
    if (!$this->isTransferToNumberSipSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\TransferToNumberResultSipSuccessModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel
   */
  public function asTransferToNumberExotelSuccess(): \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel
  {
    if (!$this->isTransferToNumberExotelSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel
   */
  public function asTransferToNumberAmazonConnectSuccess(): \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel
  {
    if (!$this->isTransferToNumberAmazonConnectSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TransferToNumberResultErrorModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\TransferToNumberResultErrorModel
   */
  public function asTransferToNumberError(): \ElevenLabs\Types\TransferToNumberResultErrorModel
  {
    if (!$this->isTransferToNumberError()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\TransferToNumberResultErrorModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SkipTurnToolResponseModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\SkipTurnToolResponseModel
   */
  public function asSkipTurnSuccess(): \ElevenLabs\Types\SkipTurnToolResponseModel
  {
    if (!$this->isSkipTurnSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\SkipTurnToolResponseModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\PlayDtmfResultSuccessModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\PlayDtmfResultSuccessModel
   */
  public function asPlayDtmfSuccess(): \ElevenLabs\Types\PlayDtmfResultSuccessModel
  {
    if (!$this->isPlayDtmfSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\PlayDtmfResultSuccessModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\PlayDtmfResultErrorModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\PlayDtmfResultErrorModel
   */
  public function asPlayDtmfError(): \ElevenLabs\Types\PlayDtmfResultErrorModel
  {
    if (!$this->isPlayDtmfError()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\PlayDtmfResultErrorModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel
   */
  public function asVoicemailDetectionSuccess(): \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel
  {
    if (!$this->isVoicemailDetectionSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TestToolResultModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\TestToolResultModel
   */
  public function asTestingToolResult(): \ElevenLabs\Types\TestToolResultModel
  {
    if (!$this->isTestingToolResult()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\TestToolResultModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\KnowledgeBaseRagToolResultModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\KnowledgeBaseRagToolResultModel
   */
  public function asKnowledgeBaseRagSuccess(): \ElevenLabs\Types\KnowledgeBaseRagToolResultModel
  {
    if (!$this->isKnowledgeBaseRagSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\KnowledgeBaseRagToolResultModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\KnowledgeBaseToolResultModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\KnowledgeBaseToolResultModel
   */
  public function asKnowledgeBaseSuccess(): \ElevenLabs\Types\KnowledgeBaseToolResultModel
  {
    if (!$this->isKnowledgeBaseSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\KnowledgeBaseToolResultModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\StartProcedureToolResultSuccessModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\StartProcedureToolResultSuccessModel
   */
  public function asStartProcedureSuccess(): \ElevenLabs\Types\StartProcedureToolResultSuccessModel
  {
    if (!$this->isStartProcedureSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\StartProcedureToolResultSuccessModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\StartProcedureToolResultErrorModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\StartProcedureToolResultErrorModel
   */
  public function asStartProcedureError(): \ElevenLabs\Types\StartProcedureToolResultErrorModel
  {
    if (!$this->isStartProcedureError()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\StartProcedureToolResultErrorModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\EndProcedureToolResultSuccessModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\EndProcedureToolResultSuccessModel
   */
  public function asEndProcedureSuccess(): \ElevenLabs\Types\EndProcedureToolResultSuccessModel
  {
    if (!$this->isEndProcedureSuccess()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\EndProcedureToolResultSuccessModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\EndProcedureToolResultErrorModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\EndProcedureToolResultErrorModel
   */
  public function asEndProcedureError(): \ElevenLabs\Types\EndProcedureToolResultErrorModel
  {
    if (!$this->isEndProcedureError()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\EndProcedureToolResultErrorModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DummyToolResultModel value
   * @throws \RuntimeException if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain a \ElevenLabs\Types\DummyToolResultModel
   */
  public function asDummy(): \ElevenLabs\Types\DummyToolResultModel
  {
    if (!$this->isDummy()) {
      throw new \RuntimeException(
        'ConversationHistoryTranscriptSystemToolResultCommonModelInputResult does not contain \ElevenLabs\Types\DummyToolResultModel'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\EndCallToolResultModel value
   * @return \ElevenLabs\Types\EndCallToolResultModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\EndCallToolResultModel, null otherwise
   */
  public function tryAsEndCallSuccess(): ?\ElevenLabs\Types\EndCallToolResultModel
  {
    return $this->isEndCallSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\LanguageDetectionToolResultModel value
   * @return \ElevenLabs\Types\LanguageDetectionToolResultModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\LanguageDetectionToolResultModel, null otherwise
   */
  public function tryAsLanguageDetectionSuccess(): ?\ElevenLabs\Types\LanguageDetectionToolResultModel
  {
    return $this->isLanguageDetectionSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput value
   * @return \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput, null otherwise
   */
  public function tryAsTransferToAgentSuccess(): ?\ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput
  {
    return $this->isTransferToAgentSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TransferToAgentToolResultErrorModel value
   * @return \ElevenLabs\Types\TransferToAgentToolResultErrorModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToAgentToolResultErrorModel, null otherwise
   */
  public function tryAsTransferToAgentError(): ?\ElevenLabs\Types\TransferToAgentToolResultErrorModel
  {
    return $this->isTransferToAgentError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel value
   * @return \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel, null otherwise
   */
  public function tryAsTransferToNumberTwilioSuccess(): ?\ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel
  {
    return $this->isTransferToNumberTwilioSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TransferToNumberResultSipSuccessModel value
   * @return \ElevenLabs\Types\TransferToNumberResultSipSuccessModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToNumberResultSipSuccessModel, null otherwise
   */
  public function tryAsTransferToNumberSipSuccess(): ?\ElevenLabs\Types\TransferToNumberResultSipSuccessModel
  {
    return $this->isTransferToNumberSipSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel value
   * @return \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel, null otherwise
   */
  public function tryAsTransferToNumberExotelSuccess(): ?\ElevenLabs\Types\TransferToNumberResultExotelSuccessModel
  {
    return $this->isTransferToNumberExotelSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel value
   * @return \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel, null otherwise
   */
  public function tryAsTransferToNumberAmazonConnectSuccess(): ?\ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel
  {
    return $this->isTransferToNumberAmazonConnectSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TransferToNumberResultErrorModel value
   * @return \ElevenLabs\Types\TransferToNumberResultErrorModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TransferToNumberResultErrorModel, null otherwise
   */
  public function tryAsTransferToNumberError(): ?\ElevenLabs\Types\TransferToNumberResultErrorModel
  {
    return $this->isTransferToNumberError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SkipTurnToolResponseModel value
   * @return \ElevenLabs\Types\SkipTurnToolResponseModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\SkipTurnToolResponseModel, null otherwise
   */
  public function tryAsSkipTurnSuccess(): ?\ElevenLabs\Types\SkipTurnToolResponseModel
  {
    return $this->isSkipTurnSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\PlayDtmfResultSuccessModel value
   * @return \ElevenLabs\Types\PlayDtmfResultSuccessModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\PlayDtmfResultSuccessModel, null otherwise
   */
  public function tryAsPlayDtmfSuccess(): ?\ElevenLabs\Types\PlayDtmfResultSuccessModel
  {
    return $this->isPlayDtmfSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\PlayDtmfResultErrorModel value
   * @return \ElevenLabs\Types\PlayDtmfResultErrorModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\PlayDtmfResultErrorModel, null otherwise
   */
  public function tryAsPlayDtmfError(): ?\ElevenLabs\Types\PlayDtmfResultErrorModel
  {
    return $this->isPlayDtmfError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel value
   * @return \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel, null otherwise
   */
  public function tryAsVoicemailDetectionSuccess(): ?\ElevenLabs\Types\VoiceMailDetectionResultSuccessModel
  {
    return $this->isVoicemailDetectionSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TestToolResultModel value
   * @return \ElevenLabs\Types\TestToolResultModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\TestToolResultModel, null otherwise
   */
  public function tryAsTestingToolResult(): ?\ElevenLabs\Types\TestToolResultModel
  {
    return $this->isTestingToolResult() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\KnowledgeBaseRagToolResultModel value
   * @return \ElevenLabs\Types\KnowledgeBaseRagToolResultModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\KnowledgeBaseRagToolResultModel, null otherwise
   */
  public function tryAsKnowledgeBaseRagSuccess(): ?\ElevenLabs\Types\KnowledgeBaseRagToolResultModel
  {
    return $this->isKnowledgeBaseRagSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\KnowledgeBaseToolResultModel value
   * @return \ElevenLabs\Types\KnowledgeBaseToolResultModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\KnowledgeBaseToolResultModel, null otherwise
   */
  public function tryAsKnowledgeBaseSuccess(): ?\ElevenLabs\Types\KnowledgeBaseToolResultModel
  {
    return $this->isKnowledgeBaseSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\StartProcedureToolResultSuccessModel value
   * @return \ElevenLabs\Types\StartProcedureToolResultSuccessModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\StartProcedureToolResultSuccessModel, null otherwise
   */
  public function tryAsStartProcedureSuccess(): ?\ElevenLabs\Types\StartProcedureToolResultSuccessModel
  {
    return $this->isStartProcedureSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\StartProcedureToolResultErrorModel value
   * @return \ElevenLabs\Types\StartProcedureToolResultErrorModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\StartProcedureToolResultErrorModel, null otherwise
   */
  public function tryAsStartProcedureError(): ?\ElevenLabs\Types\StartProcedureToolResultErrorModel
  {
    return $this->isStartProcedureError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\EndProcedureToolResultSuccessModel value
   * @return \ElevenLabs\Types\EndProcedureToolResultSuccessModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\EndProcedureToolResultSuccessModel, null otherwise
   */
  public function tryAsEndProcedureSuccess(): ?\ElevenLabs\Types\EndProcedureToolResultSuccessModel
  {
    return $this->isEndProcedureSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\EndProcedureToolResultErrorModel value
   * @return \ElevenLabs\Types\EndProcedureToolResultErrorModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\EndProcedureToolResultErrorModel, null otherwise
   */
  public function tryAsEndProcedureError(): ?\ElevenLabs\Types\EndProcedureToolResultErrorModel
  {
    return $this->isEndProcedureError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DummyToolResultModel value
   * @return \ElevenLabs\Types\DummyToolResultModel|null Returns the value if this ConversationHistoryTranscriptSystemToolResultCommonModelInputResult contains a \ElevenLabs\Types\DummyToolResultModel, null otherwise
   */
  public function tryAsDummy(): ?\ElevenLabs\Types\DummyToolResultModel
  {
    return $this->isDummy() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\EndCallToolResultModel): T $onEndCallSuccess
   * @param callable(\ElevenLabs\Types\LanguageDetectionToolResultModel): T $onLanguageDetectionSuccess
   * @param callable(\ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput): T $onTransferToAgentSuccess
   * @param callable(\ElevenLabs\Types\TransferToAgentToolResultErrorModel): T $onTransferToAgentError
   * @param callable(\ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel): T $onTransferToNumberTwilioSuccess
   * @param callable(\ElevenLabs\Types\TransferToNumberResultSipSuccessModel): T $onTransferToNumberSipSuccess
   * @param callable(\ElevenLabs\Types\TransferToNumberResultExotelSuccessModel): T $onTransferToNumberExotelSuccess
   * @param callable(\ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel): T $onTransferToNumberAmazonConnectSuccess
   * @param callable(\ElevenLabs\Types\TransferToNumberResultErrorModel): T $onTransferToNumberError
   * @param callable(\ElevenLabs\Types\SkipTurnToolResponseModel): T $onSkipTurnSuccess
   * @param callable(\ElevenLabs\Types\PlayDtmfResultSuccessModel): T $onPlayDtmfSuccess
   * @param callable(\ElevenLabs\Types\PlayDtmfResultErrorModel): T $onPlayDtmfError
   * @param callable(\ElevenLabs\Types\VoiceMailDetectionResultSuccessModel): T $onVoicemailDetectionSuccess
   * @param callable(\ElevenLabs\Types\TestToolResultModel): T $onTestingToolResult
   * @param callable(\ElevenLabs\Types\KnowledgeBaseRagToolResultModel): T $onKnowledgeBaseRagSuccess
   * @param callable(\ElevenLabs\Types\KnowledgeBaseToolResultModel): T $onKnowledgeBaseSuccess
   * @param callable(\ElevenLabs\Types\StartProcedureToolResultSuccessModel): T $onStartProcedureSuccess
   * @param callable(\ElevenLabs\Types\StartProcedureToolResultErrorModel): T $onStartProcedureError
   * @param callable(\ElevenLabs\Types\EndProcedureToolResultSuccessModel): T $onEndProcedureSuccess
   * @param callable(\ElevenLabs\Types\EndProcedureToolResultErrorModel): T $onEndProcedureError
   * @param callable(\ElevenLabs\Types\DummyToolResultModel): T $onDummy
   * @return T
   */
  public function match(
    callable $onEndCallSuccess,
    callable $onLanguageDetectionSuccess,
    callable $onTransferToAgentSuccess,
    callable $onTransferToAgentError,
    callable $onTransferToNumberTwilioSuccess,
    callable $onTransferToNumberSipSuccess,
    callable $onTransferToNumberExotelSuccess,
    callable $onTransferToNumberAmazonConnectSuccess,
    callable $onTransferToNumberError,
    callable $onSkipTurnSuccess,
    callable $onPlayDtmfSuccess,
    callable $onPlayDtmfError,
    callable $onVoicemailDetectionSuccess,
    callable $onTestingToolResult,
    callable $onKnowledgeBaseRagSuccess,
    callable $onKnowledgeBaseSuccess,
    callable $onStartProcedureSuccess,
    callable $onStartProcedureError,
    callable $onEndProcedureSuccess,
    callable $onEndProcedureError,
    callable $onDummy
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onEndCallSuccess($this->value),
      1 => $onLanguageDetectionSuccess($this->value),
      2 => $onTransferToAgentSuccess($this->value),
      3 => $onTransferToAgentError($this->value),
      4 => $onTransferToNumberTwilioSuccess($this->value),
      5 => $onTransferToNumberSipSuccess($this->value),
      6 => $onTransferToNumberExotelSuccess($this->value),
      7 => $onTransferToNumberAmazonConnectSuccess($this->value),
      8 => $onTransferToNumberError($this->value),
      9 => $onSkipTurnSuccess($this->value),
      10 => $onPlayDtmfSuccess($this->value),
      11 => $onPlayDtmfError($this->value),
      12 => $onVoicemailDetectionSuccess($this->value),
      13 => $onTestingToolResult($this->value),
      14 => $onKnowledgeBaseRagSuccess($this->value),
      15 => $onKnowledgeBaseSuccess($this->value),
      16 => $onStartProcedureSuccess($this->value),
      17 => $onStartProcedureError($this->value),
      18 => $onEndProcedureSuccess($this->value),
      19 => $onEndProcedureError($this->value),
      20 => $onDummy($this->value),
      default => throw new \UnexpectedValueException("Unknown type index: $this->typeIndex")
    };
  }

  /**
   * Deserialize from data - try each type in order
   * @param array<string, mixed> $data
   * @return self
   * @throws \InvalidArgumentException if data doesn't match any type
   */
  public static function fromArray(array $data): self
  {
    // Best-match-wins: collect every variant that fromArray() accepted,
    // score each by how many of the input keys it actually consumed
    // (looked up via the per-instance _dirtyFields populated by the
    // variant's own fromArray), then keep the highest-scoring one. Ties
    // break to the first-declared variant because PHP's usort is stable
    // when compared values are equal and we visit variants in order.
    // This is what makes oneOf with overlapping schemas (e.g. Cat & Dog
    // both have `name`, only Cat has `color`) pick the right variant
    // when discriminating fields are present.
    // The payload's own discriminator value picks the variant. Scoring alone ties whenever two
    // members have the same shape and differ only in that constant, and the first would win.
    if (is_array($data) && isset($data['result_type']) && is_string($data['result_type'])) {
      switch ($data['result_type']) {
        case 'dummy':
          return new self(\ElevenLabs\Types\DummyToolResultModel::fromArray($data), 20);
        case 'end_call_success':
          return new self(\ElevenLabs\Types\EndCallToolResultModel::fromArray($data), 0);
        case 'end_procedure_error':
          return new self(\ElevenLabs\Types\EndProcedureToolResultErrorModel::fromArray($data), 19);
        case 'end_procedure_success':
          return new self(
            \ElevenLabs\Types\EndProcedureToolResultSuccessModel::fromArray($data),
            18
          );
        case 'knowledge_base_rag_success':
          return new self(\ElevenLabs\Types\KnowledgeBaseRagToolResultModel::fromArray($data), 14);
        case 'knowledge_base_success':
          return new self(\ElevenLabs\Types\KnowledgeBaseToolResultModel::fromArray($data), 15);
        case 'language_detection_success':
          return new self(\ElevenLabs\Types\LanguageDetectionToolResultModel::fromArray($data), 1);
        case 'play_dtmf_error':
          return new self(\ElevenLabs\Types\PlayDtmfResultErrorModel::fromArray($data), 11);
        case 'play_dtmf_success':
          return new self(\ElevenLabs\Types\PlayDtmfResultSuccessModel::fromArray($data), 10);
        case 'skip_turn_success':
          return new self(\ElevenLabs\Types\SkipTurnToolResponseModel::fromArray($data), 9);
        case 'start_procedure_error':
          return new self(
            \ElevenLabs\Types\StartProcedureToolResultErrorModel::fromArray($data),
            17
          );
        case 'start_procedure_success':
          return new self(
            \ElevenLabs\Types\StartProcedureToolResultSuccessModel::fromArray($data),
            16
          );
        case 'testing_tool_result':
          return new self(\ElevenLabs\Types\TestToolResultModel::fromArray($data), 13);
        case 'transfer_to_agent_error':
          return new self(
            \ElevenLabs\Types\TransferToAgentToolResultErrorModel::fromArray($data),
            3
          );
        case 'transfer_to_agent_success':
          return new self(
            \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput::fromArray($data),
            2
          );
        case 'transfer_to_number_amazon_connect_success':
          return new self(
            \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel::fromArray($data),
            7
          );
        case 'transfer_to_number_error':
          return new self(\ElevenLabs\Types\TransferToNumberResultErrorModel::fromArray($data), 8);
        case 'transfer_to_number_exotel_success':
          return new self(
            \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel::fromArray($data),
            6
          );
        case 'transfer_to_number_sip_success':
          return new self(
            \ElevenLabs\Types\TransferToNumberResultSipSuccessModel::fromArray($data),
            5
          );
        case 'transfer_to_number_twilio_success':
          return new self(
            \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel::fromArray($data),
            4
          );
        case 'voicemail_detection_success':
          return new self(
            \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel::fromArray($data),
            12
          );
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\EndCallToolResultModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\EndCallToolResultModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\LanguageDetectionToolResultModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\LanguageDetectionToolResultModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TransferToAgentToolResultErrorModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TransferToAgentToolResultErrorModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TransferToNumberResultTwilioSuccessModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TransferToNumberResultSipSuccessModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TransferToNumberResultSipSuccessModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TransferToNumberResultExotelSuccessModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel::fromArray(
        $data
      );
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TransferToNumberResultErrorModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TransferToNumberResultErrorModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SkipTurnToolResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SkipTurnToolResponseModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\PlayDtmfResultSuccessModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 10, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PlayDtmfResultSuccessModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\PlayDtmfResultErrorModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 11, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PlayDtmfResultErrorModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 12, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TestToolResultModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 13, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TestToolResultModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\KnowledgeBaseRagToolResultModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 14, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\KnowledgeBaseRagToolResultModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\KnowledgeBaseToolResultModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 15, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\KnowledgeBaseToolResultModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\StartProcedureToolResultSuccessModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 16, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\StartProcedureToolResultSuccessModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\StartProcedureToolResultErrorModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 17, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\StartProcedureToolResultErrorModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\EndProcedureToolResultSuccessModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 18, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\EndProcedureToolResultSuccessModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\EndProcedureToolResultErrorModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 19, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\EndProcedureToolResultErrorModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DummyToolResultModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 20, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DummyToolResultModel didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any ConversationHistoryTranscriptSystemToolResultCommonModelInputResult type'
      );
    }
    $best = $candidates[0];
    foreach ($candidates as $candidate) {
      if ($candidate['score'] > $best['score']) {
        $best = $candidate;
      }
    }
    return new self($best['instance'], $best['idx']);
  }

  /**
   * Serialize to JSON - returns the serialized inner value
   *
   * @return array<mixed>
   */
  public function jsonSerialize(): array
  {
    if ($this->_isUnknown()) {
      return $this->_asUnknown();
    }
    return $this->value->jsonSerialize();
  }
}
