<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools\Models;

/**
 * @internal Serialization fixes for the generated models `build()` returns, so the request the
 * client sends matches the builder's wire format:
 *
 * - A map field (such as `properties`) whose keys are `"0"`, `"1"`… is a PHP list, and an empty
 *   one is `[]`; json_encode would write either as a JSON array. These are written as objects.
 * - The generated `fromJson()` decodes with associative arrays, so a `{}` inside a free-form
 *   constant becomes `[]`. The constant is written exactly as the builder had it.
 *
 * Hand-written (see `.fernignore`).
 */
trait KeepsWireShape
{
  private bool $hasWireConstant = false;
  private mixed $wireConstant = null;

  /** Writes `constant_value` exactly as given, `{}` included. */
  public function keepConstant(mixed $value): void
  {
    $this->hasWireConstant = true;
    $this->wireConstant = $value;
  }

  /**
   * @return array<mixed>
   */
  public function jsonSerialize(): array
  {
    $out = parent::jsonSerialize();
    foreach ($this->mapKeys() as $key) {
      if (isset($out[$key]) && is_array($out[$key]) && array_is_list($out[$key])) {
        $out[$key] = (object) $out[$key];
      }
    }
    if ($this->hasWireConstant) {
      $out['constant_value'] = $this->wireConstant;
    }
    return $out;
  }
}
