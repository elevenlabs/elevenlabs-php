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
class AlertingWebhookHeader extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('is_secret')]
  public ?bool $isSecret;

  /**
   * Header value. May be null only for a secret header on update.
   */
  #[JsonProperty('value')]
  public ?string $value;

  /**
   * @param array{
   *   name: string,
   *   isSecret?: ?bool,
   *   value?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->isSecret = $values['isSecret'] ?? null;
    $this->value = $values['value'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('isSecret', $values)) {
      $this->_dirtyFields['is_secret'] = true;
    }
    if (array_key_exists('value', $values)) {
      $this->_dirtyFields['value'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->isSecret !== null) {
      $parts[] = [
        'name' => 'is_secret',
        'contents' => $this->isSecret ? 'true' : 'false'
      ];
    }

    if ($this->value !== null) {
      $parts[] = [
        'name' => 'value',
        'contents' => $this->value
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', maxLength: 256);
  }
}
