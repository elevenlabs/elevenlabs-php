<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * Mutable state shared by a {@see Workflow} and every node handle created from it. Nodes are
 * kept in wire format (associative arrays).
 *
 * Hand-written (see `.fernignore`), mirroring the workflow builder in the Python/TS SDKs.
 */
final class WorkflowGraph
{
  /** @var array<string, array<string, mixed>> Node id → wire-format model, in insertion order. */
  public array $nodes = [];

  /** @var list<GraphEdge> */
  public array $edges = [];

  /** @var list<WorkflowIssue> */
  public array $issues = [];

  public string $startId = 'start_node';

  /** @var array<string, list<GraphEdge>> Each loaded node's edge_order, as edges. */
  public array $loadedOrder = [];

  public ?bool $preventSubagentLoops = null;

  /** Canonical option name → API field, per node type. */
  private const FIELDS = [
    'start' => ['position' => 'position'],
    'end' => ['position' => 'position'],
    'override_agent' => [
      'position' => 'position',
      'prompt' => 'additional_prompt',
      'label' => 'label',
      'tool_ids' => 'additional_tool_ids',
      'knowledge_base' => 'additional_knowledge_base',
      'conversation_config' => 'conversation_config',
      'entry_behavior' => 'entry_behavior',
    ],
    'tool' => ['position' => 'position'],
    'phone_number' => [
      'position' => 'position',
      'transfer_type' => 'transfer_type',
      'custom_sip_headers' => 'custom_sip_headers',
      'sip_refer_play_dialtone' => 'sip_refer_play_dialtone',
      'uui' => 'uui',
      'post_dial_digits' => 'post_dial_digits',
    ],
    'standalone_agent' => [
      'position' => 'position',
      'delay_ms' => 'delay_ms',
      'transfer_message' => 'transfer_message',
      'enable_transferred_agent_first_message' => 'enable_transferred_agent_first_message',
      'preserve_client_tts_overrides' => 'preserve_client_tts_overrides',
      'preserve_voice_settings' => 'preserve_voice_settings',
    ],
  ];

  private const NODE_KIND = [
    'start' => 'start',
    'end' => 'end',
    'override_agent' => 'subagent',
    'tool' => 'tool',
    'phone_number' => 'phone/SIP transfer',
    'standalone_agent' => 'agent transfer',
  ];

  private const TRANSFER_TYPES = ['phone_number', 'standalone_agent'];

  /**
   * @param array<string, mixed> $model
   */
  public function addNode(string $id, array $model): void
  {
    $existing = $this->nodes[$id] ?? null;
    if ($existing === null) {
      $this->nodes[$id] = $model;
    } elseif (!(($existing['type'] ?? null) === 'end' && ($model['type'] ?? null) === 'end')) {
      $this->issue('duplicate_node_id', "Node id \"{$id}\" is used by more than one node", $id);
    }
  }

  public function issue(string $code, string $message, ?string $nodeId): void
  {
    $this->issues[] = new WorkflowIssue($code, 'error', $message, $nodeId);
  }

  /**
   * Applies canonical options to a node model. Options set to null are ignored.
   *
   * @param array<string, mixed> $model
   * @param array<string, mixed> $options
   * @return array<string, mixed>
   */
  public function applyOptions(string $id, array $model, array $options): array
  {
    $rest = [];
    foreach ($options as $key => $value) {
      if ($value !== null) {
        $rest[$key] = $value;
      }
    }
    $destination = $rest['destination'] ?? null;
    unset($rest['destination']);
    $toolIds = $rest['tool_ids'] ?? null;
    unset($rest['tool_ids']);
    $schemaOverrides = $rest['schema_overrides'] ?? null;
    unset($rest['schema_overrides']);
    $node = $model;

    if ($destination instanceof Destination) {
      if (in_array($node['type'] ?? null, self::TRANSFER_TYPES, true)) {
        $dest = $destination->toWire();
        if (($dest['type'] ?? null) !== $node['type']) {
          $position = $node['position'] ?? null;
          $node = $dest;
          if ($position !== null) {
            $node['position'] = $position;
          }
        } else {
          if ($node['type'] === 'standalone_agent') {
            foreach (['agent_id', 'node_id', 'branch_id'] as $key) {
              unset($node[$key]);
            }
          }
          $node = array_merge($node, $dest);
        }
      } else {
        $this->invalidOption($id, 'destination', $node['type'] ?? null);
      }
    }

    if (($node['type'] ?? null) === 'tool') {
      /** @var list<array<string, mixed>> $existing */
      $existing = $node['tools'] ?? [];
      if ($toolIds !== null) {
        $ids = array_values($toolIds);
      } else {
        $ids = array_map(static fn(array $tool) => $tool['tool_id'], $existing);
      }
      foreach (array_keys($schemaOverrides ?? []) as $toolId) {
        if (!in_array($toolId, $ids, true)) {
          $this->issue(
            'invalid_option',
            "Node \"{$id}\" has schema overrides for tool \"{$toolId}\", which it doesn't run",
            $id
          );
        }
      }
      $tools = [];
      foreach ($ids as $toolId) {
        $overrides = $schemaOverrides[$toolId] ?? null;
        if ($overrides !== null) {
          $overrides = Wire::toWire($overrides);
        } else {
          $overrides = null;
          foreach ($existing as $tool) {
            if (($tool['tool_id'] ?? null) === $toolId) {
              $overrides = $tool['schema_overrides'] ?? null;
              break;
            }
          }
        }
        $tools[] = $overrides === null
          ? ['tool_id' => $toolId]
          : ['tool_id' => $toolId, 'schema_overrides' => $overrides];
      }
      $node['tools'] = $tools;
    } else {
      if ($schemaOverrides !== null) {
        $this->invalidOption($id, 'schema_overrides', $node['type'] ?? null);
      }
      if ($toolIds !== null) {
        $rest['tool_ids'] = array_values($toolIds);
      }
    }

    // Node kinds without a dedicated field map (e.g. generated say/update_state) still accept
    // position, which is common to every node kind.
    $fields = self::FIELDS[$node['type'] ?? ''] ?? ['position' => 'position'];
    foreach ($rest as $key => $value) {
      $field = $fields[$key] ?? null;
      if ($field === null) {
        $this->invalidOption($id, $key, $node['type'] ?? null);
      } else {
        $node[$field] = Wire::toWire($value);
      }
    }
    return $node;
  }

