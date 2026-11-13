<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents\Requests;

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
class BodyCreateTextDocumentV1ConvaiKnowledgeBaseTextPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Text content to be added to the knowledge base.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * A custom, human-readable name for the document.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * If set, the created document or folder will be placed inside the given folder.
   */
  #[JsonProperty('parent_folder_id')]
  public ?string $parentFolderId;

  /**
   * @param array{
   *   text: string,
   *   name?: ?string,
   *   parentFolderId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->name = $values['name'] ?? null;
    $this->parentFolderId = $values['parentFolderId'] ?? null;

    $this->_dirtyFields = [
      'text' => true
    ];
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('parentFolderId', $values)) {
      $this->_dirtyFields['parent_folder_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->parentFolderId !== null) {
      $parts[] = [
        'name' => 'parent_folder_id',
        'contents' => $this->parentFolderId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', minLength: 1);
  }
}
