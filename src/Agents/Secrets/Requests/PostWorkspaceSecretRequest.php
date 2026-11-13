<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Secrets\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class PostWorkspaceSecretRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Agents\Secrets\Types\PostWorkspaceSecretRequestType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('value', required: true)]
  public string $value;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Agents\Secrets\Types\PostWorkspaceSecretRequestType>,
   *   name: string,
   *   value: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->name = $values['name'];
    $this->value = $values['value'];

    $this->_dirtyFields = [
      'type' => true,
      'name' => true,
      'value' => true
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
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'value',
      'contents' => $this->value
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
