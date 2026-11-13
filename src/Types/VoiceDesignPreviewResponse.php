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
class VoiceDesignPreviewResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\VoicePreviewResponseModel[]
   * The previews of the generated voices.
   */
  #[
    JsonProperty('previews', required: true),
    ArrayType([\ElevenLabs\Types\VoicePreviewResponseModel::class])
  ]
  public array $previews;

  /**
   * The text used to preview the voices.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * @param array{
   *   previews: \ElevenLabs\Types\VoicePreviewResponseModel[],
   *   text: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->previews = $values['previews'];
    $this->text = $values['text'];

    $this->_dirtyFields = [
      'previews' => true,
      'text' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'previews',
      'contents' => json_encode($this->previews),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->previews as $item) {
      $item->validate();
    }
  }
}
