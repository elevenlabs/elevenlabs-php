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
class TriggeredGuardrailCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\GuardrailType>
   */
  #[JsonProperty('guardrail_type', required: true)]
  public string $guardrailType;

  #[JsonProperty('guardrail_name')]
  public ?string $guardrailName;

  /**
   * @var ?value-of<\ElevenLabs\Types\GuardrailExecutionMode>
   * `blocking` if the agent's response waited for the guardrail, `streaming` if the guardrail ran while the response was sent.
   */
  #[JsonProperty('execution_mode')]
  public ?string $executionMode;

  /**
   * Why the guardrail triggered: the LLM's rationale for custom guardrails, or the score and threshold for moderation and content guardrails.
   */
  #[JsonProperty('guardrail_details')]
  public ?\ElevenLabs\Types\TriggeredGuardrailCommonModelGuardrailDetails $guardrailDetails;

  /**
   * @param array{
   *   guardrailType: value-of<\ElevenLabs\Types\GuardrailType>,
   *   guardrailName?: ?string,
   *   executionMode?: ?value-of<\ElevenLabs\Types\GuardrailExecutionMode>,
   *   guardrailDetails?: ?\ElevenLabs\Types\TriggeredGuardrailCommonModelGuardrailDetails,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->guardrailType = $values['guardrailType'];
    $this->guardrailName = $values['guardrailName'] ?? null;
    $this->executionMode = $values['executionMode'] ?? null;
    $this->guardrailDetails = $values['guardrailDetails'] ?? null;

    $this->_dirtyFields = [
      'guardrail_type' => true
    ];
    if (array_key_exists('guardrailName', $values)) {
      $this->_dirtyFields['guardrail_name'] = true;
    }
    if (array_key_exists('executionMode', $values)) {
      $this->_dirtyFields['execution_mode'] = true;
    }
    if (array_key_exists('guardrailDetails', $values)) {
      $this->_dirtyFields['guardrail_details'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'guardrail_type',
      'contents' => $this->guardrailType
    ];

    if ($this->guardrailName !== null) {
      $parts[] = [
        'name' => 'guardrail_name',
        'contents' => $this->guardrailName
      ];
    }

    if ($this->executionMode !== null) {
      $parts[] = [
        'name' => 'execution_mode',
        'contents' => $this->executionMode
      ];
    }

    if ($this->guardrailDetails !== null) {
      $parts[] = [
        'name' => 'guardrail_details',
        'contents' => json_encode($this->guardrailDetails),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
