<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * Wire-format helpers. The builder keeps its state in API wire format (snake_case keys,
 * as the REST API and the CLI's agent_configs/*.json use them). These helpers convert
 * generated models to wire format, canonicalize for byte-identical output across SDKs,
 * and serialize with the exact formatting the spec requires.
 *
 * Hand-written (see `.fernignore`).
 */
final class Wire
{
  /**
   * Convert a generated model (or an array/scalar holding them) to a wire-format value.
   * Models serialize through their own JSON serialization; arrays recurse; scalars pass through.
   */
  public static function toWire(mixed $value): mixed
  {
    if (is_object($value)) {
      return json_decode((string) json_encode($value), true);
    }
    if (is_array($value)) {
      $out = [];
      foreach ($value as $key => $item) {
        $out[$key] = self::toWire($item);
      }
      return $out;
    }
    return $value;
  }

  /**
   * Sort object keys at every level and write whole floats as integers, so the JSON
   * matches every other SDK byte for byte. Associative arrays become objects; lists keep
   * their order. An empty `\stdClass` is preserved as an empty object (`{}`).
   */
  public static function canonical(mixed $value): mixed
  {
    if ($value instanceof \stdClass) {
      $out = new \stdClass();
      $arr = (array) $value;
      ksort($arr);
      foreach ($arr as $key => $item) {
        $out->{$key} = self::canonical($item);
      }
      return $out;
    }
    if (is_array($value)) {
      if (array_is_list($value)) {
        return array_map([self::class, 'canonical'], $value);
      }
      ksort($value);
      $out = [];
      foreach ($value as $key => $item) {
        $out[(string) $key] = self::canonical($item);
      }
      return $out;
    }
    if (is_float($value) && is_finite($value) && floor($value) === $value) {
      return (int) $value;
    }
    return $value;
  }

  /**
   * Deep-copy an array/scalar structure (wire values are plain arrays and scalars).
   */
  public static function deepCopy(mixed $value): mixed
  {
    if (is_array($value)) {
      $out = [];
      foreach ($value as $key => $item) {
        $out[$key] = self::deepCopy($item);
      }
      return $out;
    }
    if (is_object($value)) {
      return clone $value;
    }
    return $value;
  }

  /**
   * Serialize a canonical value as JSON with 2-space indentation and a trailing newline —
   * byte-identical to `JSON.stringify(value, null, 2) + "\n"`. PHP's JSON_PRETTY_PRINT uses
   * four spaces and can't be configured, so this is a hand-rolled encoder.
   */
  public static function encode(mixed $value): string
  {
    return self::encodeValue($value, 0) . "\n";
  }

  private static function encodeValue(mixed $value, int $depth): string
  {
    if ($value instanceof \stdClass) {
      return self::encodeObject((array) $value, $depth);
    }
    if (is_array($value)) {
      return array_is_list($value)
        ? self::encodeList($value, $depth)
        : self::encodeObject($value, $depth);
    }
    if ($value === null) {
      return 'null';
    }
    if (is_bool($value)) {
      return $value ? 'true' : 'false';
    }
    if (is_int($value)) {
      return (string) $value;
    }
    if (is_float($value)) {
      return (string) json_encode($value);
    }
    return (string) json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
  }

  /**
   * @param list<mixed> $list
   */
  private static function encodeList(array $list, int $depth): string
  {
    if ($list === []) {
      return '[]';
    }
    $pad = str_repeat('  ', $depth + 1);
    $items = array_map(
      fn(mixed $item): string => $pad . self::encodeValue($item, $depth + 1),
      $list
    );
    return "[\n" . implode(",\n", $items) . "\n" . str_repeat('  ', $depth) . ']';
  }

  /**
   * @param array<string, mixed> $object
   */
  private static function encodeObject(array $object, int $depth): string
  {
    if ($object === []) {
      return '{}';
    }
    $pad = str_repeat('  ', $depth + 1);
    $items = [];
    foreach ($object as $key => $item) {
      $encodedKey = (string) json_encode((string) $key, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      $items[] = $pad . $encodedKey . ': ' . self::encodeValue($item, $depth + 1);
    }
    return "{\n" . implode(",\n", $items) . "\n" . str_repeat('  ', $depth) . '}';
  }
}
