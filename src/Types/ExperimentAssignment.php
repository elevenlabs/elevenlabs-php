<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Experiment membership recorded on a conversation.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ExperimentAssignment extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Experiment key.
   */
  #[JsonProperty('key', required: true)]
  public string $key;

  /**
   * Variant identifier: the branch id for server_branch, or the client-supplied variant for client_declared.
   */
  #[JsonProperty('variant', required: true)]
  public string $variant;

  /**
   * @var value-of<\ElevenLabs\Types\ExperimentAssignmentSource>
   */
  #[JsonProperty('source', required: true)]
  public string $source;

  /**
   * The AgentExperiment id, when the assignment maps to a registered experiment.
   */
  #[JsonProperty('experiment_id')]
  public ?string $experimentId;

  /**
   * @param array{
   *   key: string,
   *   variant: string,
   *   source: value-of<\ElevenLabs\Types\ExperimentAssignmentSource>,
   *   experimentId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->key = $values['key'];
    $this->variant = $values['variant'];
    $this->source = $values['source'];
    $this->experimentId = $values['experimentId'] ?? null;

    $this->_dirtyFields = [
      'key' => true,
      'variant' => true,
      'source' => true
    ];
    if (array_key_exists('experimentId', $values)) {
      $this->_dirtyFields['experiment_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'key',
      'contents' => $this->key
    ];

    $parts[] = [
      'name' => 'variant',
      'contents' => $this->variant
    ];

    $parts[] = [
      'name' => 'source',
      'contents' => $this->source
    ];

    if ($this->experimentId !== null) {
      $parts[] = [
        'name' => 'experiment_id',
        'contents' => $this->experimentId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
