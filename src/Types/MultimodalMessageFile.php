<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Deprecated: single attachment, kept for clients that predate `files`. Ignored when `files` is set.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MultimodalMessageFile extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\MultimodalMessageFileType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('file_id', required: true)]
  public string $fileId;

  /**
   * @param array{
   *   fileId: string,
   *   type?: ?value-of<\ElevenLabs\Types\MultimodalMessageFileType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'file_input';
    $this->fileId = $values['fileId'];

    $this->_dirtyFields = [
      'file_id' => true
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
      'name' => 'file_id',
      'contents' => $this->fileId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
