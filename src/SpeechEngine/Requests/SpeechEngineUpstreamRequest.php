<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechEngine\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class SpeechEngineUpstreamRequest extends JsonSerializableType
{
  /**
   * @var string $elevenLabsSpeechEngineAuthorization
   */
  public string $elevenLabsSpeechEngineAuthorization;

  /**
   * @param array{
   *   elevenLabsSpeechEngineAuthorization: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->elevenLabsSpeechEngineAuthorization = $values['elevenLabsSpeechEngineAuthorization'];
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'elevenLabsSpeechEngineAuthorization' => $data['X-ElevenLabs-Speech-Engine-Authorization']
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    $result['X-ElevenLabs-Speech-Engine-Authorization'] =
      $this->elevenLabsSpeechEngineAuthorization;
    return $result;
  }
}
