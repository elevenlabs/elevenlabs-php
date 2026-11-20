<?php

declare(strict_types=1);

namespace ElevenLabs\AgentsAsCode;

use ElevenLabs\AgentWorkflows\Wire;

/**
 * @internal Helpers for agent configs in API format (snake_case), as {@see Wire::decodeJson()}
 * loads them: objects are associative arrays, except an empty object, which is a `\stdClass` so it
 * stays `{}`; JSON arrays are lists.
 *
 * Hand-written (see `.fernignore`).
 */
final class ConfigWire
{
  public const TOOL_IDS_PATH = ['conversation_config', 'agent', 'prompt', 'tool_ids'];
  public const BUILT_IN_TOOLS_PATH = ['conversation_config', 'agent', 'prompt', 'built_in_tools'];
  public const PROMPT_PATH = ['conversation_config', 'agent', 'prompt', 'prompt'];

  /** Whether `$value` is a JSON object: a non-list array, or a `\stdClass`. */
  public static function isObject(mixed $value): bool
  {
    return $value instanceof \stdClass || (is_array($value) && $value !== [] && !array_is_list($value));
  }

  /**
   * An object as an array to read or edit (an empty `\stdClass` is `[]`), or null if `$value` isn't
   * an object.
   *
   * @return array<string, mixed>|null
   */
  public static function fields(mixed $value): ?array
  {
    if ($value instanceof \stdClass) {
      /** @var array<string, mixed> */
      return (array) $value;
    }
    /** @var array<string, mixed>|null */
    return self::isObject($value) ? $value : null;
  }

  /**
   * The value at `$path`, or null if any step is missing.
   *
   * @param list<string> $path
   */
  public static function get(mixed $target, array $path): mixed
  {
    $current = $target;
    foreach ($path as $key) {
      $fields = self::fields($current);
      if ($fields === null || !array_key_exists($key, $fields)) {
        return null;
      }
      $current = $fields[$key];
    }
    return $current;
  }

  /**
   * Whether `$path` is set, even to null.
   *
   * @param list<string> $path
   */
  public static function has(mixed $target, array $path): bool
  {
    $current = $target;
    foreach ($path as $key) {
      $fields = self::fields($current);
      if ($fields === null || !array_key_exists($key, $fields)) {
        return false;
      }
      $current = $fields[$key];
    }
    return true;
  }

  /**
   * Sets the value at `$path`, creating objects along the way.
   *
   * @param array<string, mixed> $target
   * @param list<string> $path
   */
  public static function set(array &$target, array $path, mixed $value): void
  {
    $key = array_shift($path);
    if ($key === null) {
      return;
    }
    if ($path === []) {
      $target[$key] = $value;
      return;
    }
    $child = self::fields($target[$key] ?? null) ?? [];
    self::set($child, $path, $value);
    $target[$key] = $child;
  }

  /**
   * Deletes the key at `$path`, if it's there. An object left empty stays an (empty) object.
   *
   * @param array<string, mixed> $target
   * @param list<string> $path
   */
  public static function delete(array &$target, array $path): void
  {
    $key = array_shift($path);
    if ($key === null || !array_key_exists($key, $target)) {
      return;
    }
    if ($path === []) {
      unset($target[$key]);
      return;
    }
    $child = self::fields($target[$key]);
    if ($child === null) {
      return;
    }
    self::delete($child, $path);
    $target[$key] = $child === [] ? new \stdClass() : $child;
  }

  /**
   * Merges `$source` into `$target`: objects merge key by key, anything else (lists included)
   * replaces.
   *
   * @param array<string, mixed> $target
   * @param array<string, mixed> $source
   */
  public static function deepMerge(array &$target, array $source): void
  {
    foreach ($source as $key => $value) {
      $existing = array_key_exists($key, $target) ? self::fields($target[$key]) : null;
      $incoming = self::fields($value);
      if ($existing !== null && $incoming !== null) {
        self::deepMerge($existing, $incoming);
        $target[$key] = $existing === [] ? new \stdClass() : $existing;
      } else {
        $target[$key] = Wire::deepCopy($value);
      }
    }
  }

