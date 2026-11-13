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
class AgentWorkspaceOverridesInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The webhook to send conversation initiation client data to
   */
  #[JsonProperty('conversation_initiation_client_data_webhook')]
  public ?\ElevenLabs\Types\ConversationInitiationClientDataWebhook $conversationInitiationClientDataWebhook;

  #[JsonProperty('webhooks')]
  public ?\ElevenLabs\Types\ConvAiWebhooks $webhooks;

  /**
   * @param array{
   *   conversationInitiationClientDataWebhook?: ?\ElevenLabs\Types\ConversationInitiationClientDataWebhook,
   *   webhooks?: ?\ElevenLabs\Types\ConvAiWebhooks,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->conversationInitiationClientDataWebhook =
      $values['conversationInitiationClientDataWebhook'] ?? null;
    $this->webhooks = $values['webhooks'] ?? null;

    if (array_key_exists('conversationInitiationClientDataWebhook', $values)) {
      $this->_dirtyFields['conversation_initiation_client_data_webhook'] = true;
    }
    if (array_key_exists('webhooks', $values)) {
      $this->_dirtyFields['webhooks'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->conversationInitiationClientDataWebhook !== null) {
      $parts[] = [
        'name' => 'conversation_initiation_client_data_webhook',
        'contents' => json_encode($this->conversationInitiationClientDataWebhook),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->webhooks !== null) {
      $parts[] = [
        'name' => 'webhooks',
        'contents' => json_encode($this->webhooks),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->conversationInitiationClientDataWebhook?->validate();
    $this->webhooks?->validate();
  }
}
