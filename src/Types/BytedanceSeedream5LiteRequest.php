<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Request body for the ByteDance Seedream 5.0 Lite image model.
 *
 * ByteDance models are disabled by default and require explicit approval
 * before use. Contact support to request access.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BytedanceSeedream5LiteRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Include to send the generation's result to the workspace's configured flows webhooks once it completes or fails. The webhook payload matches the terminal response of the corresponding GET endpoint.
   */
  #[JsonProperty('webhook')]
  public ?\ElevenLabs\Types\WebhookTarget $webhook;

  /**
   * A text description of the image to generate.
   */
  #[JsonProperty('prompt', required: true)]
  public string $prompt;

  /**
   * @var \ElevenLabs\Types\ImageReference[]|null
   * Up to 10 reference images to edit or draw from.
   */
  #[JsonProperty('images'), ArrayType([\ElevenLabs\Types\ImageReference::class])]
  public ?array $images;

  /**
   * @var ?value-of<\ElevenLabs\Types\BytedanceSeedream5LiteRequestAspectRatio>
   * The aspect ratio of the output image. With `auto`, the model picks an aspect ratio based on the inputs.
   */
  #[JsonProperty('aspect_ratio')]
  public ?string $aspectRatio;

  /**
   * A seed for reproducible generation: the same seed and inputs give similar output across generations. Omit for random.
   */
  #[JsonProperty('seed')]
  public ?int $seed;

  /**
   * @var value-of<\ElevenLabs\Types\BytedanceSeedream5LiteRequestModelId>
   * The model to use for the generation.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  /**
   * @var ?value-of<\ElevenLabs\Types\BytedanceSeedream5LiteRequestResolution>
   * The resolution of the output image.
   */
  #[JsonProperty('resolution')]
  public ?string $resolution;

  /**
   * @param array{
   *   prompt: string,
   *   modelId: value-of<\ElevenLabs\Types\BytedanceSeedream5LiteRequestModelId>,
   *   webhook?: ?\ElevenLabs\Types\WebhookTarget,
   *   images?: \ElevenLabs\Types\ImageReference[]|null,
   *   aspectRatio?: ?value-of<\ElevenLabs\Types\BytedanceSeedream5LiteRequestAspectRatio>,
   *   seed?: ?int,
   *   resolution?: ?value-of<\ElevenLabs\Types\BytedanceSeedream5LiteRequestResolution>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->webhook = $values['webhook'] ?? null;
    $this->prompt = $values['prompt'];
    $this->images = $values['images'] ?? null;
    $this->aspectRatio = $values['aspectRatio'] ?? null;
    $this->seed = $values['seed'] ?? null;
    $this->modelId = $values['modelId'];
    $this->resolution = $values['resolution'] ?? null;

    $this->_dirtyFields = [
      'prompt' => true,
      'model_id' => true
    ];
    if (array_key_exists('webhook', $values)) {
      $this->_dirtyFields['webhook'] = true;
    }
    if (array_key_exists('images', $values)) {
      $this->_dirtyFields['images'] = true;
    }
    if (array_key_exists('aspectRatio', $values)) {
      $this->_dirtyFields['aspect_ratio'] = true;
    }
    if (array_key_exists('seed', $values)) {
      $this->_dirtyFields['seed'] = true;
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

    if ($this->images !== null) {
      $parts[] = [
        'name' => 'images',
        'contents' => json_encode($this->images),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->aspectRatio !== null) {
      $parts[] = [
        'name' => 'aspect_ratio',
        'contents' => $this->aspectRatio
      ];
    }

    if ($this->seed !== null) {
      $parts[] = [
        'name' => 'seed',
        'contents' => (string) $this->seed
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
    Validator::validateArray($this->images, 'images', maxItems: 10);
  }
}
