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
class WhatsAppTemplateImageParamDetails extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('link', required: true)]
  public string $link;

  /**
   * @param array{
   *   link: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->link = $values['link'];

    $this->_dirtyFields = [
      'link' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'link',
      'contents' => $this->link
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
