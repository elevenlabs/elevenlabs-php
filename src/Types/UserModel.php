<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * OCSF User object.
 *
 * Spec: https://schema.ocsf.io/1.6.0/objects/user
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UserModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Username
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * Unique user identifier
   */
  #[JsonProperty('uid')]
  public ?string $uid;

  /**
   * @var ?value-of<\ElevenLabs\Types\UserTypeId>
   * OCSF User type IDs.
   *
   * Spec: https://schema.ocsf.io/1.6.0/objects/user
   */
  #[JsonProperty('type_id')]
  public ?int $typeId;

  /**
   * Account type description
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * User email address
   */
  #[JsonProperty('email_addr')]
  public ?string $emailAddr;

  /**
   * Full name of the user
   */
  #[JsonProperty('full_name')]
  public ?string $fullName;

  /**
   * User's domain
   */
  #[JsonProperty('domain')]
  public ?string $domain;

  /**
   * @param array{
   *   name?: ?string,
   *   uid?: ?string,
   *   typeId?: ?value-of<\ElevenLabs\Types\UserTypeId>,
   *   type?: ?string,
   *   emailAddr?: ?string,
   *   fullName?: ?string,
   *   domain?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->name = $values['name'] ?? null;
    $this->uid = $values['uid'] ?? null;
    $this->typeId = $values['typeId'] ?? null;
    $this->type = $values['type'] ?? null;
    $this->emailAddr = $values['emailAddr'] ?? null;
    $this->fullName = $values['fullName'] ?? null;
    $this->domain = $values['domain'] ?? null;

    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('uid', $values)) {
      $this->_dirtyFields['uid'] = true;
    }
    if (array_key_exists('typeId', $values)) {
      $this->_dirtyFields['type_id'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('emailAddr', $values)) {
      $this->_dirtyFields['email_addr'] = true;
    }
    if (array_key_exists('fullName', $values)) {
      $this->_dirtyFields['full_name'] = true;
    }
    if (array_key_exists('domain', $values)) {
      $this->_dirtyFields['domain'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->uid !== null) {
      $parts[] = [
        'name' => 'uid',
        'contents' => $this->uid
      ];
    }

    if ($this->typeId !== null) {
      $parts[] = [
        'name' => 'type_id',
        'contents' => (string) $this->typeId
      ];
    }

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->emailAddr !== null) {
      $parts[] = [
        'name' => 'email_addr',
        'contents' => $this->emailAddr
      ];
    }

    if ($this->fullName !== null) {
      $parts[] = [
        'name' => 'full_name',
        'contents' => $this->fullName
      ];
    }

    if ($this->domain !== null) {
      $parts[] = [
        'name' => 'domain',
        'contents' => $this->domain
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
