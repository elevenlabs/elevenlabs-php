<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Receptionists\Procedures\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Request model for creating a new procedure.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionCreateProcedureRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('trigger', required: true)]
  public string $trigger;

  /**
   * Step-by-step instructions, as markdown.
   */
  #[JsonProperty('body')]
  public ?string $body;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   name: string,
   *   trigger: string,
   *   body?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->name = $values['name'];
    $this->trigger = $values['trigger'];
    $this->body = $values['body'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'trigger' => true
    ];
    if (array_key_exists('body', $values)) {
      $this->_dirtyFields['body'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'trigger',
      'contents' => $this->trigger
    ];

    if ($this->body !== null) {
      $parts[] = [
        'name' => 'body',
        'contents' => $this->body
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->body, 'body', maxLength: 40000);
  }
}
