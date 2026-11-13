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
class OpenAiAudioInputFormat extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\OpenAiAudioFormat>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * Sample rate in Hz of `audio/pcm` input. Only 24000 is supported; G.711 formats are always 8000 and ignore this field.
   */
  #[JsonProperty('rate')]
  public ?int $rate;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\OpenAiAudioFormat>,
   *   rate?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? null;
    $this->rate = $values['rate'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('rate', $values)) {
      $this->_dirtyFields['rate'] = true;
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

    if ($this->rate !== null) {
      $parts[] = [
        'name' => 'rate',
        'contents' => (string) $this->rate
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
