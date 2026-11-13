<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Date;
use DateTime;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MusicFinetuneResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Unique identifier of the finetune.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * Name of the finetune.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var string[]
   * Tags associated with the finetune.
   */
  #[JsonProperty('tags', required: true), ArrayType(['string'])]
  public array $tags;

  /**
   * Primary musical genre of the finetune.
   */
  #[JsonProperty('primary_genre')]
  public ?string $primaryGenre;

  /**
   * The base music model the finetune was trained on.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  /**
   * When the finetune was created (UTC).
   */
  #[JsonProperty('created_at', required: true), Date(Date::TYPE_DATETIME)]
  public DateTime $createdAt;

  /**
   * @var value-of<\ElevenLabs\Types\FinetuneVisibility>
   */
  #[JsonProperty('visibility', required: true)]
  public string $visibility;

  /**
   * @var value-of<\ElevenLabs\Types\FinetuneCreatedBy>
   */
  #[JsonProperty('created_by', required: true)]
  public string $createdBy;

  /**
   * @var value-of<\ElevenLabs\Types\MusicFinetuneStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * Training progress from 0.0 to 1.0.
   */
  #[JsonProperty('training_progress', required: true)]
  public float $trainingProgress;

  /**
   * @var ?value-of<\ElevenLabs\Types\MusicFinetuneFailureReason>
   * Reason the finetune failed or was blocked, if applicable.
   */
  #[JsonProperty('failure_reason')]
  public ?string $failureReason;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   tags: string[],
   *   modelId: string,
   *   createdAt: DateTime,
   *   visibility: value-of<\ElevenLabs\Types\FinetuneVisibility>,
   *   createdBy: value-of<\ElevenLabs\Types\FinetuneCreatedBy>,
   *   status: value-of<\ElevenLabs\Types\MusicFinetuneStatus>,
   *   trainingProgress: float,
   *   primaryGenre?: ?string,
   *   failureReason?: ?value-of<\ElevenLabs\Types\MusicFinetuneFailureReason>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->name = $values['name'];
    $this->tags = $values['tags'];
    $this->primaryGenre = $values['primaryGenre'] ?? null;
    $this->modelId = $values['modelId'];
    $this->createdAt = $values['createdAt'];
    $this->visibility = $values['visibility'];
    $this->createdBy = $values['createdBy'];
    $this->status = $values['status'];
    $this->trainingProgress = $values['trainingProgress'];
    $this->failureReason = $values['failureReason'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'name' => true,
      'tags' => true,
      'model_id' => true,
      'created_at' => true,
      'visibility' => true,
      'created_by' => true,
      'status' => true,
      'training_progress' => true
    ];
    if (array_key_exists('primaryGenre', $values)) {
      $this->_dirtyFields['primary_genre'] = true;
    }
    if (array_key_exists('failureReason', $values)) {
      $this->_dirtyFields['failure_reason'] = true;
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
      'name' => 'name',
      'contents' => $this->name
    ];

    foreach ($this->tags as $item) {
      $parts[] = [
        'name' => 'tags',
        'contents' => $item
      ];
    }

    if ($this->primaryGenre !== null) {
      $parts[] = [
        'name' => 'primary_genre',
        'contents' => $this->primaryGenre
      ];
    }

    $parts[] = [
      'name' => 'model_id',
      'contents' => $this->modelId
    ];

    $parts[] = [
      'name' => 'created_at',
      'contents' => $this->createdAt
    ];

    $parts[] = [
      'name' => 'visibility',
      'contents' => $this->visibility
    ];

    $parts[] = [
      'name' => 'created_by',
      'contents' => $this->createdBy
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'training_progress',
      'contents' => (string) $this->trainingProgress
    ];

    if ($this->failureReason !== null) {
      $parts[] = [
        'name' => 'failure_reason',
        'contents' => $this->failureReason
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
