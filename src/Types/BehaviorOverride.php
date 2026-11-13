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
class BehaviorOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\Verbosity>
   * Verbosity override. Underlying default applies when unset.
   */
  #[JsonProperty('verbosity')]
  public ?string $verbosity;

  /**
   * @var ?value-of<\ElevenLabs\Types\OutputFormat>
   * Output format override. Underlying default applies when unset.
   */
  #[JsonProperty('output_format')]
  public ?string $outputFormat;

  /**
   * @var ?value-of<\ElevenLabs\Types\InteractionBudget>
   * Interaction budget override. Underlying default applies when unset.
   */
  #[JsonProperty('interaction_budget')]
  public ?string $interactionBudget;

  /**
   * @param array{
   *   verbosity?: ?value-of<\ElevenLabs\Types\Verbosity>,
   *   outputFormat?: ?value-of<\ElevenLabs\Types\OutputFormat>,
   *   interactionBudget?: ?value-of<\ElevenLabs\Types\InteractionBudget>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->verbosity = $values['verbosity'] ?? null;
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->interactionBudget = $values['interactionBudget'] ?? null;

    if (array_key_exists('verbosity', $values)) {
      $this->_dirtyFields['verbosity'] = true;
    }
    if (array_key_exists('outputFormat', $values)) {
      $this->_dirtyFields['output_format'] = true;
    }
    if (array_key_exists('interactionBudget', $values)) {
      $this->_dirtyFields['interaction_budget'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->verbosity !== null) {
      $parts[] = [
        'name' => 'verbosity',
        'contents' => $this->verbosity
      ];
    }

    if ($this->outputFormat !== null) {
      $parts[] = [
        'name' => 'output_format',
        'contents' => $this->outputFormat
      ];
    }

    if ($this->interactionBudget !== null) {
      $parts[] = [
        'name' => 'interaction_budget',
        'contents' => $this->interactionBudget
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
