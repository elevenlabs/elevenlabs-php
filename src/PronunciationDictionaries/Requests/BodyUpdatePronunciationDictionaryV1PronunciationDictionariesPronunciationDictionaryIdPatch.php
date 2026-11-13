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
class BodyUpdatePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdPatch
  extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether to archive the pronunciation dictionary.
   */
  #[JsonProperty('archived')]
  public ?bool $archived;

  /**
   * The name of the pronunciation dictionary, used for identification only.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * @param array{
   *   archived?: ?bool,
   *   name?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->archived = $values['archived'] ?? null;
    $this->name = $values['name'] ?? null;

    if (array_key_exists('archived', $values)) {
      $this->_dirtyFields['archived'] = true;
    }
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->archived !== null) {
      $parts[] = [
        'name' => 'archived',
        'contents' => $this->archived ? 'true' : 'false'
      ];
    }

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
