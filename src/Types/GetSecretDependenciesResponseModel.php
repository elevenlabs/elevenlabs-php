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
class GetSecretDependenciesResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('dependencies', required: true)]
  public array $dependencies;

  /**
   * Cursor for fetching the next page of dependencies
   */
  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  /**
   * @param array{
   *   dependencies: array,
   *   nextCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->dependencies = $values['dependencies'];
    $this->nextCursor = $values['nextCursor'] ?? null;

    $this->_dirtyFields = [
      'dependencies' => true
    ];
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'dependencies',
      'contents' => json_encode($this->dependencies),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
