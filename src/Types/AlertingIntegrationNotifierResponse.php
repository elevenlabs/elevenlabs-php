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
class AlertingIntegrationNotifierResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AlertingIntegrationNotifierResponseType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var ?value-of<\ElevenLabs\Types\AlertingIntegrationNotifierResponseIntegrationType>
   */
  #[JsonProperty('integration_type')]
  public ?string $integrationType;

  #[JsonProperty('connection_id', required: true)]
  public string $connectionId;

  #[JsonProperty('channel_id')]
  public ?string $channelId;

  /**
   * @param array{
   *   connectionId: string,
   *   type?: ?value-of<\ElevenLabs\Types\AlertingIntegrationNotifierResponseType>,
   *   integrationType?: ?value-of<\ElevenLabs\Types\AlertingIntegrationNotifierResponseIntegrationType>,
   *   channelId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'integration';
    $this->integrationType = $values['integrationType'] ?? null;
    $this->connectionId = $values['connectionId'];
    $this->channelId = $values['channelId'] ?? null;

    $this->_dirtyFields = [
      'connection_id' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('integrationType', $values)) {
      $this->_dirtyFields['integration_type'] = true;
    }
    if (array_key_exists('channelId', $values)) {
      $this->_dirtyFields['channel_id'] = true;
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

    if ($this->integrationType !== null) {
      $parts[] = [
        'name' => 'integration_type',
        'contents' => $this->integrationType
      ];
    }

    $parts[] = [
      'name' => 'connection_id',
      'contents' => $this->connectionId
    ];

    if ($this->channelId !== null) {
      $parts[] = [
        'name' => 'channel_id',
        'contents' => $this->channelId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
