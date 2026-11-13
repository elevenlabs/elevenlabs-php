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
class CaptionStyleHorizontalPlacementModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\CaptionStyleHorizontalPlacementModelAlign>
   */
  #[JsonProperty('align', required: true)]
  public string $align;

  #[JsonProperty('translate_pct', required: true)]
  public float $translatePct;

  /**
   * @param array{
   *   align: value-of<\ElevenLabs\Types\CaptionStyleHorizontalPlacementModelAlign>,
   *   translatePct: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->align = $values['align'];
    $this->translatePct = $values['translatePct'];

    $this->_dirtyFields = [
      'align' => true,
      'translate_pct' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'align',
      'contents' => $this->align
    ];

    $parts[] = [
      'name' => 'translate_pct',
      'contents' => (string) $this->translatePct
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
