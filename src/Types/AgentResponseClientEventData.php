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
class AgentResponseClientEventData extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_response', required: true)]
  public string $agentResponse;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  #[JsonProperty('response_id', required: true)]
  public string $responseId;

  /**
   * @var string[]|null
   */
  #[JsonProperty('in_response_to_ids'), ArrayType(['string'])]
  public ?array $inResponseToIds;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentResponseType>
   */
  #[JsonProperty('response_type')]
  public ?string $responseType;

  /**
   * @var \ElevenLabs\Types\AgentResponseAttachment[]|null
   */
  #[JsonProperty('attachments'), ArrayType([\ElevenLabs\Types\AgentResponseAttachment::class])]
  public ?array $attachments;

  /**
   * @param array{
   *   agentResponse: string,
   *   eventId: int,
   *   responseId: string,
   *   inResponseToIds?: string[]|null,
   *   responseType?: ?value-of<\ElevenLabs\Types\AgentResponseType>,
   *   attachments?: \ElevenLabs\Types\AgentResponseAttachment[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentResponse = $values['agentResponse'];
    $this->eventId = $values['eventId'];
    $this->responseId = $values['responseId'];
    $this->inResponseToIds = $values['inResponseToIds'] ?? null;
    $this->responseType = $values['responseType'] ?? null;
    $this->attachments = $values['attachments'] ?? null;

    $this->_dirtyFields = [
      'agent_response' => true,
      'event_id' => true,
      'response_id' => true
    ];
    if (array_key_exists('inResponseToIds', $values)) {
      $this->_dirtyFields['in_response_to_ids'] = true;
    }
    if (array_key_exists('responseType', $values)) {
      $this->_dirtyFields['response_type'] = true;
    }
    if (array_key_exists('attachments', $values)) {
      $this->_dirtyFields['attachments'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_response',
      'contents' => $this->agentResponse
    ];

    $parts[] = [
      'name' => 'event_id',
      'contents' => (string) $this->eventId
    ];

    $parts[] = [
      'name' => 'response_id',
      'contents' => $this->responseId
    ];

    if ($this->inResponseToIds !== null) {
      foreach ($this->inResponseToIds ?? [] as $item) {
        $parts[] = [
          'name' => 'in_response_to_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->responseType !== null) {
      $parts[] = [
        'name' => 'response_type',
        'contents' => $this->responseType
      ];
    }

    if ($this->attachments !== null) {
      $parts[] = [
        'name' => 'attachments',
        'contents' => json_encode($this->attachments),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->attachments ?? [] as $item) {
      $item->validate();
    }
  }
}
