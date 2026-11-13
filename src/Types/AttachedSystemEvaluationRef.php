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
class AttachedSystemEvaluationRef extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AttachedSystemEvaluationRefSource>
   */
  #[JsonProperty('source', required: true)]
  public string $source;

  /**
   * @var value-of<\ElevenLabs\Types\SystemEvaluationId>
   */
  #[JsonProperty('analysis_item_id', required: true)]
  public string $analysisItemId;

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
   *   source: value-of<\ElevenLabs\Types\AttachedSystemEvaluationRefSource>,
   *   analysisItemId: value-of<\ElevenLabs\Types\SystemEvaluationId>,
   *   scope?: ?value-of<\ElevenLabs\Types\AnalysisScope>,
   *   weight?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->source = $values['source'];
    $this->analysisItemId = $values['analysisItemId'];
    $this->scope = $values['scope'] ?? null;
    $this->weight = $values['weight'] ?? null;

    $this->_dirtyFields = [
      'source' => true,
      'analysis_item_id' => true
    ];
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
