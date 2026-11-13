<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationHistoryRedactionConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether conversation history redaction is enabled
   */
  #[JsonProperty('enabled')]
  public ?bool $enabled;

  /**
   * @var array<value-of<\ElevenLabs\Types\ConfigEntityType>>|null
   * The entities to redact from the conversation transcript, audio and analysis. Use top-level types like 'name', 'email_address', or dot notation for specific subtypes like 'name.full_name'.
   */
  #[JsonProperty('entities'), ArrayType(['string'])]
  public ?array $entities;

  /**
   * @var string[]|null
   * Data collection item IDs whose extracted values are not redacted. Their rationales are still redacted.
   */
  #[JsonProperty('excluded_data_collection_ids'), ArrayType(['string'])]
  public ?array $excludedDataCollectionIds;

  /**
   * @param array{
   *   enabled?: ?bool,
   *   entities?: array<value-of<\ElevenLabs\Types\ConfigEntityType>>|null,
   *   excludedDataCollectionIds?: string[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enabled = $values['enabled'] ?? null;
    $this->entities = $values['entities'] ?? null;
    $this->excludedDataCollectionIds = $values['excludedDataCollectionIds'] ?? null;

    if (array_key_exists('enabled', $values)) {
      $this->_dirtyFields['enabled'] = true;
    }
    if (array_key_exists('entities', $values)) {
      $this->_dirtyFields['entities'] = true;
    }
    if (array_key_exists('excludedDataCollectionIds', $values)) {
      $this->_dirtyFields['excluded_data_collection_ids'] = true;
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

    if ($this->entities !== null) {
      foreach ($this->entities ?? [] as $item) {
        $parts[] = [
          'name' => 'entities',
          'contents' => $item
        ];
      }
    }

    if ($this->excludedDataCollectionIds !== null) {
      foreach ($this->excludedDataCollectionIds ?? [] as $item) {
        $parts[] = [
          'name' => 'excluded_data_collection_ids',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray(
      $this->excludedDataCollectionIds,
      'excluded_data_collection_ids',
      maxItems: 50
    );
  }
}
