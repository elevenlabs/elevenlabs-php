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
class LlmDeprecationConfigModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Number of days before the provider deprecation date when warnings start being shown.
   */
  #[JsonProperty('warning_start_days', required: true)]
  public int $warningStartDays;

  /**
   * Number of days before the provider deprecation date when traffic starts being routed to the replacement model.
   */
  #[JsonProperty('fallback_start_days', required: true)]
  public int $fallbackStartDays;

  /**
   * Number of days before the provider deprecation date when all traffic is routed to the replacement model.
   */
  #[JsonProperty('fallback_complete_days', required: true)]
  public int $fallbackCompleteDays;

  /**
   * Percentage of traffic routed to the replacement model when fallback begins.
   */
  #[JsonProperty('fallback_start_percentage', required: true)]
  public int $fallbackStartPercentage;

  /**
   * Percentage of traffic routed to the replacement model when fallback is complete.
   */
  #[JsonProperty('fallback_complete_percentage', required: true)]
  public int $fallbackCompletePercentage;

  /**
   * @param array{
   *   warningStartDays: int,
   *   fallbackStartDays: int,
   *   fallbackCompleteDays: int,
   *   fallbackStartPercentage: int,
   *   fallbackCompletePercentage: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->warningStartDays = $values['warningStartDays'];
    $this->fallbackStartDays = $values['fallbackStartDays'];
    $this->fallbackCompleteDays = $values['fallbackCompleteDays'];
    $this->fallbackStartPercentage = $values['fallbackStartPercentage'];
    $this->fallbackCompletePercentage = $values['fallbackCompletePercentage'];

    $this->_dirtyFields = [
      'warning_start_days' => true,
      'fallback_start_days' => true,
      'fallback_complete_days' => true,
      'fallback_start_percentage' => true,
      'fallback_complete_percentage' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'warning_start_days',
      'contents' => (string) $this->warningStartDays
    ];

    $parts[] = [
      'name' => 'fallback_start_days',
      'contents' => (string) $this->fallbackStartDays
    ];

    $parts[] = [
      'name' => 'fallback_complete_days',
      'contents' => (string) $this->fallbackCompleteDays
    ];

    $parts[] = [
      'name' => 'fallback_start_percentage',
      'contents' => (string) $this->fallbackStartPercentage
    ];

    $parts[] = [
      'name' => 'fallback_complete_percentage',
      'contents' => (string) $this->fallbackCompletePercentage
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
