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
class AlertingSlackNotifierResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AlertingSlackNotifierResponseType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var ?value-of<\ElevenLabs\Types\AlertingSlackNotifierResponseIntegrationType>
   */
  #[JsonProperty('integration_type')]
  public ?string $integrationType;

  #[JsonProperty('connection_id', required: true)]
  public string $connectionId;

  #[JsonProperty('channel_id', required: true)]
  public string $channelId;

  /**
   * @param array{
   *   connectionId: string,
   *   channelId: string,
   *   type?: ?value-of<\ElevenLabs\Types\AlertingSlackNotifierResponseType>,
   *   integrationType?: ?value-of<\ElevenLabs\Types\AlertingSlackNotifierResponseIntegrationType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'integration';
    $this->integrationType = $values['integrationType'] ?? 'slack';
    $this->connectionId = $values['connectionId'];
    $this->channelId = $values['channelId'];

    $this->_dirtyFields = [
      'connection_id' => true,
      'channel_id' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('integrationType', $values)) {
      $this->_dirtyFields['integration_type'] = true;
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

    $parts[] = [
      'name' => 'channel_id',
      'contents' => $this->channelId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
