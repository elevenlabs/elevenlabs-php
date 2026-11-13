<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetVoicesRequest extends JsonSerializableType
{
  /**
   * @var ?bool $withSettings This parameter is now deprecated. It is ignored and will be removed in a future version.
   */
  public ?bool $withSettings;

  /**
   * @param array{
   *   withSettings?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->withSettings = $values['withSettings'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'withSettings' => $data['with_settings'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->withSettings !== null) {
      $result['with_settings'] = $this->withSettings;
    }
    return $result;
  }
}
