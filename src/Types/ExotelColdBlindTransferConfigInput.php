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
class ExotelColdBlindTransferConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('transfer_destination', required: true)]
  public \ElevenLabs\Types\ExotelColdBlindTransferConfigInputTransferDestination $transferDestination;

  /**
   * @var ?value-of<\ElevenLabs\Types\ExotelColdBlindTransferConfigInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   transferDestination: \ElevenLabs\Types\ExotelColdBlindTransferConfigInputTransferDestination,
   *   type?: ?value-of<\ElevenLabs\Types\ExotelColdBlindTransferConfigInputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->transferDestination = $values['transferDestination'];
    $this->type = $values['type'] ?? 'exotel_cold_blind_transfer';

    $this->_dirtyFields = [
      'transfer_destination' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'transfer_destination',
      'contents' => json_encode($this->transferDestination),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
