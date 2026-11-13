<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class PronunciationDictionaryRulesResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the pronunciation dictionary.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * The version ID of the pronunciation dictionary.
   */
  #[JsonProperty('version_id', required: true)]
  public string $versionId;

  /**
   * The number of rules in the version of the pronunciation dictionary.
   */
  #[JsonProperty('version_rules_num', required: true)]
  public int $versionRulesNum;

  /**
   * @param array{
   *   id: string,
   *   versionId: string,
   *   versionRulesNum: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->versionId = $values['versionId'];
    $this->versionRulesNum = $values['versionRulesNum'];

    $this->_dirtyFields = [
      'id' => true,
      'version_id' => true,
      'version_rules_num' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'version_id',
      'contents' => $this->versionId
    ];

    $parts[] = [
      'name' => 'version_rules_num',
      'contents' => (string) $this->versionRulesNum
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
