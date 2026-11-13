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
class WorkspaceServiceAccountListResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\WorkspaceServiceAccountResponseModel[]
   */
  #[
    JsonProperty('service-accounts', required: true),
    ArrayType([\ElevenLabs\Types\WorkspaceServiceAccountResponseModel::class])
  ]
  public array $serviceAccounts;

  /**
   * @param array{
   *   serviceAccounts: \ElevenLabs\Types\WorkspaceServiceAccountResponseModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->serviceAccounts = $values['serviceAccounts'];

    $this->_dirtyFields = [
      'service-accounts' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'service-accounts',
      'contents' => json_encode($this->serviceAccounts),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->serviceAccounts as $item) {
      $item->validate();
    }
  }
}
