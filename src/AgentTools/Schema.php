<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

use ElevenLabs\AgentWorkflows\Wire;

/**
 * A tool param's JSON schema, and where its value comes from. Schemas are values: every method
 * returns a new schema and never changes the one it is called on, so one schema can be reused
 * across tools and properties.
 *
 *     Schema::object()
 *         ->property('order_id', Schema::string()->fromVariable('order_id'))
 *         ->property('reason', Schema::string()->describe('Why the caller wants a refund')->choices(['damaged', 'late']))
 *         ->property('note', Schema::string()->describe('Anything else the caller said')->optional());
 *
 * Hand-written (see `.fernignore`), mirroring the tool builder in the Python/TS SDKs.
 */
abstract class Schema
{
  private const MODELED_KEYS = [
    'type',
    'description',
    'dynamic_variable',
    'constant_value',
    'is_system_provided',
    'is_omitted',
    'enum',
    'allowed_values',
    'items',
    'properties',
    'required',
    'required_constraints',
  ];

  /** A loaded literal's `type`, kept as is (the API also allows a list of types such as `["integer", "null"]`). */
  protected mixed $literalType = null;
  protected ?string $description = null;
  protected ?string $dynamicVariable = null;
  protected bool $hasConstant = false;
  protected mixed $constantValue = null;
  protected bool $systemProvided = false;
  protected bool $omitted = false;
  protected bool $optional = false;
  /** @var list<string>|null */
  protected ?array $choices = null;
  protected ?string $allowedFrom = null;
  protected ?Schema $items = null;
  /** @var list<array{0: string, 1: Schema}> */
  protected array $properties = [];
  /** @var list<string>|null A loaded object's `required`, so its order survives edits. */
  protected ?array $loadedRequired = null;
  /** @var list<list<string>> */
  protected array $anyOf = [];
  /** @var list<list<string>> */
  protected array $allOf = [];
  /** @var array<string, mixed> Loaded fields the builder doesn't model, and the API's defaults for unset ones. */
  protected array $extra = [];

  /**
   * @param string $kind `"string"`, `"integer"`, `"number"`, `"boolean"`, `"object"` or `"array"`.
   */
  final protected function __construct(protected string $kind)
  {
  }

  /** A string. */
  public static function string(): LiteralSchema
  {
    return new LiteralSchema('string');
  }

  /** An integer. */
  public static function integer(): LiteralSchema
  {
    return new LiteralSchema('integer');
  }

  /** A number. */
  public static function number(): LiteralSchema
  {
    return new LiteralSchema('number');
  }

  /** A boolean. Named `bool` to match the other SDKs (`boolean` is reserved in Java). */
  public static function bool(): LiteralSchema
  {
    return new LiteralSchema('boolean');
  }

  /** An object. Add properties with `property()`. */
  public static function object(): ObjectSchema
  {
    return new ObjectSchema('object');
  }

  /** An array whose elements match `$items`. */
  public static function array(Schema $items): ArraySchema
  {
    $schema = new ArraySchema('array');
    $schema->items = $items;
    return $schema;
  }

  /**
   * Loads a schema in API format (snake_case), given as a JSON string or a parsed array.
   *
   * @param string|array<string, mixed> $data
   */
  public static function fromJson(string|array $data): Schema
  {
    return self::fromWire(ToolWire::parse($data));
  }

