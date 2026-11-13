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
class OpenAiAudioConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('input')]
  public ?\ElevenLabs\Types\OpenAiAudioInputConfigOutput $input;

  #[JsonProperty('output')]
  public ?\ElevenLabs\Types\OpenAiAudioOutputConfigOutput $output;

  /**
   * @param array{
   *   input?: ?\ElevenLabs\Types\OpenAiAudioInputConfigOutput,
   *   output?: ?\ElevenLabs\Types\OpenAiAudioOutputConfigOutput,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->input = $values['input'] ?? null;
    $this->output = $values['output'] ?? null;

    if (array_key_exists('input', $values)) {
      $this->_dirtyFields['input'] = true;
    }
    if (array_key_exists('output', $values)) {
      $this->_dirtyFields['output'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->input !== null) {
      $parts[] = [
        'name' => 'input',
        'contents' => json_encode($this->input),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->output !== null) {
      $parts[] = [
        'name' => 'output',
        'contents' => json_encode($this->output),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->input?->validate();
    $this->output?->validate();
  }
}
