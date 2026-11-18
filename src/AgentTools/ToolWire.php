<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

use ElevenLabs\AgentTools\Models\ArraySchemaModel;
use ElevenLabs\AgentTools\Models\ObjectSchemaModel;
use ElevenLabs\AgentTools\Models\QueryParamsModel;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\LiteralJsonSchemaProperty;

/**
 * @internal Wire-format helpers. The tool builder keeps its state in API wire format, like the
 * workflow builder, and shares its {@see Wire} helpers for canonical output. This adds parsing,
 * dropping the `null`s the API returns for unset fields, and converting to and from generated
 * models without the generated schema union's losses (see {@see self::schemaModel()}).
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
    $wire = is_string($data) ? Wire::decodeJson($data) : self::modelToWire($data);
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
   * A value that holds generated models, in wire format. Like {@see Wire::toWire()}, but also
   * recovers what the model's own serialization loses: the generated deserializer reads each
   * member of a Literal|Object|Array schema union as a literal, which keeps a nested object's
   * `properties` and an array's `items` only in `getAdditionalProperties()`.
   */
  public static function modelToWire(mixed $value): mixed
  {
    if (is_array($value)) {
      $out = [];
      foreach ($value as $key => $item) {
        $out[$key] = self::modelToWire($item);
      }
      return $out;
    }
    if (!($value instanceof JsonSerializableType)) {
      return Wire::toWire($value);
    }
    if (method_exists($value, '_isUnknown') && property_exists($value, 'value')) {
      // A generated union: its wire form is its member's.
      return $value->_isUnknown() ? Wire::toWire($value) : self::modelToWire($value->value);
    }
    $wire = Wire::toWire($value);
    if (!is_array($wire)) {
      return $wire;
    }
    foreach ((new \ReflectionObject($value))->getProperties() as $property) {
      $attribute = $property->getAttributes(JsonProperty::class)[0] ?? null;
      if ($attribute === null || !$property->isInitialized($value)) {
        continue;
      }
      $key = $attribute->newInstance()->name;
      $item = $property->getValue($value);
      if (array_key_exists($key, $wire) && (is_array($item) || $item instanceof JsonSerializableType)) {
        $wire[$key] = self::modelToWire($item);
      }
    }
    foreach ($value->getAdditionalProperties() as $key => $item) {
      if (!array_key_exists($key, $wire)) {
        $wire[$key] = Wire::toWire($item);
      }
    }
    return $wire;
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
   * A loaded value that should be a schema, as an array: an empty object `{}` (which loads as an
   * empty `\stdClass`) is an empty schema. Null for anything else.
   *
   * @return array<string, mixed>|null
   */
  public static function schemaWire(mixed $value): ?array
  {
    if ($value instanceof \stdClass) {
      /** @var array<string, mixed> */
      return (array) $value;
    }
    /** @var array<string, mixed>|null */
    return is_array($value) ? $value : null;
  }

  /**
   * A map for the wire. A PHP array whose keys are `0`, `1`… (for example properties named
   * `"0"` and `"1"`) is a list to PHP and would be written as a JSON array, so it becomes an object.
   *
   * @param array<mixed> $entries
   * @return array<mixed>|\stdClass
   */
  public static function map(array $entries): array|\stdClass
  {
    return array_is_list($entries) ? (object) $entries : $entries;
  }

  /**
   * The generated model of a wire-format schema, with every nested property and `items` of the
   * right class. The generated deserializer can't be used for this: it reads each member of the
   * Literal|Object|Array union as the first variant, a literal, which drops the `properties` of a
   * nested object and the `items` of an array.
   *
   * @param array<string, mixed> $wire
   */
  public static function schemaModel(array $wire): LiteralJsonSchemaProperty|ObjectSchemaModel|ArraySchemaModel
  {
    return self::modelOfKind($wire, Schema::kindOf($wire));
  }

  /**
   * @param array<string, mixed> $wire
   */
  public static function objectModel(array $wire): ObjectSchemaModel
  {
    /** @var ObjectSchemaModel */
    return self::modelOfKind($wire, 'object');
  }

  /**
   * The generated model of a `query_params_schema`. Its `properties` are literals, so the
   * generated deserializer reads them correctly; the API requires the field, so an empty schema
   * gets an empty one.
   *
   * @param array<string, mixed> $wire
   */
  public static function queryModel(array $wire): QueryParamsModel
  {
    $wire['properties'] ??= new \stdClass();
    return QueryParamsModel::fromJson(self::json($wire));
  }

  /**
   * JSON for a wire value. An empty array is the empty object, since every value passed here is
   * an object.
   *
   * @param array<string, mixed> $wire
   */
  public static function json(array $wire): string
  {
    return (string) json_encode($wire === [] ? new \stdClass() : $wire, JSON_THROW_ON_ERROR);
  }

  /**
   * @param array<string, mixed> $wire
   */
  private static function modelOfKind(
    array $wire,
    string $kind,
  ): LiteralJsonSchemaProperty|ObjectSchemaModel|ArraySchemaModel {
    $json = self::json($wire);
    if ($kind === 'object') {
      $model = ObjectSchemaModel::fromJson($json);
      $properties = self::schemaWire($wire['properties'] ?? null);
      if ($properties !== null) {
        $models = [];
        foreach ($properties as $name => $child) {
          $models[(string) $name] = self::schemaModel(self::schemaWire($child) ?? []);
        }
        $model->properties = $models;
      }
    } elseif ($kind === 'array') {
      $model = ArraySchemaModel::fromJson($json);
      $items = self::schemaWire($wire['items'] ?? null);
      if ($items !== null) {
        $model->items = self::schemaModel($items);
      }
    } else {
      return LiteralJsonSchemaProperty::fromJson($json);
    }
    if (array_key_exists('constant_value', $wire)) {
      $model->keepConstant(Wire::deepCopy($wire['constant_value']));
    }
    return $model;
  }
}
