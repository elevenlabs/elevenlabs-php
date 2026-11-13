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
class StudioAgentSettingsModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\StudioAgentToolSettingsModel>|null
   */
  #[
    JsonProperty('tool_settings'),
    ArrayType(['string' => \ElevenLabs\Types\StudioAgentToolSettingsModel::class])
  ]
  public ?array $toolSettings;

  /**
   * @param array{
   *   toolSettings?: array<string, \ElevenLabs\Types\StudioAgentToolSettingsModel>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->toolSettings = $values['toolSettings'] ?? null;

    if (array_key_exists('toolSettings', $values)) {
      $this->_dirtyFields['tool_settings'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->toolSettings !== null) {
      $parts[] = [
        'name' => 'tool_settings',
        'contents' => json_encode($this->toolSettings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
