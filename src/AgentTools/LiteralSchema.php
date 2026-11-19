<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

/**
 * A string, integer, number or boolean schema. Create one with {@see Schema::string()},
 * {@see Schema::integer()}, {@see Schema::number()} or {@see Schema::bool()}.
 *
 * Hand-written (see `.fernignore`), mirroring the tool builder in the Python/TS SDKs.
 */
final class LiteralSchema extends Schema
{
  /**
   * The values the LLM may choose from (`enum`). Strings only. Named `choices` because `enum` is
   * reserved in PHP 8.1+.
   *
   * @param list<string> $values
   */
  public function choices(array $values): static
  {
    $copy = clone $this;
    $copy->choices = array_values($values);
    return $copy;
  }

  /** The value is filled in by the system at runtime. */
  public function systemProvided(): static
  {
    $copy = clone $this;
    $copy->systemProvided = true;
    return $copy;
  }

  /**
   * Rejects an LLM value that isn't in the list held by the dynamic variable `$variable`. The
   * list isn't shown to the LLM. Needs `describe()`.
   */
  public function allowedFrom(string $variable): static
  {
    $copy = clone $this;
    $copy->allowedFrom = $variable;
    return $copy;
  }
}
