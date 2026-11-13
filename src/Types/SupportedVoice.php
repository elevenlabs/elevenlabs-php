<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SupportedVoice extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('label', required: true)]
  public string $label;

  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  #[JsonProperty('description')]
  public ?string $description;

  #[JsonProperty('language')]
  public ?string $language;

  /**
   * @var ?value-of<\ElevenLabs\Types\TtsModelFamily>
   */
  #[JsonProperty('model_family')]
  public ?string $modelFamily;

  /**
   * @var ?value-of<\ElevenLabs\Types\TtsOptimizeStreamingLatency>
   */
  #[JsonProperty('optimize_streaming_latency')]
  public ?int $optimizeStreamingLatency;

  #[JsonProperty('stability')]
  public ?float $stability;

  #[JsonProperty('speed')]
  public ?float $speed;

  #[JsonProperty('similarity_boost')]
  public ?float $similarityBoost;

  #[JsonProperty('clone_strength')]
  public ?float $cloneStrength;

  /**
   * @param array{
   *   label: string,
   *   voiceId: string,
   *   description?: ?string,
   *   language?: ?string,
   *   modelFamily?: ?value-of<\ElevenLabs\Types\TtsModelFamily>,
   *   optimizeStreamingLatency?: ?value-of<\ElevenLabs\Types\TtsOptimizeStreamingLatency>,
   *   stability?: ?float,
   *   speed?: ?float,
   *   similarityBoost?: ?float,
   *   cloneStrength?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->label = $values['label'];
    $this->voiceId = $values['voiceId'];
    $this->description = $values['description'] ?? null;
    $this->language = $values['language'] ?? null;
    $this->modelFamily = $values['modelFamily'] ?? null;
    $this->optimizeStreamingLatency = $values['optimizeStreamingLatency'] ?? null;
    $this->stability = $values['stability'] ?? null;
    $this->speed = $values['speed'] ?? null;
    $this->similarityBoost = $values['similarityBoost'] ?? null;
    $this->cloneStrength = $values['cloneStrength'] ?? null;

    $this->_dirtyFields = [
      'label' => true,
      'voice_id' => true
    ];
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
    if (array_key_exists('modelFamily', $values)) {
      $this->_dirtyFields['model_family'] = true;
    }
    if (array_key_exists('optimizeStreamingLatency', $values)) {
      $this->_dirtyFields['optimize_streaming_latency'] = true;
    }
    if (array_key_exists('stability', $values)) {
      $this->_dirtyFields['stability'] = true;
    }
    if (array_key_exists('speed', $values)) {
      $this->_dirtyFields['speed'] = true;
    }
    if (array_key_exists('similarityBoost', $values)) {
      $this->_dirtyFields['similarity_boost'] = true;
    }
    if (array_key_exists('cloneStrength', $values)) {
      $this->_dirtyFields['clone_strength'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language
      ];
    }

    if ($this->modelFamily !== null) {
      $parts[] = [
        'name' => 'model_family',
        'contents' => $this->modelFamily
      ];
    }

    if ($this->optimizeStreamingLatency !== null) {
      $parts[] = [
        'name' => 'optimize_streaming_latency',
        'contents' => (string) $this->optimizeStreamingLatency
      ];
    }

    if ($this->stability !== null) {
      $parts[] = [
        'name' => 'stability',
        'contents' => (string) $this->stability
      ];
    }

    if ($this->speed !== null) {
      $parts[] = [
        'name' => 'speed',
        'contents' => (string) $this->speed
      ];
    }

    if ($this->similarityBoost !== null) {
      $parts[] = [
        'name' => 'similarity_boost',
        'contents' => (string) $this->similarityBoost
      ];
    }

    if ($this->cloneStrength !== null) {
      $parts[] = [
        'name' => 'clone_strength',
        'contents' => (string) $this->cloneStrength
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->label, 'label', minLength: 1);
    Validator::validateString($this->voiceId, 'voice_id', minLength: 1);
    Validator::validateNumber($this->stability, 'stability', min: 0, max: 1);
    Validator::validateNumber($this->speed, 'speed', min: 0.7, max: 1.2);
    Validator::validateNumber($this->similarityBoost, 'similarity_boost', min: 0, max: 1);
    Validator::validateNumber($this->cloneStrength, 'clone_strength', min: 0, max: 1);
  }
}
