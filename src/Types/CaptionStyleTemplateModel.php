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
class CaptionStyleTemplateModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('key', required: true)]
  public string $key;

  #[JsonProperty('label', required: true)]
  public string $label;

  #[JsonProperty('requires_high_fps')]
  public ?bool $requiresHighFps;

  /**
   * @param array{
   *   key: string,
   *   label: string,
   *   requiresHighFps?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->key = $values['key'];
    $this->label = $values['label'];
    $this->requiresHighFps = $values['requiresHighFps'] ?? null;

    $this->_dirtyFields = [
      'key' => true,
      'label' => true
    ];
    if (array_key_exists('requiresHighFps', $values)) {
      $this->_dirtyFields['requires_high_fps'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'key',
      'contents' => $this->key
    ];

    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    if ($this->requiresHighFps !== null) {
      $parts[] = [
        'name' => 'requires_high_fps',
        'contents' => $this->requiresHighFps ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
