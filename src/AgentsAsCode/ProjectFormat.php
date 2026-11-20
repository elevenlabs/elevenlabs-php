<?php

declare(strict_types=1);

namespace ElevenLabs\AgentsAsCode;

use ElevenLabs\AgentWorkflows\Wire;

/**
 * @internal The ElevenLabs CLI's file format and naming: JSON with a 4-space indent and no
 * trailing newline (serde_json's pretty printer), keys sorted in config files, and the CLI's
 * `sanitize_filename` / `generate_unique_filename` for new files.
 *
 * Hand-written (see `.fernignore`).
 */
final class ProjectFormat
{
  /** An index file (`agents.json`, `tools.json`): keys in the order given. */
  public static function formatIndex(mixed $value): string
  {
    return Wire::encodeIndented($value, '    ');
  }

  /** A config file: like `formatIndex()`, with keys sorted at every level. */
  public static function formatConfig(mixed $value): string
  {
    return Wire::encodeIndented(Wire::canonical($value), '    ');
  }

  /** The CLI's `sanitize_filename`: a filesystem-safe file stem for an agent or tool name. */
  public static function sanitizeFilename(string $name): string
  {
    $trimmed = (string) preg_replace('/^\s+|\s+$/u', '', $name);
    if ($trimmed === '') {
      return 'unnamed';
    }
    $sanitized = (string) preg_replace('/[\/\\\\:*?"<>|]|\s/u', '-', $trimmed);
    $sanitized = (string) preg_replace('/-{2,}/', '-', $sanitized);
    $stripped = (string) preg_replace('/^[.-]+|[.-]+$/', '', $sanitized);
    if ($stripped === '') {
      return 'unnamed';
    }
    $result = str_starts_with($trimmed, '.') ? "_{$stripped}" : $stripped;
    $chars = preg_split('//u', $result, -1, PREG_SPLIT_NO_EMPTY);
    return $chars === false ? substr($result, 0, 100) : implode('', array_slice($chars, 0, 100));
  }

  /**
   * The CLI's `generate_unique_filename`: `<dir>/<name>.json`, then `-1`, `-2`... while the path is taken.
   *
   * @param array<string, true> $taken
   */
  public static function uniquePath(string $dir, string $name, array $taken): string
  {
    $stem = self::sanitizeFilename($name);
    $candidate = "{$dir}/{$stem}.json";
    for ($n = 1; isset($taken[$candidate]); $n++) {
      $candidate = "{$dir}/{$stem}-{$n}.json";
    }
    return $candidate;
  }

  /** A project-relative path in one canonical spelling: forward slashes, no `./` or empty segments. */
  public static function normalizePath(string $path): string
  {
    $parts = array_filter(
      explode('/', str_replace('\\', '/', $path)),
      static fn(string $part): bool => $part !== '' && $part !== '.'
    );
    return implode('/', $parts);
  }
}
