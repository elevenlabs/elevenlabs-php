<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Branches\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyUpdateAgentBranchV1ConvaiAgentsAgentIdBranchesBranchIdPatch extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * New name for the branch. Must be unique within the agent.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * New description for the branch. Pass an empty string to clear it.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * Whether the branch should be archived
   */
  #[JsonProperty('is_archived')]
  public ?bool $isArchived;

  /**
   * @var ?value-of<\ElevenLabs\Types\BranchProtectionStatus>
   * The protection level for the branch
   */
  #[JsonProperty('protection_status')]
  public ?string $protectionStatus;

  /**
   * When true, rebase this branch onto main automatically after each new main version. Cannot be enabled on the main branch.
   */
  #[JsonProperty('auto_rebase')]
  public ?bool $autoRebase;

  /**
   * @param array{
   *   name?: ?string,
   *   description?: ?string,
   *   isArchived?: ?bool,
   *   protectionStatus?: ?value-of<\ElevenLabs\Types\BranchProtectionStatus>,
   *   autoRebase?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->name = $values['name'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->isArchived = $values['isArchived'] ?? null;
    $this->protectionStatus = $values['protectionStatus'] ?? null;
    $this->autoRebase = $values['autoRebase'] ?? null;

    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('isArchived', $values)) {
      $this->_dirtyFields['is_archived'] = true;
    }
    if (array_key_exists('protectionStatus', $values)) {
      $this->_dirtyFields['protection_status'] = true;
    }
    if (array_key_exists('autoRebase', $values)) {
      $this->_dirtyFields['auto_rebase'] = true;
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

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->isArchived !== null) {
      $parts[] = [
        'name' => 'is_archived',
        'contents' => $this->isArchived ? 'true' : 'false'
      ];
    }

    if ($this->protectionStatus !== null) {
      $parts[] = [
        'name' => 'protection_status',
        'contents' => $this->protectionStatus
      ];
    }

    if ($this->autoRebase !== null) {
      $parts[] = [
        'name' => 'auto_rebase',
        'contents' => $this->autoRebase ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', minLength: 1, maxLength: 140);
    Validator::validateString($this->description, 'description', maxLength: 4096);
  }
}
