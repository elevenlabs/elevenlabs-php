<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

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
class AttachedUserEvaluationRef extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AttachedUserEvaluationRefSource>
   */
  #[JsonProperty('source', required: true)]
  public string $source;

  /**
   * Id of the referenced user evaluation item.
   */
  #[JsonProperty('analysis_item_id', required: true)]
  public string $analysisItemId;

  /**
   * Primary item version whose result feeds scoring. 'latest' tracks the item's latest published version.
   */
  #[JsonProperty('version_id')]
  public ?string $versionId;

  /**
   * @var string[]|null
   * Extra item versions to also run for comparison (A/B). These are executed and stored but excluded from scoring; the primary version_id is the one that scores.
   */
  #[JsonProperty('additional_version_ids'), ArrayType(['string'])]
  public ?array $additionalVersionIds;

  /**
   * @var ?value-of<\ElevenLabs\Types\AnalysisScope>
   */
  #[JsonProperty('scope')]
  public ?string $scope;

  /**
   * Optional relative weight for aggregate scoring.
   */
  #[JsonProperty('weight')]
  public ?float $weight;

  /**
   * @param array{
   *   source: value-of<\ElevenLabs\Types\AttachedUserEvaluationRefSource>,
   *   analysisItemId: string,
   *   versionId?: ?string,
   *   additionalVersionIds?: string[]|null,
   *   scope?: ?value-of<\ElevenLabs\Types\AnalysisScope>,
   *   weight?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->source = $values['source'];
    $this->analysisItemId = $values['analysisItemId'];
    $this->versionId = $values['versionId'] ?? null;
    $this->additionalVersionIds = $values['additionalVersionIds'] ?? null;
    $this->scope = $values['scope'] ?? null;
    $this->weight = $values['weight'] ?? null;

    $this->_dirtyFields = [
      'source' => true,
      'analysis_item_id' => true
    ];
    if (array_key_exists('versionId', $values)) {
      $this->_dirtyFields['version_id'] = true;
    }
    if (array_key_exists('additionalVersionIds', $values)) {
      $this->_dirtyFields['additional_version_ids'] = true;
    }
    if (array_key_exists('scope', $values)) {
      $this->_dirtyFields['scope'] = true;
    }
    if (array_key_exists('weight', $values)) {
      $this->_dirtyFields['weight'] = true;
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

    if ($this->additionalVersionIds !== null) {
      foreach ($this->additionalVersionIds ?? [] as $item) {
        $parts[] = [
          'name' => 'additional_version_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->scope !== null) {
      $parts[] = [
        'name' => 'scope',
        'contents' => $this->scope
      ];
    }

    if ($this->weight !== null) {
      $parts[] = [
        'name' => 'weight',
        'contents' => (string) $this->weight
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
