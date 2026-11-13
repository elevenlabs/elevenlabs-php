<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A reference image guiding a Veo generation, with its role.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class VeoImageReference extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('image', required: true)]
  public \ElevenLabs\Types\ImageReference $image;

  /**
   * @var value-of<\ElevenLabs\Types\VeoImageReferenceRole>
   * How the model uses the image: `subject` places its subject or scene elements into the video; `style` transfers its visual style.
   */
  #[JsonProperty('role', required: true)]
  public string $role;

  /**
   * @param array{
   *   image: \ElevenLabs\Types\ImageReference,
   *   role: value-of<\ElevenLabs\Types\VeoImageReferenceRole>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->image = $values['image'];
    $this->role = $values['role'];

    $this->_dirtyFields = [
      'image' => true,
      'role' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'image',
      'contents' => json_encode($this->image),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'role',
      'contents' => $this->role
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
