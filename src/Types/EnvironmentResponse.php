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
class EnvironmentResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Name of the environment, e.g. 'staging'.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * When the environment was created or one of its values last changed. Unset when neither is known.
   */
  #[JsonProperty('updated_at_unix_secs')]
  public ?int $updatedAtUnixSecs;

  /**
   * Unset for 'production' and when the creator is not known.
   */
  #[JsonProperty('created_by_user_id')]
  public ?string $createdByUserId;

  /**
   * @param array{
   *   name: string,
   *   updatedAtUnixSecs?: ?int,
   *   createdByUserId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->updatedAtUnixSecs = $values['updatedAtUnixSecs'] ?? null;
    $this->createdByUserId = $values['createdByUserId'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('updatedAtUnixSecs', $values)) {
      $this->_dirtyFields['updated_at_unix_secs'] = true;
    }
    if (array_key_exists('createdByUserId', $values)) {
      $this->_dirtyFields['created_by_user_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->updatedAtUnixSecs !== null) {
      $parts[] = [
        'name' => 'updated_at_unix_secs',
        'contents' => (string) $this->updatedAtUnixSecs
      ];
    }

    if ($this->createdByUserId !== null) {
      $parts[] = [
        'name' => 'created_by_user_id',
        'contents' => $this->createdByUserId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
