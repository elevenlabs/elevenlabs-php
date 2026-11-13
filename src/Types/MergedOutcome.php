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
class MergedOutcome extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\MergedOutcomeStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  #[JsonProperty('version_id', required: true)]
  public string $versionId;

  #[JsonProperty('at', required: true)]
  public int $at;

  #[JsonProperty('by_user_id', required: true)]
  public ?string $byUserId;

  /**
   * @param array{
   *   versionId: string,
   *   at: int,
   *   byUserId: ?string,
   *   status?: ?value-of<\ElevenLabs\Types\MergedOutcomeStatus>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->status = $values['status'] ?? 'merged';
    $this->versionId = $values['versionId'];
    $this->at = $values['at'];
    $this->byUserId = $values['byUserId'];

    $this->_dirtyFields = [
      'version_id' => true,
      'at' => true,
      'by_user_id' => true
    ];
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    $parts[] = [
      'name' => 'version_id',
      'contents' => $this->versionId
    ];

    $parts[] = [
      'name' => 'at',
      'contents' => (string) $this->at
    ];

    $parts[] = [
      'name' => 'by_user_id',
      'contents' => $this->byUserId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
