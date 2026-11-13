<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Request body for the Google Veo 3.1 video model.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class Veo31Request extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Include to send the generation's result to the workspace's configured flows webhooks once it completes or fails. The webhook payload matches the terminal response of the corresponding GET endpoint.
   */
  #[JsonProperty('webhook')]
  public ?\ElevenLabs\Types\WebhookTarget $webhook;

  /**
   * A text description of the video to generate.
   */
  #[JsonProperty('prompt', required: true)]
  public string $prompt;

  /**
   * A text description of what the video should avoid.
   */
  #[JsonProperty('negative_prompt')]
  public ?string $negativePrompt;

  /**
   * A seed for reproducible generation: the same seed and inputs give similar output across generations. Omit for random.
   */
  #[JsonProperty('seed')]
  public ?int $seed;

  /**
   * Whether the model may rewrite the prompt to improve results.
   */
  #[JsonProperty('enhance_prompt')]
  public ?bool $enhancePrompt;

  /**
   * @var ?value-of<\ElevenLabs\Types\Veo31RequestDurationSecs>
   * The duration of the output video in seconds.
   */
  #[JsonProperty('duration_secs')]
  public ?int $durationSecs;

  /**
   * @var ?value-of<\ElevenLabs\Types\Veo31RequestAspectRatio>
   * The aspect ratio of the output video.
   */
  #[JsonProperty('aspect_ratio')]
  public ?string $aspectRatio;

  /**
   * @var ?value-of<\ElevenLabs\Types\Veo31RequestResolution>
   * The resolution of the output video.
   */
  #[JsonProperty('resolution')]
  public ?string $resolution;

  /**
   * Whether to generate audio with the video.
   */
  #[JsonProperty('generate_audio')]
  public ?bool $generateAudio;

  /**
   * The image to use as the video's first frame.
   */
  #[JsonProperty('start_frame')]
  public ?\ElevenLabs\Types\ImageReference $startFrame;

  /**
   * The image to use as the video's last frame.
   */
  #[JsonProperty('end_frame')]
  public ?\ElevenLabs\Types\ImageReference $endFrame;

  /**
   * @var \ElevenLabs\Types\VeoImageReference[]|null
   * Up to 3 reference images to draw subjects or style from. Cannot be combined with `start_frame`/`end_frame`, and requires the 8-second duration.
   */
  #[JsonProperty('images'), ArrayType([\ElevenLabs\Types\VeoImageReference::class])]
  public ?array $images;

  /**
   * @var value-of<\ElevenLabs\Types\Veo31RequestModelId>
   * The model to use for the generation.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  /**
   * @param array{
   *   prompt: string,
   *   modelId: value-of<\ElevenLabs\Types\Veo31RequestModelId>,
   *   webhook?: ?\ElevenLabs\Types\WebhookTarget,
   *   negativePrompt?: ?string,
   *   seed?: ?int,
   *   enhancePrompt?: ?bool,
   *   durationSecs?: ?value-of<\ElevenLabs\Types\Veo31RequestDurationSecs>,
   *   aspectRatio?: ?value-of<\ElevenLabs\Types\Veo31RequestAspectRatio>,
   *   resolution?: ?value-of<\ElevenLabs\Types\Veo31RequestResolution>,
   *   generateAudio?: ?bool,
   *   startFrame?: ?\ElevenLabs\Types\ImageReference,
   *   endFrame?: ?\ElevenLabs\Types\ImageReference,
   *   images?: \ElevenLabs\Types\VeoImageReference[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->webhook = $values['webhook'] ?? null;
    $this->prompt = $values['prompt'];
    $this->negativePrompt = $values['negativePrompt'] ?? null;
    $this->seed = $values['seed'] ?? null;
    $this->enhancePrompt = $values['enhancePrompt'] ?? null;
    $this->durationSecs = $values['durationSecs'] ?? null;
    $this->aspectRatio = $values['aspectRatio'] ?? null;
    $this->resolution = $values['resolution'] ?? null;
    $this->generateAudio = $values['generateAudio'] ?? null;
    $this->startFrame = $values['startFrame'] ?? null;
    $this->endFrame = $values['endFrame'] ?? null;
    $this->images = $values['images'] ?? null;
    $this->modelId = $values['modelId'];

    $this->_dirtyFields = [
      'prompt' => true,
      'model_id' => true
    ];
    if (array_key_exists('webhook', $values)) {
      $this->_dirtyFields['webhook'] = true;
    }
    if (array_key_exists('negativePrompt', $values)) {
      $this->_dirtyFields['negative_prompt'] = true;
    }
    if (array_key_exists('seed', $values)) {
      $this->_dirtyFields['seed'] = true;
    }
    if (array_key_exists('enhancePrompt', $values)) {
      $this->_dirtyFields['enhance_prompt'] = true;
    }
    if (array_key_exists('durationSecs', $values)) {
      $this->_dirtyFields['duration_secs'] = true;
    }
    if (array_key_exists('aspectRatio', $values)) {
      $this->_dirtyFields['aspect_ratio'] = true;
    }
    if (array_key_exists('resolution', $values)) {
      $this->_dirtyFields['resolution'] = true;
    }
    if (array_key_exists('generateAudio', $values)) {
      $this->_dirtyFields['generate_audio'] = true;
    }
    if (array_key_exists('startFrame', $values)) {
      $this->_dirtyFields['start_frame'] = true;
    }
    if (array_key_exists('endFrame', $values)) {
      $this->_dirtyFields['end_frame'] = true;
    }
    if (array_key_exists('images', $values)) {
      $this->_dirtyFields['images'] = true;
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
      'name' => 'prompt',
      'contents' => $this->prompt
    ];

    if ($this->negativePrompt !== null) {
      $parts[] = [
        'name' => 'negative_prompt',
        'contents' => $this->negativePrompt
      ];
    }

    if ($this->seed !== null) {
      $parts[] = [
        'name' => 'seed',
        'contents' => (string) $this->seed
      ];
    }

    if ($this->enhancePrompt !== null) {
      $parts[] = [
        'name' => 'enhance_prompt',
        'contents' => $this->enhancePrompt ? 'true' : 'false'
      ];
    }

    if ($this->durationSecs !== null) {
      $parts[] = [
        'name' => 'duration_secs',
        'contents' => (string) $this->durationSecs
      ];
    }

    if ($this->aspectRatio !== null) {
      $parts[] = [
        'name' => 'aspect_ratio',
        'contents' => $this->aspectRatio
      ];
    }

    if ($this->resolution !== null) {
      $parts[] = [
        'name' => 'resolution',
        'contents' => $this->resolution
      ];
    }

    if ($this->generateAudio !== null) {
      $parts[] = [
        'name' => 'generate_audio',
        'contents' => $this->generateAudio ? 'true' : 'false'
      ];
    }

    if ($this->startFrame !== null) {
      $parts[] = [
        'name' => 'start_frame',
        'contents' => json_encode($this->startFrame),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->endFrame !== null) {
      $parts[] = [
        'name' => 'end_frame',
        'contents' => json_encode($this->endFrame),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->images !== null) {
      $parts[] = [
        'name' => 'images',
        'contents' => json_encode($this->images),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'model_id',
      'contents' => $this->modelId
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->images ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->images, 'images', maxItems: 3);
  }
}
