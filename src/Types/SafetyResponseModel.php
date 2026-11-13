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
class SafetyResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('is_blocked_ivc')]
  public ?bool $isBlockedIvc;

  #[JsonProperty('is_blocked_non_ivc')]
  public ?bool $isBlockedNonIvc;

  #[JsonProperty('ignore_safety_evaluation')]
  public ?bool $ignoreSafetyEvaluation;

  /**
   * @param array{
   *   isBlockedIvc?: ?bool,
   *   isBlockedNonIvc?: ?bool,
   *   ignoreSafetyEvaluation?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->isBlockedIvc = $values['isBlockedIvc'] ?? null;
    $this->isBlockedNonIvc = $values['isBlockedNonIvc'] ?? null;
    $this->ignoreSafetyEvaluation = $values['ignoreSafetyEvaluation'] ?? null;

    if (array_key_exists('isBlockedIvc', $values)) {
      $this->_dirtyFields['is_blocked_ivc'] = true;
    }
    if (array_key_exists('isBlockedNonIvc', $values)) {
      $this->_dirtyFields['is_blocked_non_ivc'] = true;
    }
    if (array_key_exists('ignoreSafetyEvaluation', $values)) {
      $this->_dirtyFields['ignore_safety_evaluation'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->isBlockedIvc !== null) {
      $parts[] = [
        'name' => 'is_blocked_ivc',
        'contents' => $this->isBlockedIvc ? 'true' : 'false'
      ];
    }

    if ($this->isBlockedNonIvc !== null) {
      $parts[] = [
        'name' => 'is_blocked_non_ivc',
        'contents' => $this->isBlockedNonIvc ? 'true' : 'false'
      ];
    }

    if ($this->ignoreSafetyEvaluation !== null) {
      $parts[] = [
        'name' => 'ignore_safety_evaluation',
        'contents' => $this->ignoreSafetyEvaluation ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
