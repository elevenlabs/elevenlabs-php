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
class ConvAiWorkspaceStoredSecretConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ConvAiWorkspaceStoredSecretConfigType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('secret_id', required: true)]
  public string $secretId;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('used_by', required: true)]
  public \ElevenLabs\Types\ConvAiStoredSecretDependencies $usedBy;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\ConvAiWorkspaceStoredSecretConfigType>,
   *   secretId: string,
   *   name: string,
   *   usedBy: \ElevenLabs\Types\ConvAiStoredSecretDependencies,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->secretId = $values['secretId'];
    $this->name = $values['name'];
    $this->usedBy = $values['usedBy'];

    $this->_dirtyFields = [
      'type' => true,
      'secret_id' => true,
      'name' => true,
      'used_by' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'secret_id',
      'contents' => $this->secretId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'used_by',
      'contents' => json_encode($this->usedBy),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->usedBy->validate();
  }
}
