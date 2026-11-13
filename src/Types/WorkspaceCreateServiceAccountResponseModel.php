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
class WorkspaceCreateServiceAccountResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('service-account-user-id', required: true)]
  public string $serviceAccountUserId;

  /**
   * @param array{
   *   serviceAccountUserId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->serviceAccountUserId = $values['serviceAccountUserId'];

    $this->_dirtyFields = [
      'service-account-user-id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'service-account-user-id',
      'contents' => $this->serviceAccountUserId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
