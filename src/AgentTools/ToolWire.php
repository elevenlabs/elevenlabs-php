<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\Types\ArrayJsonSchemaPropertyInput;
use ElevenLabs\Types\LiteralJsonSchemaProperty;
use ElevenLabs\Types\ObjectJsonSchemaPropertyInput;

/**
 * @internal Wire-format helpers. The tool builder keeps its state in API wire format, like the
 * workflow builder, and shares its {@see Wire} helpers for canonical output. This adds parsing,
 * dropping the `null`s the API returns for unset fields, and building generated schema models.
 *
 * Hand-written (see `.fernignore`).
 */
final class ToolWire
{
  /** Free-form JSON values, where `null` is data rather than an unset field. */
  private const FREE_FORM_KEYS = ['constant_value', 'dynamic_variable_placeholders'];

  /**
   * A JSON string, a parsed array or a generated model, as a fresh wire-format array with the
   * API's `null` (unset) fields removed.
   *
   * @return array<string, mixed>
   */
  public static function parse(mixed $data): array
  {
    $wire = is_string($data) ? Wire::decodeJson($data) : Wire::toWire($data);
    if ($wire instanceof \stdClass) {
      return [];
    }
    if (!is_array($wire)) {
      throw new \InvalidArgumentException('Expected a JSON object, got ' . get_debug_type($wire));
    }
    /** @var array<string, mixed> $stripped */
    $stripped = self::stripNulls($wire);
    return $stripped;
  }

  /**
   * Drops `null` fields at every level, except inside free-form values such as constants. A
   * `null` constant is kept: on a literal it is a real constant (the API's unset value is `""`).
   * Loading a schema drops it from a container, where it means unset.
   */
  public static function stripNulls(mixed $value): mixed
  {
    if (!is_array($value)) {
      return Wire::deepCopy($value);
    }
    if (array_is_list($value)) {
      return array_map([self::class, 'stripNulls'], $value);
    }
    $out = [];
    foreach ($value as $key => $item) {
      $free = in_array((string) $key, self::FREE_FORM_KEYS, true);
      if ($item === null && (string) $key !== 'constant_value') {
        continue;
      }
      $out[$key] = $free ? Wire::deepCopy($item) : self::stripNulls($item);
    }
    return $out;
  }

  /**
   * The generated model of a wire-format schema, with every nested property and `items` of the
   * right class. The generated deserializer can't be used for this: it reads each member of the
   * Literal|Object|Array union as the first variant, a literal, which drops the `properties` of a
   * nested object and the `items` of an array.
   *
   * @param array<string, mixed> $wire
   */
  public static function schemaModel(array $wire): LiteralJsonSchemaProperty|ObjectJsonSchemaPropertyInput|ArrayJsonSchemaPropertyInput
  {
    return self::objectOrSchema($wire, Schema::kindOf($wire));
  }

  /**
   * @param array<string, mixed> $wire
   */
  public static function objectModel(array $wire): ObjectJsonSchemaPropertyInput
  {
    /** @var ObjectJsonSchemaPropertyInput */
    return self::objectOrSchema($wire, 'object');
  }

  /**
   * @param array<string, mixed> $wire
   */
  private static function objectOrSchema(
    array $wire,
    string $kind,
  ): LiteralJsonSchemaProperty|ObjectJsonSchemaPropertyInput|ArrayJsonSchemaPropertyInput {
    $json = (string) json_encode($wire);
    if ($kind === 'object') {
      $model = ObjectJsonSchemaPropertyInput::fromJson($json);
      if (is_array($wire['properties'] ?? null)) {
        $properties = [];
        foreach ($wire['properties'] as $name => $child) {
          $properties[(string) $name] = self::schemaModel(is_array($child) ? $child : []);
        }
        $model->properties = $properties;
      }
      return $model;
    }
    if ($kind === 'array') {
      $model = ArrayJsonSchemaPropertyInput::fromJson($json);
      if (is_array($wire['items'] ?? null)) {
        $model->items = self::schemaModel($wire['items']);
      }
      return $model;
    }
    return LiteralJsonSchemaProperty::fromJson($json);
  }
}
