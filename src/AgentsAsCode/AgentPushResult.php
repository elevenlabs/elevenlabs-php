<?php

declare(strict_types=1);

namespace ElevenLabs\AgentsAsCode;

/**
 * What {@see AgentsAsCode::push()} did. On an {@see AgentPushError}, holds what was written
 * before the failure: `agentId` and `action` stay null until the agent itself was written.
 *
 * Hand-written (see `.fernignore`).
 */
final class AgentPushResult
{
  /** The agent's id. */
  public ?string $agentId = null;

  /** @var "created"|"updated"|null What happened to the agent. */
  public ?string $action = null;

  /** @var array<string, ToolPushResult> Each tool `push` touched, by name. */
  public array $tools = [];

  /**
   * The result as plain arrays: `['agentId' => ..., 'action' => ..., 'tools' => [name => ['id' => ..., 'action' => ...]]]`.
   * Unset fields are left out.
   *
   * @return array<string, mixed>
   */
  public function toArray(): array
  {
    $tools = [];
    foreach ($this->tools as $name => $tool) {
      $tools[(string) $name] = ['id' => $tool->id, 'action' => $tool->action];
    }
    $out = [];
    if ($this->agentId !== null) {
      $out['agentId'] = $this->agentId;
    }
    if ($this->action !== null) {
      $out['action'] = $this->action;
    }
    $out['tools'] = $tools;
    return $out;
  }
}
