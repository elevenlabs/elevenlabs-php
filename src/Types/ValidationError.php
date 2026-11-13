<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ValidationError extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var (string|int)[]
   */
  #[JsonProperty('loc', required: true), ArrayType([new Union('string', 'integer')])]
  public array $loc;

  #[JsonProperty('msg', required: true)]
  public string $msg;

  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @param array{
   *   loc: (string|int)[],
   *   msg: string,
   *   type: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->loc = $values['loc'];
    $this->msg = $values['msg'];
    $this->type = $values['type'];

    $this->_dirtyFields = [
      'loc' => true,
      'msg' => true,
      'type' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'loc',
      'contents' => json_encode($this->loc),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'msg',
      'contents' => $this->msg
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
