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
class BodyUpdateDocumentV1ConvaiKnowledgeBaseDocumentationIdPatch extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * A custom, human-readable name for the document.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * Updated content for the document. Only supported for text documents, URL documents with auto-sync disabled, and file documents that are not synced from an external source.
   */
  #[JsonProperty('content')]
  public ?string $content;

  /**
   * Whether the document or folder is refreshed automatically. Only applicable to URL documents, folders, and externally-synced files. Leave unset to keep the current value.
   */
  #[JsonProperty('enable_auto_sync')]
  public ?bool $enableAutoSync;

  /**
   * Whether to automatically remove the document once its source is no longer available. Only applicable when auto-sync is enabled. Leave unset to keep the current value.
   */
  #[JsonProperty('auto_remove')]
  public ?bool $autoRemove;

  /**
   * Minimum frequency (in days) at which the document is refreshed. The actual interval may be shorter, never longer. Only applicable when auto-sync is enabled. Leave unset to keep the current value.
   */
  #[JsonProperty('minimum_frequency_days')]
  public ?int $minimumFrequencyDays;

  /**
   * Folders only. When true, items already in the folder are only tightened to stay at least as strict as the folder, and keep any setting that is stricter than the folder's. When false, they are set to exactly the folder's auto-sync settings. Ignored for externally synced folders, whose contents always follow the folder's schedule.
   */
  #[JsonProperty('tighten_only')]
  public ?bool $tightenOnly;

  /**
   * @param array{
   *   name?: ?string,
   *   content?: ?string,
   *   enableAutoSync?: ?bool,
   *   autoRemove?: ?bool,
   *   minimumFrequencyDays?: ?int,
   *   tightenOnly?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->name = $values['name'] ?? null;
    $this->content = $values['content'] ?? null;
    $this->enableAutoSync = $values['enableAutoSync'] ?? null;
    $this->autoRemove = $values['autoRemove'] ?? null;
    $this->minimumFrequencyDays = $values['minimumFrequencyDays'] ?? null;
    $this->tightenOnly = $values['tightenOnly'] ?? null;

    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('content', $values)) {
      $this->_dirtyFields['content'] = true;
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
    if (array_key_exists('tightenOnly', $values)) {
      $this->_dirtyFields['tighten_only'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->content !== null) {
      $parts[] = [
        'name' => 'content',
        'contents' => $this->content
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

    if ($this->tightenOnly !== null) {
      $parts[] = [
        'name' => 'tighten_only',
        'contents' => $this->tightenOnly ? 'true' : 'false'
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
