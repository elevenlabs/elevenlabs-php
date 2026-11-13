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
class ScimGroupResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('scim_external_id', required: true)]
  public ?string $scimExternalId;

  #[JsonProperty('display_name', required: true)]
  public string $displayName;

  #[JsonProperty('created_at_unix')]
  public ?int $createdAtUnix;

  #[JsonProperty('updated_at_unix')]
  public ?int $updatedAtUnix;

  /**
   * @var ?value-of<\ElevenLabs\Types\SeatType>
   */
  #[JsonProperty('seat_type')]
  public ?string $seatType;

  /**
   * @param array{
   *   scimExternalId: ?string,
   *   displayName: string,
   *   createdAtUnix?: ?int,
   *   updatedAtUnix?: ?int,
   *   seatType?: ?value-of<\ElevenLabs\Types\SeatType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->scimExternalId = $values['scimExternalId'];
    $this->displayName = $values['displayName'];
    $this->createdAtUnix = $values['createdAtUnix'] ?? null;
    $this->updatedAtUnix = $values['updatedAtUnix'] ?? null;
    $this->seatType = $values['seatType'] ?? null;

    $this->_dirtyFields = [
      'scim_external_id' => true,
      'display_name' => true
    ];
    if (array_key_exists('createdAtUnix', $values)) {
      $this->_dirtyFields['created_at_unix'] = true;
    }
    if (array_key_exists('updatedAtUnix', $values)) {
      $this->_dirtyFields['updated_at_unix'] = true;
    }
    if (array_key_exists('seatType', $values)) {
      $this->_dirtyFields['seat_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'scim_external_id',
      'contents' => $this->scimExternalId
    ];

    $parts[] = [
      'name' => 'display_name',
      'contents' => $this->displayName
    ];

    if ($this->createdAtUnix !== null) {
      $parts[] = [
        'name' => 'created_at_unix',
        'contents' => (string) $this->createdAtUnix
      ];
    }

    if ($this->updatedAtUnix !== null) {
      $parts[] = [
        'name' => 'updated_at_unix',
        'contents' => (string) $this->updatedAtUnix
      ];
    }

    if ($this->seatType !== null) {
      $parts[] = [
        'name' => 'seat_type',
        'contents' => $this->seatType
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
