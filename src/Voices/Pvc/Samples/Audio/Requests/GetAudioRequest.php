<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Pvc\Samples\Audio\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetAudioRequest extends JsonSerializableType
{
  /**
   * @var ?bool $removeBackgroundNoise If set will remove background noise for voice samples using our audio isolation model. If the samples do not include background noise, it can make the quality worse.
   */
  public ?bool $removeBackgroundNoise;

  /**
   * @param array{
   *   removeBackgroundNoise?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->removeBackgroundNoise = $values['removeBackgroundNoise'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'removeBackgroundNoise' => $data['remove_background_noise'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->removeBackgroundNoise !== null) {
      $result['remove_background_noise'] = $this->removeBackgroundNoise;
    }
    return $result;
  }
}
