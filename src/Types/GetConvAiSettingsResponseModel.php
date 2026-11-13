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
class GetConvAiSettingsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('conversation_initiation_client_data_webhook')]
  public ?\ElevenLabs\Types\ConversationInitiationClientDataWebhook $conversationInitiationClientDataWebhook;

  #[JsonProperty('webhooks')]
  public ?\ElevenLabs\Types\ConvAiWebhooks $webhooks;

  /**
   * Whether the workspace can use MCP servers
   */
  #[JsonProperty('can_use_mcp_servers')]
  public ?bool $canUseMcpServers;

  #[JsonProperty('rag_retention_period_days')]
  public ?int $ragRetentionPeriodDays;

  /**
   * Days to retain conversation embeddings. None means use the system default (30 days).
   */
  #[JsonProperty('conversation_embedding_retention_days')]
  public ?int $conversationEmbeddingRetentionDays;

  /**
   * @var ?value-of<\ElevenLabs\Types\LivekitStackType>
   */
  #[JsonProperty('default_livekit_stack')]
  public ?string $defaultLivekitStack;

  /**
   * @param array{
   *   conversationInitiationClientDataWebhook?: ?\ElevenLabs\Types\ConversationInitiationClientDataWebhook,
   *   webhooks?: ?\ElevenLabs\Types\ConvAiWebhooks,
   *   canUseMcpServers?: ?bool,
   *   ragRetentionPeriodDays?: ?int,
   *   conversationEmbeddingRetentionDays?: ?int,
   *   defaultLivekitStack?: ?value-of<\ElevenLabs\Types\LivekitStackType>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->conversationInitiationClientDataWebhook =
      $values['conversationInitiationClientDataWebhook'] ?? null;
    $this->webhooks = $values['webhooks'] ?? null;
    $this->canUseMcpServers = $values['canUseMcpServers'] ?? null;
    $this->ragRetentionPeriodDays = $values['ragRetentionPeriodDays'] ?? null;
    $this->conversationEmbeddingRetentionDays =
      $values['conversationEmbeddingRetentionDays'] ?? null;
    $this->defaultLivekitStack = $values['defaultLivekitStack'] ?? null;

    if (array_key_exists('conversationInitiationClientDataWebhook', $values)) {
      $this->_dirtyFields['conversation_initiation_client_data_webhook'] = true;
    }
    if (array_key_exists('webhooks', $values)) {
      $this->_dirtyFields['webhooks'] = true;
    }
    if (array_key_exists('canUseMcpServers', $values)) {
      $this->_dirtyFields['can_use_mcp_servers'] = true;
    }
    if (array_key_exists('ragRetentionPeriodDays', $values)) {
      $this->_dirtyFields['rag_retention_period_days'] = true;
    }
    if (array_key_exists('conversationEmbeddingRetentionDays', $values)) {
      $this->_dirtyFields['conversation_embedding_retention_days'] = true;
    }
    if (array_key_exists('defaultLivekitStack', $values)) {
      $this->_dirtyFields['default_livekit_stack'] = true;
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

    if ($this->canUseMcpServers !== null) {
      $parts[] = [
        'name' => 'can_use_mcp_servers',
        'contents' => $this->canUseMcpServers ? 'true' : 'false'
      ];
    }

    if ($this->ragRetentionPeriodDays !== null) {
      $parts[] = [
        'name' => 'rag_retention_period_days',
        'contents' => (string) $this->ragRetentionPeriodDays
      ];
    }

    if ($this->conversationEmbeddingRetentionDays !== null) {
      $parts[] = [
        'name' => 'conversation_embedding_retention_days',
        'contents' => (string) $this->conversationEmbeddingRetentionDays
      ];
    }

    if ($this->defaultLivekitStack !== null) {
      $parts[] = [
        'name' => 'default_livekit_stack',
        'contents' => $this->defaultLivekitStack
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->conversationInitiationClientDataWebhook?->validate();
    $this->webhooks?->validate();
    Validator::validateNumber($this->ragRetentionPeriodDays, 'rag_retention_period_days', max: 30);
    Validator::validateNumber(
      $this->conversationEmbeddingRetentionDays,
      'conversation_embedding_retention_days',
      max: 365
    );
  }
}