  /**
   * @internal Loads a wire-format schema. `$optional` is whether its parent leaves it out of
   * `required`. `$kind` is given where the API only allows one kind (for example a tool's params
   * object), since an empty schema has no `type`.
   *
   * @param array<string, mixed> $model
   */
  public static function fromWire(array $model, bool $optional = false, ?string $kind = null): Schema
  {
    $kind ??= self::kindOf($model);
    if (
      ($kind === 'object' || $kind === 'array')
      && array_key_exists('constant_value', $model) && $model['constant_value'] === null
    ) {
      // A container's unset constant is `null`; a literal's is `""`, so a literal's `null` is a constant.
      unset($model['constant_value']);
    }
    $schema = match ($kind) {
      'object' => new ObjectSchema('object'),
      'array' => new ArraySchema('array'),
      default => new LiteralSchema($kind),
    };
    // The API fills unset fields with defaults ("", false). They aren't value sources, but are kept
    // as extra fields so a pulled config writes back unchanged.
    foreach ($model as $key => $value) {
      $key = (string) $key;
      if (!in_array($key, self::MODELED_KEYS, true) || self::isUnset($key, $value, $kind)) {
        $schema->extra[$key] = ($key === 'properties' && $value === []) ? new \stdClass() : Wire::deepCopy($value);
      }
    }
    $get = static function (string $key) use ($model, $kind): mixed {
      $value = $model[$key] ?? null;
      return ($value === null || self::isUnset($key, $value, $kind)) ? null : $value;
    };
    $description = $get('description');
    $schema->description = is_string($description) ? $description : null;
    $variable = $get('dynamic_variable');
    $schema->dynamicVariable = is_string($variable) ? $variable : null;
    $schema->hasConstant = array_key_exists('constant_value', $model)
      && !self::isUnset('constant_value', $model['constant_value'], $kind);
    $schema->constantValue = $schema->hasConstant ? Wire::deepCopy($model['constant_value']) : null;
    $schema->omitted = ($model['is_omitted'] ?? null) === true;
    $schema->optional = $optional;

    if ($kind === 'object') {
      $required = $get('required');
      /** @var list<string> $requiredList */
      $requiredList = is_array($required) ? array_values(array_map('strval', $required)) : [];
      foreach (ToolWire::schemaWire($get('properties')) ?? [] as $name => $child) {
        $name = (string) $name;
        $schema->properties[] = [
          $name,
          self::fromWire(ToolWire::schemaWire($child) ?? [], !in_array($name, $requiredList, true)),
        ];
      }
      $schema->loadedRequired = is_array($required) ? $requiredList : null;
      $constraints = self::asMap($model['required_constraints'] ?? null);
      $schema->anyOf = self::constraintGroups($constraints['any_of'] ?? null);
      $schema->allOf = self::constraintGroups($constraints['all_of'] ?? null);
      return $schema;
    }
    if ($kind === 'array') {
      $items = $get('items');
      $itemsWire = ToolWire::schemaWire($items);
      $schema->items = $itemsWire === null ? null : self::fromWire($itemsWire, true);
      return $schema;
    }
    $schema->literalType = Wire::deepCopy($model['type'] ?? null);
    $schema->systemProvided = ($model['is_system_provided'] ?? null) === true;
    $choices = $get('enum');
    $schema->choices = is_array($choices) ? array_values($choices) : null;
    $allowed = self::asMap($get('allowed_values'));
    $schema->allowedFrom = isset($allowed['dynamic_variable']) && is_string($allowed['dynamic_variable'])
      ? $allowed['dynamic_variable']
      : null;
    return $schema;
  }

  /** `"string"`, `"integer"`, `"number"`, `"boolean"`, `"object"` or `"array"`. */
  public function kind(): string
  {
    return $this->kind;
  }

  /** Whether the parent leaves this property out of `required`. */
  public function isOptional(): bool
  {
    return $this->optional;
  }

  /** The LLM provides the value, guided by `$text`. On an object or array, documents the container. */
  public function describe(string $text): static
  {
    $copy = clone $this;
    $copy->description = $text;
    return $copy;
  }

  /** The value is read from the dynamic variable `$name` when the tool runs. */
  public function fromVariable(string $name): static
  {
    $copy = clone $this;
    $copy->dynamicVariable = $name;
    return $copy;
  }

  /** The value is always `$value`, a JSON value matching the schema's type. */
  public function constant(mixed $value): static
  {
    $copy = clone $this;
    $copy->hasConstant = true;
    $copy->constantValue = Wire::toWire($value);
    return $copy;
  }

  /** The param is left out of the request. Only allowed on an optional property. */
  public function omit(): static
  {
    $copy = clone $this;
    $copy->omitted = true;
    return $copy;
  }

  /** Leaves this property out of its parent's `required`. Properties are required unless marked optional. */
  public function optional(): static
  {
    $copy = clone $this;
    $copy->optional = true;
    return $copy;
  }

  /**
   * The schema in API format (snake_case keys, sorted at every level). Doesn't validate.
   *
   * @return array<string, mixed>
   */
  public function toJson(): array
  {
    /** @var array<string, mixed> $canonical */
    $canonical = Wire::canonical($this->toWire());
    return $canonical;
  }

