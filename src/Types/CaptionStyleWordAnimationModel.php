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
class CaptionStyleWordAnimationModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\CaptionStyleWordAnimationModelEnterType>
   */
  #[JsonProperty('enter_type', required: true)]
  public string $enterType;

  /**
   * @var value-of<\ElevenLabs\Types\CaptionStyleWordAnimationModelExitType>
   */
  #[JsonProperty('exit_type', required: true)]
  public string $exitType;

  /**
   * @param array{
   *   enterType: value-of<\ElevenLabs\Types\CaptionStyleWordAnimationModelEnterType>,
   *   exitType: value-of<\ElevenLabs\Types\CaptionStyleWordAnimationModelExitType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->enterType = $values['enterType'];
    $this->exitType = $values['exitType'];

    $this->_dirtyFields = [
      'enter_type' => true,
      'exit_type' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'enter_type',
      'contents' => $this->enterType
    ];

    $parts[] = [
      'name' => 'exit_type',
      'contents' => $this->exitType
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
