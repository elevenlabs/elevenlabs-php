<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Additional properties describing a Tool to clients.
 *
 * NOTE: all properties in ToolAnnotations are **hints**.
 * They are not guaranteed to provide a faithful description of
 * tool behavior (including descriptive properties like `title`).
 *
 * Clients should never make tool use decisions based on ToolAnnotations
 * received from untrusted servers.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ToolAnnotations extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('title')]
  public ?string $title;

  #[JsonProperty('readOnlyHint')]
  public ?bool $readOnlyHint;

  #[JsonProperty('destructiveHint')]
  public ?bool $destructiveHint;

  #[JsonProperty('idempotentHint')]
  public ?bool $idempotentHint;

  #[JsonProperty('openWorldHint')]
  public ?bool $openWorldHint;

  /**
   * @param array{
   *   title?: ?string,
   *   readOnlyHint?: ?bool,
   *   destructiveHint?: ?bool,
   *   idempotentHint?: ?bool,
   *   openWorldHint?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->title = $values['title'] ?? null;
    $this->readOnlyHint = $values['readOnlyHint'] ?? null;
    $this->destructiveHint = $values['destructiveHint'] ?? null;
    $this->idempotentHint = $values['idempotentHint'] ?? null;
    $this->openWorldHint = $values['openWorldHint'] ?? null;

    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('readOnlyHint', $values)) {
      $this->_dirtyFields['readOnlyHint'] = true;
    }
    if (array_key_exists('destructiveHint', $values)) {
      $this->_dirtyFields['destructiveHint'] = true;
    }
    if (array_key_exists('idempotentHint', $values)) {
      $this->_dirtyFields['idempotentHint'] = true;
    }
    if (array_key_exists('openWorldHint', $values)) {
      $this->_dirtyFields['openWorldHint'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->title !== null) {
      $parts[] = [
        'name' => 'title',
        'contents' => $this->title
      ];
    }

    if ($this->readOnlyHint !== null) {
      $parts[] = [
        'name' => 'readOnlyHint',
        'contents' => $this->readOnlyHint ? 'true' : 'false'
      ];
    }

    if ($this->destructiveHint !== null) {
      $parts[] = [
        'name' => 'destructiveHint',
        'contents' => $this->destructiveHint ? 'true' : 'false'
      ];
    }

    if ($this->idempotentHint !== null) {
      $parts[] = [
        'name' => 'idempotentHint',
        'contents' => $this->idempotentHint ? 'true' : 'false'
      ];
    }

    if ($this->openWorldHint !== null) {
      $parts[] = [
        'name' => 'openWorldHint',
        'contents' => $this->openWorldHint ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
