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
class PrivacyConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether to record the conversation
   */
  #[JsonProperty('record_voice')]
  public ?bool $recordVoice;

  /**
   * The number of days to retain the conversation. -1 indicates there is no retention limit
   */
  #[JsonProperty('retention_days')]
  public ?int $retentionDays;

  /**
   * Whether to delete the transcript and PII
   */
  #[JsonProperty('delete_transcript_and_pii')]
  public ?bool $deleteTranscriptAndPii;

  /**
   * Whether to delete the audio
   */
  #[JsonProperty('delete_audio')]
  public ?bool $deleteAudio;

  /**
   * Whether to apply the privacy settings to existing conversations
   */
  #[JsonProperty('apply_to_existing_conversations')]
  public ?bool $applyToExistingConversations;

  /**
   * Whether to enable zero retention mode - no PII data is stored
   */
  #[JsonProperty('zero_retention_mode')]
  public ?bool $zeroRetentionMode;

  #[JsonProperty('conversation_history_redaction')]
  public ?\ElevenLabs\Types\ConversationHistoryRedactionConfig $conversationHistoryRedaction;

  /**
   * @param array{
   *   recordVoice?: ?bool,
   *   retentionDays?: ?int,
   *   deleteTranscriptAndPii?: ?bool,
   *   deleteAudio?: ?bool,
   *   applyToExistingConversations?: ?bool,
   *   zeroRetentionMode?: ?bool,
   *   conversationHistoryRedaction?: ?\ElevenLabs\Types\ConversationHistoryRedactionConfig,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->recordVoice = $values['recordVoice'] ?? null;
    $this->retentionDays = $values['retentionDays'] ?? null;
    $this->deleteTranscriptAndPii = $values['deleteTranscriptAndPii'] ?? null;
    $this->deleteAudio = $values['deleteAudio'] ?? null;
    $this->applyToExistingConversations = $values['applyToExistingConversations'] ?? null;
    $this->zeroRetentionMode = $values['zeroRetentionMode'] ?? null;
    $this->conversationHistoryRedaction = $values['conversationHistoryRedaction'] ?? null;

    if (array_key_exists('recordVoice', $values)) {
      $this->_dirtyFields['record_voice'] = true;
    }
    if (array_key_exists('retentionDays', $values)) {
      $this->_dirtyFields['retention_days'] = true;
    }
    if (array_key_exists('deleteTranscriptAndPii', $values)) {
      $this->_dirtyFields['delete_transcript_and_pii'] = true;
    }
    if (array_key_exists('deleteAudio', $values)) {
      $this->_dirtyFields['delete_audio'] = true;
    }
    if (array_key_exists('applyToExistingConversations', $values)) {
      $this->_dirtyFields['apply_to_existing_conversations'] = true;
    }
    if (array_key_exists('zeroRetentionMode', $values)) {
      $this->_dirtyFields['zero_retention_mode'] = true;
    }
    if (array_key_exists('conversationHistoryRedaction', $values)) {
      $this->_dirtyFields['conversation_history_redaction'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->recordVoice !== null) {
      $parts[] = [
        'name' => 'record_voice',
        'contents' => $this->recordVoice ? 'true' : 'false'
      ];
    }

    if ($this->retentionDays !== null) {
      $parts[] = [
        'name' => 'retention_days',
        'contents' => (string) $this->retentionDays
      ];
    }

    if ($this->deleteTranscriptAndPii !== null) {
      $parts[] = [
        'name' => 'delete_transcript_and_pii',
        'contents' => $this->deleteTranscriptAndPii ? 'true' : 'false'
      ];
    }

    if ($this->deleteAudio !== null) {
      $parts[] = [
        'name' => 'delete_audio',
        'contents' => $this->deleteAudio ? 'true' : 'false'
      ];
    }

    if ($this->applyToExistingConversations !== null) {
      $parts[] = [
        'name' => 'apply_to_existing_conversations',
        'contents' => $this->applyToExistingConversations ? 'true' : 'false'
      ];
    }

    if ($this->zeroRetentionMode !== null) {
      $parts[] = [
        'name' => 'zero_retention_mode',
        'contents' => $this->zeroRetentionMode ? 'true' : 'false'
      ];
    }

    if ($this->conversationHistoryRedaction !== null) {
      $parts[] = [
        'name' => 'conversation_history_redaction',
        'contents' => json_encode($this->conversationHistoryRedaction),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->conversationHistoryRedaction?->validate();
  }
}
