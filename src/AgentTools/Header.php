<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

/**
 * The value of a webhook request header. Static constructors only.
 *
 * Hand-written (see `.fernignore`), mirroring the tool builder in the Python/TS SDKs.
 */
final class Header
{
  /**
   * @param string|array<string, string> $wire Use the static constructors.
   */
  private function __construct(private readonly string|array $wire)
  {
  }

  /** A fixed value. */
  public static function value(string $text): self
  {
    return new self($text);
  }

  /** A secret from the workspace's secret store, so the value never appears in the config. */
  public static function secret(string $secretId): self
  {
    return new self(['secret_id' => $secretId]);
  }

  /** The value of a dynamic variable when the tool runs. */
  public static function variable(string $name): self
  {
    return new self(['variable_name' => $name]);
  }

  /** A workspace environment variable, by label. */
  public static function envVar(string $label): self
  {
    return new self(['env_var_label' => $label]);
  }

  /**
   * @internal The header value in API wire format.
   * @return string|array<string, string>
   */
  public function toWire(): string|array
  {
    return $this->wire;
  }
}
