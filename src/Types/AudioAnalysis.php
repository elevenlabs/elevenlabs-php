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
class AudioAnalysis extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AudioAnalysisStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  #[JsonProperty('data', required: true)]
  public ?\ElevenLabs\Types\AudioAnalysisResult $data;

  #[JsonProperty('updated_at_ms')]
  public ?int $updatedAtMs;

  /**
   * @param array{
   *   status: value-of<\ElevenLabs\Types\AudioAnalysisStatus>,
   *   data: ?\ElevenLabs\Types\AudioAnalysisResult,
   *   updatedAtMs?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->status = $values['status'];
    $this->data = $values['data'];
    $this->updatedAtMs = $values['updatedAtMs'] ?? null;

    $this->_dirtyFields = [
      'status' => true,
      'data' => true
    ];
    if (array_key_exists('updatedAtMs', $values)) {
      $this->_dirtyFields['updated_at_ms'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'data',
      'contents' => json_encode($this->data),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->updatedAtMs !== null) {
      $parts[] = [
        'name' => 'updated_at_ms',
        'contents' => (string) $this->updatedAtMs
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->data?->validate();
  }
}
