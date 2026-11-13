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
class UpdateAnalysisItemAttachmentsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\UpdateAnalysisItemAttachmentsResponseModelResultsItem[]
   */
  #[
    JsonProperty('results', required: true),
    ArrayType([\ElevenLabs\Types\UpdateAnalysisItemAttachmentsResponseModelResultsItem::class])
  ]
  public array $results;

  /**
   * @param array{
   *   results: \ElevenLabs\Types\UpdateAnalysisItemAttachmentsResponseModelResultsItem[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->results = $values['results'];

    $this->_dirtyFields = [
      'results' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'results',
      'contents' => json_encode($this->results),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
