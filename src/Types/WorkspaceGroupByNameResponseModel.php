<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkspaceGroupByNameResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name of the workspace group.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The ID of the workspace group.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var string[]
   * The emails of the members of the workspace group.
   */
  #[JsonProperty('members_emails', required: true), ArrayType(['string'])]
  public array $membersEmails;

  /**
   * @param array{
   *   name: string,
   *   id: string,
   *   membersEmails: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->id = $values['id'];
    $this->membersEmails = $values['membersEmails'];

    $this->_dirtyFields = [
      'name' => true,
      'id' => true,
      'members_emails' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    foreach ($this->membersEmails as $item) {
      $parts[] = [
        'name' => 'members_emails',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
