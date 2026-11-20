<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Receptionists\Rules\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Request model for creating a new agent rule.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionCreateAgentRuleRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

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
   * @param array{
   *   xiWorkspaceId: string,
   *   title: string,
   *   description: string,
   *   priority?: ?value-of<\ElevenLabs\Types\RulePriority>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->title = $values['title'];
    $this->description = $values['description'];
    $this->priority = $values['priority'] ?? null;

    $this->_dirtyFields = [
      'title' => true,
      'description' => true
    ];
    if (array_key_exists('priority', $values)) {
      $this->_dirtyFields['priority'] = true;
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

    return $parts;
  }

  public function validate(): void
  {
  }
}
