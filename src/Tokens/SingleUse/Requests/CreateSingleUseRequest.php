<?php

declare(strict_types=1);

namespace ElevenLabs\Tokens\SingleUse\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class CreateSingleUseRequest extends JsonSerializableType
{
  /**
   * @var ?int $maxSessionDurationSeconds Closes the realtime transcription session opened with this token after this many seconds. Only for realtime_scribe tokens.
   */
  public ?int $maxSessionDurationSeconds;

  /**
   * @param array{
   *   maxSessionDurationSeconds?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->maxSessionDurationSeconds = $values['maxSessionDurationSeconds'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'maxSessionDurationSeconds' => $data['max_session_duration_seconds'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->maxSessionDurationSeconds !== null) {
      $result['max_session_duration_seconds'] = $this->maxSessionDurationSeconds;
    }
    return $result;
  }
}
