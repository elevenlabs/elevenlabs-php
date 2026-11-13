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
class BodyRenderAudioOrVideoForTheGivenLanguageV1DubbingResourceDubbingIdRenderLanguagePost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\RenderType>
   */
  #[JsonProperty('render_type', required: true)]
  public string $renderType;

  /**
   * Whether to normalize the volume of the rendered audio.
   */
  #[JsonProperty('normalize_volume')]
  public ?bool $normalizeVolume;

  /**
   * @param array{
   *   renderType: value-of<\ElevenLabs\Types\RenderType>,
   *   normalizeVolume?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->renderType = $values['renderType'];
    $this->normalizeVolume = $values['normalizeVolume'] ?? null;

    $this->_dirtyFields = [
      'render_type' => true
    ];
    if (array_key_exists('normalizeVolume', $values)) {
      $this->_dirtyFields['normalize_volume'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'render_type',
      'contents' => $this->renderType
    ];

    if ($this->normalizeVolume !== null) {
      $parts[] = [
        'name' => 'normalize_volume',
        'contents' => $this->normalizeVolume ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
