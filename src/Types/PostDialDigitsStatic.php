<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class PostDialDigitsStatic extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\PostDialDigitsStaticType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * DTMF digits to send after call connects (e.g., 'ww1234' for extension)
   */
  #[JsonProperty('value', required: true)]
  public string $value;

  /**
   * @param array{
   *   value: string,
   *   type?: ?value-of<\ElevenLabs\Types\PostDialDigitsStaticType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'static';
    $this->value = $values['value'];

    $this->_dirtyFields = [
      'value' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
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

    $parts[] = [
      'name' => 'value',
      'contents' => $this->value
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->value, 'value', minLength: 1, pattern: '^[0-9*#wW]*$');
  }
}
