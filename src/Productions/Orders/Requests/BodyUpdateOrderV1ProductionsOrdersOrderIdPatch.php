<?php

declare(strict_types=1);

namespace ElevenLabs\Productions\Orders\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyUpdateOrderV1ProductionsOrdersOrderIdPatch extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('request', required: true)]
  public \ElevenLabs\Types\UpdateOrderRequest $request;

  /**
   * @param array{
   *   request: \ElevenLabs\Types\UpdateOrderRequest,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->request = $values['request'];

    $this->_dirtyFields = [
      'request' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'request',
      'contents' => json_encode($this->request),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->request->validate();
  }
}
