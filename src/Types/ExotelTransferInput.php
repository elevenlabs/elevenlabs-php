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
class ExotelTransferInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ExotelTransferInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('config', required: true)]
  public \ElevenLabs\Types\ExotelTransferInputConfig $config;

  /**
   * @param array{
   *   config: \ElevenLabs\Types\ExotelTransferInputConfig,
   *   type?: ?value-of<\ElevenLabs\Types\ExotelTransferInputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'exotel';
    $this->config = $values['config'];

    $this->_dirtyFields = [
      'config' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'config',
      'contents' => json_encode($this->config),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
