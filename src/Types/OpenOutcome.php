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
class OpenOutcome extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\OpenOutcomeStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  /**
   * @param array{
   *   status?: ?value-of<\ElevenLabs\Types\OpenOutcomeStatus>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->status = $values['status'] ?? 'open';

    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
