<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class GenerationSourceContext extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\GenerationSourceContextSourceType>
   */
  #[JsonProperty('source_type')]
  public ?string $sourceType;

  #[JsonProperty('generation_id', required: true)]
  public string $generationId;

  #[JsonProperty('prompt')]
  public ?string $prompt;

  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  #[JsonProperty('model_provider')]
  public ?string $modelProvider;

  #[JsonProperty('generation_session_id')]
  public ?string $generationSessionId;

  #[JsonProperty('session_iteration_id')]
  public ?string $sessionIterationId;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('model_parameters'), ArrayType(['string' => 'mixed'])]
  public ?array $modelParameters;

  #[JsonProperty('extend_video')]
  public ?\ElevenLabs\Types\ReferenceVideo $extendVideo;

  /**
   * @param array{
   *   generationId: string,
   *   modelId: string,
   *   sourceType?: ?value-of<\ElevenLabs\Types\GenerationSourceContextSourceType>,
   *   prompt?: ?string,
   *   modelProvider?: ?string,
   *   generationSessionId?: ?string,
   *   sessionIterationId?: ?string,
   *   modelParameters?: array<string, mixed>|null,
   *   extendVideo?: ?\ElevenLabs\Types\ReferenceVideo,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->sourceType = $values['sourceType'] ?? 'generation';
    $this->generationId = $values['generationId'];
    $this->prompt = $values['prompt'] ?? null;
    $this->modelId = $values['modelId'];
    $this->modelProvider = $values['modelProvider'] ?? null;
    $this->generationSessionId = $values['generationSessionId'] ?? null;
    $this->sessionIterationId = $values['sessionIterationId'] ?? null;
    $this->modelParameters = $values['modelParameters'] ?? null;
    $this->extendVideo = $values['extendVideo'] ?? null;

    $this->_dirtyFields = [
      'generation_id' => true,
      'model_id' => true
    ];
    if (array_key_exists('sourceType', $values)) {
      $this->_dirtyFields['source_type'] = true;
    }
    if (array_key_exists('prompt', $values)) {
      $this->_dirtyFields['prompt'] = true;
    }
    if (array_key_exists('modelProvider', $values)) {
      $this->_dirtyFields['model_provider'] = true;
    }
    if (array_key_exists('generationSessionId', $values)) {
      $this->_dirtyFields['generation_session_id'] = true;
    }
    if (array_key_exists('sessionIterationId', $values)) {
      $this->_dirtyFields['session_iteration_id'] = true;
    }
    if (array_key_exists('modelParameters', $values)) {
      $this->_dirtyFields['model_parameters'] = true;
    }
    if (array_key_exists('extendVideo', $values)) {
      $this->_dirtyFields['extend_video'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->sourceType !== null) {
      $parts[] = [
        'name' => 'source_type',
        'contents' => $this->sourceType
      ];
    }

    $parts[] = [
      'name' => 'generation_id',
      'contents' => $this->generationId
    ];

    if ($this->prompt !== null) {
      $parts[] = [
        'name' => 'prompt',
        'contents' => $this->prompt
      ];
    }

    $parts[] = [
      'name' => 'model_id',
      'contents' => $this->modelId
    ];

    if ($this->modelProvider !== null) {
      $parts[] = [
        'name' => 'model_provider',
        'contents' => $this->modelProvider
      ];
    }

    if ($this->generationSessionId !== null) {
      $parts[] = [
        'name' => 'generation_session_id',
        'contents' => $this->generationSessionId
      ];
    }

    if ($this->sessionIterationId !== null) {
      $parts[] = [
        'name' => 'session_iteration_id',
        'contents' => $this->sessionIterationId
      ];
    }

    if ($this->modelParameters !== null) {
      $parts[] = [
        'name' => 'model_parameters',
        'contents' => json_encode($this->modelParameters),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->extendVideo !== null) {
      $parts[] = [
        'name' => 'extend_video',
        'contents' => json_encode($this->extendVideo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->extendVideo?->validate();
  }
}
