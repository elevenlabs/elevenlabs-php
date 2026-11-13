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
class ConversationHistoryErrorCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('code', required: true)]
  public int $code;

  #[JsonProperty('reason')]
  public ?string $reason;

  /**
   * @param array{
   *   code: int,
   *   reason?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->code = $values['code'];
    $this->reason = $values['reason'] ?? null;

    $this->_dirtyFields = [
      'code' => true
    ];
    if (array_key_exists('reason', $values)) {
      $this->_dirtyFields['reason'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'code',
      'contents' => (string) $this->code
    ];

    if ($this->reason !== null) {
      $parts[] = [
        'name' => 'reason',
        'contents' => $this->reason
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
