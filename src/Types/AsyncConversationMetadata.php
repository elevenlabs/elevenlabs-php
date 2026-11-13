<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Metadata for async conversation delivery (Zendesk, Slack, etc.).
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AsyncConversationMetadata extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AsyncConversationMetadataDeliveryStatus>
   */
  #[JsonProperty('delivery_status', required: true)]
  public string $deliveryStatus;

  #[JsonProperty('delivery_timestamp', required: true)]
  public int $deliveryTimestamp;

  #[JsonProperty('delivery_error')]
  public ?string $deliveryError;

  #[JsonProperty('external_system', required: true)]
  public string $externalSystem;

  #[JsonProperty('external_id', required: true)]
  public string $externalId;

  #[JsonProperty('external_link')]
  public ?string $externalLink;

  #[JsonProperty('retry_count')]
  public ?int $retryCount;

  #[JsonProperty('last_retry_timestamp')]
  public ?int $lastRetryTimestamp;

  #[JsonProperty('last_processed_external_message_id')]
  public ?string $lastProcessedExternalMessageId;

  #[JsonProperty('integration_trigger_id')]
  public ?string $integrationTriggerId;

  #[JsonProperty('platform_metadata')]
  public ?\ElevenLabs\Types\AsyncConversationMetadataPlatformMetadata $platformMetadata;

  /**
   * @param array{
   *   deliveryStatus: value-of<\ElevenLabs\Types\AsyncConversationMetadataDeliveryStatus>,
   *   deliveryTimestamp: int,
   *   externalSystem: string,
   *   externalId: string,
   *   deliveryError?: ?string,
   *   externalLink?: ?string,
   *   retryCount?: ?int,
   *   lastRetryTimestamp?: ?int,
   *   lastProcessedExternalMessageId?: ?string,
   *   integrationTriggerId?: ?string,
   *   platformMetadata?: ?\ElevenLabs\Types\AsyncConversationMetadataPlatformMetadata,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->deliveryStatus = $values['deliveryStatus'];
    $this->deliveryTimestamp = $values['deliveryTimestamp'];
    $this->deliveryError = $values['deliveryError'] ?? null;
    $this->externalSystem = $values['externalSystem'];
    $this->externalId = $values['externalId'];
    $this->externalLink = $values['externalLink'] ?? null;
    $this->retryCount = $values['retryCount'] ?? null;
    $this->lastRetryTimestamp = $values['lastRetryTimestamp'] ?? null;
    $this->lastProcessedExternalMessageId = $values['lastProcessedExternalMessageId'] ?? null;
    $this->integrationTriggerId = $values['integrationTriggerId'] ?? null;
    $this->platformMetadata = $values['platformMetadata'] ?? null;

    $this->_dirtyFields = [
      'delivery_status' => true,
      'delivery_timestamp' => true,
      'external_system' => true,
      'external_id' => true
    ];
    if (array_key_exists('deliveryError', $values)) {
      $this->_dirtyFields['delivery_error'] = true;
    }
    if (array_key_exists('externalLink', $values)) {
      $this->_dirtyFields['external_link'] = true;
    }
    if (array_key_exists('retryCount', $values)) {
      $this->_dirtyFields['retry_count'] = true;
    }
    if (array_key_exists('lastRetryTimestamp', $values)) {
      $this->_dirtyFields['last_retry_timestamp'] = true;
    }
    if (array_key_exists('lastProcessedExternalMessageId', $values)) {
      $this->_dirtyFields['last_processed_external_message_id'] = true;
    }
    if (array_key_exists('integrationTriggerId', $values)) {
      $this->_dirtyFields['integration_trigger_id'] = true;
    }
    if (array_key_exists('platformMetadata', $values)) {
      $this->_dirtyFields['platform_metadata'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'delivery_status',
      'contents' => $this->deliveryStatus
    ];

    $parts[] = [
      'name' => 'delivery_timestamp',
      'contents' => (string) $this->deliveryTimestamp
    ];

    if ($this->deliveryError !== null) {
      $parts[] = [
        'name' => 'delivery_error',
        'contents' => $this->deliveryError
      ];
    }

    $parts[] = [
      'name' => 'external_system',
      'contents' => $this->externalSystem
    ];

    $parts[] = [
      'name' => 'external_id',
      'contents' => $this->externalId
    ];

    if ($this->externalLink !== null) {
      $parts[] = [
        'name' => 'external_link',
        'contents' => $this->externalLink
      ];
    }

    if ($this->retryCount !== null) {
      $parts[] = [
        'name' => 'retry_count',
        'contents' => (string) $this->retryCount
      ];
    }

    if ($this->lastRetryTimestamp !== null) {
      $parts[] = [
        'name' => 'last_retry_timestamp',
        'contents' => (string) $this->lastRetryTimestamp
      ];
    }

    if ($this->lastProcessedExternalMessageId !== null) {
      $parts[] = [
        'name' => 'last_processed_external_message_id',
        'contents' => $this->lastProcessedExternalMessageId
      ];
    }

    if ($this->integrationTriggerId !== null) {
      $parts[] = [
        'name' => 'integration_trigger_id',
        'contents' => $this->integrationTriggerId
      ];
    }

    if ($this->platformMetadata !== null) {
      $parts[] = [
        'name' => 'platform_metadata',
        'contents' => json_encode($this->platformMetadata),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
