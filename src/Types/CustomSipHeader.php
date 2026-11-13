<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Custom SIP header for phone transfers with a static (validated) value.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CustomSipHeader extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\CustomSipHeaderType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * The SIP header name (e.g., 'X-Customer-ID')
   */
  #[JsonProperty('key', required: true)]
  public string $key;

  /**
   * The header value
   */
  #[JsonProperty('value', required: true)]
  public string $value;

  /**
   * @param array{
   *   key: string,
   *   value: string,
   *   type?: ?value-of<\ElevenLabs\Types\CustomSipHeaderType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'static';
    $this->key = $values['key'];
    $this->value = $values['value'];

    $this->_dirtyFields = [
      'key' => true,
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
      'name' => 'key',
      'contents' => $this->key
    ];

    $parts[] = [
      'name' => 'value',
      'contents' => $this->value
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString(
      $this->key,
      'key',
      minLength: 1,
      maxLength: 64,
      pattern: '^[A-Za-z0-9]+(-[A-Za-z0-9]+)*$'
    );
    Validator::validateString(
      $this->value,
      'value',
      minLength: 1,
      maxLength: 512,
      pattern: '^[\\x09\\x20-\\x7E]+$'
    );
  }
}
