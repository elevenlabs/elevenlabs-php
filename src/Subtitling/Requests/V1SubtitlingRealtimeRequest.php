<?php

declare(strict_types=1);

namespace ElevenLabs\Subtitling\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\SubtitlingRealtimeEagerness;
use ElevenLabs\Types\SubtitlingRealtimeInputFormat;

class V1SubtitlingRealtimeRequest extends JsonSerializableType
{
  /**
   * @var string $targetLanguage
   */
  public string $targetLanguage;

  /**
   * @var ?string $sourceLanguage
   */
  public ?string $sourceLanguage;

  /**
   * @var ?value-of<SubtitlingRealtimeInputFormat> $inputFormat
   */
  public ?string $inputFormat;

  /**
   * @var ?value-of<SubtitlingRealtimeEagerness> $eagerness
   */
  public ?string $eagerness;

  /**
   * @var ?string $clientSessionId
   */
  public ?string $clientSessionId;

  /**
   * @var ?bool $enableLogging
   */
  public ?bool $enableLogging;

  /**
   * @param array{
   *   targetLanguage: string,
   *   sourceLanguage?: ?string,
   *   inputFormat?: ?value-of<SubtitlingRealtimeInputFormat>,
   *   eagerness?: ?value-of<SubtitlingRealtimeEagerness>,
   *   clientSessionId?: ?string,
   *   enableLogging?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->targetLanguage = $values['targetLanguage'];
    $this->sourceLanguage = $values['sourceLanguage'] ?? null;
    $this->inputFormat = $values['inputFormat'] ?? null;
    $this->eagerness = $values['eagerness'] ?? null;
    $this->clientSessionId = $values['clientSessionId'] ?? null;
    $this->enableLogging = $values['enableLogging'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'targetLanguage' => $data['target_language'],
      'sourceLanguage' => $data['source_language'] ?? null,
      'inputFormat' => $data['input_format'] ?? null,
      'eagerness' => $data['eagerness'] ?? null,
      'clientSessionId' => $data['client_session_id'] ?? null,
      'enableLogging' => $data['enable_logging'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    $result['target_language'] = $this->targetLanguage;
    if ($this->sourceLanguage !== null) {
      $result['source_language'] = $this->sourceLanguage;
    }
    if ($this->inputFormat !== null) {
      $result['input_format'] = $this->inputFormat;
    }
    if ($this->eagerness !== null) {
      $result['eagerness'] = $this->eagerness;
    }
    if ($this->clientSessionId !== null) {
      $result['client_session_id'] = $this->clientSessionId;
    }
    if ($this->enableLogging !== null) {
      $result['enable_logging'] = $this->enableLogging;
    }
    return $result;
  }
}
