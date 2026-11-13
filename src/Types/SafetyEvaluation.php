<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Safety evaluation of the agent. Prompt and first message is taken into account.
 * The unsafe reason is provided from the evaluation
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SafetyEvaluation extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('is_unsafe')]
  public ?bool $isUnsafe;

  #[JsonProperty('llm_reason')]
  public ?string $llmReason;

  #[JsonProperty('safety_prompt_version')]
  public ?int $safetyPromptVersion;

  /**
   * @var array<value-of<\ElevenLabs\Types\SafetyRule>>|null
   */
  #[JsonProperty('matched_rule_id'), ArrayType(['string'])]
  public ?array $matchedRuleId;

  /**
   * @param array{
   *   isUnsafe?: ?bool,
   *   llmReason?: ?string,
   *   safetyPromptVersion?: ?int,
   *   matchedRuleId?: array<value-of<\ElevenLabs\Types\SafetyRule>>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->isUnsafe = $values['isUnsafe'] ?? null;
    $this->llmReason = $values['llmReason'] ?? null;
    $this->safetyPromptVersion = $values['safetyPromptVersion'] ?? null;
    $this->matchedRuleId = $values['matchedRuleId'] ?? null;

    if (array_key_exists('isUnsafe', $values)) {
      $this->_dirtyFields['is_unsafe'] = true;
    }
    if (array_key_exists('llmReason', $values)) {
      $this->_dirtyFields['llm_reason'] = true;
    }
    if (array_key_exists('safetyPromptVersion', $values)) {
      $this->_dirtyFields['safety_prompt_version'] = true;
    }
    if (array_key_exists('matchedRuleId', $values)) {
      $this->_dirtyFields['matched_rule_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->isUnsafe !== null) {
      $parts[] = [
        'name' => 'is_unsafe',
        'contents' => $this->isUnsafe ? 'true' : 'false'
      ];
    }

    if ($this->llmReason !== null) {
      $parts[] = [
        'name' => 'llm_reason',
        'contents' => $this->llmReason
      ];
    }

    if ($this->safetyPromptVersion !== null) {
      $parts[] = [
        'name' => 'safety_prompt_version',
        'contents' => (string) $this->safetyPromptVersion
      ];
    }

    if ($this->matchedRuleId !== null) {
      foreach ($this->matchedRuleId ?? [] as $item) {
        $parts[] = [
          'name' => 'matched_rule_id',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
