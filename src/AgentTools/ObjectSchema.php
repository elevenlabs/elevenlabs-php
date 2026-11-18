<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

/**
 * An object schema with named properties. Create one with {@see Schema::object()}.
 *
 * Hand-written (see `.fernignore`), mirroring the tool builder in the Python/TS SDKs.
 */
final class ObjectSchema extends Schema
{
  /** Adds the property `$name`, or replaces it in place if it exists. */
  public function property(string $name, Schema $schema): static
  {
    $copy = clone $this;
    foreach ($copy->properties as $i => [$existing]) {
      if ($existing === $name) {
        $copy->properties[$i] = [$name, $schema];
        return $copy;
      }
    }
    $copy->properties[] = [$name, $schema];
    return $copy;
  }

  /** Removes the property `$name`. Removing one that doesn't exist does nothing. */
  public function without(string $name): static
  {
    $copy = clone $this;
    $copy->properties = array_values(array_filter(
      $this->properties,
      static fn(array $entry): bool => $entry[0] !== $name
    ));
    return $copy;
  }

  /**
   * Requires at least one of these properties: appends `$names` to `required_constraints.any_of`.
   *
   * @param list<string> $names
   */
  public function requireAnyOf(array $names): static
  {
    $copy = clone $this;
    $copy->anyOf[] = array_values($names);
    return $copy;
  }

  /**
   * Requires all of these properties: appends `$names` to `required_constraints.all_of`.
   *
   * @param list<string> $names
   */
  public function requireAllOf(array $names): static
  {
    $copy = clone $this;
    $copy->allOf[] = array_values($names);
    return $copy;
  }

  /**
   * Property names, in order.
   *
   * @return list<string>
   */
  public function propertyNames(): array
  {
    return array_map(static fn(array $entry): string => $entry[0], $this->properties);
  }

  /** The schema of property `$name`, or null if there is none. */
  public function propertySchema(string $name): ?Schema
  {
    foreach ($this->properties as [$existing, $schema]) {
      if ($existing === $name) {
        return $schema;
      }
    }
    return null;
  }
}
