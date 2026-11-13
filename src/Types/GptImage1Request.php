<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Request body for the OpenAI GPT Image 1 model.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class GptImage1Request extends JsonSerializableType
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
   * Up to 5 reference images to edit or draw from.
   */
  #[JsonProperty('images'), ArrayType([\ElevenLabs\Types\ImageReference::class])]
  public ?array $images;

  /**
   * An image whose fully transparent areas mark where the first reference image may be edited; requires `images`.
   */
  #[JsonProperty('mask')]
  public ?\ElevenLabs\Types\ImageReference $mask;

  /**
   * @var ?value-of<\ElevenLabs\Types\GptImage1RequestQuality>
   * The quality of the output image.
   */
  #[JsonProperty('quality')]
  public ?string $quality;

  /**
   * @var ?value-of<\ElevenLabs\Types\GptImage1RequestBackground>
   * The background of the output image. With `auto`, the model picks the background that suits the image.
   */
  #[JsonProperty('background')]
  public ?string $background;

  /**
   * @var ?value-of<\ElevenLabs\Types\GptImage1RequestAspectRatio>
   * The aspect ratio of the output image.
   */
  #[JsonProperty('aspect_ratio')]
  public ?string $aspectRatio;

  /**
   * @var value-of<\ElevenLabs\Types\GptImage1RequestModelId>
   * The model to use for the generation.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  /**
   * @param array{
   *   prompt: string,
   *   modelId: value-of<\ElevenLabs\Types\GptImage1RequestModelId>,
   *   webhook?: ?\ElevenLabs\Types\WebhookTarget,
   *   images?: \ElevenLabs\Types\ImageReference[]|null,
   *   mask?: ?\ElevenLabs\Types\ImageReference,
   *   quality?: ?value-of<\ElevenLabs\Types\GptImage1RequestQuality>,
   *   background?: ?value-of<\ElevenLabs\Types\GptImage1RequestBackground>,
   *   aspectRatio?: ?value-of<\ElevenLabs\Types\GptImage1RequestAspectRatio>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->webhook = $values['webhook'] ?? null;
    $this->prompt = $values['prompt'];
    $this->images = $values['images'] ?? null;
    $this->mask = $values['mask'] ?? null;
    $this->quality = $values['quality'] ?? null;
    $this->background = $values['background'] ?? null;
    $this->aspectRatio = $values['aspectRatio'] ?? null;
    $this->modelId = $values['modelId'];

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
    if (array_key_exists('background', $values)) {
      $this->_dirtyFields['background'] = true;
    }
    if (array_key_exists('aspectRatio', $values)) {
      $this->_dirtyFields['aspect_ratio'] = true;
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

    if ($this->background !== null) {
      $parts[] = [
        'name' => 'background',
        'contents' => $this->background
      ];
    }

    if ($this->aspectRatio !== null) {
      $parts[] = [
        'name' => 'aspect_ratio',
        'contents' => $this->aspectRatio
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
    Validator::validateArray($this->images, 'images', maxItems: 5);
  }
}
