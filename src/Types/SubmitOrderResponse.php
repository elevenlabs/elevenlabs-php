<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\Date;
use ElevenLabs\Utils\Validator;
use DateTime;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SubmitOrderResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('order_id', required: true)]
  public string $orderId;

  /**
   * @var value-of<\ElevenLabs\Types\OrderState>
   */
  #[JsonProperty('state', required: true)]
  public string $state;

  /**
   * The timestamp when the order was submitted.
   */
  #[JsonProperty('submitted_at', required: true), Date(Date::TYPE_DATETIME)]
  public DateTime $submittedAt;

  /**
   * @param array{
   *   orderId: string,
   *   state: value-of<\ElevenLabs\Types\OrderState>,
   *   submittedAt: DateTime,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->orderId = $values['orderId'];
    $this->state = $values['state'];
    $this->submittedAt = $values['submittedAt'];

    $this->_dirtyFields = [
      'order_id' => true,
      'state' => true,
      'submitted_at' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'order_id',
      'contents' => $this->orderId
    ];

    $parts[] = [
      'name' => 'state',
      'contents' => $this->state
    ];

    $parts[] = [
      'name' => 'submitted_at',
      'contents' => $this->submittedAt
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->orderId, 'order_id', pattern: '^prodorder_[a-z0-9]{26}$');
  }
}
