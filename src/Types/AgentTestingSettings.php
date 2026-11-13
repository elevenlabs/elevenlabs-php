<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Settings for agent testing configuration.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AgentTestingSettings extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AttachedTestModel[]|null
   * List of test IDs that should be run for this agent
   */
  #[JsonProperty('attached_tests'), ArrayType([\ElevenLabs\Types\AttachedTestModel::class])]
  public ?array $attachedTests;

  /**
   * @param array{
   *   attachedTests?: \ElevenLabs\Types\AttachedTestModel[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->attachedTests = $values['attachedTests'] ?? null;

    if (array_key_exists('attachedTests', $values)) {
      $this->_dirtyFields['attached_tests'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->attachedTests !== null) {
      $parts[] = [
        'name' => 'attached_tests',
        'contents' => json_encode($this->attachedTests),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->attachedTests ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->attachedTests, 'attached_tests', minItems: 0, maxItems: 5000);
  }
}
