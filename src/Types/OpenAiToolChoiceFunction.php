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
class OpenAiToolChoiceFunction extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\OpenAiToolChoiceFunctionType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('function', required: true)]
  public \ElevenLabs\Types\OpenAiToolChoiceFunctionInner $function;

  /**
   * @param array{
   *   function: \ElevenLabs\Types\OpenAiToolChoiceFunctionInner,
   *   type?: ?value-of<\ElevenLabs\Types\OpenAiToolChoiceFunctionType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'function';
    $this->function = $values['function'];

    $this->_dirtyFields = [
      'function' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'function',
      'contents' => json_encode($this->function),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->function->validate();
  }
}