  /**
   * @internal The schema in wire format, unsorted.
   *
   * @return array<string, mixed>
   */
  public function toWire(): array
  {
    // Modeled fields that are unset leave the matching extra field (an API default) in place.
    /** @var array<string, mixed> $wire */
    $wire = Wire::deepCopy($this->extra);
    if ($this->description !== null) {
      $wire['description'] = $this->description;
    }
    if ($this->dynamicVariable !== null) {
      $wire['dynamic_variable'] = $this->dynamicVariable;
    }
    if ($this->omitted) {
      $wire['is_omitted'] = true;
    }
    if ($this->hasConstant) {
      // PHP can't tell `{}` from `[]`; on an object schema an empty constant is the empty object.
      $wire['constant_value'] = ($this->kind === 'object' && $this->constantValue === [])
        ? new \stdClass()
        : Wire::deepCopy($this->constantValue);
    }
    if ($this->kind === 'object') {
      $wire['type'] = 'object';
      if ($this->properties !== []) {
        $properties = [];
        foreach ($this->properties as [$name, $child]) {
          $properties[$name] = $child->toWire();
        }
        $wire['properties'] = ToolWire::map($properties);
      }
      $required = $this->requiredOrder();
      if ($required !== []) {
        $wire['required'] = $required;
      }
      $constraints = [];
      if ($this->anyOf !== []) {
        $constraints['any_of'] = array_map(static fn(array $names): array => ['required' => $names], $this->anyOf);
      }
      if ($this->allOf !== []) {
        $constraints['all_of'] = array_map(static fn(array $names): array => ['required' => $names], $this->allOf);
      }
      if ($constraints !== []) {
        $wire['required_constraints'] = $constraints;
      }
      return $wire;
    }
    if ($this->kind === 'array') {
      $wire['type'] = 'array';
      if ($this->items !== null) {
        $wire['items'] = $this->items->toWire();
      }
      return $wire;
    }
    $wire['type'] = $this->literalType !== null ? Wire::deepCopy($this->literalType) : $this->kind;
    if ($this->systemProvided) {
      $wire['is_system_provided'] = true;
    }
    if ($this->choices !== null) {
      $wire['enum'] = $this->choices;
    }
    if ($this->allowedFrom !== null) {
      $wire['allowed_values'] = ['dynamic_variable' => $this->allowedFrom];
    }
    return $wire;
  }

  /** @internal Whether this is a string, integer, number or boolean. */
  public function isLiteral(): bool
  {
    return $this->kind !== 'object' && $this->kind !== 'array';
  }

  /**
   * @internal Checks this schema and everything under it. `$path` names it in messages, e.g.
   * `"body.reason"`. `$isProperty` is whether it is a property (or a param), so `omit()` needs it
   * to be optional.
   *
   * @param list<ToolIssue> $issues
   */
  public function check(string $path, bool $isProperty, array &$issues): void
  {
    // The API reads "" as unset, so an empty description or variable name isn't a value source.
    $described = $this->description !== null && $this->description !== '';
    $sources = count(array_filter([
      $described,
      $this->dynamicVariable !== null && $this->dynamicVariable !== '',
      $this->hasConstant,
      $this->systemProvided,
      $this->omitted,
    ]));
    if ($sources > 1) {
      $issues[] = ToolIssue::error(
        'conflicting_value_source',
        $path,
        "\"{$path}\" sets more than one of describe(), fromVariable(), constant(), systemProvided() and omit()"
      );
    }
    if ($this->omitted && $isProperty && !$this->optional) {
      $issues[] = ToolIssue::error('omitted_required', $path, "\"{$path}\" uses omit(), so it must be optional()");
    }
    if ($this->choices !== null && $this->kind !== 'string') {
      $issues[] = ToolIssue::error('invalid_choices', $path, "\"{$path}\" uses choices(), which only applies to strings");
    }
    if ($this->allowedFrom !== null && !$described) {
      $issues[] = ToolIssue::error(
        'allowed_values_needs_description',
        $path,
        "\"{$path}\" uses allowedFrom(), which needs describe() so the LLM provides the value"
      );
    }
    if ($this->hasConstant && !self::matchesKind($this->kind, $this->constantValue, $this->isNullable())) {
      $what = is_float($this->constantValue) && !is_finite($this->constantValue) ? 'finite number' : $this->kind;
      $issues[] = ToolIssue::error('constant_type_mismatch', $path, "\"{$path}\" has a constant that isn't a {$what}");
    } elseif ($this->hasConstant && $this->constantValue === '') {
      $issues[] = ToolIssue::error(
        'constant_type_mismatch',
        $path,
        "\"{$path}\" can't have \"\" as a constant: the API reads it as unset"
      );
    }
    // The API rejects a literal with no value source wherever it appears, response schemas included.
    if ($sources === 0 && $this->isLiteral()) {
      $issues[] = ToolIssue::error(
        'missing_value_source',
        $path,
        "\"{$path}\" needs one of describe(), fromVariable(), constant(), systemProvided() or omit()"
      );
    }

    if ($this->kind === 'object') {
      $names = array_map(static fn(array $entry): string => $entry[0], $this->properties);
      foreach (array_merge($this->anyOf, $this->allOf) as $group) {
        foreach ($group as $name) {
          if (!in_array($name, $names, true)) {
            $issues[] = ToolIssue::error(
              'unknown_required_property',
              $path,
              "\"{$path}\" requires \"{$name}\" in requireAnyOf()/requireAllOf(), but has no such property"
            );
          }
        }
      }
      foreach ($this->properties as [$name, $child]) {
        $child->check("{$path}.{$name}", true, $issues);
      }
    }
    if ($this->kind === 'array') {
      if ($this->items === null) {
        $issues[] = ToolIssue::error('missing_array_items', $path, "Array \"{$path}\" has no items schema");
      } else {
        $this->items->check("{$path}[]", false, $issues);
      }
    }
  }

