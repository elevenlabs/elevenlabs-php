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
class DummyToolResultModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\DummyToolResultModelResultType>
   */
  #[JsonProperty('result_type')]
  public ?string $resultType;

  /**
   * @param array{
   *   resultType?: ?value-of<\ElevenLabs\Types\DummyToolResultModelResultType>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->resultType = $values['resultType'] ?? 'dummy';

    if (array_key_exists('resultType', $values)) {
      $this->_dirtyFields['result_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->resultType !== null) {
      $parts[] = [
        'name' => 'result_type',
        'contents' => $this->resultType
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
