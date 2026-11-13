<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Request body for the OpenAI GPT Image 2 model.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class GptImage2Request extends JsonSerializableType
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
   * An image whose fully transparent areas mark where the first reference image may be edited; requires `images`.
   */
  #[JsonProperty('mask')]
  public ?\ElevenLabs\Types\ImageReference $mask;

  /**
   * @var ?value-of<\ElevenLabs\Types\GptImage2RequestQuality>
   * The quality of the output image.
   */
  #[JsonProperty('quality')]
  public ?string $quality;

  /**
   * @var value-of<\ElevenLabs\Types\GptImage2RequestModelId>
   * The model to use for the generation.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  /**
   * @var ?value-of<\ElevenLabs\Types\GptImage2RequestAspectRatio>
   * The aspect ratio of the output image. With `auto`, the model picks an aspect ratio based on the inputs.
   */
  #[JsonProperty('aspect_ratio')]
  public ?string $aspectRatio;

  /**
   * @var ?value-of<\ElevenLabs\Types\GptImage2RequestResolution>
   * The resolution of the output image.
   */
  #[JsonProperty('resolution')]
  public ?string $resolution;

  /**
   * @param array{
   *   prompt: string,
   *   modelId: value-of<\ElevenLabs\Types\GptImage2RequestModelId>,
   *   webhook?: ?\ElevenLabs\Types\WebhookTarget,
   *   images?: \ElevenLabs\Types\ImageReference[]|null,
   *   mask?: ?\ElevenLabs\Types\ImageReference,
   *   quality?: ?value-of<\ElevenLabs\Types\GptImage2RequestQuality>,
   *   aspectRatio?: ?value-of<\ElevenLabs\Types\GptImage2RequestAspectRatio>,
   *   resolution?: ?value-of<\ElevenLabs\Types\GptImage2RequestResolution>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->webhook = $values['webhook'] ?? null;
    $this->prompt = $values['prompt'];
    $this->images = $values['images'] ?? null;
    $this->mask = $values['mask'] ?? null;
    $this->quality = $values['quality'] ?? null;
    $this->modelId = $values['modelId'];
    $this->aspectRatio = $values['aspectRatio'] ?? null;
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
    if (array_key_exists('mask', $values)) {
      $this->_dirtyFields['mask'] = true;
    }
    if (array_key_exists('quality', $values)) {
      $this->_dirtyFields['quality'] = true;
    }
    if (array_key_exists('aspectRatio', $values)) {
      $this->_dirtyFields['aspect_ratio'] = true;
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

    if ($this->mask !== null) {
      $parts[] = [
        'name' => 'mask',
        'contents' => json_encode($this->mask),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->quality !== null) {
      $parts[] = [
        'name' => 'quality',
        'contents' => $this->quality
      ];
    }

    $parts[] = [
      'name' => 'model_id',
      'contents' => $this->modelId
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

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->images, 'images', maxItems: 10);
  }
}
