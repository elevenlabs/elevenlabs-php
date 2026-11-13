<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns\Config\Requests;

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
class ReplaceWorkspaceConfigRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The `version` of the configuration being replaced. Omit it only to create the first configuration.
   */
  #[JsonProperty('expected_version')]
  public ?int $expectedVersion;

  #[JsonProperty('config', required: true)]
  public \ElevenLabs\Types\CampaignConfigInput $config;

  /**
   * @param array{
   *   config: \ElevenLabs\Types\CampaignConfigInput,
   *   expectedVersion?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->expectedVersion = $values['expectedVersion'] ?? null;
    $this->config = $values['config'];

    $this->_dirtyFields = [
      'config' => true
    ];
    if (array_key_exists('expectedVersion', $values)) {
      $this->_dirtyFields['expected_version'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->expectedVersion !== null) {
      $parts[] = [
        'name' => 'expected_version',
        'contents' => (string) $this->expectedVersion
      ];
    }

    $parts[] = [
      'name' => 'config',
      'contents' => json_encode($this->config),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->expectedVersion, 'expected_version', min: 1);
    $this->config->validate();
  }
}
