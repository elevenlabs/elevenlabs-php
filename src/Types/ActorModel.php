<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * OCSF Actor object - describes the entity that performed the action.
 *
 * Spec: https://schema.ocsf.io/1.6.0/objects/actor
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ActorModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * OCSF User object.
   *
   * Spec: https://schema.ocsf.io/1.6.0/objects/user
   */
  #[JsonProperty('user', required: true)]
  public \ElevenLabs\Types\UserModel $user;

  /**
   * Client application or service name
   */
  #[JsonProperty('app_name')]
  public ?string $appName;

  /**
   * Client application unique identifier
   */
  #[JsonProperty('app_uid')]
  public ?string $appUid;

  /**
   * @var array<string, mixed>|null
   * Session information
   */
  #[JsonProperty('session'), ArrayType(['string' => 'mixed'])]
  public ?array $session;

  /**
   * @param array{
   *   user: \ElevenLabs\Types\UserModel,
   *   appName?: ?string,
   *   appUid?: ?string,
   *   session?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->user = $values['user'];
    $this->appName = $values['appName'] ?? null;
    $this->appUid = $values['appUid'] ?? null;
    $this->session = $values['session'] ?? null;

    $this->_dirtyFields = [
      'user' => true
    ];
    if (array_key_exists('appName', $values)) {
      $this->_dirtyFields['app_name'] = true;
    }
    if (array_key_exists('appUid', $values)) {
      $this->_dirtyFields['app_uid'] = true;
    }
    if (array_key_exists('session', $values)) {
      $this->_dirtyFields['session'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'user',
      'contents' => json_encode($this->user),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->appName !== null) {
      $parts[] = [
        'name' => 'app_name',
        'contents' => $this->appName
      ];
    }

    if ($this->appUid !== null) {
      $parts[] = [
        'name' => 'app_uid',
        'contents' => $this->appUid
      ];
    }

    if ($this->session !== null) {
      $parts[] = [
        'name' => 'session',
        'contents' => json_encode($this->session),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->user->validate();
  }
}
