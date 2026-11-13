<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\TriageTickets\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MergeAgentConversationTicketsRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * Open tickets of the same agent to fold into this one. They are kept with status 'merged', pointing at this ticket.
   */
  #[JsonProperty('source_ticket_ids', required: true), ArrayType(['string'])]
  public array $sourceTicketIds;

  /**
   * @param array{
   *   sourceTicketIds: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->sourceTicketIds = $values['sourceTicketIds'];

    $this->_dirtyFields = [
      'source_ticket_ids' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->sourceTicketIds as $item) {
      $parts[] = [
        'name' => 'source_ticket_ids',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray(
      $this->sourceTicketIds,
      'source_ticket_ids',
      minItems: 1,
      maxItems: 50
    );
  }
}
