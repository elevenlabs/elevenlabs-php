<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * A standard operating procedure (SOP) the receptionist can run on calls.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionProcedure extends JsonSerializableType
{
  use ReflectiveSerialization;

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
   * ID of the procedure.
   */
  #[JsonProperty('id')]
  public ?string $id;

  /**
   * Unix timestamp (seconds since epoch)
   */
  #[JsonProperty('created_at_unix')]
  public ?int $createdAtUnix;

  /**
   * Set when the procedure was copied from an integration's template; null for procedures you create.
   */
  #[JsonProperty('source_key')]
  public ?string $sourceKey;

  /**
   * @param array{
   *   name: string,
   *   trigger: string,
   *   body?: ?string,
   *   id?: ?string,
   *   createdAtUnix?: ?int,
   *   sourceKey?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->trigger = $values['trigger'];
    $this->body = $values['body'] ?? null;
    $this->id = $values['id'] ?? null;
    $this->createdAtUnix = $values['createdAtUnix'] ?? null;
    $this->sourceKey = $values['sourceKey'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'trigger' => true
    ];
    if (array_key_exists('body', $values)) {
      $this->_dirtyFields['body'] = true;
    }
    if (array_key_exists('id', $values)) {
      $this->_dirtyFields['id'] = true;
    }
    if (array_key_exists('createdAtUnix', $values)) {
      $this->_dirtyFields['created_at_unix'] = true;
    }
    if (array_key_exists('sourceKey', $values)) {
      $this->_dirtyFields['source_key'] = true;
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

    if ($this->sourceKey !== null) {
      $parts[] = [
        'name' => 'source_key',
        'contents' => $this->sourceKey
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->body, 'body', maxLength: 40000);
  }
}
