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
class PodcastBulletinMode extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\PodcastBulletinModeType>
   * The type of podcast to create.
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('bulletin', required: true)]
  public \ElevenLabs\Types\PodcastBulletinModeData $bulletin;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\PodcastBulletinModeType>,
   *   bulletin: \ElevenLabs\Types\PodcastBulletinModeData,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->bulletin = $values['bulletin'];

    $this->_dirtyFields = [
      'type' => true,
      'bulletin' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'bulletin',
      'contents' => json_encode($this->bulletin),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->bulletin->validate();
  }
}
