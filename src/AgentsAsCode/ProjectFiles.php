<?php

declare(strict_types=1);

namespace ElevenLabs\AgentsAsCode;

/**
 * @internal File access for {@see AgentProject}: reads the index files and the configs they list,
 * and writes files owner-only, never through a symlink and never outside the project. Ports the
 * CLI's `resolve_in_project`.
 *
 * Hand-written (see `.fernignore`).
 */
final class ProjectFiles
{
  /**
   * The index files and every config they list, keyed by project-relative path, and the files
   * already in the config directories.
   *
   * @return array{files: array<string, string>, taken: list<string>, root: string}
   * @throws AgentProjectError
   */
  public static function read(string $dir): array
  {
    $root = realpath($dir);
    if ($root === false || !is_dir($root)) {
      throw new AgentProjectError("{$dir} isn't a directory");
    }
    $files = [];
    foreach ([AgentProject::AGENTS_FILE, AgentProject::TOOLS_FILE] as $index) {
      $text = self::readIfExists(self::resolve($root, $index), $index);
      if ($text === null) {
        continue;
      }
      $files[$index] = $text;
      $parsed = json_decode($text, true);
      if (!is_array($parsed)) {
        continue; // AgentProject reports it, with the parse error.
      }
      $configs = [];
      foreach (is_array($parsed['agents'] ?? null) ? $parsed['agents'] : [] as $entry) {
        $configs[] = is_array($entry) ? ($entry['config'] ?? null) : null;
        $branches = is_array($entry) ? ($entry['branches'] ?? null) : null;
        foreach (is_array($branches) ? $branches : [] as $branch) {
          $configs[] = is_array($branch) ? ($branch['config'] ?? null) : null;
        }
      }
      foreach (is_array($parsed['tools'] ?? null) ? $parsed['tools'] : [] as $entry) {
        $configs[] = is_array($entry) ? ($entry['config'] ?? null) : null;
      }
      foreach ($configs as $config) {
        if (!is_string($config)) {
          throw new AgentProjectError("{$index} has an entry without a \"config\" path");
        }
        $content = self::readIfExists(self::resolve($root, $config), $config);
        if ($content !== null) {
          $files[ProjectFormat::normalizePath($config)] = $content;
        }
      }
    }
    $taken = [];
    foreach ([AgentProject::AGENT_CONFIGS_DIR, AgentProject::TOOL_CONFIGS_DIR] as $sub) {
      $path = $root . DIRECTORY_SEPARATOR . $sub;
      $names = is_dir($path) ? scandir($path) : false;
      foreach ($names === false ? [] : $names as $name) {
        if ($name !== '.' && $name !== '..') {
          $taken[] = "{$sub}/{$name}";
        }
      }
    }
    return ['files' => $files, 'taken' => $taken, 'root' => $root];
  }

  /**
   * Writes each file owner-only (`0600`), creating directories as needed. Each file is written to a
   * new temporary file next to it, which is then renamed into place, so an existing symlink is
   * never followed.
   *
   * @param array<string, string> $files Project-relative path => contents.
   * @throws AgentProjectError
   */
  public static function write(string $dir, array $files): void
  {
    $root = realpath($dir);
    if ($root === false) {
      throw new AgentProjectError("{$dir} isn't a directory");
    }
    foreach ($files as $path => $text) {
      $path = (string) $path;
      $target = self::resolve($root, $path);
      $parent = dirname($target);
      if (!is_dir($parent) && !@mkdir($parent, 0777, true) && !is_dir($parent)) {
        throw new AgentProjectError("Couldn't create the directory for {$path}");
      }
      // Created since the check above: the directory itself must still be inside the project.
      self::resolve($root, $path);
      if (is_link($target)) {
        throw new AgentProjectError("Refusing to write {$path}: it's a symlink");
      }
      $temp = $parent . DIRECTORY_SEPARATOR . '.' . basename($target) . '.' . bin2hex(random_bytes(6)) . '.tmp';
      // `x` creates the file and fails if anything, a symlink included, is already there.
      $handle = @fopen($temp, 'x');
      if ($handle === false) {
        throw new AgentProjectError("Couldn't write {$path}");
      }
      try {
        @chmod($temp, 0600);
        $written = fwrite($handle, $text);
      } finally {
        fclose($handle);
      }
      if ($written !== strlen($text) || !@rename($temp, $target)) {
        @unlink($temp);
        throw new AgentProjectError("Couldn't write {$path}");
      }
    }
  }

  /**
   * The absolute path for a project-relative one, refusing anything that escapes the project,
   * including through a symlinked directory.
   *
   * @throws AgentProjectError
   */
  public static function resolve(string $root, string $path): string
  {
    if (trim($path) === '' || preg_match('/[\x00-\x1f\x7f]/', $path) === 1) {
      throw new AgentProjectError('Invalid config path ' . json_encode($path));
    }
    $normalized = str_replace('\\', '/', $path);
    $absolute = str_starts_with($normalized, '/') || preg_match('/^[A-Za-z]:\//', $normalized) === 1;
    $segments = [];
    foreach (explode('/', $absolute ? $normalized : str_replace('\\', '/', $root) . '/' . $normalized) as $segment) {
      if ($segment === '' || $segment === '.') {
        continue;
      }
      if ($segment === '..') {
        array_pop($segments);
        continue;
      }
      $segments[] = $segment;
    }
    $rootNormalized = rtrim(str_replace('\\', '/', $root), '/');
    $prefix = preg_match('/^[A-Za-z]:/', $rootNormalized) === 1 ? '' : '/';
    $candidate = $prefix . implode('/', $segments);
    $inside = static fn(string $p): bool => $p === $rootNormalized || str_starts_with($p, $rootNormalized . '/');
    if (!$inside($candidate)) {
      throw new AgentProjectError("Config path {$path} is outside the project");
    }
    // The deepest part of the path that exists, with symlinks resolved, must still be inside.
    $ancestor = $candidate;
    while (true) {
      $real = realpath($ancestor);
      if ($real !== false) {
        if (!$inside(str_replace('\\', '/', $real))) {
          throw new AgentProjectError("Config path {$path} leads outside the project through a symlink");
        }
        return $candidate;
      }
      $parent = dirname($ancestor);
      if ($parent === $ancestor) {
        throw new AgentProjectError("Config path {$path} is outside the project");
      }
      $ancestor = $parent;
    }
  }

  private static function readIfExists(string $absolute, string $path): ?string
  {
    if (!file_exists($absolute)) {
      return null;
    }
    $text = @file_get_contents($absolute);
    if ($text === false) {
      throw new AgentProjectError("Couldn't read {$path}");
    }
    return $text;
  }
}
