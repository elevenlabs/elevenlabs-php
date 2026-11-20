<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Products\Stock\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionAdjustProductStockRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * Location whose count changes.
   */
  #[JsonProperty('location_id', required: true)]
  public string $locationId;

  /**
   * Signed change to apply to on-hand. Prefer this over an absolute write whenever the intent is 'a few more/fewer'.
   */
  #[JsonProperty('delta', required: true)]
  public int $delta;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   locationId: string,
   *   delta: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->locationId = $values['locationId'];
    $this->delta = $values['delta'];

    $this->_dirtyFields = [
      'location_id' => true,
      'delta' => true
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
      'name' => 'delta',
      'contents' => (string) $this->delta
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
