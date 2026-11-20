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
class WatermarkDetails extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Product that generated the audio, when known.
   */
  #[JsonProperty('product')]
  public ?string $product;

  /**
   * Generating model, when known.
   */
  #[JsonProperty('model')]
  public ?string $model;

  /**
   * Generation time, when known.
   */
  #[JsonProperty('generated_at')]
  public ?string $generatedAt;

  /**
   * Identifier of the matched generation record, when known.
   */
  #[JsonProperty('unique_id')]
  public ?string $uniqueId;

  /**
   * @param array{
   *   product?: ?string,
   *   model?: ?string,
   *   generatedAt?: ?string,
   *   uniqueId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->product = $values['product'] ?? null;
    $this->model = $values['model'] ?? null;
    $this->generatedAt = $values['generatedAt'] ?? null;
    $this->uniqueId = $values['uniqueId'] ?? null;

    if (array_key_exists('product', $values)) {
      $this->_dirtyFields['product'] = true;
    }
    if (array_key_exists('model', $values)) {
      $this->_dirtyFields['model'] = true;
    }
    if (array_key_exists('generatedAt', $values)) {
      $this->_dirtyFields['generated_at'] = true;
    }
    if (array_key_exists('uniqueId', $values)) {
      $this->_dirtyFields['unique_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->product !== null) {
      $parts[] = [
        'name' => 'product',
        'contents' => $this->product
      ];
    }

    if ($this->model !== null) {
      $parts[] = [
        'name' => 'model',
        'contents' => $this->model
      ];
    }

    if ($this->generatedAt !== null) {
      $parts[] = [
        'name' => 'generated_at',
        'contents' => $this->generatedAt
      ];
    }

    if ($this->uniqueId !== null) {
      $parts[] = [
        'name' => 'unique_id',
        'contents' => $this->uniqueId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
