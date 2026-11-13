<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConvAiWebhooks extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('post_call_webhook_id')]
  public ?string $postCallWebhookId;

  /**
   * @var array<value-of<\ElevenLabs\Types\WebhookEventType>>|null
   * List of event types to send via webhook. Options: transcript, audio, call_initiation_failure, answering_machine_detection, unredacted_transcript, unredacted_audio.
   */
  #[JsonProperty('events'), ArrayType(['string'])]
  public ?array $events;

  /**
   * @var ?value-of<\ElevenLabs\Types\WebhookTranscriptFormat>
   */
  #[JsonProperty('transcript_format')]
  public ?string $transcriptFormat;

  /**
   * When true, JSON post-call transcription webhooks omit the turn-by-turn transcript. Analysis, metadata, and other conversation fields are still sent. Ignored for OpenTelemetry transcript format.
   */
  #[JsonProperty('exclude_transcript')]
  public ?bool $excludeTranscript;

  /**
   * DEPRECATED: Use 'events' field instead. Whether to send audio data with post-call webhooks for ConvAI conversations
   */
  #[JsonProperty('send_audio')]
  public ?bool $sendAudio;

  /**
   * @param array{
   *   postCallWebhookId?: ?string,
   *   events?: array<value-of<\ElevenLabs\Types\WebhookEventType>>|null,
   *   transcriptFormat?: ?value-of<\ElevenLabs\Types\WebhookTranscriptFormat>,
   *   excludeTranscript?: ?bool,
   *   sendAudio?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->postCallWebhookId = $values['postCallWebhookId'] ?? null;
    $this->events = $values['events'] ?? null;
    $this->transcriptFormat = $values['transcriptFormat'] ?? null;
    $this->excludeTranscript = $values['excludeTranscript'] ?? null;
    $this->sendAudio = $values['sendAudio'] ?? null;

    if (array_key_exists('postCallWebhookId', $values)) {
      $this->_dirtyFields['post_call_webhook_id'] = true;
    }
    if (array_key_exists('events', $values)) {
      $this->_dirtyFields['events'] = true;
    }
    if (array_key_exists('transcriptFormat', $values)) {
      $this->_dirtyFields['transcript_format'] = true;
    }
    if (array_key_exists('excludeTranscript', $values)) {
      $this->_dirtyFields['exclude_transcript'] = true;
    }
    if (array_key_exists('sendAudio', $values)) {
      $this->_dirtyFields['send_audio'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->postCallWebhookId !== null) {
      $parts[] = [
        'name' => 'post_call_webhook_id',
        'contents' => $this->postCallWebhookId
      ];
    }

    if ($this->events !== null) {
      foreach ($this->events ?? [] as $item) {
        $parts[] = [
          'name' => 'events',
          'contents' => $item
        ];
      }
    }

    if ($this->transcriptFormat !== null) {
      $parts[] = [
        'name' => 'transcript_format',
        'contents' => $this->transcriptFormat
      ];
    }

    if ($this->excludeTranscript !== null) {
      $parts[] = [
        'name' => 'exclude_transcript',
        'contents' => $this->excludeTranscript ? 'true' : 'false'
      ];
    }

    if ($this->sendAudio !== null) {
      $parts[] = [
        'name' => 'send_audio',
        'contents' => $this->sendAudio ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
