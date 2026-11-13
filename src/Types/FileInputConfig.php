<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

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
class FileInputConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * When enabled, users may attach images, PDFs, or text files in chat when the LLM supports multimodal input.
   */
  #[JsonProperty('enabled')]
  public ?bool $enabled;

  /**
   * Number of most-recent files kept in memory during a conversation. Older files are summarized and their bytes freed.
   */
  #[JsonProperty('max_files_in_memory')]
  public ?int $maxFilesInMemory;

  /**
   * Total files a user can upload in one conversation. Uploads are billed per file. Use -1 for no limit, or a value >= max_files_in_memory.
   */
  #[JsonProperty('max_files_per_conversation')]
  public ?int $maxFilesPerConversation;

  /**
   * @param array{
   *   enabled?: ?bool,
   *   maxFilesInMemory?: ?int,
   *   maxFilesPerConversation?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enabled = $values['enabled'] ?? null;
    $this->maxFilesInMemory = $values['maxFilesInMemory'] ?? null;
    $this->maxFilesPerConversation = $values['maxFilesPerConversation'] ?? null;

    if (array_key_exists('enabled', $values)) {
      $this->_dirtyFields['enabled'] = true;
    }
    if (array_key_exists('maxFilesInMemory', $values)) {
      $this->_dirtyFields['max_files_in_memory'] = true;
    }
    if (array_key_exists('maxFilesPerConversation', $values)) {
      $this->_dirtyFields['max_files_per_conversation'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->enabled !== null) {
      $parts[] = [
        'name' => 'enabled',
        'contents' => $this->enabled ? 'true' : 'false'
      ];
    }

    if ($this->maxFilesInMemory !== null) {
      $parts[] = [
        'name' => 'max_files_in_memory',
        'contents' => (string) $this->maxFilesInMemory
      ];
    }

    if ($this->maxFilesPerConversation !== null) {
      $parts[] = [
        'name' => 'max_files_per_conversation',
        'contents' => (string) $this->maxFilesPerConversation
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->maxFilesInMemory, 'max_files_in_memory', min: 1, max: 30);
  }
}
