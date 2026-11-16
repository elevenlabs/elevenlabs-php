<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * When an edge may be followed. A plain string passed where a condition is expected is
 * shorthand for {@see Condition::llm()}, and an {@see Expr} is shorthand for
 * {@see Condition::expr()}. `label` is shown on the edge in the workflow editor.
 *
 * Static constructors only. Hand-written (see `.fernignore`).
 */
final class Condition
{
  /**
   * @param array<string, mixed> $model Use the static constructors; the condition is kept in wire format.
   */
  private function __construct(private readonly array $model)
  {
  }

  /** Followed when the LLM judges `$condition` to be true. */
  public static function llm(string $condition, ?string $label = null): self
  {
    return new self(self::labelled(['type' => 'llm', 'condition' => $condition], $label));
  }

  /** Followed when `$expression` evaluates to true. */
  public static function expr(Expr $expression, ?string $label = null): self
  {
    return new self(self::labelled(['type' => 'expression', 'expression' => $expression->toWire()], $label));
  }

  /** Always followed. */
  public static function always(?string $label = null): self
  {
    return new self(self::labelled(['type' => 'unconditional'], $label));
  }

  /** Followed when every tool in a tool node succeeded. */
  public static function success(?string $label = null): self
  {
    return new self(self::labelled(['type' => 'result', 'successful' => true], $label));
  }

  /** Followed when any tool in a tool node failed. */
  public static function failure(?string $label = null): self
  {
    return new self(self::labelled(['type' => 'result', 'successful' => false], $label));
  }

  /**
   * The condition in API wire format.
   *
   * @return array<string, mixed>
   */
  public function toWire(): array
  {
    /** @var array<string, mixed> $copy */
    $copy = Wire::deepCopy($this->model);
    return $copy;
  }

  /**
   * Coerce the accepted shorthands into a Condition: a Condition is returned as-is, an Expr
   * becomes `Condition::expr()`, and a string becomes `Condition::llm()`.
   */
  public static function from(Condition|Expr|string $value): self
  {
    if ($value instanceof self) {
      return $value;
    }
    if ($value instanceof Expr) {
      return self::expr($value);
    }
    return self::llm($value);
  }

  /**
   * @param array<string, mixed> $model
   * @return array<string, mixed>
   */
  private static function labelled(array $model, ?string $label): array
  {
    if ($label !== null) {
      $model['label'] = $label;
    }
    return $model;
  }
}
