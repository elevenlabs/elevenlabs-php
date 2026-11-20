<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

use ElevenLabs\AgentTools\Tool;

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

  /**
   * `Tool` objects referenced by nodes, by placeholder (`<tool:NAME>`). Nodes hold the placeholder
   * until `build()` swaps in the tool's id.
   *
   * @var array<string, Tool>
   */
  public array $toolRefs = [];

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

  /** The placeholder a `Tool` object stands under in the graph until `build()` swaps in its id. */
  public static function toolPlaceholder(string $name): string
  {
    return "<tool:{$name}>";
  }

  /** A tool id as shown in messages: the name, for a `Tool` object's placeholder. */
  public static function displayTool(string $id): string
  {
    return preg_match('/^<tool:(.*)>$/s', $id, $match) === 1 ? $match[1] : $id;
  }

  /**
   * Swaps `Tool` objects for placeholders, remembering each one. Ids pass through.
   *
   * @param list<string|Tool> $refs
   * @return list<string>
   */
  public function refTools(string $nodeId, array $refs): array
  {
    /** @var array<string, Tool> $inThisNode */
    $inThisNode = [];
    $out = [];
    foreach ($refs as $ref) {
      if (!($ref instanceof Tool)) {
        $out[] = $ref;
        continue;
      }
      $key = self::toolPlaceholder($ref->name());
      $known = $this->toolRefs[$key] ?? null;
      // A different tool of the same name conflicts if this node or another node still uses it; one
      // left behind by a removed or edited node doesn't.
      $clash = $inThisNode[$key] ?? null;
      if ($clash === null && $known !== null && $this->usesPlaceholder($key, $nodeId)) {
        $clash = $known;
      }
      $inThisNode[$key] = $ref;
      if ($clash !== null && $clash !== $ref) {
        $this->issue(
          'duplicate_tool_name',
          "Node \"{$nodeId}\" uses a different tool also named \"{$ref->name()}\"",
          $nodeId
        );
      }
      $this->toolRefs[$key] = $ref;
      $out[] = $key;
    }
    return $out;
  }

  /**
   * The tool ids (or placeholders) a node uses: a tool node's tools, or a subagent's extra tools.
   *
   * @param array<string, mixed> $model
   * @return list<string>
   */
  public static function nodeToolIds(array $model): array
  {
    $ids = [];
    $tools = $model['tools'] ?? [];
    foreach (is_array($tools) ? $tools : [] as $tool) {
      if (is_array($tool) && is_string($tool['tool_id'] ?? null)) {
        $ids[] = $tool['tool_id'];
      }
    }
    $extra = $model['additional_tool_ids'] ?? [];
    foreach (is_array($extra) ? $extra : [] as $id) {
      if (is_string($id)) {
        $ids[] = $id;
      }
    }
    return $ids;
  }

  /**
   * A node with each tool id (or placeholder) replaced by `$map($id)`.
   *
   * @param array<string, mixed> $model
   * @param callable(string): string $map
   * @return array<string, mixed>
   */
  public static function mapNodeToolIds(array $model, callable $map): array
  {
    $type = $model['type'] ?? null;
    if ($type === 'tool' && is_array($model['tools'] ?? null)) {
      $tools = [];
      foreach ($model['tools'] as $tool) {
        if (is_array($tool) && is_string($tool['tool_id'] ?? null)) {
          $tool['tool_id'] = $map($tool['tool_id']);
        }
        $tools[] = $tool;
      }
      $model['tools'] = $tools;
    } elseif ($type === 'override_agent' && is_array($model['additional_tool_ids'] ?? null)) {
      $model['additional_tool_ids'] = array_map(
        static fn(mixed $id): mixed => is_string($id) ? $map($id) : $id,
        $model['additional_tool_ids']
      );
    }
    return $model;
  }

  private function usesPlaceholder(string $key, string $exceptNodeId): bool
  {
    foreach ($this->nodes as $id => $model) {
      if ((string) $id !== $exceptNodeId && in_array($key, self::nodeToolIds($model), true)) {
        return true;
      }
    }
    return false;
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
    $toolIds = is_array($toolIds) ? $this->refTools($id, array_values($toolIds)) : null;
    if (is_array($schemaOverrides)) {
      // For a `Tool` object, overrides may be keyed by the tool's name.
      $rekeyed = [];
      foreach ($schemaOverrides as $key => $value) {
        $placeholder = self::toolPlaceholder((string) $key);
        $rekeyed[isset($this->toolRefs[$placeholder]) ? $placeholder : $key] = $value;
      }
      $schemaOverrides = $rekeyed;
    }
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
            "Node \"{$id}\" has schema overrides for tool \"" . self::displayTool((string) $toolId) . "\", which it doesn't run",
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
    $this->toolRefs = [];
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
