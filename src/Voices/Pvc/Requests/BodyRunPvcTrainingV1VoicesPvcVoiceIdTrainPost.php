<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Pvc\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyRunPvcTrainingV1VoicesPvcVoiceIdTrainPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The model ID to use for the conversion.
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * @param array{
   *   modelId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->modelId = $values['modelId'] ?? null;

    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
