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
class AnalysisItemResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('definition', required: true)]
  public \ElevenLabs\Types\AnalysisItemResponseModelDefinition $definition;

  #[JsonProperty('access_info', required: true)]
  public \ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  #[JsonProperty('updated_at_unix_secs', required: true)]
  public int $updatedAtUnixSecs;

  #[JsonProperty('current_version_id', required: true)]
  public string $currentVersionId;

  #[JsonProperty('legacy_source_id')]
  public ?string $legacySourceId;

  /**
   * @param array{
   *   id: string,
   *   definition: \ElevenLabs\Types\AnalysisItemResponseModelDefinition,
   *   accessInfo: \ElevenLabs\Types\ResourceAccessInfo,
   *   createdAtUnixSecs: int,
   *   updatedAtUnixSecs: int,
   *   currentVersionId: string,
   *   legacySourceId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->definition = $values['definition'];
    $this->accessInfo = $values['accessInfo'];
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];
    $this->updatedAtUnixSecs = $values['updatedAtUnixSecs'];
    $this->currentVersionId = $values['currentVersionId'];
    $this->legacySourceId = $values['legacySourceId'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'definition' => true,
      'access_info' => true,
      'created_at_unix_secs' => true,
      'updated_at_unix_secs' => true,
      'current_version_id' => true
    ];
    if (array_key_exists('legacySourceId', $values)) {
      $this->_dirtyFields['legacy_source_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'definition',
      'contents' => json_encode($this->definition),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'access_info',
      'contents' => json_encode($this->accessInfo),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    $parts[] = [
      'name' => 'updated_at_unix_secs',
      'contents' => (string) $this->updatedAtUnixSecs
    ];

    $parts[] = [
      'name' => 'current_version_id',
      'contents' => $this->currentVersionId
    ];

    if ($this->legacySourceId !== null) {
      $parts[] = [
        'name' => 'legacy_source_id',
        'contents' => $this->legacySourceId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->accessInfo->validate();
  }
}
