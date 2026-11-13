<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Request body for the ByteDance Seedance 2.5 video model.
 *
 * Diverges from the Seedance 2.0 public shape: no 4K, durations up to 30s,
 * larger reference caps, audio-only input allowed, and no ``seed`` (Ark
 * tolerates it but does not honour it).
 *
 * ByteDance models are disabled by default and require explicit approval
 * before use. Contact support to request access.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BytedanceSeedance25Request extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Include to send the generation's result to the workspace's configured flows webhooks once it completes or fails. The webhook payload matches the terminal response of the corresponding GET endpoint.
   */
  #[JsonProperty('webhook')]
  public ?\ElevenLabs\Types\WebhookTarget $webhook;

  /**
   * @var value-of<\ElevenLabs\Types\BytedanceSeedance25RequestModelId>
   * The model to use for the generation.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  /**
   * A text description of the video to generate.
   */
  #[JsonProperty('prompt', required: true)]
  public string $prompt;

  /**
   * @var ?value-of<\ElevenLabs\Types\BytedanceSeedance25RequestAspectRatio>
   * The aspect ratio of the output video. With `auto`, the model picks an aspect ratio based on the inputs. First-frame / first-and-last-frame tasks always use `auto`.
   */
  #[JsonProperty('aspect_ratio')]
  public ?string $aspectRatio;

  /**
   * @var ?value-of<\ElevenLabs\Types\BytedanceSeedance25RequestResolution>
   * The resolution of the output video.
   */
  #[JsonProperty('resolution')]
  public ?string $resolution;

  /**
   * The duration of the output video in seconds.
   */
  #[JsonProperty('duration_secs')]
  public ?int $durationSecs;

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
   * Up to 30 reference images to draw subjects from. Cannot be combined with `start_frame`/`end_frame`.
   */
  #[JsonProperty('images'), ArrayType([\ElevenLabs\Types\ImageReference::class])]
  public ?array $images;

  /**
   * @var \ElevenLabs\Types\VideoReference[]|null
   * Up to 10 reference videos to draw subjects or motion from. Cannot be combined with `start_frame`/`end_frame`.
   */
  #[JsonProperty('videos'), ArrayType([\ElevenLabs\Types\VideoReference::class])]
  public ?array $videos;

  /**
   * @var \ElevenLabs\Types\AudioReference[]|null
   * Up to 10 reference audios, e.g. for lipsync. Cannot be combined with `start_frame`/`end_frame`.
   */
  #[JsonProperty('audios'), ArrayType([\ElevenLabs\Types\AudioReference::class])]
  public ?array $audios;

  /**
   * @param array{
   *   modelId: value-of<\ElevenLabs\Types\BytedanceSeedance25RequestModelId>,
   *   prompt: string,
   *   webhook?: ?\ElevenLabs\Types\WebhookTarget,
   *   aspectRatio?: ?value-of<\ElevenLabs\Types\BytedanceSeedance25RequestAspectRatio>,
   *   resolution?: ?value-of<\ElevenLabs\Types\BytedanceSeedance25RequestResolution>,
   *   durationSecs?: ?int,
   *   generateAudio?: ?bool,
   *   startFrame?: ?\ElevenLabs\Types\ImageReference,
   *   endFrame?: ?\ElevenLabs\Types\ImageReference,
   *   images?: \ElevenLabs\Types\ImageReference[]|null,
   *   videos?: \ElevenLabs\Types\VideoReference[]|null,
   *   audios?: \ElevenLabs\Types\AudioReference[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->webhook = $values['webhook'] ?? null;
    $this->modelId = $values['modelId'];
    $this->prompt = $values['prompt'];
    $this->aspectRatio = $values['aspectRatio'] ?? null;
    $this->resolution = $values['resolution'] ?? null;
    $this->durationSecs = $values['durationSecs'] ?? null;
    $this->generateAudio = $values['generateAudio'] ?? null;
    $this->startFrame = $values['startFrame'] ?? null;
    $this->endFrame = $values['endFrame'] ?? null;
    $this->images = $values['images'] ?? null;
    $this->videos = $values['videos'] ?? null;
    $this->audios = $values['audios'] ?? null;

    $this->_dirtyFields = [
      'model_id' => true,
      'prompt' => true
    ];
    if (array_key_exists('webhook', $values)) {
      $this->_dirtyFields['webhook'] = true;
    }
    if (array_key_exists('aspectRatio', $values)) {
      $this->_dirtyFields['aspect_ratio'] = true;
    }
    if (array_key_exists('resolution', $values)) {
      $this->_dirtyFields['resolution'] = true;
    }
    if (array_key_exists('durationSecs', $values)) {
      $this->_dirtyFields['duration_secs'] = true;
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
      'name' => 'prompt',
      'contents' => $this->prompt
    ];

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

    if ($this->durationSecs !== null) {
      $parts[] = [
        'name' => 'duration_secs',
        'contents' => (string) $this->durationSecs
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

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->durationSecs, 'duration_secs', min: 4, max: 30);
    Validator::validateArray($this->images, 'images', maxItems: 30);
    Validator::validateArray($this->videos, 'videos', maxItems: 10);
    Validator::validateArray($this->audios, 'audios', maxItems: 10);
  }
}
