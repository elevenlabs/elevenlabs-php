<?php

declare(strict_types=1);

namespace ElevenLabs\Music\CompositionPlan\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\Union;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyGenerateCompositionPlanV1MusicPlanPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * When enable_logging is set to false zero retention mode will be used for the request. Zero retention mode may only be used by enterprise customers.
   */
  public ?bool $enableLogging;

  /**
   * A simple text prompt to compose a plan from.
   */
  #[JsonProperty('prompt', required: true)]
  public string $prompt;

  /**
   * The length of the composition plan to generate in milliseconds. Must be between 3000ms and 600000ms. Optional - if not provided, the model will choose a length based on the prompt.
   */
  #[JsonProperty('music_length_ms')]
  public ?int $musicLengthMs;

  /**
   * An optional composition plan to use as a source for the new composition plan.
   */
  #[
    JsonProperty('source_composition_plan'),
    Union(\ElevenLabs\Types\MusicPrompt::class, \ElevenLabs\Types\CompositionPlan::class, 'null')
  ]
  public \ElevenLabs\Types\MusicPrompt|\ElevenLabs\Types\CompositionPlan|null $sourceCompositionPlan;

  /**
   * @var ?value-of<\ElevenLabs\Types\MusicModelId>
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * @param array{
   *   prompt: string,
   *   enableLogging?: ?bool,
   *   musicLengthMs?: ?int,
   *   sourceCompositionPlan?: \ElevenLabs\Types\MusicPrompt|\ElevenLabs\Types\CompositionPlan|null,
   *   modelId?: ?value-of<\ElevenLabs\Types\MusicModelId>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->enableLogging = $values['enableLogging'] ?? null;
    $this->prompt = $values['prompt'];
    $this->musicLengthMs = $values['musicLengthMs'] ?? null;
    $this->sourceCompositionPlan = $values['sourceCompositionPlan'] ?? null;
    $this->modelId = $values['modelId'] ?? null;

    $this->_dirtyFields = [
      'prompt' => true
    ];
    if (array_key_exists('musicLengthMs', $values)) {
      $this->_dirtyFields['music_length_ms'] = true;
    }
    if (array_key_exists('sourceCompositionPlan', $values)) {
      $this->_dirtyFields['source_composition_plan'] = true;
    }
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'prompt',
      'contents' => $this->prompt
    ];

    if ($this->musicLengthMs !== null) {
      $parts[] = [
        'name' => 'music_length_ms',
        'contents' => (string) $this->musicLengthMs
      ];
    }

    if ($this->sourceCompositionPlan !== null) {
      $parts[] = [
        'name' => 'source_composition_plan',
        'contents' => json_encode($this->sourceCompositionPlan),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->prompt, 'prompt', maxLength: 4100);
    Validator::validateNumber($this->musicLengthMs, 'music_length_ms', min: 3000, max: 600000);
  }
}
