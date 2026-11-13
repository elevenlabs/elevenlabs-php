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
class AlertingWebhookNotifierResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AlertingWebhookNotifierResponseType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('webhook_id', required: true)]
  public string $webhookId;

  /**
   * @param array{
   *   webhookId: string,
   *   type?: ?value-of<\ElevenLabs\Types\AlertingWebhookNotifierResponseType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'webhook';
    $this->webhookId = $values['webhookId'];

    $this->_dirtyFields = [
      'webhook_id' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
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

    $parts[] = [
      'name' => 'webhook_id',
      'contents' => $this->webhookId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
