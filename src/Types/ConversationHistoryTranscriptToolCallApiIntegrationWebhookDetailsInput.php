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
class ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsInput extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('integration_id')]
  public ?string $integrationId;

  #[JsonProperty('credential_id')]
  public ?string $credentialId;

  #[JsonProperty('integration_connection_id')]
  public ?string $integrationConnectionId;

  #[JsonProperty('webhook_details', required: true)]
  public \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails $webhookDetails;

  /**
   * @param array{
   *   webhookDetails: \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails,
   *   type?: ?value-of<\ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsInputType>,
   *   integrationId?: ?string,
   *   credentialId?: ?string,
   *   integrationConnectionId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'api_integration_webhook';
    $this->integrationId = $values['integrationId'] ?? null;
    $this->credentialId = $values['credentialId'] ?? null;
    $this->integrationConnectionId = $values['integrationConnectionId'] ?? null;
    $this->webhookDetails = $values['webhookDetails'];

    $this->_dirtyFields = [
      'webhook_details' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('integrationId', $values)) {
      $this->_dirtyFields['integration_id'] = true;
    }
    if (array_key_exists('credentialId', $values)) {
      $this->_dirtyFields['credential_id'] = true;
    }
    if (array_key_exists('integrationConnectionId', $values)) {
      $this->_dirtyFields['integration_connection_id'] = true;
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

    if ($this->integrationId !== null) {
      $parts[] = [
        'name' => 'integration_id',
        'contents' => $this->integrationId
      ];
    }

    if ($this->credentialId !== null) {
      $parts[] = [
        'name' => 'credential_id',
        'contents' => $this->credentialId
      ];
    }

    if ($this->integrationConnectionId !== null) {
      $parts[] = [
        'name' => 'integration_connection_id',
        'contents' => $this->integrationConnectionId
      ];
    }

    $parts[] = [
      'name' => 'webhook_details',
      'contents' => json_encode($this->webhookDetails),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->webhookDetails->validate();
  }
}
