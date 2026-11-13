<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Published versions, newest first; current_version_id is the main that unpinned refs resolve to.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AnalysisItemVersionsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AnalysisItemVersionResponseModel[]
   */
  #[
    JsonProperty('versions', required: true),
    ArrayType([\ElevenLabs\Types\AnalysisItemVersionResponseModel::class])
  ]
  public array $versions;

  #[JsonProperty('current_version_id', required: true)]
  public string $currentVersionId;

  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * @param array{
   *   versions: \ElevenLabs\Types\AnalysisItemVersionResponseModel[],
   *   currentVersionId: string,
   *   hasMore: bool,
   *   nextCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->versions = $values['versions'];
    $this->currentVersionId = $values['currentVersionId'];
    $this->nextCursor = $values['nextCursor'] ?? null;
    $this->hasMore = $values['hasMore'];

    $this->_dirtyFields = [
      'versions' => true,
      'current_version_id' => true,
      'has_more' => true
    ];
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'versions',
      'contents' => json_encode($this->versions),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'current_version_id',
      'contents' => $this->currentVersionId
    ];

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    $parts[] = [
      'name' => 'has_more',
      'contents' => $this->hasMore ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->versions as $item) {
      $item->validate();
    }
  }
}
