<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Accents\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetAccentsRequest extends JsonSerializableType
{
  /**
   * @var ?string $language If provided, only accents for this language code are returned.
   */
  public ?string $language;

  /**
   * @var ?string $modelId If provided, returns the accents available for this model. Defaults to the most complete accent list when omitted.
   */
  public ?string $modelId;

  /**
   * @param array{
   *   language?: ?string,
   *   modelId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->language = $values['language'] ?? null;
    $this->modelId = $values['modelId'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'language' => $data['language'] ?? null,
      'modelId' => $data['model_id'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->language !== null) {
      $result['language'] = $this->language;
    }
    if ($this->modelId !== null) {
      $result['model_id'] = $this->modelId;
    }
    return $result;
  }
}
