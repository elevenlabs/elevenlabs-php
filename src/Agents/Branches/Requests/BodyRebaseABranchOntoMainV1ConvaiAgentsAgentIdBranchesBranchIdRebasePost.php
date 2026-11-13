<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Branches\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyRebaseABranchOntoMainV1ConvaiAgentsAgentIdBranchesBranchIdRebasePost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the branch to pull changes from. Defaults to the agent's main branch.
   */
  public ?string $sourceBranchId;

  /**
   * @var array<string, mixed>
   */
  public array $additionalProperties = [];

  /**
   * @param array{
   *   sourceBranchId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->sourceBranchId = $values['sourceBranchId'] ?? null;
  }

  public function toMultipart(): array
  {
    $parts = [];

    return $parts;
  }

  public function validate(): void
  {
  }
}
