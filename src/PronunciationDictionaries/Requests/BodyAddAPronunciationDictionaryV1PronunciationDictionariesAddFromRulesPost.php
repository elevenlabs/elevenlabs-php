<?php

declare(strict_types=1);

namespace ElevenLabs\PronunciationDictionaries\Requests;

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
class BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\PronunciationDictionaries\Types\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostRulesItem[]
   * List of pronunciation rules. Rule can be either:
   *     an alias rule: {'string_to_replace': 'a', 'type': 'alias', 'alias': 'b', }
   *     or a phoneme rule: {'string_to_replace': 'a', 'type': 'phoneme', 'phoneme': 'b', 'alphabet': 'ipa' }
   */
  #[
    JsonProperty('rules', required: true),
    ArrayType([
      \ElevenLabs\PronunciationDictionaries\Types\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostRulesItem::class
    ])
  ]
  public array $rules;

  /**
   * The name of the pronunciation dictionary, used for identification only.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * A description of the pronunciation dictionary, used for identification only.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var ?value-of<\ElevenLabs\PronunciationDictionaries\Types\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostWorkspaceAccess>
   * Should be one of 'admin', 'editor' or 'viewer'. If not provided, defaults to no access.
   */
  #[JsonProperty('workspace_access')]
  public ?string $workspaceAccess;

  /**
   * @param array{
   *   rules: \ElevenLabs\PronunciationDictionaries\Types\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostRulesItem[],
   *   name: string,
   *   description?: ?string,
   *   workspaceAccess?: ?value-of<\ElevenLabs\PronunciationDictionaries\Types\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostWorkspaceAccess>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->rules = $values['rules'];
    $this->name = $values['name'];
    $this->description = $values['description'] ?? null;
    $this->workspaceAccess = $values['workspaceAccess'] ?? null;

    $this->_dirtyFields = [
      'rules' => true,
      'name' => true
    ];
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
      'name' => 'rules',
      'contents' => json_encode($this->rules),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

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
