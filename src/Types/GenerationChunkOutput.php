<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class GenerationChunkOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The text config to be generated for this chunk. Can contain an optional section name in square brackets at the beginning, e.g. [Verse 1], lyrics lines, and inline directions in curly braces, e.g. {scratching}. Section names must be between 1 and 100 characters. At most 30 lines are allowed, each at most 200 characters.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * The duration of the chunk in milliseconds. Must be between 3000ms and 120000ms.
   */
  #[JsonProperty('duration_ms', required: true)]
  public int $durationMs;

  /**
   * @var string[]
   * The styles and musical directions that should be present in this chunk. Use English language for best results. The styles for the first chunk are the most important as they set the overall tone and genre. Styles for subsequent chunks can be used to add nuance, progression, emphasis, or change the direction of the song. Aim to have at least 6-7 styles in early chunks until the direction is established. Generic styles like 'great production quality' are good default styles to append to the list.
   */
  #[JsonProperty('positive_styles', required: true), ArrayType(['string'])]
  public array $positiveStyles;

  /**
   * @var string[]|null
   * The styles and musical directions that should not be present in this chunk. Use English language for best results. Leaving empty is a good default, only use this field if you want to explicitly avoid a particular style or direction.
   */
  #[JsonProperty('negative_styles'), ArrayType(['string'])]
  public ?array $negativeStyles;

  /**
   * @var ?value-of<\ElevenLabs\Types\GenerationChunkOutputContextAdherence>
   * How much the model adheres to the context of its surrounding chunks. Low adherence means the model can deviate from the context and be more creative. High adherence means the model will be more consistent with the context.
   */
  #[JsonProperty('context_adherence')]
  public ?string $contextAdherence;

  /**
   * The audio reference to condition the generation on. The first chunk is the most important as it will influence the generation of all subsequent chunks. Thus, if you want to apply conditioning to the entire song, start conditioning from the first chunk.
   */
  #[JsonProperty('conditioning_ref')]
  public ?\ElevenLabs\Types\AudioRefChunk $conditioningRef;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConditionStrength>
   * How strongly the model adheres to the conditioning reference. Low strength means the model will be more creative and deviate from the reference. High strength means the model will be more consistent with the reference.
   */
  #[JsonProperty('condition_strength')]
  public ?string $conditionStrength;

  /**
   * @param array{
   *   text: string,
   *   durationMs: int,
   *   positiveStyles: string[],
   *   negativeStyles?: string[]|null,
   *   contextAdherence?: ?value-of<\ElevenLabs\Types\GenerationChunkOutputContextAdherence>,
   *   conditioningRef?: ?\ElevenLabs\Types\AudioRefChunk,
   *   conditionStrength?: ?value-of<\ElevenLabs\Types\ConditionStrength>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->durationMs = $values['durationMs'];
    $this->positiveStyles = $values['positiveStyles'];
    $this->negativeStyles = $values['negativeStyles'] ?? null;
    $this->contextAdherence = $values['contextAdherence'] ?? null;
    $this->conditioningRef = $values['conditioningRef'] ?? null;
    $this->conditionStrength = $values['conditionStrength'] ?? null;

    $this->_dirtyFields = [
      'text' => true,
      'duration_ms' => true,
      'positive_styles' => true
    ];
    if (array_key_exists('negativeStyles', $values)) {
      $this->_dirtyFields['negative_styles'] = true;
    }
    if (array_key_exists('contextAdherence', $values)) {
      $this->_dirtyFields['context_adherence'] = true;
    }
    if (array_key_exists('conditioningRef', $values)) {
      $this->_dirtyFields['conditioning_ref'] = true;
    }
    if (array_key_exists('conditionStrength', $values)) {
      $this->_dirtyFields['condition_strength'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'duration_ms',
      'contents' => (string) $this->durationMs
    ];

    foreach ($this->positiveStyles as $item) {
      $parts[] = [
        'name' => 'positive_styles',
        'contents' => $item
      ];
    }

    if ($this->negativeStyles !== null) {
      foreach ($this->negativeStyles ?? [] as $item) {
        $parts[] = [
          'name' => 'negative_styles',
          'contents' => $item
        ];
      }
    }

    if ($this->contextAdherence !== null) {
      $parts[] = [
        'name' => 'context_adherence',
        'contents' => $this->contextAdherence
      ];
    }

    if ($this->conditioningRef !== null) {
      $parts[] = [
        'name' => 'conditioning_ref',
        'contents' => json_encode($this->conditioningRef),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->conditionStrength !== null) {
      $parts[] = [
        'name' => 'condition_strength',
        'contents' => $this->conditionStrength
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->text, 'text', maxLength: 6132);
    Validator::validateNumber($this->durationMs, 'duration_ms', min: 3000, max: 120000);
    Validator::validateArray($this->positiveStyles, 'positive_styles', maxItems: 50);
    Validator::validateArray($this->negativeStyles, 'negative_styles', maxItems: 50);
    $this->conditioningRef?->validate();
  }
}
