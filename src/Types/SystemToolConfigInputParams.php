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
class SystemToolConfigInputParams extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $systemToolType;

  /**
   * @var \ElevenLabs\Types\EndCallToolConfig|\ElevenLabs\Types\LanguageDetectionToolConfig|\ElevenLabs\Types\TransferToAgentToolConfigInput|\ElevenLabs\Types\TransferToNumberToolConfigInput|\ElevenLabs\Types\SkipTurnToolConfig|\ElevenLabs\Types\PlayDtmfToolConfig|\ElevenLabs\Types\VoicemailDetectionToolConfig|\ElevenLabs\Types\KnowledgeBaseRagToolConfig|\ElevenLabs\Types\KnowledgeBaseToolConfig|\ElevenLabs\Types\StartProcedureToolConfig|\ElevenLabs\Types\EndProcedureToolConfig|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this SystemToolConfigInputParams holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'SystemToolConfigInputParams does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\EndCallToolConfig|\ElevenLabs\Types\LanguageDetectionToolConfig|\ElevenLabs\Types\TransferToAgentToolConfigInput|\ElevenLabs\Types\TransferToNumberToolConfigInput|\ElevenLabs\Types\SkipTurnToolConfig|\ElevenLabs\Types\PlayDtmfToolConfig|\ElevenLabs\Types\VoicemailDetectionToolConfig|\ElevenLabs\Types\KnowledgeBaseRagToolConfig|\ElevenLabs\Types\KnowledgeBaseToolConfig|\ElevenLabs\Types\StartProcedureToolConfig|\ElevenLabs\Types\EndProcedureToolConfig|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->systemToolType = match ($typeIndex) {
      0 => 'end_call',
      1 => 'language_detection',
      2 => 'transfer_to_agent',
      3 => 'transfer_to_number',
      4 => 'skip_turn',
      5 => 'play_keypad_touch_tone',
      6 => 'voicemail_detection',
      7 => 'knowledge_base_rag',
      8 => 'knowledge_base',
      9 => 'start_procedure',
      10 => 'end_procedure',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a SystemToolConfigInputParams instance containing a \ElevenLabs\Types\EndCallToolConfig
   */
  public static function endCall(\ElevenLabs\Types\EndCallToolConfig $endCall): self
  {
    return new self($endCall, 0);
  }

  /**
   * Create a SystemToolConfigInputParams instance containing a \ElevenLabs\Types\LanguageDetectionToolConfig
   */
  public static function languageDetection(
    \ElevenLabs\Types\LanguageDetectionToolConfig $languageDetection
  ): self {
    return new self($languageDetection, 1);
  }

  /**
   * Create a SystemToolConfigInputParams instance containing a \ElevenLabs\Types\TransferToAgentToolConfigInput
   */
  public static function transferToAgent(
    \ElevenLabs\Types\TransferToAgentToolConfigInput $transferToAgent
  ): self {
    return new self($transferToAgent, 2);
  }

  /**
   * Create a SystemToolConfigInputParams instance containing a \ElevenLabs\Types\TransferToNumberToolConfigInput
   */
  public static function transferToNumber(
    \ElevenLabs\Types\TransferToNumberToolConfigInput $transferToNumber
  ): self {
    return new self($transferToNumber, 3);
  }

  /**
   * Create a SystemToolConfigInputParams instance containing a \ElevenLabs\Types\SkipTurnToolConfig
   */
  public static function skipTurn(\ElevenLabs\Types\SkipTurnToolConfig $skipTurn): self
  {
    return new self($skipTurn, 4);
  }

  /**
   * Create a SystemToolConfigInputParams instance containing a \ElevenLabs\Types\PlayDtmfToolConfig
   */
  public static function playKeypadTouchTone(
    \ElevenLabs\Types\PlayDtmfToolConfig $playKeypadTouchTone
  ): self {
    return new self($playKeypadTouchTone, 5);
  }

  /**
   * Create a SystemToolConfigInputParams instance containing a \ElevenLabs\Types\VoicemailDetectionToolConfig
   */
  public static function voicemailDetection(
    \ElevenLabs\Types\VoicemailDetectionToolConfig $voicemailDetection
  ): self {
    return new self($voicemailDetection, 6);
  }

  /**
   * Create a SystemToolConfigInputParams instance containing a \ElevenLabs\Types\KnowledgeBaseRagToolConfig
   */
  public static function knowledgeBaseRag(
    \ElevenLabs\Types\KnowledgeBaseRagToolConfig $knowledgeBaseRag
  ): self {
    return new self($knowledgeBaseRag, 7);
  }

  /**
   * Create a SystemToolConfigInputParams instance containing a \ElevenLabs\Types\KnowledgeBaseToolConfig
   */
  public static function knowledgeBase(
    \ElevenLabs\Types\KnowledgeBaseToolConfig $knowledgeBase
  ): self {
    return new self($knowledgeBase, 8);
  }

  /**
   * Create a SystemToolConfigInputParams instance containing a \ElevenLabs\Types\StartProcedureToolConfig
   */
  public static function startProcedure(
    \ElevenLabs\Types\StartProcedureToolConfig $startProcedure
  ): self {
    return new self($startProcedure, 9);
  }

  /**
   * Create a SystemToolConfigInputParams instance containing a \ElevenLabs\Types\EndProcedureToolConfig
   */
  public static function endProcedure(\ElevenLabs\Types\EndProcedureToolConfig $endProcedure): self
  {
    return new self($endProcedure, 10);
  }

  // Type checking methods
  /**
   * Check if this SystemToolConfigInputParams contains a \ElevenLabs\Types\EndCallToolConfig
   */
  public function isEndCall(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this SystemToolConfigInputParams contains a \ElevenLabs\Types\LanguageDetectionToolConfig
   */
  public function isLanguageDetection(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this SystemToolConfigInputParams contains a \ElevenLabs\Types\TransferToAgentToolConfigInput
   */
  public function isTransferToAgent(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this SystemToolConfigInputParams contains a \ElevenLabs\Types\TransferToNumberToolConfigInput
   */
  public function isTransferToNumber(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this SystemToolConfigInputParams contains a \ElevenLabs\Types\SkipTurnToolConfig
   */
  public function isSkipTurn(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this SystemToolConfigInputParams contains a \ElevenLabs\Types\PlayDtmfToolConfig
   */
  public function isPlayKeypadTouchTone(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this SystemToolConfigInputParams contains a \ElevenLabs\Types\VoicemailDetectionToolConfig
   */
  public function isVoicemailDetection(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this SystemToolConfigInputParams contains a \ElevenLabs\Types\KnowledgeBaseRagToolConfig
   */
  public function isKnowledgeBaseRag(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this SystemToolConfigInputParams contains a \ElevenLabs\Types\KnowledgeBaseToolConfig
   */
  public function isKnowledgeBase(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this SystemToolConfigInputParams contains a \ElevenLabs\Types\StartProcedureToolConfig
   */
  public function isStartProcedure(): bool
  {
    return $this->typeIndex === 9;
  }

  /**
   * Check if this SystemToolConfigInputParams contains a \ElevenLabs\Types\EndProcedureToolConfig
   */
  public function isEndProcedure(): bool
  {
    return $this->typeIndex === 10;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\EndCallToolConfig value
   * @throws \RuntimeException if this SystemToolConfigInputParams does not contain a \ElevenLabs\Types\EndCallToolConfig
   */
  public function asEndCall(): \ElevenLabs\Types\EndCallToolConfig
  {
    if (!$this->isEndCall()) {
      throw new \RuntimeException(
        'SystemToolConfigInputParams does not contain \ElevenLabs\Types\EndCallToolConfig'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\LanguageDetectionToolConfig value
   * @throws \RuntimeException if this SystemToolConfigInputParams does not contain a \ElevenLabs\Types\LanguageDetectionToolConfig
   */
  public function asLanguageDetection(): \ElevenLabs\Types\LanguageDetectionToolConfig
  {
    if (!$this->isLanguageDetection()) {
      throw new \RuntimeException(
        'SystemToolConfigInputParams does not contain \ElevenLabs\Types\LanguageDetectionToolConfig'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TransferToAgentToolConfigInput value
   * @throws \RuntimeException if this SystemToolConfigInputParams does not contain a \ElevenLabs\Types\TransferToAgentToolConfigInput
   */
  public function asTransferToAgent(): \ElevenLabs\Types\TransferToAgentToolConfigInput
  {
    if (!$this->isTransferToAgent()) {
      throw new \RuntimeException(
        'SystemToolConfigInputParams does not contain \ElevenLabs\Types\TransferToAgentToolConfigInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TransferToNumberToolConfigInput value
   * @throws \RuntimeException if this SystemToolConfigInputParams does not contain a \ElevenLabs\Types\TransferToNumberToolConfigInput
   */
  public function asTransferToNumber(): \ElevenLabs\Types\TransferToNumberToolConfigInput
  {
    if (!$this->isTransferToNumber()) {
      throw new \RuntimeException(
        'SystemToolConfigInputParams does not contain \ElevenLabs\Types\TransferToNumberToolConfigInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SkipTurnToolConfig value
   * @throws \RuntimeException if this SystemToolConfigInputParams does not contain a \ElevenLabs\Types\SkipTurnToolConfig
   */
  public function asSkipTurn(): \ElevenLabs\Types\SkipTurnToolConfig
  {
    if (!$this->isSkipTurn()) {
      throw new \RuntimeException(
        'SystemToolConfigInputParams does not contain \ElevenLabs\Types\SkipTurnToolConfig'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\PlayDtmfToolConfig value
   * @throws \RuntimeException if this SystemToolConfigInputParams does not contain a \ElevenLabs\Types\PlayDtmfToolConfig
   */
  public function asPlayKeypadTouchTone(): \ElevenLabs\Types\PlayDtmfToolConfig
  {
    if (!$this->isPlayKeypadTouchTone()) {
      throw new \RuntimeException(
        'SystemToolConfigInputParams does not contain \ElevenLabs\Types\PlayDtmfToolConfig'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\VoicemailDetectionToolConfig value
   * @throws \RuntimeException if this SystemToolConfigInputParams does not contain a \ElevenLabs\Types\VoicemailDetectionToolConfig
   */
  public function asVoicemailDetection(): \ElevenLabs\Types\VoicemailDetectionToolConfig
  {
    if (!$this->isVoicemailDetection()) {
      throw new \RuntimeException(
        'SystemToolConfigInputParams does not contain \ElevenLabs\Types\VoicemailDetectionToolConfig'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\KnowledgeBaseRagToolConfig value
   * @throws \RuntimeException if this SystemToolConfigInputParams does not contain a \ElevenLabs\Types\KnowledgeBaseRagToolConfig
   */
  public function asKnowledgeBaseRag(): \ElevenLabs\Types\KnowledgeBaseRagToolConfig
  {
    if (!$this->isKnowledgeBaseRag()) {
      throw new \RuntimeException(
        'SystemToolConfigInputParams does not contain \ElevenLabs\Types\KnowledgeBaseRagToolConfig'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\KnowledgeBaseToolConfig value
   * @throws \RuntimeException if this SystemToolConfigInputParams does not contain a \ElevenLabs\Types\KnowledgeBaseToolConfig
   */
  public function asKnowledgeBase(): \ElevenLabs\Types\KnowledgeBaseToolConfig
  {
    if (!$this->isKnowledgeBase()) {
      throw new \RuntimeException(
        'SystemToolConfigInputParams does not contain \ElevenLabs\Types\KnowledgeBaseToolConfig'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\StartProcedureToolConfig value
   * @throws \RuntimeException if this SystemToolConfigInputParams does not contain a \ElevenLabs\Types\StartProcedureToolConfig
   */
  public function asStartProcedure(): \ElevenLabs\Types\StartProcedureToolConfig
  {
    if (!$this->isStartProcedure()) {
      throw new \RuntimeException(
        'SystemToolConfigInputParams does not contain \ElevenLabs\Types\StartProcedureToolConfig'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\EndProcedureToolConfig value
   * @throws \RuntimeException if this SystemToolConfigInputParams does not contain a \ElevenLabs\Types\EndProcedureToolConfig
   */
  public function asEndProcedure(): \ElevenLabs\Types\EndProcedureToolConfig
  {
    if (!$this->isEndProcedure()) {
      throw new \RuntimeException(
        'SystemToolConfigInputParams does not contain \ElevenLabs\Types\EndProcedureToolConfig'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\EndCallToolConfig value
   * @return \ElevenLabs\Types\EndCallToolConfig|null Returns the value if this SystemToolConfigInputParams contains a \ElevenLabs\Types\EndCallToolConfig, null otherwise
   */
  public function tryAsEndCall(): ?\ElevenLabs\Types\EndCallToolConfig
  {
    return $this->isEndCall() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\LanguageDetectionToolConfig value
   * @return \ElevenLabs\Types\LanguageDetectionToolConfig|null Returns the value if this SystemToolConfigInputParams contains a \ElevenLabs\Types\LanguageDetectionToolConfig, null otherwise
   */
  public function tryAsLanguageDetection(): ?\ElevenLabs\Types\LanguageDetectionToolConfig
  {
    return $this->isLanguageDetection() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TransferToAgentToolConfigInput value
   * @return \ElevenLabs\Types\TransferToAgentToolConfigInput|null Returns the value if this SystemToolConfigInputParams contains a \ElevenLabs\Types\TransferToAgentToolConfigInput, null otherwise
   */
  public function tryAsTransferToAgent(): ?\ElevenLabs\Types\TransferToAgentToolConfigInput
  {
    return $this->isTransferToAgent() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TransferToNumberToolConfigInput value
   * @return \ElevenLabs\Types\TransferToNumberToolConfigInput|null Returns the value if this SystemToolConfigInputParams contains a \ElevenLabs\Types\TransferToNumberToolConfigInput, null otherwise
   */
  public function tryAsTransferToNumber(): ?\ElevenLabs\Types\TransferToNumberToolConfigInput
  {
    return $this->isTransferToNumber() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SkipTurnToolConfig value
   * @return \ElevenLabs\Types\SkipTurnToolConfig|null Returns the value if this SystemToolConfigInputParams contains a \ElevenLabs\Types\SkipTurnToolConfig, null otherwise
   */
  public function tryAsSkipTurn(): ?\ElevenLabs\Types\SkipTurnToolConfig
  {
    return $this->isSkipTurn() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\PlayDtmfToolConfig value
   * @return \ElevenLabs\Types\PlayDtmfToolConfig|null Returns the value if this SystemToolConfigInputParams contains a \ElevenLabs\Types\PlayDtmfToolConfig, null otherwise
   */
  public function tryAsPlayKeypadTouchTone(): ?\ElevenLabs\Types\PlayDtmfToolConfig
  {
    return $this->isPlayKeypadTouchTone() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\VoicemailDetectionToolConfig value
   * @return \ElevenLabs\Types\VoicemailDetectionToolConfig|null Returns the value if this SystemToolConfigInputParams contains a \ElevenLabs\Types\VoicemailDetectionToolConfig, null otherwise
   */
  public function tryAsVoicemailDetection(): ?\ElevenLabs\Types\VoicemailDetectionToolConfig
  {
    return $this->isVoicemailDetection() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\KnowledgeBaseRagToolConfig value
   * @return \ElevenLabs\Types\KnowledgeBaseRagToolConfig|null Returns the value if this SystemToolConfigInputParams contains a \ElevenLabs\Types\KnowledgeBaseRagToolConfig, null otherwise
   */
  public function tryAsKnowledgeBaseRag(): ?\ElevenLabs\Types\KnowledgeBaseRagToolConfig
  {
    return $this->isKnowledgeBaseRag() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\KnowledgeBaseToolConfig value
   * @return \ElevenLabs\Types\KnowledgeBaseToolConfig|null Returns the value if this SystemToolConfigInputParams contains a \ElevenLabs\Types\KnowledgeBaseToolConfig, null otherwise
   */
  public function tryAsKnowledgeBase(): ?\ElevenLabs\Types\KnowledgeBaseToolConfig
  {
    return $this->isKnowledgeBase() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\StartProcedureToolConfig value
   * @return \ElevenLabs\Types\StartProcedureToolConfig|null Returns the value if this SystemToolConfigInputParams contains a \ElevenLabs\Types\StartProcedureToolConfig, null otherwise
   */
  public function tryAsStartProcedure(): ?\ElevenLabs\Types\StartProcedureToolConfig
  {
    return $this->isStartProcedure() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\EndProcedureToolConfig value
   * @return \ElevenLabs\Types\EndProcedureToolConfig|null Returns the value if this SystemToolConfigInputParams contains a \ElevenLabs\Types\EndProcedureToolConfig, null otherwise
   */
  public function tryAsEndProcedure(): ?\ElevenLabs\Types\EndProcedureToolConfig
  {
    return $this->isEndProcedure() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\EndCallToolConfig): T $onEndCall
   * @param callable(\ElevenLabs\Types\LanguageDetectionToolConfig): T $onLanguageDetection
   * @param callable(\ElevenLabs\Types\TransferToAgentToolConfigInput): T $onTransferToAgent
   * @param callable(\ElevenLabs\Types\TransferToNumberToolConfigInput): T $onTransferToNumber
   * @param callable(\ElevenLabs\Types\SkipTurnToolConfig): T $onSkipTurn
   * @param callable(\ElevenLabs\Types\PlayDtmfToolConfig): T $onPlayKeypadTouchTone
   * @param callable(\ElevenLabs\Types\VoicemailDetectionToolConfig): T $onVoicemailDetection
   * @param callable(\ElevenLabs\Types\KnowledgeBaseRagToolConfig): T $onKnowledgeBaseRag
   * @param callable(\ElevenLabs\Types\KnowledgeBaseToolConfig): T $onKnowledgeBase
   * @param callable(\ElevenLabs\Types\StartProcedureToolConfig): T $onStartProcedure
   * @param callable(\ElevenLabs\Types\EndProcedureToolConfig): T $onEndProcedure
   * @return T
   */
  public function match(
    callable $onEndCall,
    callable $onLanguageDetection,
    callable $onTransferToAgent,
    callable $onTransferToNumber,
    callable $onSkipTurn,
    callable $onPlayKeypadTouchTone,
    callable $onVoicemailDetection,
    callable $onKnowledgeBaseRag,
    callable $onKnowledgeBase,
    callable $onStartProcedure,
    callable $onEndProcedure
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onEndCall($this->value),
      1 => $onLanguageDetection($this->value),
      2 => $onTransferToAgent($this->value),
      3 => $onTransferToNumber($this->value),
      4 => $onSkipTurn($this->value),
      5 => $onPlayKeypadTouchTone($this->value),
      6 => $onVoicemailDetection($this->value),
      7 => $onKnowledgeBaseRag($this->value),
      8 => $onKnowledgeBase($this->value),
      9 => $onStartProcedure($this->value),
      10 => $onEndProcedure($this->value),
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
    if (
      is_array($data) &&
      isset($data['system_tool_type']) &&
      is_string($data['system_tool_type'])
    ) {
      switch ($data['system_tool_type']) {
        case 'end_call':
          return new self(\ElevenLabs\Types\EndCallToolConfig::fromArray($data), 0);
        case 'end_procedure':
          return new self(\ElevenLabs\Types\EndProcedureToolConfig::fromArray($data), 10);
        case 'knowledge_base':
          return new self(\ElevenLabs\Types\KnowledgeBaseToolConfig::fromArray($data), 8);
        case 'knowledge_base_rag':
          return new self(\ElevenLabs\Types\KnowledgeBaseRagToolConfig::fromArray($data), 7);
        case 'language_detection':
          return new self(\ElevenLabs\Types\LanguageDetectionToolConfig::fromArray($data), 1);
        case 'play_keypad_touch_tone':
          return new self(\ElevenLabs\Types\PlayDtmfToolConfig::fromArray($data), 5);
        case 'skip_turn':
          return new self(\ElevenLabs\Types\SkipTurnToolConfig::fromArray($data), 4);
        case 'start_procedure':
          return new self(\ElevenLabs\Types\StartProcedureToolConfig::fromArray($data), 9);
        case 'transfer_to_agent':
          return new self(\ElevenLabs\Types\TransferToAgentToolConfigInput::fromArray($data), 2);
        case 'transfer_to_number':
          return new self(\ElevenLabs\Types\TransferToNumberToolConfigInput::fromArray($data), 3);
        case 'voicemail_detection':
          return new self(\ElevenLabs\Types\VoicemailDetectionToolConfig::fromArray($data), 6);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\EndCallToolConfig::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\EndCallToolConfig didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\LanguageDetectionToolConfig::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\LanguageDetectionToolConfig didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TransferToAgentToolConfigInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TransferToAgentToolConfigInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TransferToNumberToolConfigInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TransferToNumberToolConfigInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SkipTurnToolConfig::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SkipTurnToolConfig didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\PlayDtmfToolConfig::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PlayDtmfToolConfig didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\VoicemailDetectionToolConfig::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\VoicemailDetectionToolConfig didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\KnowledgeBaseRagToolConfig::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\KnowledgeBaseRagToolConfig didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\KnowledgeBaseToolConfig::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\KnowledgeBaseToolConfig didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\StartProcedureToolConfig::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\StartProcedureToolConfig didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\EndProcedureToolConfig::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 10, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\EndProcedureToolConfig didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any SystemToolConfigInputParams type'
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
