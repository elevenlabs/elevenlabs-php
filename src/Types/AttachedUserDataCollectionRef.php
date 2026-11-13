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
class AttachedUserDataCollectionRef extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AttachedUserDataCollectionRefSource>
   */
  #[JsonProperty('source', required: true)]
  public string $source;

  /**
   * Id of the referenced user data-collection item.
   */
  #[JsonProperty('analysis_item_id', required: true)]
  public string $analysisItemId;

  /**
   * Pinned item version. 'latest' tracks the item's latest published version.
   */
  #[JsonProperty('version_id')]
  public ?string $versionId;

  /**
   * @var ?value-of<\ElevenLabs\Types\AnalysisScope>
   */
  #[JsonProperty('scope')]
  public ?string $scope;

  /**
   * @param array{
   *   source: value-of<\ElevenLabs\Types\AttachedUserDataCollectionRefSource>,
   *   analysisItemId: string,
   *   versionId?: ?string,
   *   scope?: ?value-of<\ElevenLabs\Types\AnalysisScope>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->source = $values['source'];
    $this->analysisItemId = $values['analysisItemId'];
    $this->versionId = $values['versionId'] ?? null;
    $this->scope = $values['scope'] ?? null;

    $this->_dirtyFields = [
      'source' => true,
      'analysis_item_id' => true
    ];
    if (array_key_exists('versionId', $values)) {
      $this->_dirtyFields['version_id'] = true;
    }
    if (array_key_exists('scope', $values)) {
      $this->_dirtyFields['scope'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'source',
      'contents' => $this->source
    ];

    $parts[] = [
      'name' => 'analysis_item_id',
      'contents' => $this->analysisItemId
    ];

    if ($this->versionId !== null) {
      $parts[] = [
        'name' => 'version_id',
        'contents' => $this->versionId
      ];
    }

    if ($this->scope !== null) {
      $parts[] = [
        'name' => 'scope',
        'contents' => $this->scope
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
