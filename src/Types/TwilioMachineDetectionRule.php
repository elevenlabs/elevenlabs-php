<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Action to take on a live call for the given AMD verdicts.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TwilioMachineDetectionRule extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\TwilioMachineDetectionAction>
   */
  #[JsonProperty('action', required: true)]
  public string $action;

  /**
   * @var array<value-of<\ElevenLabs\Types\TwilioAnsweredBy>>
   * Verdicts that trigger the action.
   */
  #[JsonProperty('answered_by', required: true), ArrayType(['string'])]
  public array $answeredBy;

  /**
   * @param array{
   *   action: value-of<\ElevenLabs\Types\TwilioMachineDetectionAction>,
   *   answeredBy: array<value-of<\ElevenLabs\Types\TwilioAnsweredBy>>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->action = $values['action'];
    $this->answeredBy = $values['answeredBy'];

    $this->_dirtyFields = [
      'action' => true,
      'answered_by' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'action',
      'contents' => $this->action
    ];

    foreach ($this->answeredBy as $item) {
      $parts[] = [
        'name' => 'answered_by',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->answeredBy, 'answered_by', minItems: 1);
  }
}
