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
class CampaignProgressResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('leads', required: true)]
  public \ElevenLabs\Types\LeadsProgress $leads;

  #[JsonProperty('conversations', required: true)]
  public \ElevenLabs\Types\ConversationProgress $conversations;

  /**
   * When the next call is due; unset when none is scheduled.
   */
  #[JsonProperty('next_call_time_unix', required: true)]
  public ?int $nextCallTimeUnix;

  /**
   * @param array{
   *   leads: \ElevenLabs\Types\LeadsProgress,
   *   conversations: \ElevenLabs\Types\ConversationProgress,
   *   nextCallTimeUnix: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->leads = $values['leads'];
    $this->conversations = $values['conversations'];
    $this->nextCallTimeUnix = $values['nextCallTimeUnix'];

    $this->_dirtyFields = [
      'leads' => true,
      'conversations' => true,
      'next_call_time_unix' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'leads',
      'contents' => json_encode($this->leads),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'conversations',
      'contents' => json_encode($this->conversations),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'next_call_time_unix',
      'contents' => (string) $this->nextCallTimeUnix
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->leads->validate();
    $this->conversations->validate();
  }
}
