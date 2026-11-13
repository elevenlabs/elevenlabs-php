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
class ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutput extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('integration_id', required: true)]
  public string $integrationId;

  #[JsonProperty('credential_id', required: true)]
  public string $credentialId;

  #[JsonProperty('integration_connection_id', required: true)]
  public string $integrationConnectionId;

  #[JsonProperty('webhook_details', required: true)]
  public \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails $webhookDetails;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\ConversationHistoryTranscriptToolCallApiIntegrationWebhookDetailsOutputType>,
   *   integrationId: string,
   *   credentialId: string,
   *   integrationConnectionId: string,
   *   webhookDetails: \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->integrationId = $values['integrationId'];
    $this->credentialId = $values['credentialId'];
    $this->integrationConnectionId = $values['integrationConnectionId'];
    $this->webhookDetails = $values['webhookDetails'];

    $this->_dirtyFields = [
      'type' => true,
      'integration_id' => true,
      'credential_id' => true,
      'integration_connection_id' => true,
      'webhook_details' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'integration_id',
      'contents' => $this->integrationId
    ];

    $parts[] = [
      'name' => 'credential_id',
      'contents' => $this->credentialId
    ];

    $parts[] = [
      'name' => 'integration_connection_id',
      'contents' => $this->integrationConnectionId
    ];

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
