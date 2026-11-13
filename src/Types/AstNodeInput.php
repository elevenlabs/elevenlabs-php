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
class AstNodeInput extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\AstStringNodeInput|\ElevenLabs\Types\AstNumberNodeInput|\ElevenLabs\Types\AstBooleanNodeInput|\ElevenLabs\Types\AstNullNodeInput|\ElevenLabs\Types\AstNodeInputLlm|\ElevenLabs\Types\AstDynamicVariableNodeInput|\ElevenLabs\Types\AstOrOperatorNodeInput|\ElevenLabs\Types\AstAndOperatorNodeInput|\ElevenLabs\Types\AstEqualsOperatorNodeInput|\ElevenLabs\Types\AstNotEqualsOperatorNodeInput|\ElevenLabs\Types\AstGreaterThanOperatorNodeInput|\ElevenLabs\Types\AstLessThanOperatorNodeInput|\ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput|\ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput|\ElevenLabs\Types\AstAdditionOperatorNodeInput|\ElevenLabs\Types\AstSubtractionOperatorNodeInput|\ElevenLabs\Types\AstMultiplicationOperatorNodeInput|\ElevenLabs\Types\AstDivisionOperatorNodeInput|\ElevenLabs\Types\AstConditionalOperatorNodeInput|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this AstNodeInput holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('AstNodeInput does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\AstStringNodeInput|\ElevenLabs\Types\AstNumberNodeInput|\ElevenLabs\Types\AstBooleanNodeInput|\ElevenLabs\Types\AstNullNodeInput|\ElevenLabs\Types\AstNodeInputLlm|\ElevenLabs\Types\AstDynamicVariableNodeInput|\ElevenLabs\Types\AstOrOperatorNodeInput|\ElevenLabs\Types\AstAndOperatorNodeInput|\ElevenLabs\Types\AstEqualsOperatorNodeInput|\ElevenLabs\Types\AstNotEqualsOperatorNodeInput|\ElevenLabs\Types\AstGreaterThanOperatorNodeInput|\ElevenLabs\Types\AstLessThanOperatorNodeInput|\ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput|\ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput|\ElevenLabs\Types\AstAdditionOperatorNodeInput|\ElevenLabs\Types\AstSubtractionOperatorNodeInput|\ElevenLabs\Types\AstMultiplicationOperatorNodeInput|\ElevenLabs\Types\AstDivisionOperatorNodeInput|\ElevenLabs\Types\AstConditionalOperatorNodeInput|array<string, mixed> $value
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
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstStringNodeInput
   */
  public static function stringLiteral(\ElevenLabs\Types\AstStringNodeInput $stringLiteral): self
  {
    return new self($stringLiteral, 0);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstNumberNodeInput
   */
  public static function numberLiteral(\ElevenLabs\Types\AstNumberNodeInput $numberLiteral): self
  {
    return new self($numberLiteral, 1);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstBooleanNodeInput
   */
  public static function booleanLiteral(\ElevenLabs\Types\AstBooleanNodeInput $booleanLiteral): self
  {
    return new self($booleanLiteral, 2);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstNullNodeInput
   */
  public static function nullLiteral(\ElevenLabs\Types\AstNullNodeInput $nullLiteral): self
  {
    return new self($nullLiteral, 3);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstNodeInputLlm
   */
  public static function llm(\ElevenLabs\Types\AstNodeInputLlm $llm): self
  {
    return new self($llm, 4);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstDynamicVariableNodeInput
   */
  public static function dynamicVariable(
    \ElevenLabs\Types\AstDynamicVariableNodeInput $dynamicVariable
  ): self {
    return new self($dynamicVariable, 5);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstOrOperatorNodeInput
   */
  public static function orOperator(\ElevenLabs\Types\AstOrOperatorNodeInput $orOperator): self
  {
    return new self($orOperator, 6);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstAndOperatorNodeInput
   */
  public static function andOperator(\ElevenLabs\Types\AstAndOperatorNodeInput $andOperator): self
  {
    return new self($andOperator, 7);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstEqualsOperatorNodeInput
   */
  public static function eqOperator(\ElevenLabs\Types\AstEqualsOperatorNodeInput $eqOperator): self
  {
    return new self($eqOperator, 8);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstNotEqualsOperatorNodeInput
   */
  public static function neqOperator(
    \ElevenLabs\Types\AstNotEqualsOperatorNodeInput $neqOperator
  ): self {
    return new self($neqOperator, 9);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstGreaterThanOperatorNodeInput
   */
  public static function gtOperator(
    \ElevenLabs\Types\AstGreaterThanOperatorNodeInput $gtOperator
  ): self {
    return new self($gtOperator, 10);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstLessThanOperatorNodeInput
   */
  public static function ltOperator(
    \ElevenLabs\Types\AstLessThanOperatorNodeInput $ltOperator
  ): self {
    return new self($ltOperator, 11);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput
   */
  public static function gteOperator(
    \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput $gteOperator
  ): self {
    return new self($gteOperator, 12);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput
   */
  public static function lteOperator(
    \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput $lteOperator
  ): self {
    return new self($lteOperator, 13);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstAdditionOperatorNodeInput
   */
  public static function addOperator(
    \ElevenLabs\Types\AstAdditionOperatorNodeInput $addOperator
  ): self {
    return new self($addOperator, 14);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstSubtractionOperatorNodeInput
   */
  public static function subOperator(
    \ElevenLabs\Types\AstSubtractionOperatorNodeInput $subOperator
  ): self {
    return new self($subOperator, 15);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstMultiplicationOperatorNodeInput
   */
  public static function mulOperator(
    \ElevenLabs\Types\AstMultiplicationOperatorNodeInput $mulOperator
  ): self {
    return new self($mulOperator, 16);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstDivisionOperatorNodeInput
   */
  public static function divOperator(
    \ElevenLabs\Types\AstDivisionOperatorNodeInput $divOperator
  ): self {
    return new self($divOperator, 17);
  }

  /**
   * Create a AstNodeInput instance containing a \ElevenLabs\Types\AstConditionalOperatorNodeInput
   */
  public static function conditionalOperator(
    \ElevenLabs\Types\AstConditionalOperatorNodeInput $conditionalOperator
  ): self {
    return new self($conditionalOperator, 18);
  }

  // Type checking methods
  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstStringNodeInput
   */
  public function isStringLiteral(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstNumberNodeInput
   */
  public function isNumberLiteral(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstBooleanNodeInput
   */
  public function isBooleanLiteral(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstNullNodeInput
   */
  public function isNullLiteral(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstNodeInputLlm
   */
  public function isLlm(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstDynamicVariableNodeInput
   */
  public function isDynamicVariable(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstOrOperatorNodeInput
   */
  public function isOrOperator(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstAndOperatorNodeInput
   */
  public function isAndOperator(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstEqualsOperatorNodeInput
   */
  public function isEqOperator(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstNotEqualsOperatorNodeInput
   */
  public function isNeqOperator(): bool
  {
    return $this->typeIndex === 9;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstGreaterThanOperatorNodeInput
   */
  public function isGtOperator(): bool
  {
    return $this->typeIndex === 10;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstLessThanOperatorNodeInput
   */
  public function isLtOperator(): bool
  {
    return $this->typeIndex === 11;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput
   */
  public function isGteOperator(): bool
  {
    return $this->typeIndex === 12;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput
   */
  public function isLteOperator(): bool
  {
    return $this->typeIndex === 13;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstAdditionOperatorNodeInput
   */
  public function isAddOperator(): bool
  {
    return $this->typeIndex === 14;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstSubtractionOperatorNodeInput
   */
  public function isSubOperator(): bool
  {
    return $this->typeIndex === 15;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstMultiplicationOperatorNodeInput
   */
  public function isMulOperator(): bool
  {
    return $this->typeIndex === 16;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstDivisionOperatorNodeInput
   */
  public function isDivOperator(): bool
  {
    return $this->typeIndex === 17;
  }

  /**
   * Check if this AstNodeInput contains a \ElevenLabs\Types\AstConditionalOperatorNodeInput
   */
  public function isConditionalOperator(): bool
  {
    return $this->typeIndex === 18;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\AstStringNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstStringNodeInput
   */
  public function asStringLiteral(): \ElevenLabs\Types\AstStringNodeInput
  {
    if (!$this->isStringLiteral()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstStringNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstNumberNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstNumberNodeInput
   */
  public function asNumberLiteral(): \ElevenLabs\Types\AstNumberNodeInput
  {
    if (!$this->isNumberLiteral()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstNumberNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstBooleanNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstBooleanNodeInput
   */
  public function asBooleanLiteral(): \ElevenLabs\Types\AstBooleanNodeInput
  {
    if (!$this->isBooleanLiteral()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstBooleanNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstNullNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstNullNodeInput
   */
  public function asNullLiteral(): \ElevenLabs\Types\AstNullNodeInput
  {
    if (!$this->isNullLiteral()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstNullNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstNodeInputLlm value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstNodeInputLlm
   */
  public function asLlm(): \ElevenLabs\Types\AstNodeInputLlm
  {
    if (!$this->isLlm()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstNodeInputLlm'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstDynamicVariableNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstDynamicVariableNodeInput
   */
  public function asDynamicVariable(): \ElevenLabs\Types\AstDynamicVariableNodeInput
  {
    if (!$this->isDynamicVariable()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstDynamicVariableNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstOrOperatorNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstOrOperatorNodeInput
   */
  public function asOrOperator(): \ElevenLabs\Types\AstOrOperatorNodeInput
  {
    if (!$this->isOrOperator()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstOrOperatorNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstAndOperatorNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstAndOperatorNodeInput
   */
  public function asAndOperator(): \ElevenLabs\Types\AstAndOperatorNodeInput
  {
    if (!$this->isAndOperator()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstAndOperatorNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstEqualsOperatorNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstEqualsOperatorNodeInput
   */
  public function asEqOperator(): \ElevenLabs\Types\AstEqualsOperatorNodeInput
  {
    if (!$this->isEqOperator()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstEqualsOperatorNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstNotEqualsOperatorNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstNotEqualsOperatorNodeInput
   */
  public function asNeqOperator(): \ElevenLabs\Types\AstNotEqualsOperatorNodeInput
  {
    if (!$this->isNeqOperator()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstNotEqualsOperatorNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstGreaterThanOperatorNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstGreaterThanOperatorNodeInput
   */
  public function asGtOperator(): \ElevenLabs\Types\AstGreaterThanOperatorNodeInput
  {
    if (!$this->isGtOperator()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstGreaterThanOperatorNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstLessThanOperatorNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstLessThanOperatorNodeInput
   */
  public function asLtOperator(): \ElevenLabs\Types\AstLessThanOperatorNodeInput
  {
    if (!$this->isLtOperator()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstLessThanOperatorNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput
   */
  public function asGteOperator(): \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput
  {
    if (!$this->isGteOperator()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput
   */
  public function asLteOperator(): \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput
  {
    if (!$this->isLteOperator()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstAdditionOperatorNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstAdditionOperatorNodeInput
   */
  public function asAddOperator(): \ElevenLabs\Types\AstAdditionOperatorNodeInput
  {
    if (!$this->isAddOperator()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstAdditionOperatorNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstSubtractionOperatorNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstSubtractionOperatorNodeInput
   */
  public function asSubOperator(): \ElevenLabs\Types\AstSubtractionOperatorNodeInput
  {
    if (!$this->isSubOperator()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstSubtractionOperatorNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstMultiplicationOperatorNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstMultiplicationOperatorNodeInput
   */
  public function asMulOperator(): \ElevenLabs\Types\AstMultiplicationOperatorNodeInput
  {
    if (!$this->isMulOperator()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstMultiplicationOperatorNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstDivisionOperatorNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstDivisionOperatorNodeInput
   */
  public function asDivOperator(): \ElevenLabs\Types\AstDivisionOperatorNodeInput
  {
    if (!$this->isDivOperator()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstDivisionOperatorNodeInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstConditionalOperatorNodeInput value
   * @throws \RuntimeException if this AstNodeInput does not contain a \ElevenLabs\Types\AstConditionalOperatorNodeInput
   */
  public function asConditionalOperator(): \ElevenLabs\Types\AstConditionalOperatorNodeInput
  {
    if (!$this->isConditionalOperator()) {
      throw new \RuntimeException(
        'AstNodeInput does not contain \ElevenLabs\Types\AstConditionalOperatorNodeInput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\AstStringNodeInput value
   * @return \ElevenLabs\Types\AstStringNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstStringNodeInput, null otherwise
   */
  public function tryAsStringLiteral(): ?\ElevenLabs\Types\AstStringNodeInput
  {
    return $this->isStringLiteral() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstNumberNodeInput value
   * @return \ElevenLabs\Types\AstNumberNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstNumberNodeInput, null otherwise
   */
  public function tryAsNumberLiteral(): ?\ElevenLabs\Types\AstNumberNodeInput
  {
    return $this->isNumberLiteral() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstBooleanNodeInput value
   * @return \ElevenLabs\Types\AstBooleanNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstBooleanNodeInput, null otherwise
   */
  public function tryAsBooleanLiteral(): ?\ElevenLabs\Types\AstBooleanNodeInput
  {
    return $this->isBooleanLiteral() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstNullNodeInput value
   * @return \ElevenLabs\Types\AstNullNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstNullNodeInput, null otherwise
   */
  public function tryAsNullLiteral(): ?\ElevenLabs\Types\AstNullNodeInput
  {
    return $this->isNullLiteral() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstNodeInputLlm value
   * @return \ElevenLabs\Types\AstNodeInputLlm|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstNodeInputLlm, null otherwise
   */
  public function tryAsLlm(): ?\ElevenLabs\Types\AstNodeInputLlm
  {
    return $this->isLlm() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstDynamicVariableNodeInput value
   * @return \ElevenLabs\Types\AstDynamicVariableNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstDynamicVariableNodeInput, null otherwise
   */
  public function tryAsDynamicVariable(): ?\ElevenLabs\Types\AstDynamicVariableNodeInput
  {
    return $this->isDynamicVariable() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstOrOperatorNodeInput value
   * @return \ElevenLabs\Types\AstOrOperatorNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstOrOperatorNodeInput, null otherwise
   */
  public function tryAsOrOperator(): ?\ElevenLabs\Types\AstOrOperatorNodeInput
  {
    return $this->isOrOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstAndOperatorNodeInput value
   * @return \ElevenLabs\Types\AstAndOperatorNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstAndOperatorNodeInput, null otherwise
   */
  public function tryAsAndOperator(): ?\ElevenLabs\Types\AstAndOperatorNodeInput
  {
    return $this->isAndOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstEqualsOperatorNodeInput value
   * @return \ElevenLabs\Types\AstEqualsOperatorNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstEqualsOperatorNodeInput, null otherwise
   */
  public function tryAsEqOperator(): ?\ElevenLabs\Types\AstEqualsOperatorNodeInput
  {
    return $this->isEqOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstNotEqualsOperatorNodeInput value
   * @return \ElevenLabs\Types\AstNotEqualsOperatorNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstNotEqualsOperatorNodeInput, null otherwise
   */
  public function tryAsNeqOperator(): ?\ElevenLabs\Types\AstNotEqualsOperatorNodeInput
  {
    return $this->isNeqOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstGreaterThanOperatorNodeInput value
   * @return \ElevenLabs\Types\AstGreaterThanOperatorNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstGreaterThanOperatorNodeInput, null otherwise
   */
  public function tryAsGtOperator(): ?\ElevenLabs\Types\AstGreaterThanOperatorNodeInput
  {
    return $this->isGtOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstLessThanOperatorNodeInput value
   * @return \ElevenLabs\Types\AstLessThanOperatorNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstLessThanOperatorNodeInput, null otherwise
   */
  public function tryAsLtOperator(): ?\ElevenLabs\Types\AstLessThanOperatorNodeInput
  {
    return $this->isLtOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput value
   * @return \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput, null otherwise
   */
  public function tryAsGteOperator(): ?\ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput
  {
    return $this->isGteOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput value
   * @return \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput, null otherwise
   */
  public function tryAsLteOperator(): ?\ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput
  {
    return $this->isLteOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstAdditionOperatorNodeInput value
   * @return \ElevenLabs\Types\AstAdditionOperatorNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstAdditionOperatorNodeInput, null otherwise
   */
  public function tryAsAddOperator(): ?\ElevenLabs\Types\AstAdditionOperatorNodeInput
  {
    return $this->isAddOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstSubtractionOperatorNodeInput value
   * @return \ElevenLabs\Types\AstSubtractionOperatorNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstSubtractionOperatorNodeInput, null otherwise
   */
  public function tryAsSubOperator(): ?\ElevenLabs\Types\AstSubtractionOperatorNodeInput
  {
    return $this->isSubOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstMultiplicationOperatorNodeInput value
   * @return \ElevenLabs\Types\AstMultiplicationOperatorNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstMultiplicationOperatorNodeInput, null otherwise
   */
  public function tryAsMulOperator(): ?\ElevenLabs\Types\AstMultiplicationOperatorNodeInput
  {
    return $this->isMulOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstDivisionOperatorNodeInput value
   * @return \ElevenLabs\Types\AstDivisionOperatorNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstDivisionOperatorNodeInput, null otherwise
   */
  public function tryAsDivOperator(): ?\ElevenLabs\Types\AstDivisionOperatorNodeInput
  {
    return $this->isDivOperator() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstConditionalOperatorNodeInput value
   * @return \ElevenLabs\Types\AstConditionalOperatorNodeInput|null Returns the value if this AstNodeInput contains a \ElevenLabs\Types\AstConditionalOperatorNodeInput, null otherwise
   */
  public function tryAsConditionalOperator(): ?\ElevenLabs\Types\AstConditionalOperatorNodeInput
  {
    return $this->isConditionalOperator() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\AstStringNodeInput): T $onStringLiteral
   * @param callable(\ElevenLabs\Types\AstNumberNodeInput): T $onNumberLiteral
   * @param callable(\ElevenLabs\Types\AstBooleanNodeInput): T $onBooleanLiteral
   * @param callable(\ElevenLabs\Types\AstNullNodeInput): T $onNullLiteral
   * @param callable(\ElevenLabs\Types\AstNodeInputLlm): T $onLlm
   * @param callable(\ElevenLabs\Types\AstDynamicVariableNodeInput): T $onDynamicVariable
   * @param callable(\ElevenLabs\Types\AstOrOperatorNodeInput): T $onOrOperator
   * @param callable(\ElevenLabs\Types\AstAndOperatorNodeInput): T $onAndOperator
   * @param callable(\ElevenLabs\Types\AstEqualsOperatorNodeInput): T $onEqOperator
   * @param callable(\ElevenLabs\Types\AstNotEqualsOperatorNodeInput): T $onNeqOperator
   * @param callable(\ElevenLabs\Types\AstGreaterThanOperatorNodeInput): T $onGtOperator
   * @param callable(\ElevenLabs\Types\AstLessThanOperatorNodeInput): T $onLtOperator
   * @param callable(\ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput): T $onGteOperator
   * @param callable(\ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput): T $onLteOperator
   * @param callable(\ElevenLabs\Types\AstAdditionOperatorNodeInput): T $onAddOperator
   * @param callable(\ElevenLabs\Types\AstSubtractionOperatorNodeInput): T $onSubOperator
   * @param callable(\ElevenLabs\Types\AstMultiplicationOperatorNodeInput): T $onMulOperator
   * @param callable(\ElevenLabs\Types\AstDivisionOperatorNodeInput): T $onDivOperator
   * @param callable(\ElevenLabs\Types\AstConditionalOperatorNodeInput): T $onConditionalOperator
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
        case 'llm':
          return new self(\ElevenLabs\Types\AstNodeInputLlm::fromArray($data), 4);
        case 'add_operator':
          return new self(\ElevenLabs\Types\AstAdditionOperatorNodeInput::fromArray($data), 14);
        case 'and_operator':
          return new self(\ElevenLabs\Types\AstAndOperatorNodeInput::fromArray($data), 7);
        case 'boolean_literal':
          return new self(\ElevenLabs\Types\AstBooleanNodeInput::fromArray($data), 2);
        case 'conditional_operator':
          return new self(\ElevenLabs\Types\AstConditionalOperatorNodeInput::fromArray($data), 18);
        case 'div_operator':
          return new self(\ElevenLabs\Types\AstDivisionOperatorNodeInput::fromArray($data), 17);
        case 'dynamic_variable':
          return new self(\ElevenLabs\Types\AstDynamicVariableNodeInput::fromArray($data), 5);
        case 'eq_operator':
          return new self(\ElevenLabs\Types\AstEqualsOperatorNodeInput::fromArray($data), 8);
        case 'gt_operator':
          return new self(\ElevenLabs\Types\AstGreaterThanOperatorNodeInput::fromArray($data), 10);
        case 'gte_operator':
          return new self(
            \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput::fromArray($data),
            12
          );
        case 'lt_operator':
          return new self(\ElevenLabs\Types\AstLessThanOperatorNodeInput::fromArray($data), 11);
        case 'lte_operator':
          return new self(
            \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput::fromArray($data),
            13
          );
        case 'mul_operator':
          return new self(
            \ElevenLabs\Types\AstMultiplicationOperatorNodeInput::fromArray($data),
            16
          );
        case 'neq_operator':
          return new self(\ElevenLabs\Types\AstNotEqualsOperatorNodeInput::fromArray($data), 9);
        case 'null_literal':
          return new self(\ElevenLabs\Types\AstNullNodeInput::fromArray($data), 3);
        case 'number_literal':
          return new self(\ElevenLabs\Types\AstNumberNodeInput::fromArray($data), 1);
        case 'or_operator':
          return new self(\ElevenLabs\Types\AstOrOperatorNodeInput::fromArray($data), 6);
        case 'string_literal':
          return new self(\ElevenLabs\Types\AstStringNodeInput::fromArray($data), 0);
        case 'sub_operator':
          return new self(\ElevenLabs\Types\AstSubtractionOperatorNodeInput::fromArray($data), 15);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\AstStringNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstStringNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstNumberNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstNumberNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstBooleanNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstBooleanNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstNullNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstNullNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstNodeInputLlm::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstNodeInputLlm didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstDynamicVariableNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstDynamicVariableNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstOrOperatorNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstOrOperatorNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstAndOperatorNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstAndOperatorNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstEqualsOperatorNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstEqualsOperatorNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstNotEqualsOperatorNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstNotEqualsOperatorNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstGreaterThanOperatorNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 10, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstGreaterThanOperatorNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstLessThanOperatorNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 11, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstLessThanOperatorNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 12, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstGreaterThanOrEqualsOperatorNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 13, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstLessThanOrEqualsOperatorNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstAdditionOperatorNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 14, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstAdditionOperatorNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstSubtractionOperatorNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 15, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstSubtractionOperatorNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstMultiplicationOperatorNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 16, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstMultiplicationOperatorNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstDivisionOperatorNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 17, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstDivisionOperatorNodeInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstConditionalOperatorNodeInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 18, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstConditionalOperatorNodeInput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any AstNodeInput type');
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
