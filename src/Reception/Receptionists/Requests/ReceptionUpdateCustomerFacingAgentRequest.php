<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Receptionists\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionUpdateCustomerFacingAgentRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * Receptionist settings to change; omitted settings keep their value.
   */
  #[JsonProperty('config')]
  public ?\ElevenLabs\Types\ReceptionCustomerFacingConfigPatch $config;

  /**
   * New display name for the receptionist.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * New website widget appearance.
   */
  #[JsonProperty('widget')]
  public ?\ElevenLabs\Types\ReceptionWidgetAppearance $widget;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   config?: ?\ElevenLabs\Types\ReceptionCustomerFacingConfigPatch,
   *   name?: ?string,
   *   widget?: ?\ElevenLabs\Types\ReceptionWidgetAppearance,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->config = $values['config'] ?? null;
    $this->name = $values['name'] ?? null;
    $this->widget = $values['widget'] ?? null;

    if (array_key_exists('config', $values)) {
      $this->_dirtyFields['config'] = true;
    }
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('widget', $values)) {
      $this->_dirtyFields['widget'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->config !== null) {
      $parts[] = [
        'name' => 'config',
        'contents' => json_encode($this->config),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->widget !== null) {
      $parts[] = [
        'name' => 'widget',
        'contents' => json_encode($this->widget),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->config?->validate();
    $this->widget?->validate();
  }
}
