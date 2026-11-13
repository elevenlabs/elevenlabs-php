<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CreateOrderResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('order_id', required: true)]
  public string $orderId;

  /**
   * Whether this is a sandbox order.
   */
  #[JsonProperty('sandbox')]
  public ?bool $sandbox;

  /**
   * @param array{
   *   orderId: string,
   *   sandbox?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->orderId = $values['orderId'];
    $this->sandbox = $values['sandbox'] ?? null;

    $this->_dirtyFields = [
      'order_id' => true
    ];
    if (array_key_exists('sandbox', $values)) {
      $this->_dirtyFields['sandbox'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'order_id',
      'contents' => $this->orderId
    ];

    if ($this->sandbox !== null) {
      $parts[] = [
        'name' => 'sandbox',
        'contents' => $this->sandbox ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->orderId, 'order_id', pattern: '^prodorder_[a-z0-9]{26}$');
  }
}
