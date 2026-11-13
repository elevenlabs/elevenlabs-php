<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UnitTestToolCallParameter extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('eval', required: true)]
  public \ElevenLabs\Types\UnitTestToolCallParameterEval $eval;

  #[JsonProperty('path', required: true)]
  public string $path;

  /**
   * @param array{
   *   eval: \ElevenLabs\Types\UnitTestToolCallParameterEval,
   *   path: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->eval = $values['eval'];
    $this->path = $values['path'];

    $this->_dirtyFields = [
      'eval' => true,
      'path' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'eval',
      'contents' => json_encode($this->eval),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'path',
      'contents' => $this->path
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
