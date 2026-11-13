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
class EnvironmentVariableResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('label', required: true)]
  public string $label;

  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  #[JsonProperty('updated_at_unix_secs', required: true)]
  public int $updatedAtUnixSecs;

  #[JsonProperty('created_by_user_id')]
  public ?string $createdByUserId;

  /**
   * @var value-of<\ElevenLabs\Types\EnvironmentVariableResponseType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('workspace_id', required: true)]
  public string $workspaceId;

  /**
   * @var array<string, mixed>
   */
  #[JsonProperty('values', required: true), ArrayType(['string' => 'mixed'])]
  public array $values;

  /**
   * @param array{
   *   label: string,
   *   createdAtUnixSecs: int,
   *   updatedAtUnixSecs: int,
   *   type: value-of<\ElevenLabs\Types\EnvironmentVariableResponseType>,
   *   id: string,
   *   workspaceId: string,
   *   values: array<string, mixed>,
   *   createdByUserId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->label = $values['label'];
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];
    $this->updatedAtUnixSecs = $values['updatedAtUnixSecs'];
    $this->createdByUserId = $values['createdByUserId'] ?? null;
    $this->type = $values['type'];
    $this->id = $values['id'];
    $this->workspaceId = $values['workspaceId'];
    $this->values = $values['values'];

    $this->_dirtyFields = [
      'label' => true,
      'created_at_unix_secs' => true,
      'updated_at_unix_secs' => true,
      'type' => true,
      'id' => true,
      'workspace_id' => true,
      'values' => true
    ];
    if (array_key_exists('createdByUserId', $values)) {
      $this->_dirtyFields['created_by_user_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    $parts[] = [
      'name' => 'updated_at_unix_secs',
      'contents' => (string) $this->updatedAtUnixSecs
    ];

    if ($this->createdByUserId !== null) {
      $parts[] = [
        'name' => 'created_by_user_id',
        'contents' => $this->createdByUserId
      ];
    }

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'workspace_id',
      'contents' => $this->workspaceId
    ];

    $parts[] = [
      'name' => 'values',
      'contents' => json_encode($this->values),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
