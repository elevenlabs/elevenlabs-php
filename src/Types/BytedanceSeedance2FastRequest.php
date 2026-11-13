<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Request body for the ByteDance Seedance 2.0 Fast video model.
 *
 * ByteDance models are disabled by default and require explicit approval
 * before use. Contact support to request access.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BytedanceSeedance2FastRequest extends JsonSerializableType
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
   * @var ?value-of<\ElevenLabs\Types\BytedanceSeedance2FastRequestAspectRatio>
   * The aspect ratio of the output video. With `auto`, the model picks an aspect ratio based on the inputs.
   */
  #[JsonProperty('aspect_ratio')]
  public ?string $aspectRatio;

  /**
   * The duration of the output video in seconds.
   */
  #[JsonProperty('duration_secs')]
  public ?int $durationSecs;

  /**
   * A seed for reproducible generation: the same seed and inputs give similar output across generations. Omit for random.
   */
  #[JsonProperty('seed')]
  public ?int $seed;

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
   * @var \ElevenLabs\Types\ImageReference[]|null
   * Up to 9 reference images to draw subjects from. Cannot be combined with `start_frame`/`end_frame`.
   */
  #[JsonProperty('images'), ArrayType([\ElevenLabs\Types\ImageReference::class])]
  public ?array $images;

  /**
   * @var \ElevenLabs\Types\VideoReference[]|null
   * Up to 3 reference videos to draw subjects or motion from. Cannot be combined with `start_frame`/`end_frame`.
   */
  #[JsonProperty('videos'), ArrayType([\ElevenLabs\Types\VideoReference::class])]
  public ?array $videos;

  /**
   * @var \ElevenLabs\Types\AudioReference[]|null
   * Up to 3 reference audios, e.g. for lipsync. Requires at least one of `images` or `videos`, and cannot be combined with `start_frame`/`end_frame`.
   */
  #[JsonProperty('audios'), ArrayType([\ElevenLabs\Types\AudioReference::class])]
  public ?array $audios;

  /**
   * @var value-of<\ElevenLabs\Types\BytedanceSeedance2FastRequestModelId>
   * The model to use for the generation.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  /**
   * @var ?value-of<\ElevenLabs\Types\BytedanceSeedance2FastRequestResolution>
   * The resolution of the output video.
   */
  #[JsonProperty('resolution')]
  public ?string $resolution;

  /**
   * @param array{
   *   prompt: string,
   *   modelId: value-of<\ElevenLabs\Types\BytedanceSeedance2FastRequestModelId>,
   *   webhook?: ?\ElevenLabs\Types\WebhookTarget,
   *   aspectRatio?: ?value-of<\ElevenLabs\Types\BytedanceSeedance2FastRequestAspectRatio>,
   *   durationSecs?: ?int,
   *   seed?: ?int,
   *   generateAudio?: ?bool,
   *   startFrame?: ?\ElevenLabs\Types\ImageReference,
   *   endFrame?: ?\ElevenLabs\Types\ImageReference,
   *   images?: \ElevenLabs\Types\ImageReference[]|null,
   *   videos?: \ElevenLabs\Types\VideoReference[]|null,
   *   audios?: \ElevenLabs\Types\AudioReference[]|null,
   *   resolution?: ?value-of<\ElevenLabs\Types\BytedanceSeedance2FastRequestResolution>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->webhook = $values['webhook'] ?? null;
    $this->prompt = $values['prompt'];
    $this->aspectRatio = $values['aspectRatio'] ?? null;
    $this->durationSecs = $values['durationSecs'] ?? null;
    $this->seed = $values['seed'] ?? null;
    $this->generateAudio = $values['generateAudio'] ?? null;
    $this->startFrame = $values['startFrame'] ?? null;
    $this->endFrame = $values['endFrame'] ?? null;
    $this->images = $values['images'] ?? null;
    $this->videos = $values['videos'] ?? null;
    $this->audios = $values['audios'] ?? null;
    $this->modelId = $values['modelId'];
    $this->resolution = $values['resolution'] ?? null;

    $this->_dirtyFields = [
      'prompt' => true,
      'model_id' => true
    ];
    if (array_key_exists('webhook', $values)) {
      $this->_dirtyFields['webhook'] = true;
    }
    if (array_key_exists('aspectRatio', $values)) {
      $this->_dirtyFields['aspect_ratio'] = true;
    }
    if (array_key_exists('durationSecs', $values)) {
      $this->_dirtyFields['duration_secs'] = true;
    }
    if (array_key_exists('seed', $values)) {
      $this->_dirtyFields['seed'] = true;
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
    if (array_key_exists('videos', $values)) {
      $this->_dirtyFields['videos'] = true;
    }
    if (array_key_exists('audios', $values)) {
      $this->_dirtyFields['audios'] = true;
    }
    if (array_key_exists('resolution', $values)) {
      $this->_dirtyFields['resolution'] = true;
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

    if ($this->aspectRatio !== null) {
      $parts[] = [
        'name' => 'aspect_ratio',
        'contents' => $this->aspectRatio
      ];
    }

    if ($this->durationSecs !== null) {
      $parts[] = [
        'name' => 'duration_secs',
        'contents' => (string) $this->durationSecs
      ];
    }

    if ($this->seed !== null) {
      $parts[] = [
        'name' => 'seed',
        'contents' => (string) $this->seed
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

    if ($this->videos !== null) {
      $parts[] = [
        'name' => 'videos',
        'contents' => json_encode($this->videos),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->audios !== null) {
      $parts[] = [
        'name' => 'audios',
        'contents' => json_encode($this->audios),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'model_id',
      'contents' => $this->modelId
    ];

    if ($this->resolution !== null) {
      $parts[] = [
        'name' => 'resolution',
        'contents' => $this->resolution
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->durationSecs, 'duration_secs', min: 4, max: 15);
    Validator::validateArray($this->images, 'images', maxItems: 9);
    Validator::validateArray($this->videos, 'videos', maxItems: 3);
    Validator::validateArray($this->audios, 'audios', maxItems: 3);
  }
}
