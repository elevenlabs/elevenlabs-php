<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * How widely a group is shared, besides its owner and workspace admins (who always have access).
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class RealtimeConversationGroupSharingSummary extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Distinct people besides the owner with access, whether shared directly or through a workspace group they belong to.
   */
  #[JsonProperty('people_count', required: true)]
  public int $peopleCount;

  /**
   * Whether every workspace member has access to the group.
   */
  #[JsonProperty('shared_with_everyone')]
  public ?bool $sharedWithEveryone;

  /**
   * @var ?value-of<\ElevenLabs\Types\RealtimeConversationGroupSharingSummaryEveryoneRole>
   * The preset role every workspace member has, when shared with everyone. None for a workspace custom role.
   */
  #[JsonProperty('everyone_role')]
  public ?string $everyoneRole;

  /**
   * @param array{
   *   peopleCount: int,
   *   sharedWithEveryone?: ?bool,
   *   everyoneRole?: ?value-of<\ElevenLabs\Types\RealtimeConversationGroupSharingSummaryEveryoneRole>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->peopleCount = $values['peopleCount'];
    $this->sharedWithEveryone = $values['sharedWithEveryone'] ?? null;
    $this->everyoneRole = $values['everyoneRole'] ?? null;

    $this->_dirtyFields = [
      'people_count' => true
    ];
    if (array_key_exists('sharedWithEveryone', $values)) {
      $this->_dirtyFields['shared_with_everyone'] = true;
    }
    if (array_key_exists('everyoneRole', $values)) {
      $this->_dirtyFields['everyone_role'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'people_count',
      'contents' => (string) $this->peopleCount
    ];

    if ($this->sharedWithEveryone !== null) {
      $parts[] = [
        'name' => 'shared_with_everyone',
        'contents' => $this->sharedWithEveryone ? 'true' : 'false'
      ];
    }

    if ($this->everyoneRole !== null) {
      $parts[] = [
        'name' => 'everyone_role',
        'contents' => $this->everyoneRole
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
