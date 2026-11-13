<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\LlmUsage\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class LlmUsageCalculatorRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Length of the prompt in characters.
   */
  #[JsonProperty('prompt_length')]
  public ?int $promptLength;

  /**
   * Pages of content in pdf documents OR urls in agent's Knowledge Base.
   */
  #[JsonProperty('number_of_pages')]
  public ?int $numberOfPages;

  /**
   * Whether RAG is enabled.
   */
  #[JsonProperty('rag_enabled')]
  public ?bool $ragEnabled;

  /**
   * @var ?value-of<\ElevenLabs\Types\LlmServiceTier>
   * Service tier to price against. Only affects models that offer the tier; others fall back to their standard price.
   */
  #[JsonProperty('service_tier')]
  public ?string $serviceTier;

  /**
   * @param array{
   *   promptLength?: ?int,
   *   numberOfPages?: ?int,
   *   ragEnabled?: ?bool,
   *   serviceTier?: ?value-of<\ElevenLabs\Types\LlmServiceTier>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->promptLength = $values['promptLength'] ?? null;
    $this->numberOfPages = $values['numberOfPages'] ?? null;
    $this->ragEnabled = $values['ragEnabled'] ?? null;
    $this->serviceTier = $values['serviceTier'] ?? null;

    if (array_key_exists('promptLength', $values)) {
      $this->_dirtyFields['prompt_length'] = true;
    }
    if (array_key_exists('numberOfPages', $values)) {
      $this->_dirtyFields['number_of_pages'] = true;
    }
    if (array_key_exists('ragEnabled', $values)) {
      $this->_dirtyFields['rag_enabled'] = true;
    }
    if (array_key_exists('serviceTier', $values)) {
      $this->_dirtyFields['service_tier'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->promptLength !== null) {
      $parts[] = [
        'name' => 'prompt_length',
        'contents' => (string) $this->promptLength
      ];
    }

    if ($this->numberOfPages !== null) {
      $parts[] = [
        'name' => 'number_of_pages',
        'contents' => (string) $this->numberOfPages
      ];
    }

    if ($this->ragEnabled !== null) {
      $parts[] = [
        'name' => 'rag_enabled',
        'contents' => $this->ragEnabled ? 'true' : 'false'
      ];
    }

    if ($this->serviceTier !== null) {
      $parts[] = [
        'name' => 'service_tier',
        'contents' => $this->serviceTier
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
