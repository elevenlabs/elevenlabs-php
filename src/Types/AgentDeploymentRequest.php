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
class AgentDeploymentRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AgentDeploymentRequestItem[]
   * List of deployment requests
   */
  #[
    JsonProperty('requests', required: true),
    ArrayType([\ElevenLabs\Types\AgentDeploymentRequestItem::class])
  ]
  public array $requests;

  /**
   * @param array{
   *   requests: \ElevenLabs\Types\AgentDeploymentRequestItem[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->requests = $values['requests'];

    $this->_dirtyFields = [
      'requests' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'requests',
      'contents' => json_encode($this->requests),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->requests as $item) {
      $item->validate();
    }
  }
}