  /**
   * Replaces the graph's contents with an existing wire-format workflow, keeping ids,
   * positions and edge order.
   *
   * @param array<string, mixed> $workflow
   */
  public function load(array $workflow): void
  {
    $this->nodes = [];
    $this->edges = [];
    $this->issues = [];
    $this->loadedOrder = [];
    $this->preventSubagentLoops = $workflow['prevent_subagent_loops'] ?? null;

    // The top-level node/edge maps must be arrays for the loader. Decoding preserves an empty object
    // as \stdClass (so `{}` in nested payloads round-trips), so an edgeless workflow's `"edges": {}`
    // arrives here as a \stdClass; cast the structural maps to arrays. Nested payloads keep their
    // object identity (they are deep-copied below, not re-cast).
    /** @var array<string, array<string, mixed>> $nodes */
    $nodes = (array) ($workflow['nodes'] ?? []);
    /** @var array<string, array<string, mixed>> $edges */
    $edges = (array) ($workflow['edges'] ?? []);

    foreach ($nodes as $id => $node) {
      $copy = [];
      foreach ($node as $key => $value) {
        if ($key !== 'edge_order') {
          $copy[$key] = Wire::deepCopy($value);
        }
      }
      $this->nodes[(string) $id] = $copy;
    }

    $this->startId = 'start_node';
    foreach ($nodes as $id => $node) {
      if (($node['type'] ?? null) === 'start') {
        $this->startId = (string) $id;
        break;
      }
    }
    if (!isset($this->nodes[$this->startId])) {
      $this->nodes[$this->startId] = ['type' => 'start'];
    }

    /** @var array<string, GraphEdge> $placed */
    $placed = [];
    $addEdge = function (string $edgeId) use (&$placed, $edges): void {
      $edge = $edges[$edgeId] ?? null;
      if ($edge === null || isset($placed[$edgeId])) {
        return;
      }
      $rest = [];
      foreach ($edge as $key => $value) {
        $rest[$key] = Wire::deepCopy($value);
      }
      $source = $rest['source'] ?? null;
      unset($rest['source']);
      $target = $rest['target'] ?? null;
      unset($rest['target']);
      $forward = $rest['forward_condition'] ?? null;
      unset($rest['forward_condition']);
      $backward = $rest['backward_condition'] ?? null;
      unset($rest['backward_condition']);
      $graphEdge = new GraphEdge(
        source: (string) $source,
        target: (string) $target,
        forwardCondition: $forward,
        backwardCondition: $backward,
        id: $edgeId,
        extra: $rest,
      );
      $placed[$edgeId] = $graphEdge;
      $this->edges[] = $graphEdge;
    };

    foreach ($nodes as $id => $node) {
      $order = $node['edge_order'] ?? [];
      foreach ($order as $edgeId) {
        $addEdge((string) $edgeId);
      }
      $loaded = [];
      foreach ($order as $edgeId) {
        if (isset($placed[(string) $edgeId])) {
          $loaded[] = $placed[(string) $edgeId];
        }
      }
      $this->loadedOrder[(string) $id] = $loaded;
    }
    foreach (array_keys($edges) as $edgeId) {
      $addEdge((string) $edgeId);
    }
  }

  private function invalidOption(string $id, string $option, mixed $nodeType): void
  {
    $kind = (is_string($nodeType) && isset(self::NODE_KIND[$nodeType]))
      ? self::NODE_KIND[$nodeType]
      : '"' . (is_string($nodeType) ? $nodeType : 'null') . '"';
    $this->issue('invalid_option', "Option \"{$option}\" doesn't apply to {$kind} node \"{$id}\"", $id);
  }
}
