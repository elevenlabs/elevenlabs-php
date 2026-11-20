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
class TeamInviteResult extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('email', required: true)]
  public string $email;

  /**
   * @var value-of<\ElevenLabs\Types\TeamInviteOutcome>
   */
  #[JsonProperty('outcome', required: true)]
  public string $outcome;

  #[JsonProperty('error_status')]
  public ?string $errorStatus;

  /**
   * @param array{
   *   email: string,
   *   outcome: value-of<\ElevenLabs\Types\TeamInviteOutcome>,
   *   errorStatus?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->email = $values['email'];
    $this->outcome = $values['outcome'];
    $this->errorStatus = $values['errorStatus'] ?? null;

    $this->_dirtyFields = [
      'email' => true,
      'outcome' => true
    ];
    if (array_key_exists('errorStatus', $values)) {
      $this->_dirtyFields['error_status'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'email',
      'contents' => $this->email
    ];

    $parts[] = [
      'name' => 'outcome',
      'contents' => $this->outcome
    ];

    if ($this->errorStatus !== null) {
      $parts[] = [
        'name' => 'error_status',
        'contents' => $this->errorStatus
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
