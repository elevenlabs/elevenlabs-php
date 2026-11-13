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
class BodyCreateFolderV1ConvaiKnowledgeBaseFolderPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * A custom, human-readable name for the document.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * If set, the created document or folder will be placed inside the given folder.
   */
  #[JsonProperty('parent_folder_id')]
  public ?string $parentFolderId;

  /**
   * Whether to enable auto-sync for this URL document.
   */
  #[JsonProperty('enable_auto_sync')]
  public ?bool $enableAutoSync;

  /**
   * Whether to automatically remove the document if the URL becomes unavailable. Only applicable when auto-sync is enabled.
   */
  #[JsonProperty('auto_remove')]
  public ?bool $autoRemove;

  /**
   * Minimum frequency (in days) at which the underlying eligible documents are refreshed. The actual interval may be shorter, never longer. Defaults to 7, tightened to the parent folder's frequency if that is stricter. Only applicable when auto-sync is enabled.
   */
  #[JsonProperty('minimum_frequency_days')]
  public ?int $minimumFrequencyDays;

  /**
   * @param array{
   *   name: string,
   *   parentFolderId?: ?string,
   *   enableAutoSync?: ?bool,
   *   autoRemove?: ?bool,
   *   minimumFrequencyDays?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->parentFolderId = $values['parentFolderId'] ?? null;
    $this->enableAutoSync = $values['enableAutoSync'] ?? null;
    $this->autoRemove = $values['autoRemove'] ?? null;
    $this->minimumFrequencyDays = $values['minimumFrequencyDays'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('parentFolderId', $values)) {
      $this->_dirtyFields['parent_folder_id'] = true;
    }
    if (array_key_exists('enableAutoSync', $values)) {
      $this->_dirtyFields['enable_auto_sync'] = true;
    }
    if (array_key_exists('autoRemove', $values)) {
      $this->_dirtyFields['auto_remove'] = true;
    }
    if (array_key_exists('minimumFrequencyDays', $values)) {
      $this->_dirtyFields['minimum_frequency_days'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->parentFolderId !== null) {
      $parts[] = [
        'name' => 'parent_folder_id',
        'contents' => $this->parentFolderId
      ];
    }

    if ($this->enableAutoSync !== null) {
      $parts[] = [
        'name' => 'enable_auto_sync',
        'contents' => $this->enableAutoSync ? 'true' : 'false'
      ];
    }

    if ($this->autoRemove !== null) {
      $parts[] = [
        'name' => 'auto_remove',
        'contents' => $this->autoRemove ? 'true' : 'false'
      ];
    }

    if ($this->minimumFrequencyDays !== null) {
      $parts[] = [
        'name' => 'minimum_frequency_days',
        'contents' => (string) $this->minimumFrequencyDays
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', minLength: 1);
    Validator::validateNumber(
      $this->minimumFrequencyDays,
      'minimum_frequency_days',
      min: 1,
      max: 180
    );
  }
}
