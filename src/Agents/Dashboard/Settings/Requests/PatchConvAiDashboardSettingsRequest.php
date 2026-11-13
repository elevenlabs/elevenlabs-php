<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Dashboard\Settings\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class PatchConvAiDashboardSettingsRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Agents\Dashboard\Settings\Types\PatchConvAiDashboardSettingsRequestChartsItem[]|null
   */
  #[
    JsonProperty('charts'),
    ArrayType([
      \ElevenLabs\Agents\Dashboard\Settings\Types\PatchConvAiDashboardSettingsRequestChartsItem::class
    ])
  ]
  public ?array $charts;

  /**
   * @param array{
   *   charts?: \ElevenLabs\Agents\Dashboard\Settings\Types\PatchConvAiDashboardSettingsRequestChartsItem[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->charts = $values['charts'] ?? null;

    if (array_key_exists('charts', $values)) {
      $this->_dirtyFields['charts'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->charts !== null) {
      $parts[] = [
        'name' => 'charts',
        'contents' => json_encode($this->charts),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->charts, 'charts', maxItems: 4);
  }
}
