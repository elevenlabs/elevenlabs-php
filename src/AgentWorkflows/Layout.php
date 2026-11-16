<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * Editor positions for the workflow. Nodes with a position keep it; the rest are placed at
 * column = breadth-first depth from the start node, row = discovery order within that column,
 * skipping grid cells a positioned node already occupies. Unreachable nodes go in the column
 * after the deepest one.
 *
 * Hand-written (see `.fernignore`), mirroring the workflow builder in the Python/TS SDKs.
 */
final class Layout
{
  private const COLUMN_WIDTH = 300;
  private const ROW_HEIGHT = 200;

  /**
   * @return array<string, array{x: int|float, y: int|float}>
   */
  public static function layout(WorkflowGraph $graph): array
  {
    $depths = Validate::depthsFrom($graph);
    $lastColumn = max(array_merge([0], array_values($depths))) + 1;

    $order = array_keys($depths);
    foreach (array_keys($graph->nodes) as $id) {
      if (!isset($depths[$id])) {
        $order[] = $id;
      }
    }

    $rows = [];
    $positions = [];
    $occupied = [];
    foreach ($graph->nodes as $model) {
      if (isset($model['position'])) {
        $occupied[self::posKey($model['position']['x'] ?? null, $model['position']['y'] ?? null)] = true;
      }
    }

    foreach ($order as $id) {
      $existing = $graph->nodes[$id]['position'] ?? null;
      if ($existing !== null) {
        $positions[$id] = $existing;
        continue;
      }
      $column = $depths[$id] ?? $lastColumn;
      $row = $rows[$column] ?? 0;
      while (isset($occupied[self::posKey($column * self::COLUMN_WIDTH, $row * self::ROW_HEIGHT)])) {
        $row++;
      }
      $rows[$column] = $row + 1;
      $occupied[self::posKey($column * self::COLUMN_WIDTH, $row * self::ROW_HEIGHT)] = true;
      $positions[(string) $id] = ['x' => $column * self::COLUMN_WIDTH, 'y' => $row * self::ROW_HEIGHT];
    }
    return $positions;
  }

  /** A grid-cell key that treats whole floats and ints as equal (300.0 == 300). */
  private static function posKey(mixed $x, mixed $y): string
  {
    return self::num($x) . ',' . self::num($y);
  }

  private static function num(mixed $value): string
  {
    if (is_float($value) && is_finite($value) && floor($value) === $value) {
      return (string) (int) $value;
    }
    return (string) $value;
  }
}