  /**
   * Whether every value in `$local` is in `$remote` at the same place. Extra keys in `$remote`
   * (server defaults) are fine, and so is a `null` in `$local`.
   */
  public static function isSubset(mixed $local, mixed $remote): bool
  {
    if (is_array($local) && array_is_list($local) && $local !== []) {
      if (!is_array($remote) || !array_is_list($remote) || count($local) !== count($remote)) {
        return false;
      }
      foreach ($local as $i => $item) {
        if (!self::isSubset($item, $remote[$i])) {
          return false;
        }
      }
      return true;
    }
    if ($local === []) {
      return $remote === [] || $remote instanceof \stdClass;
    }
    $fields = self::fields($local);
    if ($fields !== null) {
      $remoteFields = self::fields($remote) ?? ($remote === [] ? [] : null);
      if ($remoteFields === null) {
        return false;
      }
      foreach ($fields as $key => $item) {
        if ($item !== null && !self::isSubset($item, $remoteFields[$key] ?? null)) {
          return false;
        }
      }
      return true;
    }
    if ((is_int($local) || is_float($local)) && (is_int($remote) || is_float($remote))) {
      return $local == $remote;
    }
    return $local === $remote;
  }

  /**
   * The tool ids an API-format workflow's nodes use: tool nodes' tools and subagents' extra tools.
   *
   * @return list<string>
   */
  public static function workflowToolIds(mixed $workflow): array
  {
    $ids = [];
    foreach (self::fields(self::get($workflow, ['nodes'])) ?? [] as $node) {
      foreach (self::fields($node)['tools'] ?? [] as $locator) {
        $toolId = self::get($locator, ['tool_id']);
        if (is_string($toolId)) {
          $ids[] = $toolId;
        }
      }
      $extra = self::fields($node)['additional_tool_ids'] ?? [];
      foreach (is_array($extra) ? $extra : [] as $id) {
        if (is_string($id)) {
          $ids[] = $id;
        }
      }
    }
    return $ids;
  }

  /**
   * An API-format workflow with the tool ids in its tool nodes and subagents replaced by `$map($id)`.
   *
   * @param array<string, mixed> $workflow
   * @param callable(string): string $map
   * @return array<string, mixed>
   */
  public static function mapWorkflowToolIds(array $workflow, callable $map): array
  {
    $nodes = self::fields($workflow['nodes'] ?? null);
    if ($nodes === null || $nodes === []) {
      return $workflow;
    }
    foreach ($nodes as $id => $node) {
      $fields = self::fields($node);
      if ($fields === null) {
        continue;
      }
      if (is_array($fields['tools'] ?? null)) {
        foreach ($fields['tools'] as $i => $locator) {
          if (is_array($locator) && is_string($locator['tool_id'] ?? null)) {
            $fields['tools'][$i]['tool_id'] = $map($locator['tool_id']);
          }
        }
      }
      if (is_array($fields['additional_tool_ids'] ?? null)) {
        $fields['additional_tool_ids'] = array_map(
          static fn(mixed $toolId): mixed => is_string($toolId) ? $map($toolId) : $toolId,
          $fields['additional_tool_ids']
        );
      }
      $nodes[$id] = $fields === [] ? new \stdClass() : $fields;
    }
    $workflow['nodes'] = $nodes;
    return $workflow;
  }

  /**
   * Every tool id an agent config uses, in its `tool_ids` and the workflow's nodes, once each, in
   * order.
   *
   * @return list<string>
   */
  public static function agentToolIds(mixed $config): array
  {
    $ids = [];
    $promptIds = self::get($config, self::TOOL_IDS_PATH);
    foreach (is_array($promptIds) ? $promptIds : [] as $id) {
      if (is_string($id)) {
        $ids[] = $id;
      }
    }
    $ids = array_merge($ids, self::workflowToolIds(self::get($config, ['workflow'])));
    return array_values(array_unique($ids));
  }
}
