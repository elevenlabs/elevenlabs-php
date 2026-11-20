<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A single behavioral rule for the agent.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AgentRule extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('title', required: true)]
  public string $title;

  #[JsonProperty('description', required: true)]
  public string $description;

  /**
   * @var ?value-of<\ElevenLabs\Types\RulePriority>
   * How strictly the receptionist follows a rule.
   */
  #[JsonProperty('priority')]
  public ?string $priority;

  /**
   * ID of the rule.
   */
  #[JsonProperty('id')]
  public ?string $id;

  /**
   * Unix timestamp (seconds since epoch)
   */
  #[JsonProperty('created_at_unix')]
  public ?int $createdAtUnix;

  /**
   * @param array{
   *   title: string,
   *   description: string,
   *   priority?: ?value-of<\ElevenLabs\Types\RulePriority>,
   *   id?: ?string,
   *   createdAtUnix?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->title = $values['title'];
    $this->description = $values['description'];
    $this->priority = $values['priority'] ?? null;
    $this->id = $values['id'] ?? null;
    $this->createdAtUnix = $values['createdAtUnix'] ?? null;

    $this->_dirtyFields = [
      'title' => true,
      'description' => true
    ];
    if (array_key_exists('priority', $values)) {
      $this->_dirtyFields['priority'] = true;
    }
    if (array_key_exists('id', $values)) {
      $this->_dirtyFields['id'] = true;
    }
    if (array_key_exists('createdAtUnix', $values)) {
      $this->_dirtyFields['created_at_unix'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'title',
      'contents' => $this->title
    ];

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    if ($this->priority !== null) {
      $parts[] = [
        'name' => 'priority',
        'contents' => $this->priority
      ];
    }

    if ($this->id !== null) {
      $parts[] = [
        'name' => 'id',
        'contents' => $this->id
      ];
    }

    if ($this->createdAtUnix !== null) {
      $parts[] = [
        'name' => 'created_at_unix',
        'contents' => (string) $this->createdAtUnix
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
