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
class AttachedSystemDataCollectionRef extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AttachedSystemDataCollectionRefSource>
   */
  #[JsonProperty('source', required: true)]
  public string $source;

  /**
   * @var value-of<\ElevenLabs\Types\SystemDataCollectionId>
   */
  #[JsonProperty('analysis_item_id', required: true)]
  public string $analysisItemId;

  /**
   * @var ?value-of<\ElevenLabs\Types\AnalysisScope>
   */
  #[JsonProperty('scope')]
  public ?string $scope;

  /**
   * @param array{
   *   source: value-of<\ElevenLabs\Types\AttachedSystemDataCollectionRefSource>,
   *   analysisItemId: value-of<\ElevenLabs\Types\SystemDataCollectionId>,
   *   scope?: ?value-of<\ElevenLabs\Types\AnalysisScope>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->source = $values['source'];
    $this->analysisItemId = $values['analysisItemId'];
    $this->scope = $values['scope'] ?? null;

    $this->_dirtyFields = [
      'source' => true,
      'analysis_item_id' => true
    ];
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
