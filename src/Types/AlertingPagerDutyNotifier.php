<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

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
class AlertingPagerDutyNotifier extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AlertingPagerDutyNotifierType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var ?value-of<\ElevenLabs\Types\AlertingPagerDutyNotifierIntegrationType>
   */
  #[JsonProperty('integration_type')]
  public ?string $integrationType;

  /**
   * ID of the workspace integration connection to deliver alert lifecycle notifications to. The connection's integration must have the monitoring capability and match ``integration_type``.
   */
  #[JsonProperty('connection_id', required: true)]
  public string $connectionId;

  /**
   * @param array{
   *   connectionId: string,
   *   type?: ?value-of<\ElevenLabs\Types\AlertingPagerDutyNotifierType>,
   *   integrationType?: ?value-of<\ElevenLabs\Types\AlertingPagerDutyNotifierIntegrationType>,
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
    Validator::validateString($this->connectionId, 'connection_id', minLength: 1);
  }
}
