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
class PendingCancellationResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\PendingCancellationResponseModelKind>
   */
  #[JsonProperty('kind')]
  public ?string $kind;

  /**
   * The timestamp of the cancellation.
   */
  #[JsonProperty('timestamp_seconds', required: true)]
  public int $timestampSeconds;

  /**
   * @param array{
   *   timestampSeconds: int,
   *   kind?: ?value-of<\ElevenLabs\Types\PendingCancellationResponseModelKind>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->kind = $values['kind'] ?? 'cancellation';
    $this->timestampSeconds = $values['timestampSeconds'];

    $this->_dirtyFields = [
      'timestamp_seconds' => true
    ];
    if (array_key_exists('kind', $values)) {
      $this->_dirtyFields['kind'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->kind !== null) {
      $parts[] = [
        'name' => 'kind',
        'contents' => $this->kind
      ];
    }

    $parts[] = [
      'name' => 'timestamp_seconds',
      'contents' => (string) $this->timestampSeconds
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
