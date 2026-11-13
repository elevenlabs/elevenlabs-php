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
class AlertingPagerDutyNotifierResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AlertingPagerDutyNotifierResponseType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var ?value-of<\ElevenLabs\Types\AlertingPagerDutyNotifierResponseIntegrationType>
   */
  #[JsonProperty('integration_type')]
  public ?string $integrationType;

  #[JsonProperty('connection_id', required: true)]
  public string $connectionId;

  /**
   * @param array{
   *   connectionId: string,
   *   type?: ?value-of<\ElevenLabs\Types\AlertingPagerDutyNotifierResponseType>,
   *   integrationType?: ?value-of<\ElevenLabs\Types\AlertingPagerDutyNotifierResponseIntegrationType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'integration';
    $this->integrationType = $values['integrationType'] ?? 'pagerduty';
    $this->connectionId = $values['connectionId'];

    $this->_dirtyFields = [
      'connection_id' => true
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

    return $parts;
  }

  public function validate(): void
  {
  }
}