  /**
   * A loaded object's `required` order for the required properties it still has, then new ones
   * in property order.
   *
   * @return list<string>
   */
  private function requiredOrder(): array
  {
    $required = [];
    foreach ($this->properties as [$name, $child]) {
      if (!$child->isOptional()) {
        $required[] = $name;
      }
    }
    $kept = array_values(array_filter(
      $this->loadedRequired ?? [],
      static fn(string $name): bool => in_array($name, $required, true)
    ));
    foreach ($required as $name) {
      if (!in_array($name, $kept, true)) {
        $kept[] = $name;
      }
    }
    return $kept;
  }

  /** Whether a loaded literal's `type` is a list that includes `"null"`, e.g. `["integer", "null"]`. */
  private function isNullable(): bool
  {
    return is_array($this->literalType) && in_array('null', $this->literalType, true);
  }

  private static function matchesKind(string $kind, mixed $value, bool $nullable): bool
  {
    if ($value === null && $nullable) {
      return true;
    }
    // JSON has one number type: 3.0 is an integer, as in JavaScript.
    return match ($kind) {
      'string' => is_string($value),
      'integer' => is_int($value) || (is_float($value) && is_finite($value) && floor($value) === $value),
      'number' => is_int($value) || (is_float($value) && is_finite($value)),
      'boolean' => is_bool($value),
      // PHP decodes `{}` to `[]` unless told otherwise, so an empty array counts as an empty object.
      'object' => $value instanceof \stdClass || (is_array($value) && ($value === [] || !array_is_list($value))),
      default => is_array($value) && array_is_list($value),
    };
  }

  /**
   * Whether `$value` is what the API returns for an unset field. (It also returns `null` for
   * some, which loading already drops.) A literal's unset constant is `""`, so `""` can't be a constant.
   */
  private static function isUnset(string $key, mixed $value, string $kind): bool
  {
    return match ($key) {
      'description', 'dynamic_variable' => $value === '',
      'constant_value' => $kind !== 'object' && $kind !== 'array' && $value === '',
      'is_system_provided', 'is_omitted' => $value === false,
      'required' => $value === [],
      'properties' => $value === [] || ($value instanceof \stdClass && (array) $value === []),
      default => false,
    };
  }

  /**
   * @internal The schema kind of a wire-format schema: its `type`, or for a schema without one,
   * `object` if it has `properties` and `array` if it has `items`.
   *
   * @param array<string, mixed> $model
   */
  public static function kindOf(array $model): string
  {
    $type = $model['type'] ?? null;
    if (is_array($type)) {
      // A literal's type can be a list such as ["integer", "null"]; its kind is the non-null member.
      $type = null;
      foreach ($model['type'] as $member) {
        if ($member !== 'null') {
          $type = $member;
          break;
        }
      }
    }
    if ($type === 'object' || ($type === null && array_key_exists('properties', $model))) {
      return 'object';
    }
    if ($type === 'array' || ($type === null && array_key_exists('items', $model))) {
      return 'array';
    }
    return in_array($type, ['integer', 'number', 'boolean'], true) ? (string) $type : 'string';
  }

  /**
   * @return array<string, mixed>
   */
  private static function asMap(mixed $value): array
  {
    /** @var array<string, mixed> */
    return is_array($value) ? $value : [];
  }

  /**
   * @return list<list<string>>
   */
  private static function constraintGroups(mixed $groups): array
  {
    $out = [];
    foreach (is_array($groups) ? $groups : [] as $group) {
      $names = is_array($group) && is_array($group['required'] ?? null) ? $group['required'] : [];
      $out[] = array_values(array_map('strval', $names));
    }
    return $out;
  }
}
