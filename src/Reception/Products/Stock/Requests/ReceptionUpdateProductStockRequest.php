<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Products\Stock\Requests;

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
class ReceptionUpdateProductStockRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * Location whose count is set.
   */
  #[JsonProperty('location_id', required: true)]
  public string $locationId;

  /**
   * The new on-hand quantity.
   */
  #[JsonProperty('on_hand', required: true)]
  public int $onHand;

  /**
   * On-hand value the caller last saw. The write is rejected with a 409 if it no longer matches, so a sale made while the caller was editing is never overwritten.
   */
  #[JsonProperty('expected_on_hand', required: true)]
  public int $expectedOnHand;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   locationId: string,
   *   onHand: int,
   *   expectedOnHand: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->locationId = $values['locationId'];
    $this->onHand = $values['onHand'];
    $this->expectedOnHand = $values['expectedOnHand'];

    $this->_dirtyFields = [
      'location_id' => true,
      'on_hand' => true,
      'expected_on_hand' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'location_id',
      'contents' => $this->locationId
    ];

    $parts[] = [
      'name' => 'on_hand',
      'contents' => (string) $this->onHand
    ];

    $parts[] = [
      'name' => 'expected_on_hand',
      'contents' => (string) $this->expectedOnHand
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->onHand, 'on_hand', min: 0);
    Validator::validateNumber($this->expectedOnHand, 'expected_on_hand', min: 0);
  }
}
