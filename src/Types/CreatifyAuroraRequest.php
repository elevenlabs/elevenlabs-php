<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Request body for the Creatify Aurora lipsync video model.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CreatifyAuroraRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Include to send the generation's result to the workspace's configured flows webhooks once it completes or fails. The webhook payload matches the terminal response of the corresponding GET endpoint.
   */
  #[JsonProperty('webhook')]
  public ?\ElevenLabs\Types\WebhookTarget $webhook;

  /**
   * @var value-of<\ElevenLabs\Types\CreatifyAuroraRequestModelId>
   * The model to use for the generation.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  #[JsonProperty('image', required: true)]
  public \ElevenLabs\Types\ImageReference $image;

  #[JsonProperty('audio', required: true)]
  public \ElevenLabs\Types\AudioReference $audio;

  /**
   * @var ?value-of<\ElevenLabs\Types\CreatifyAuroraRequestResolution>
   * The resolution of the output video.
   */
  #[JsonProperty('resolution')]
  public ?string $resolution;

  /**
   * How strongly the generation adheres to the input image. Omit to use the model's default.
   */
  #[JsonProperty('guidance_scale')]
  public ?float $guidanceScale;

  /**
   * How strongly the lip movements adhere to the audio. Omit to use the model's default.
   */
  #[JsonProperty('audio_guidance_scale')]
  public ?float $audioGuidanceScale;

  /**
   * @param array{
   *   modelId: value-of<\ElevenLabs\Types\CreatifyAuroraRequestModelId>,
   *   image: \ElevenLabs\Types\ImageReference,
   *   audio: \ElevenLabs\Types\AudioReference,
   *   webhook?: ?\ElevenLabs\Types\WebhookTarget,
   *   resolution?: ?value-of<\ElevenLabs\Types\CreatifyAuroraRequestResolution>,
   *   guidanceScale?: ?float,
   *   audioGuidanceScale?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->webhook = $values['webhook'] ?? null;
    $this->modelId = $values['modelId'];
    $this->image = $values['image'];
    $this->audio = $values['audio'];
    $this->resolution = $values['resolution'] ?? null;
    $this->guidanceScale = $values['guidanceScale'] ?? null;
    $this->audioGuidanceScale = $values['audioGuidanceScale'] ?? null;

    $this->_dirtyFields = [
      'model_id' => true,
      'image' => true,
      'audio' => true
    ];
    if (array_key_exists('webhook', $values)) {
      $this->_dirtyFields['webhook'] = true;
    }
    if (array_key_exists('resolution', $values)) {
      $this->_dirtyFields['resolution'] = true;
    }
    if (array_key_exists('guidanceScale', $values)) {
      $this->_dirtyFields['guidance_scale'] = true;
    }
    if (array_key_exists('audioGuidanceScale', $values)) {
      $this->_dirtyFields['audio_guidance_scale'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->webhook !== null) {
      $parts[] = [
        'name' => 'webhook',
        'contents' => json_encode($this->webhook),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'model_id',
      'contents' => $this->modelId
    ];

    $parts[] = [
      'name' => 'image',
      'contents' => json_encode($this->image),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'audio',
      'contents' => json_encode($this->audio),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->resolution !== null) {
      $parts[] = [
        'name' => 'resolution',
        'contents' => $this->resolution
      ];
    }

    if ($this->guidanceScale !== null) {
      $parts[] = [
        'name' => 'guidance_scale',
        'contents' => (string) $this->guidanceScale
      ];
    }

    if ($this->audioGuidanceScale !== null) {
      $parts[] = [
        'name' => 'audio_guidance_scale',
        'contents' => (string) $this->audioGuidanceScale
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->guidanceScale, 'guidance_scale', min: 0, max: 5);
    Validator::validateNumber($this->audioGuidanceScale, 'audio_guidance_scale', min: 0, max: 5);
  }
}
