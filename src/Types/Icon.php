<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * An optionally-sized icon for display in a user interface (2025-11-25+).
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class Icon extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('src', required: true)]
  public string $src;

  #[JsonProperty('mimeType')]
  public ?string $mimeType;

  /**
   * @var string[]|null
   */
  #[JsonProperty('sizes'), ArrayType(['string'])]
  public ?array $sizes;

  /**
   * @var ?value-of<\ElevenLabs\Types\IconTheme>
   */
  #[JsonProperty('theme')]
  public ?string $theme;

  /**
   * @param array{
   *   src: string,
   *   mimeType?: ?string,
   *   sizes?: string[]|null,
   *   theme?: ?value-of<\ElevenLabs\Types\IconTheme>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->src = $values['src'];
    $this->mimeType = $values['mimeType'] ?? null;
    $this->sizes = $values['sizes'] ?? null;
    $this->theme = $values['theme'] ?? null;

    $this->_dirtyFields = [
      'src' => true
    ];
    if (array_key_exists('mimeType', $values)) {
      $this->_dirtyFields['mimeType'] = true;
    }
    if (array_key_exists('sizes', $values)) {
      $this->_dirtyFields['sizes'] = true;
    }
    if (array_key_exists('theme', $values)) {
      $this->_dirtyFields['theme'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'src',
      'contents' => $this->src
    ];

    if ($this->mimeType !== null) {
      $parts[] = [
        'name' => 'mimeType',
        'contents' => $this->mimeType
      ];
    }

    if ($this->sizes !== null) {
      foreach ($this->sizes ?? [] as $item) {
        $parts[] = [
          'name' => 'sizes',
          'contents' => $item
        ];
      }
    }

    if ($this->theme !== null) {
      $parts[] = [
        'name' => 'theme',
        'contents' => $this->theme
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
