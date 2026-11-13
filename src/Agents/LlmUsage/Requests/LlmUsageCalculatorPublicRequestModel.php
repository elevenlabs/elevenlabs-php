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
class LlmUsageCalculatorPublicRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Length of the prompt in characters.
   */
  #[JsonProperty('prompt_length', required: true)]
  public int $promptLength;

  /**
   * Pages of content in PDF documents or URLs in the agent's knowledge base.
   */
  #[JsonProperty('number_of_pages', required: true)]
  public int $numberOfPages;

  /**
   * Whether RAG is enabled.
   */
  #[JsonProperty('rag_enabled', required: true)]
  public bool $ragEnabled;

  /**
   * @var ?value-of<\ElevenLabs\Types\LlmServiceTier>
   * Service tier to price against. Only affects models that offer the tier; others fall back to their standard price.
   */
  #[JsonProperty('service_tier')]
  public ?string $serviceTier;

  /**
   * @param array{
   *   promptLength: int,
   *   numberOfPages: int,
   *   ragEnabled: bool,
   *   serviceTier?: ?value-of<\ElevenLabs\Types\LlmServiceTier>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->promptLength = $values['promptLength'];
    $this->numberOfPages = $values['numberOfPages'];
    $this->ragEnabled = $values['ragEnabled'];
    $this->serviceTier = $values['serviceTier'] ?? null;

    $this->_dirtyFields = [
      'prompt_length' => true,
      'number_of_pages' => true,
      'rag_enabled' => true
    ];
    if (array_key_exists('serviceTier', $values)) {
      $this->_dirtyFields['service_tier'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'prompt_length',
      'contents' => (string) $this->promptLength
    ];

    $parts[] = [
      'name' => 'number_of_pages',
      'contents' => (string) $this->numberOfPages
    ];

    $parts[] = [
      'name' => 'rag_enabled',
      'contents' => $this->ragEnabled ? 'true' : 'false'
    ];

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
