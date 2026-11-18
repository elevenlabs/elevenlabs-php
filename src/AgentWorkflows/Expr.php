<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * A workflow expression, compiled to the API's expression AST. Static constructors only,
 * so it translates directly to languages without union types or overloading.
 *
 * A plain value (string/int/float/bool/null) passed where an expression is expected becomes
 * a literal.
 *
 * Hand-written (see `.fernignore`), mirroring the workflow builder in the Python/TS SDKs.
 */
final class Expr
{
  /**
   * @param array<string, mixed> $node Use the static constructors; the AST is kept in wire format.
   */
  private function __construct(private readonly array $node)
  {
  }

  /** The value of a dynamic variable. */
  public static function variable(string $name): self
  {
    return new self(['type' => 'dynamic_variable', 'name' => $name]);
  }

  /** A string, number, boolean or null literal. */
  public static function literal(string|int|float|bool|null $value): self
  {
    if ($value === null) {
      return new self(['type' => 'null_literal']);
    }
    if (is_bool($value)) {
      return new self(['type' => 'boolean_literal', 'value' => $value]);
    }
    if (is_string($value)) {
      return new self(['type' => 'string_literal', 'value' => $value]);
    }
    return new self(['type' => 'number_literal', 'value' => $value]);
  }

  /**
   * A value the LLM extracts from the conversation. `$type` is "boolean" (default), "string",
   * "integer" or "number"; `$enum` lists the allowed values of a "string".
   *
   * @param list<string>|null $enum
   */
  public static function llm(string $description, string $type = 'boolean', ?array $enum = null): self
  {
    $schema = ['type' => $type, 'description' => $description];
    if ($enum !== null) {
      $schema['enum'] = array_values($enum);
    }
    return new self(['type' => 'llm', 'value_schema' => $schema]);
  }

  /** True when every expression is true. */
  public static function allOf(mixed ...$exprs): self
  {
    return new self(['type' => 'and_operator', 'children' => array_map([self::class, 'toAst'], $exprs)]);
  }

  /** True when at least one expression is true. */
  public static function anyOf(mixed ...$exprs): self
  {
    return new self(['type' => 'or_operator', 'children' => array_map([self::class, 'toAst'], $exprs)]);
  }

  /** `$whenTrue` if `$condition` is true, otherwise `$whenFalse`. */
  public static function ifElse(mixed $condition, mixed $whenTrue, mixed $whenFalse): self
  {
    return new self([
      'type' => 'conditional_operator',
      'condition' => self::toAst($condition),
      'trueExpression' => self::toAst($whenTrue),
      'falseExpression' => self::toAst($whenFalse),
    ]);
  }

  /**
   * Wrap an existing AST node: a generated model, or an array in wire format.
   */
  public static function fromModel(mixed $node): self
  {
    /** @var array<string, mixed> $wire */
    $wire = Wire::toWire($node);
    return new self($wire);
  }

  public function eq(mixed $other): self
  {
    return $this->binary('eq_operator', $other);
  }

  public function neq(mixed $other): self
  {
    return $this->binary('neq_operator', $other);
  }

  public function gt(mixed $other): self
  {
    return $this->binary('gt_operator', $other);
  }

  public function gte(mixed $other): self
  {
    return $this->binary('gte_operator', $other);
  }

  public function lt(mixed $other): self
  {
    return $this->binary('lt_operator', $other);
  }

  public function lte(mixed $other): self
  {
    return $this->binary('lte_operator', $other);
  }

  public function add(mixed $other): self
  {
    return $this->binary('add_operator', $other);
  }

  public function sub(mixed $other): self
  {
    return $this->binary('sub_operator', $other);
  }

  public function mul(mixed $other): self
  {
    return $this->binary('mul_operator', $other);
  }

  public function div(mixed $other): self
  {
    return $this->binary('div_operator', $other);
  }

  /**
   * The expression in API wire format.
   *
   * @return array<string, mixed>
   */
  public function toWire(): array
  {
    /** @var array<string, mixed> $copy */
    $copy = Wire::deepCopy($this->node);
    return $copy;
  }

  private function binary(string $type, mixed $other): self
  {
    return new self(['type' => $type, 'left' => $this->toWire(), 'right' => self::toAst($other)]);
  }

  /**
   * @return array<string, mixed>
   */
  private static function toAst(mixed $value): array
  {
    if ($value instanceof self) {
      return $value->toWire();
    }
    return self::literal($value)->toWire();
  }
}
