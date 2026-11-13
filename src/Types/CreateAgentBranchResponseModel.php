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
class CreateAgentBranchResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the created branch
   */
  #[JsonProperty('created_branch_id', required: true)]
  public string $createdBranchId;

  /**
   * ID of the first version on the created branch
   */
  #[JsonProperty('created_version_id', required: true)]
  public string $createdVersionId;

  /**
   * @param array{
   *   createdBranchId: string,
   *   createdVersionId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->createdBranchId = $values['createdBranchId'];
    $this->createdVersionId = $values['createdVersionId'];

    $this->_dirtyFields = [
      'created_branch_id' => true,
      'created_version_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'created_branch_id',
      'contents' => $this->createdBranchId
    ];

    $parts[] = [
      'name' => 'created_version_id',
      'contents' => $this->createdVersionId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
