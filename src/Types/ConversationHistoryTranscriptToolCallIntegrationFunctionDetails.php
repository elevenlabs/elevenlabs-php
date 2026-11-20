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
class ConversationHistoryTranscriptToolCallIntegrationFunctionDetails extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, string>
   */
  #[JsonProperty('resolved_parameters', required: true), ArrayType(['string' => 'string'])]
  public array $resolvedParameters;

  /**
   * @param array{
   *   resolvedParameters: array<string, string>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resolvedParameters = $values['resolvedParameters'];

    $this->_dirtyFields = [
      'resolved_parameters' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'resolved_parameters',
      'contents' => json_encode($this->resolvedParameters),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
