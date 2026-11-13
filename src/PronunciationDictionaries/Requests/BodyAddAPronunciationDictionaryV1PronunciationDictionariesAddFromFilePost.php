<?php

declare(strict_types=1);

namespace ElevenLabs\PronunciationDictionaries\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromFilePost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name of the pronunciation dictionary, used for identification only.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?\ElevenLabs\Utils\File
   * A lexicon .pls file which we will use to initialize the project with.
   */
  #[JsonProperty('file')]
  public ?\ElevenLabs\Utils\File $file;

  /**
   * A description of the pronunciation dictionary, used for identification only.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var ?value-of<\ElevenLabs\PronunciationDictionaries\Types\AddPronunciationDictionaryRequestWorkspaceAccess>
   * Should be one of 'admin', 'editor' or 'viewer'. If not provided, defaults to no access.
   */
  #[JsonProperty('workspace_access')]
  public ?string $workspaceAccess;

  /**
   * @param array{
   *   name: string,
   *   file?: ?\ElevenLabs\Utils\File,
   *   description?: ?string,
   *   workspaceAccess?: ?value-of<\ElevenLabs\PronunciationDictionaries\Types\AddPronunciationDictionaryRequestWorkspaceAccess>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->file = $values['file'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->workspaceAccess = $values['workspaceAccess'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('file', $values)) {
      $this->_dirtyFields['file'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('workspaceAccess', $values)) {
      $this->_dirtyFields['workspace_access'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->file !== null) {
      $parts[] = $this->file->toMultipartFormDataPart('file')->toGuzzlePart();
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->workspaceAccess !== null) {
      $parts[] = [
        'name' => 'workspace_access',
        'contents' => $this->workspaceAccess
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
