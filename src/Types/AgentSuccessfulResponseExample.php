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
class AgentSuccessfulResponseExample extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('response', required: true)]
  public string $response;

  /**
   * @var value-of<\ElevenLabs\Types\AgentSuccessfulResponseExampleType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @param array{
   *   response: string,
   *   type: value-of<\ElevenLabs\Types\AgentSuccessfulResponseExampleType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->response = $values['response'];
    $this->type = $values['type'];

    $this->_dirtyFields = [
      'response' => true,
      'type' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'response',
      'contents' => $this->response
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
