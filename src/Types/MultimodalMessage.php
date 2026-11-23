<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MultimodalMessage extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\MultimodalMessageType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('text')]
  public ?\ElevenLabs\Types\MultimodalMessageText $text;

  /**
   * Deprecated: single attachment, kept for clients that predate `files`. Ignored when `files` is set.
   */
  #[JsonProperty('file')]
  public ?\ElevenLabs\Types\MultimodalMessageFile $file;

  /**
   * @var \ElevenLabs\Types\MultimodalMessageFilesItem[]|null
   * Files attached to this message, at most 5. Each file must already have been uploaded via the conversation file upload endpoint.
   */
  #[JsonProperty('files'), ArrayType([\ElevenLabs\Types\MultimodalMessageFilesItem::class])]
  public ?array $files;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\MultimodalMessageType>,
   *   text?: ?\ElevenLabs\Types\MultimodalMessageText,
   *   file?: ?\ElevenLabs\Types\MultimodalMessageFile,
   *   files?: \ElevenLabs\Types\MultimodalMessageFilesItem[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? 'multimodal_message';
    $this->text = $values['text'] ?? null;
    $this->file = $values['file'] ?? null;
    $this->files = $values['files'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
    if (array_key_exists('file', $values)) {
      $this->_dirtyFields['file'] = true;
    }
    if (array_key_exists('files', $values)) {
      $this->_dirtyFields['files'] = true;
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

    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => json_encode($this->text),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->file !== null) {
      $parts[] = [
        'name' => 'file',
        'contents' => json_encode($this->file),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->files !== null) {
      $parts[] = [
        'name' => 'files',
        'contents' => json_encode($this->files),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->text?->validate();
    $this->file?->validate();
    foreach ($this->files ?? [] as $item) {
      $item->validate();
    }
  }
}
