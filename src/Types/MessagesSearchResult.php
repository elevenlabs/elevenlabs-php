<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * transcript_index: index of the message in the conversation transcript
 * chunk_text: text of the transcript; transcript messages if very long could have several chunks.
 * chunk_highlights: chunk_text split into matched/unmatched segments for highlighting.
 *     Only populated for keyword/text search, not semantic search.
 * score: similarity score of the message to the search query
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MessagesSearchResult extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('conversation_id', required: true)]
  public string $conversationId;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('agent_name')]
  public ?string $agentName;

  #[JsonProperty('transcript_index', required: true)]
  public int $transcriptIndex;

  #[JsonProperty('chunk_text', required: true)]
  public string $chunkText;

  /**
   * @var \ElevenLabs\Types\SearchHighlightSegment[]|null
   */
  #[JsonProperty('chunk_highlights'), ArrayType([\ElevenLabs\Types\SearchHighlightSegment::class])]
  public ?array $chunkHighlights;

  #[JsonProperty('score', required: true)]
  public float $score;

  #[JsonProperty('conversation_start_time_unix_secs', required: true)]
  public int $conversationStartTimeUnixSecs;

  /**
   * @param array{
   *   conversationId: string,
   *   agentId: string,
   *   transcriptIndex: int,
   *   chunkText: string,
   *   score: float,
   *   conversationStartTimeUnixSecs: int,
   *   agentName?: ?string,
   *   chunkHighlights?: \ElevenLabs\Types\SearchHighlightSegment[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conversationId = $values['conversationId'];
    $this->agentId = $values['agentId'];
    $this->agentName = $values['agentName'] ?? null;
    $this->transcriptIndex = $values['transcriptIndex'];
    $this->chunkText = $values['chunkText'];
    $this->chunkHighlights = $values['chunkHighlights'] ?? null;
    $this->score = $values['score'];
    $this->conversationStartTimeUnixSecs = $values['conversationStartTimeUnixSecs'];

    $this->_dirtyFields = [
      'conversation_id' => true,
      'agent_id' => true,
      'transcript_index' => true,
      'chunk_text' => true,
      'score' => true,
      'conversation_start_time_unix_secs' => true
    ];
    if (array_key_exists('agentName', $values)) {
      $this->_dirtyFields['agent_name'] = true;
    }
    if (array_key_exists('chunkHighlights', $values)) {
      $this->_dirtyFields['chunk_highlights'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    if ($this->agentName !== null) {
      $parts[] = [
        'name' => 'agent_name',
        'contents' => $this->agentName
      ];
    }

    $parts[] = [
      'name' => 'transcript_index',
      'contents' => (string) $this->transcriptIndex
    ];

    $parts[] = [
      'name' => 'chunk_text',
      'contents' => $this->chunkText
    ];

    if ($this->chunkHighlights !== null) {
      $parts[] = [
        'name' => 'chunk_highlights',
        'contents' => json_encode($this->chunkHighlights),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'score',
      'contents' => (string) $this->score
    ];

    $parts[] = [
      'name' => 'conversation_start_time_unix_secs',
      'contents' => (string) $this->conversationStartTimeUnixSecs
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->chunkHighlights ?? [] as $item) {
      $item->validate();
    }
  }
}
