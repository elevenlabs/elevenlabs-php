<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class EnvironmentsListResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\EnvironmentResponse[]
   * All workspace environments, 'production' first. Variables without a value for an environment fall back to their production value.
   */
  #[
    JsonProperty('environments', required: true),
    ArrayType([\ElevenLabs\Types\EnvironmentResponse::class])
  ]
  public array $environments;

  /**
   * @param array{
   *   environments: \ElevenLabs\Types\EnvironmentResponse[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->environments = $values['environments'];

    $this->_dirtyFields = [
      'environments' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'environments',
      'contents' => json_encode($this->environments),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->environments as $item) {
      $item->validate();
    }
  }
}
