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
class TextOutputItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TextOutputItemType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var value-of<\ElevenLabs\Types\TextOutputItemRole>
   */
  #[JsonProperty('role', required: true)]
  public string $role;

  #[JsonProperty('id')]
  public ?string $id;

  #[JsonProperty('text', required: true)]
  public string $text;

  #[JsonProperty('created_at_unix_ms')]
  public ?int $createdAtUnixMs;

  /**
   * @param array{
   *   role: value-of<\ElevenLabs\Types\TextOutputItemRole>,
   *   text: string,
   *   type?: ?value-of<\ElevenLabs\Types\TextOutputItemType>,
   *   id?: ?string,
   *   createdAtUnixMs?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'text';
    $this->role = $values['role'];
    $this->id = $values['id'] ?? null;
    $this->text = $values['text'];
    $this->createdAtUnixMs = $values['createdAtUnixMs'] ?? null;

    $this->_dirtyFields = [
      'role' => true,
      'text' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('id', $values)) {
      $this->_dirtyFields['id'] = true;
    }
    if (array_key_exists('createdAtUnixMs', $values)) {
      $this->_dirtyFields['created_at_unix_ms'] = true;
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
      'name' => 'role',
      'contents' => $this->role
    ];

    if ($this->id !== null) {
      $parts[] = [
        'name' => 'id',
        'contents' => $this->id
      ];
    }

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    if ($this->createdAtUnixMs !== null) {
      $parts[] = [
        'name' => 'created_at_unix_ms',
        'contents' => (string) $this->createdAtUnixMs
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
