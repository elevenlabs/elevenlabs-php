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
class AstNodeOutput extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\AstStringNodeOutput|\ElevenLabs\Types\AstNumberNodeOutput|\ElevenLabs\Types\AstBooleanNodeOutput|\ElevenLabs\Types\AstNullNodeOutput|\ElevenLabs\Types\AstllmNodeOutput|\ElevenLabs\Types\AstDynamicVariableNodeOutput|\ElevenLabs\Types\AstOrOperatorNodeOutput|\ElevenLabs\Types\AstAndOperatorNodeOutput|\ElevenLabs\Types\AstEqualsOperatorNodeOutput|\ElevenLabs\Types\AstNotEqualsOperatorNodeOutput|\ElevenLabs\Types\AstGreaterThanOperatorNodeOutput|\ElevenLabs\Types\AstLessThanOperatorNodeOutput|\ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput|\ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput|\ElevenLabs\Types\AstAdditionOperatorNodeOutput|\ElevenLabs\Types\AstSubtractionOperatorNodeOutput|\ElevenLabs\Types\AstMultiplicationOperatorNodeOutput|\ElevenLabs\Types\AstDivisionOperatorNodeOutput|\ElevenLabs\Types\AstConditionalOperatorNodeOutput|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this AstNodeOutput holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('AstNodeOutput does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\AstStringNodeOutput|\ElevenLabs\Types\AstNumberNodeOutput|\ElevenLabs\Types\AstBooleanNodeOutput|\ElevenLabs\Types\AstNullNodeOutput|\ElevenLabs\Types\AstllmNodeOutput|\ElevenLabs\Types\AstDynamicVariableNodeOutput|\ElevenLabs\Types\AstOrOperatorNodeOutput|\ElevenLabs\Types\AstAndOperatorNodeOutput|\ElevenLabs\Types\AstEqualsOperatorNodeOutput|\ElevenLabs\Types\AstNotEqualsOperatorNodeOutput|\ElevenLabs\Types\AstGreaterThanOperatorNodeOutput|\ElevenLabs\Types\AstLessThanOperatorNodeOutput|\ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput|\ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput|\ElevenLabs\Types\AstAdditionOperatorNodeOutput|\ElevenLabs\Types\AstSubtractionOperatorNodeOutput|\ElevenLabs\Types\AstMultiplicationOperatorNodeOutput|\ElevenLabs\Types\AstDivisionOperatorNodeOutput|\ElevenLabs\Types\AstConditionalOperatorNodeOutput|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'string_literal',
      1 => 'number_literal',
      2 => 'boolean_literal',
      3 => 'null_literal',
      4 => 'llm',
      5 => 'dynamic_variable',
      6 => 'or_operator',
      7 => 'and_operator',
      8 => 'eq_operator',
      9 => 'neq_operator',
      10 => 'gt_operator',
      11 => 'lt_operator',
      12 => 'gte_operator',
      13 => 'lte_operator',
      14 => 'add_operator',
      15 => 'sub_operator',
      16 => 'mul_operator',
      17 => 'div_operator',
      18 => 'conditional_operator',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstStringNodeOutput
   */
  public static function stringLiteral(\ElevenLabs\Types\AstStringNodeOutput $stringLiteral): self
  {
    return new self($stringLiteral, 0);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstNumberNodeOutput
   */
  public static function numberLiteral(\ElevenLabs\Types\AstNumberNodeOutput $numberLiteral): self
  {
    return new self($numberLiteral, 1);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstBooleanNodeOutput
   */
  public static function booleanLiteral(
    \ElevenLabs\Types\AstBooleanNodeOutput $booleanLiteral
  ): self {
    return new self($booleanLiteral, 2);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstNullNodeOutput
   */
  public static function nullLiteral(\ElevenLabs\Types\AstNullNodeOutput $nullLiteral): self
  {
    return new self($nullLiteral, 3);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstllmNodeOutput
   */
  public static function llm(\ElevenLabs\Types\AstllmNodeOutput $llm): self
  {
    return new self($llm, 4);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstDynamicVariableNodeOutput
   */
  public static function dynamicVariable(
    \ElevenLabs\Types\AstDynamicVariableNodeOutput $dynamicVariable
  ): self {
    return new self($dynamicVariable, 5);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstOrOperatorNodeOutput
   */
  public static function orOperator(\ElevenLabs\Types\AstOrOperatorNodeOutput $orOperator): self
  {
    return new self($orOperator, 6);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstAndOperatorNodeOutput
   */
  public static function andOperator(\ElevenLabs\Types\AstAndOperatorNodeOutput $andOperator): self
  {
    return new self($andOperator, 7);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstEqualsOperatorNodeOutput
   */
  public static function eqOperator(\ElevenLabs\Types\AstEqualsOperatorNodeOutput $eqOperator): self
  {
    return new self($eqOperator, 8);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstNotEqualsOperatorNodeOutput
   */
  public static function neqOperator(
    \ElevenLabs\Types\AstNotEqualsOperatorNodeOutput $neqOperator
  ): self {
    return new self($neqOperator, 9);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstGreaterThanOperatorNodeOutput
   */
  public static function gtOperator(
    \ElevenLabs\Types\AstGreaterThanOperatorNodeOutput $gtOperator
  ): self {
    return new self($gtOperator, 10);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstLessThanOperatorNodeOutput
   */
  public static function ltOperator(
    \ElevenLabs\Types\AstLessThanOperatorNodeOutput $ltOperator
  ): self {
    return new self($ltOperator, 11);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput
   */
  public static function gteOperator(
    \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput $gteOperator
  ): self {
    return new self($gteOperator, 12);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput
   */
  public static function lteOperator(
    \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput $lteOperator
  ): self {
    return new self($lteOperator, 13);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstAdditionOperatorNodeOutput
   */
  public static function addOperator(
    \ElevenLabs\Types\AstAdditionOperatorNodeOutput $addOperator
  ): self {
    return new self($addOperator, 14);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstSubtractionOperatorNodeOutput
   */
  public static function subOperator(
    \ElevenLabs\Types\AstSubtractionOperatorNodeOutput $subOperator
  ): self {
    return new self($subOperator, 15);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstMultiplicationOperatorNodeOutput
   */
  public static function mulOperator(
    \ElevenLabs\Types\AstMultiplicationOperatorNodeOutput $mulOperator
  ): self {
    return new self($mulOperator, 16);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstDivisionOperatorNodeOutput
   */
  public static function divOperator(
    \ElevenLabs\Types\AstDivisionOperatorNodeOutput $divOperator
  ): self {
    return new self($divOperator, 17);
  }

  /**
   * Create a AstNodeOutput instance containing a \ElevenLabs\Types\AstConditionalOperatorNodeOutput
   */
  public static function conditionalOperator(
    \ElevenLabs\Types\AstConditionalOperatorNodeOutput $conditionalOperator
  ): self {
    return new self($conditionalOperator, 18);
  }

  // Type checking methods
  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstStringNodeOutput
   */
  public function isStringLiteral(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstNumberNodeOutput
   */
  public function isNumberLiteral(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstBooleanNodeOutput
   */
  public function isBooleanLiteral(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstNullNodeOutput
   */
  public function isNullLiteral(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstllmNodeOutput
   */
  public function isLlm(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstDynamicVariableNodeOutput
   */
  public function isDynamicVariable(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstOrOperatorNodeOutput
   */
  public function isOrOperator(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstAndOperatorNodeOutput
   */
  public function isAndOperator(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstEqualsOperatorNodeOutput
   */
  public function isEqOperator(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstNotEqualsOperatorNodeOutput
   */
  public function isNeqOperator(): bool
  {
    return $this->typeIndex === 9;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstGreaterThanOperatorNodeOutput
   */
  public function isGtOperator(): bool
  {
    return $this->typeIndex === 10;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstLessThanOperatorNodeOutput
   */
  public function isLtOperator(): bool
  {
    return $this->typeIndex === 11;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput
   */
  public function isGteOperator(): bool
  {
    return $this->typeIndex === 12;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput
   */
  public function isLteOperator(): bool
  {
    return $this->typeIndex === 13;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstAdditionOperatorNodeOutput
   */
  public function isAddOperator(): bool
  {
    return $this->typeIndex === 14;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstSubtractionOperatorNodeOutput
   */
  public function isSubOperator(): bool
  {
    return $this->typeIndex === 15;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstMultiplicationOperatorNodeOutput
   */
  public function isMulOperator(): bool
  {
    return $this->typeIndex === 16;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstDivisionOperatorNodeOutput
   */
  public function isDivOperator(): bool
  {
    return $this->typeIndex === 17;
  }

  /**
   * Check if this AstNodeOutput contains a \ElevenLabs\Types\AstConditionalOperatorNodeOutput
   */
  public function isConditionalOperator(): bool
  {
    return $this->typeIndex === 18;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\AstStringNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstStringNodeOutput
   */
  public function asStringLiteral(): \ElevenLabs\Types\AstStringNodeOutput
  {
    if (!$this->isStringLiteral()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstStringNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstNumberNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstNumberNodeOutput
   */
  public function asNumberLiteral(): \ElevenLabs\Types\AstNumberNodeOutput
  {
    if (!$this->isNumberLiteral()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstNumberNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstBooleanNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstBooleanNodeOutput
   */
  public function asBooleanLiteral(): \ElevenLabs\Types\AstBooleanNodeOutput
  {
    if (!$this->isBooleanLiteral()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstBooleanNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstNullNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstNullNodeOutput
   */
  public function asNullLiteral(): \ElevenLabs\Types\AstNullNodeOutput
  {
    if (!$this->isNullLiteral()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstNullNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstllmNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstllmNodeOutput
   */
  public function asLlm(): \ElevenLabs\Types\AstllmNodeOutput
  {
    if (!$this->isLlm()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstllmNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstDynamicVariableNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstDynamicVariableNodeOutput
   */
  public function asDynamicVariable(): \ElevenLabs\Types\AstDynamicVariableNodeOutput
  {
    if (!$this->isDynamicVariable()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstDynamicVariableNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstOrOperatorNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstOrOperatorNodeOutput
   */
  public function asOrOperator(): \ElevenLabs\Types\AstOrOperatorNodeOutput
  {
    if (!$this->isOrOperator()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstOrOperatorNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstAndOperatorNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstAndOperatorNodeOutput
   */
  public function asAndOperator(): \ElevenLabs\Types\AstAndOperatorNodeOutput
  {
    if (!$this->isAndOperator()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstAndOperatorNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstEqualsOperatorNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstEqualsOperatorNodeOutput
   */
  public function asEqOperator(): \ElevenLabs\Types\AstEqualsOperatorNodeOutput
  {
    if (!$this->isEqOperator()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstEqualsOperatorNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstNotEqualsOperatorNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstNotEqualsOperatorNodeOutput
   */
  public function asNeqOperator(): \ElevenLabs\Types\AstNotEqualsOperatorNodeOutput
  {
    if (!$this->isNeqOperator()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstNotEqualsOperatorNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstGreaterThanOperatorNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstGreaterThanOperatorNodeOutput
   */
  public function asGtOperator(): \ElevenLabs\Types\AstGreaterThanOperatorNodeOutput
  {
    if (!$this->isGtOperator()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstGreaterThanOperatorNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstLessThanOperatorNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstLessThanOperatorNodeOutput
   */
  public function asLtOperator(): \ElevenLabs\Types\AstLessThanOperatorNodeOutput
  {
    if (!$this->isLtOperator()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstLessThanOperatorNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput
   */
  public function asGteOperator(): \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput
  {
    if (!$this->isGteOperator()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput
   */
  public function asLteOperator(): \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput
  {
    if (!$this->isLteOperator()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstAdditionOperatorNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstAdditionOperatorNodeOutput
   */
  public function asAddOperator(): \ElevenLabs\Types\AstAdditionOperatorNodeOutput
  {
    if (!$this->isAddOperator()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstAdditionOperatorNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstSubtractionOperatorNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstSubtractionOperatorNodeOutput
   */
  public function asSubOperator(): \ElevenLabs\Types\AstSubtractionOperatorNodeOutput
  {
    if (!$this->isSubOperator()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstSubtractionOperatorNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstMultiplicationOperatorNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstMultiplicationOperatorNodeOutput
   */
  public function asMulOperator(): \ElevenLabs\Types\AstMultiplicationOperatorNodeOutput
  {
    if (!$this->isMulOperator()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstMultiplicationOperatorNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstDivisionOperatorNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstDivisionOperatorNodeOutput
   */
  public function asDivOperator(): \ElevenLabs\Types\AstDivisionOperatorNodeOutput
  {
    if (!$this->isDivOperator()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstDivisionOperatorNodeOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstConditionalOperatorNodeOutput value
   * @throws \RuntimeException if this AstNodeOutput does not contain a \ElevenLabs\Types\AstConditionalOperatorNodeOutput
   */
  public function asConditionalOperator(): \ElevenLabs\Types\AstConditionalOperatorNodeOutput
  {
    if (!$this->isConditionalOperator()) {
      throw new \RuntimeException(
        'AstNodeOutput does not contain \ElevenLabs\Types\AstConditionalOperatorNodeOutput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\AstStringNodeOutput value
   * @return \ElevenLabs\Types\AstStringNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstStringNodeOutput, null otherwise
   */
  public function tryAsStringLiteral(): ?\ElevenLabs\Types\AstStringNodeOutput
  {
    return $this->isStringLiteral() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstNumberNodeOutput value
   * @return \ElevenLabs\Types\AstNumberNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstNumberNodeOutput, null otherwise
   */
  public function tryAsNumberLiteral(): ?\ElevenLabs\Types\AstNumberNodeOutput
  {
    return $this->isNumberLiteral() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstBooleanNodeOutput value
   * @return \ElevenLabs\Types\AstBooleanNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstBooleanNodeOutput, null otherwise
   */
  public function tryAsBooleanLiteral(): ?\ElevenLabs\Types\AstBooleanNodeOutput
  {
    return $this->isBooleanLiteral() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstNullNodeOutput value
   * @return \ElevenLabs\Types\AstNullNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstNullNodeOutput, null otherwise
   */
  public function tryAsNullLiteral(): ?\ElevenLabs\Types\AstNullNodeOutput
  {
    return $this->isNullLiteral() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstllmNodeOutput value
   * @return \ElevenLabs\Types\AstllmNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstllmNodeOutput, null otherwise
   */
  public function tryAsLlm(): ?\ElevenLabs\Types\AstllmNodeOutput
  {
    return $this->isLlm() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstDynamicVariableNodeOutput value
   * @return \ElevenLabs\Types\AstDynamicVariableNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstDynamicVariableNodeOutput, null otherwise
   */
  public function tryAsDynamicVariable(): ?\ElevenLabs\Types\AstDynamicVariableNodeOutput
  {
    return $this->isDynamicVariable() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstOrOperatorNodeOutput value
   * @return \ElevenLabs\Types\AstOrOperatorNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstOrOperatorNodeOutput, null otherwise
   */
  public function tryAsOrOperator(): ?\ElevenLabs\Types\AstOrOperatorNodeOutput
  {
    return $this->isOrOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstAndOperatorNodeOutput value
   * @return \ElevenLabs\Types\AstAndOperatorNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstAndOperatorNodeOutput, null otherwise
   */
  public function tryAsAndOperator(): ?\ElevenLabs\Types\AstAndOperatorNodeOutput
  {
    return $this->isAndOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstEqualsOperatorNodeOutput value
   * @return \ElevenLabs\Types\AstEqualsOperatorNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstEqualsOperatorNodeOutput, null otherwise
   */
  public function tryAsEqOperator(): ?\ElevenLabs\Types\AstEqualsOperatorNodeOutput
  {
    return $this->isEqOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstNotEqualsOperatorNodeOutput value
   * @return \ElevenLabs\Types\AstNotEqualsOperatorNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstNotEqualsOperatorNodeOutput, null otherwise
   */
  public function tryAsNeqOperator(): ?\ElevenLabs\Types\AstNotEqualsOperatorNodeOutput
  {
    return $this->isNeqOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstGreaterThanOperatorNodeOutput value
   * @return \ElevenLabs\Types\AstGreaterThanOperatorNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstGreaterThanOperatorNodeOutput, null otherwise
   */
  public function tryAsGtOperator(): ?\ElevenLabs\Types\AstGreaterThanOperatorNodeOutput
  {
    return $this->isGtOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstLessThanOperatorNodeOutput value
   * @return \ElevenLabs\Types\AstLessThanOperatorNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstLessThanOperatorNodeOutput, null otherwise
   */
  public function tryAsLtOperator(): ?\ElevenLabs\Types\AstLessThanOperatorNodeOutput
  {
    return $this->isLtOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput value
   * @return \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput, null otherwise
   */
  public function tryAsGteOperator(): ?\ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput
  {
    return $this->isGteOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput value
   * @return \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput, null otherwise
   */
  public function tryAsLteOperator(): ?\ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput
  {
    return $this->isLteOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstAdditionOperatorNodeOutput value
   * @return \ElevenLabs\Types\AstAdditionOperatorNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstAdditionOperatorNodeOutput, null otherwise
   */
  public function tryAsAddOperator(): ?\ElevenLabs\Types\AstAdditionOperatorNodeOutput
  {
    return $this->isAddOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstSubtractionOperatorNodeOutput value
   * @return \ElevenLabs\Types\AstSubtractionOperatorNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstSubtractionOperatorNodeOutput, null otherwise
   */
  public function tryAsSubOperator(): ?\ElevenLabs\Types\AstSubtractionOperatorNodeOutput
  {
    return $this->isSubOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstMultiplicationOperatorNodeOutput value
   * @return \ElevenLabs\Types\AstMultiplicationOperatorNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstMultiplicationOperatorNodeOutput, null otherwise
   */
  public function tryAsMulOperator(): ?\ElevenLabs\Types\AstMultiplicationOperatorNodeOutput
  {
    return $this->isMulOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstDivisionOperatorNodeOutput value
   * @return \ElevenLabs\Types\AstDivisionOperatorNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstDivisionOperatorNodeOutput, null otherwise
   */
  public function tryAsDivOperator(): ?\ElevenLabs\Types\AstDivisionOperatorNodeOutput
  {
    return $this->isDivOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstConditionalOperatorNodeOutput value
   * @return \ElevenLabs\Types\AstConditionalOperatorNodeOutput|null Returns the value if this AstNodeOutput contains a \ElevenLabs\Types\AstConditionalOperatorNodeOutput, null otherwise
   */
  public function tryAsConditionalOperator(): ?\ElevenLabs\Types\AstConditionalOperatorNodeOutput
  {
    return $this->isConditionalOperator() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\AstStringNodeOutput): T $onStringLiteral
   * @param callable(\ElevenLabs\Types\AstNumberNodeOutput): T $onNumberLiteral
   * @param callable(\ElevenLabs\Types\AstBooleanNodeOutput): T $onBooleanLiteral
   * @param callable(\ElevenLabs\Types\AstNullNodeOutput): T $onNullLiteral
   * @param callable(\ElevenLabs\Types\AstllmNodeOutput): T $onLlm
   * @param callable(\ElevenLabs\Types\AstDynamicVariableNodeOutput): T $onDynamicVariable
   * @param callable(\ElevenLabs\Types\AstOrOperatorNodeOutput): T $onOrOperator
   * @param callable(\ElevenLabs\Types\AstAndOperatorNodeOutput): T $onAndOperator
   * @param callable(\ElevenLabs\Types\AstEqualsOperatorNodeOutput): T $onEqOperator
   * @param callable(\ElevenLabs\Types\AstNotEqualsOperatorNodeOutput): T $onNeqOperator
   * @param callable(\ElevenLabs\Types\AstGreaterThanOperatorNodeOutput): T $onGtOperator
   * @param callable(\ElevenLabs\Types\AstLessThanOperatorNodeOutput): T $onLtOperator
   * @param callable(\ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput): T $onGteOperator
   * @param callable(\ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput): T $onLteOperator
   * @param callable(\ElevenLabs\Types\AstAdditionOperatorNodeOutput): T $onAddOperator
   * @param callable(\ElevenLabs\Types\AstSubtractionOperatorNodeOutput): T $onSubOperator
   * @param callable(\ElevenLabs\Types\AstMultiplicationOperatorNodeOutput): T $onMulOperator
   * @param callable(\ElevenLabs\Types\AstDivisionOperatorNodeOutput): T $onDivOperator
   * @param callable(\ElevenLabs\Types\AstConditionalOperatorNodeOutput): T $onConditionalOperator
   * @return T
   */
  public function match(
    callable $onStringLiteral,
    callable $onNumberLiteral,
    callable $onBooleanLiteral,
    callable $onNullLiteral,
    callable $onLlm,
    callable $onDynamicVariable,
    callable $onOrOperator,
    callable $onAndOperator,
    callable $onEqOperator,
    callable $onNeqOperator,
    callable $onGtOperator,
    callable $onLtOperator,
    callable $onGteOperator,
    callable $onLteOperator,
    callable $onAddOperator,
    callable $onSubOperator,
    callable $onMulOperator,
    callable $onDivOperator,
    callable $onConditionalOperator
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onStringLiteral($this->value),
      1 => $onNumberLiteral($this->value),
      2 => $onBooleanLiteral($this->value),
      3 => $onNullLiteral($this->value),
      4 => $onLlm($this->value),
      5 => $onDynamicVariable($this->value),
      6 => $onOrOperator($this->value),
      7 => $onAndOperator($this->value),
      8 => $onEqOperator($this->value),
      9 => $onNeqOperator($this->value),
      10 => $onGtOperator($this->value),
      11 => $onLtOperator($this->value),
      12 => $onGteOperator($this->value),
      13 => $onLteOperator($this->value),
      14 => $onAddOperator($this->value),
      15 => $onSubOperator($this->value),
      16 => $onMulOperator($this->value),
      17 => $onDivOperator($this->value),
      18 => $onConditionalOperator($this->value),
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
    if (is_array($data) && isset($data['type']) && is_string($data['type'])) {
      switch ($data['type']) {
        case 'add_operator':
          return new self(\ElevenLabs\Types\AstAdditionOperatorNodeOutput::fromArray($data), 14);
        case 'and_operator':
          return new self(\ElevenLabs\Types\AstAndOperatorNodeOutput::fromArray($data), 7);
        case 'boolean_literal':
          return new self(\ElevenLabs\Types\AstBooleanNodeOutput::fromArray($data), 2);
        case 'conditional_operator':
          return new self(\ElevenLabs\Types\AstConditionalOperatorNodeOutput::fromArray($data), 18);
        case 'div_operator':
          return new self(\ElevenLabs\Types\AstDivisionOperatorNodeOutput::fromArray($data), 17);
        case 'dynamic_variable':
          return new self(\ElevenLabs\Types\AstDynamicVariableNodeOutput::fromArray($data), 5);
        case 'eq_operator':
          return new self(\ElevenLabs\Types\AstEqualsOperatorNodeOutput::fromArray($data), 8);
        case 'gt_operator':
          return new self(\ElevenLabs\Types\AstGreaterThanOperatorNodeOutput::fromArray($data), 10);
        case 'gte_operator':
          return new self(
            \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput::fromArray($data),
            12
          );
        case 'llm':
          return new self(\ElevenLabs\Types\AstllmNodeOutput::fromArray($data), 4);
        case 'lt_operator':
          return new self(\ElevenLabs\Types\AstLessThanOperatorNodeOutput::fromArray($data), 11);
        case 'lte_operator':
          return new self(
            \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput::fromArray($data),
            13
          );
        case 'mul_operator':
          return new self(
            \ElevenLabs\Types\AstMultiplicationOperatorNodeOutput::fromArray($data),
            16
          );
        case 'neq_operator':
          return new self(\ElevenLabs\Types\AstNotEqualsOperatorNodeOutput::fromArray($data), 9);
        case 'null_literal':
          return new self(\ElevenLabs\Types\AstNullNodeOutput::fromArray($data), 3);
        case 'number_literal':
          return new self(\ElevenLabs\Types\AstNumberNodeOutput::fromArray($data), 1);
        case 'or_operator':
          return new self(\ElevenLabs\Types\AstOrOperatorNodeOutput::fromArray($data), 6);
        case 'string_literal':
          return new self(\ElevenLabs\Types\AstStringNodeOutput::fromArray($data), 0);
        case 'sub_operator':
          return new self(\ElevenLabs\Types\AstSubtractionOperatorNodeOutput::fromArray($data), 15);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\AstStringNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstStringNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstNumberNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstNumberNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstBooleanNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstBooleanNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstNullNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstNullNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstllmNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstllmNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstDynamicVariableNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstDynamicVariableNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstOrOperatorNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstOrOperatorNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstAndOperatorNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstAndOperatorNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstEqualsOperatorNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstEqualsOperatorNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstNotEqualsOperatorNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstNotEqualsOperatorNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstGreaterThanOperatorNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 10, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstGreaterThanOperatorNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstLessThanOperatorNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 11, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstLessThanOperatorNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 12, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 13, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstAdditionOperatorNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 14, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstAdditionOperatorNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstSubtractionOperatorNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 15, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstSubtractionOperatorNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstMultiplicationOperatorNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 16, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstMultiplicationOperatorNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstDivisionOperatorNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 17, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstDivisionOperatorNodeOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstConditionalOperatorNodeOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 18, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstConditionalOperatorNodeOutput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any AstNodeOutput type');
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
