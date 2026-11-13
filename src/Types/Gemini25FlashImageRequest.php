<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Request body for the Google Gemini 2.5 Flash image model.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class Gemini25FlashImageRequest extends JsonSerializableType
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
   * @var value-of<\ElevenLabs\Types\Gemini25FlashImageRequestModelId>
   * The model to use for the generation.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  /**
   * @var \ElevenLabs\Types\ImageReference[]|null
   * Up to 5 reference images to edit or draw from.
   */
  #[JsonProperty('images'), ArrayType([\ElevenLabs\Types\ImageReference::class])]
  public ?array $images;

  /**
   * @var ?value-of<\ElevenLabs\Types\Gemini25FlashImageRequestAspectRatio>
   * The aspect ratio of the output image. With `auto`, the model picks an aspect ratio based on the inputs.
   */
  #[JsonProperty('aspect_ratio')]
  public ?string $aspectRatio;

  /**
   * @param array{
   *   prompt: string,
   *   modelId: value-of<\ElevenLabs\Types\Gemini25FlashImageRequestModelId>,
   *   webhook?: ?\ElevenLabs\Types\WebhookTarget,
   *   images?: \ElevenLabs\Types\ImageReference[]|null,
   *   aspectRatio?: ?value-of<\ElevenLabs\Types\Gemini25FlashImageRequestAspectRatio>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->webhook = $values['webhook'] ?? null;
    $this->prompt = $values['prompt'];
    $this->modelId = $values['modelId'];
    $this->images = $values['images'] ?? null;
    $this->aspectRatio = $values['aspectRatio'] ?? null;

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

    $parts[] = [
      'name' => 'model_id',
      'contents' => $this->modelId
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

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->images, 'images', maxItems: 5);
  }
}
