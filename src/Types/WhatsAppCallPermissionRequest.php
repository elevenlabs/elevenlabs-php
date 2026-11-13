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
class WhatsAppCallPermissionRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\WhatsAppCallPermissionRequestState>
   */
  #[JsonProperty('state', required: true)]
  public string $state;

  #[JsonProperty('requested_at_unix')]
  public ?int $requestedAtUnix;

  #[JsonProperty('responded_at_unix')]
  public ?int $respondedAtUnix;

  #[JsonProperty('permanent')]
  public ?bool $permanent;

  #[JsonProperty('granted_by_user_call')]
  public ?bool $grantedByUserCall;

  /**
   * @param array{
   *   state: value-of<\ElevenLabs\Types\WhatsAppCallPermissionRequestState>,
   *   requestedAtUnix?: ?int,
   *   respondedAtUnix?: ?int,
   *   permanent?: ?bool,
   *   grantedByUserCall?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->state = $values['state'];
    $this->requestedAtUnix = $values['requestedAtUnix'] ?? null;
    $this->respondedAtUnix = $values['respondedAtUnix'] ?? null;
    $this->permanent = $values['permanent'] ?? null;
    $this->grantedByUserCall = $values['grantedByUserCall'] ?? null;

    $this->_dirtyFields = [
      'state' => true
    ];
    if (array_key_exists('requestedAtUnix', $values)) {
      $this->_dirtyFields['requested_at_unix'] = true;
    }
    if (array_key_exists('respondedAtUnix', $values)) {
      $this->_dirtyFields['responded_at_unix'] = true;
    }
    if (array_key_exists('permanent', $values)) {
      $this->_dirtyFields['permanent'] = true;
    }
    if (array_key_exists('grantedByUserCall', $values)) {
      $this->_dirtyFields['granted_by_user_call'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'state',
      'contents' => $this->state
    ];

    if ($this->requestedAtUnix !== null) {
      $parts[] = [
        'name' => 'requested_at_unix',
        'contents' => (string) $this->requestedAtUnix
      ];
    }

    if ($this->respondedAtUnix !== null) {
      $parts[] = [
        'name' => 'responded_at_unix',
        'contents' => (string) $this->respondedAtUnix
      ];
    }

    if ($this->permanent !== null) {
      $parts[] = [
        'name' => 'permanent',
        'contents' => $this->permanent ? 'true' : 'false'
      ];
    }

    if ($this->grantedByUserCall !== null) {
      $parts[] = [
        'name' => 'granted_by_user_call',
        'contents' => $this->grantedByUserCall ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
