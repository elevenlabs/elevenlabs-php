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
class AgentBan extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('at_unix', required: true)]
  public int $atUnix;

  #[JsonProperty('reason')]
  public ?string $reason;

  /**
   * @var value-of<\ElevenLabs\Types\BanReasonType>
   */
  #[JsonProperty('reason_type', required: true)]
  public string $reasonType;

  /**
   * @param array{
   *   atUnix: int,
   *   reasonType: value-of<\ElevenLabs\Types\BanReasonType>,
   *   reason?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->atUnix = $values['atUnix'];
    $this->reason = $values['reason'] ?? null;
    $this->reasonType = $values['reasonType'];

    $this->_dirtyFields = [
      'at_unix' => true,
      'reason_type' => true
    ];
    if (array_key_exists('reason', $values)) {
      $this->_dirtyFields['reason'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'at_unix',
      'contents' => (string) $this->atUnix
    ];

    if ($this->reason !== null) {
      $parts[] = [
        'name' => 'reason',
        'contents' => $this->reason
      ];
    }

    $parts[] = [
      'name' => 'reason_type',
      'contents' => $this->reasonType
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
