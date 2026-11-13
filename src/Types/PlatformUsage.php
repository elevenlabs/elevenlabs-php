<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Per-category breakdown of ``platform_charge`` (the analogue of ``llm_usage``).
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class PlatformUsage extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\PlatformCategoryUsage>|null
   */
  #[
    JsonProperty('category_usage'),
    ArrayType(['string' => \ElevenLabs\Types\PlatformCategoryUsage::class])
  ]
  public ?array $categoryUsage;

  /**
   * @param array{
   *   categoryUsage?: array<string, \ElevenLabs\Types\PlatformCategoryUsage>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->categoryUsage = $values['categoryUsage'] ?? null;

    if (array_key_exists('categoryUsage', $values)) {
      $this->_dirtyFields['category_usage'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->categoryUsage !== null) {
      $parts[] = [
        'name' => 'category_usage',
        'contents' => json_encode($this->categoryUsage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
