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
class WorkspaceConfigResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Increases with every replacement; send it as `expected_version`.
   */
  #[JsonProperty('version', required: true)]
  public int $version;

  #[JsonProperty('config', required: true)]
  public \ElevenLabs\Types\CampaignConfigOutput $config;

  /**
   * @param array{
   *   version: int,
   *   config: \ElevenLabs\Types\CampaignConfigOutput,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->version = $values['version'];
    $this->config = $values['config'];

    $this->_dirtyFields = [
      'version' => true,
      'config' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'version',
      'contents' => (string) $this->version
    ];

    $parts[] = [
      'name' => 'config',
      'contents' => json_encode($this->config),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->config->validate();
  }
}
