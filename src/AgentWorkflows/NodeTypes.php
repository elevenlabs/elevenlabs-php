<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * Which node types this SDK version's generated request model can represent. Mirrors the
 * discriminants of the generated `Workflow*NodeModelInput` union
 * ({@see \ElevenLabs\Types\AgentWorkflowRequestModelNodesValue}); a node type outside this
 * set round-trips through `toJson()`/`fromJson()` but earns an `unknown_node_type` warning
 * from `build()`.
 *
 * Hand-written (see `.fernignore`). Keep in sync with the generated node models.
 */
final class NodeTypes
{
  /** @var list<string> */
  private const KNOWN = [
    'start',
    'end',
    'tool',
    'override_agent',
    'standalone_agent',
    'phone_number',
    'say',
    'update_state',
  ];

  public static function modelKnowsNodeType(mixed $type): bool
  {
    return is_string($type) && in_array($type, self::KNOWN, true);
  }
}
