<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

/**
 * The auth connection a webhook tool authenticates with. Static constructors only.
 *
 * Hand-written (see `.fernignore`), mirroring the tool builder in the Python/TS SDKs.
 */
final class AuthConnection
{
  /**
   * @param array<string, string> $wire Use the static constructors.
   */
  private function __construct(private readonly array $wire)
  {
  }

  /** An auth connection from the workspace's store, by id. */
  public static function id(string $authConnectionId): self
  {
    return new self(['auth_connection_id' => $authConnectionId]);
  }

  /** An environment variable of type auth connection, by label, resolved for the current environment. */
  public static function envVar(string $label): self
  {
    return new self(['env_var_label' => $label]);
  }

  /**
   * @internal The auth connection in API wire format.
   * @return array<string, string>
   */
  public function toWire(): array
  {
    return $this->wire;
  }
}
