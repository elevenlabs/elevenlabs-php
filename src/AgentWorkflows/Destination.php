<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * Where a `transfer()` node hands the conversation off to. Static constructors only.
 *
 * Hand-written (see `.fernignore`), mirroring the workflow builder in the Python/TS SDKs.
 */
final class Destination
{
  /**
   * @param array<string, mixed> $model Use the static constructors; the node fields the destination sets, in wire format.
   */
  private function __construct(private readonly array $model)
  {
  }

  /** A phone number in E.164 format. */
  public static function phone(string $phoneNumber): self
  {
    return new self([
      'type' => 'phone_number',
      'transfer_destination' => ['type' => 'phone', 'phone_number' => $phoneNumber],
    ]);
  }

  /** A phone number read from a dynamic variable at transfer time. */
  public static function phoneVariable(string $variableName): self
  {
    return new self([
      'type' => 'phone_number',
      'transfer_destination' => ['type' => 'phone_dynamic_variable', 'phone_number' => $variableName],
    ]);
  }

  /** A SIP URI. */
  public static function sip(string $sipUri): self
  {
    return new self([
      'type' => 'phone_number',
      'transfer_destination' => ['type' => 'sip_uri', 'sip_uri' => $sipUri],
    ]);
  }

  /** A SIP URI read from a dynamic variable at transfer time. */
  public static function sipVariable(string $variableName): self
  {
    return new self([
      'type' => 'phone_number',
      'transfer_destination' => ['type' => 'sip_uri_dynamic_variable', 'sip_uri' => $variableName],
    ]);
  }

  /** Another ElevenLabs agent. `$nodeId` is the node in its workflow to start from. */
  public static function agent(string $agentId, ?string $nodeId = null): self
  {
    $model = ['type' => 'standalone_agent', 'agent_id' => $agentId];
    if ($nodeId !== null) {
      $model['node_id'] = $nodeId;
    }
    return new self($model);
  }

  /**
   * The node fields this destination sets, in API wire format.
   *
   * @return array<string, mixed>
   */
  public function toWire(): array
  {
    /** @var array<string, mixed> $copy */
    $copy = Wire::deepCopy($this->model);
    return $copy;
  }
}
