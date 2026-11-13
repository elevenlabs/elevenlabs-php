<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BackupLlmOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\BackupLlmOverridePreference>
   */
  #[JsonProperty('preference')]
  public ?string $preference;

  /**
   * @var array<value-of<\ElevenLabs\Types\Llm>>
   */
  #[JsonProperty('order', required: true), ArrayType(['string'])]
  public array $order;

  /**
   * @param array{
   *   order: array<value-of<\ElevenLabs\Types\Llm>>,
   *   preference?: ?value-of<\ElevenLabs\Types\BackupLlmOverridePreference>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->preference = $values['preference'] ?? 'override';
    $this->order = $values['order'];

    $this->_dirtyFields = [
      'order' => true
    ];
    if (array_key_exists('preference', $values)) {
      $this->_dirtyFields['preference'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->preference !== null) {
      $parts[] = [
        'name' => 'preference',
        'contents' => $this->preference
      ];
    }

    foreach ($this->order as $item) {
      $parts[] = [
        'name' => 'order',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
