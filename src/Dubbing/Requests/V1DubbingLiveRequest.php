<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\DubbingLiveInputFormat;
use ElevenLabs\Types\DubbingLiveInputNumChannels;
use ElevenLabs\Types\DubbingLiveMaxLagS;
use ElevenLabs\Types\DubbingLiveOutputFormat;

class V1DubbingLiveRequest extends JsonSerializableType
{
  /**
   * @var ?string $authorization
   */
  public ?string $authorization;

  /**
   * @var string $targetLanguage
   */
  public string $targetLanguage;

  /**
   * @var string $sourceLanguage
   */
  public string $sourceLanguage;

  /**
   * @var ?value-of<DubbingLiveMaxLagS> $maxLagS
   */
  public ?int $maxLagS;

  /**
   * @var ?int $cloningStrength
   */
  public ?int $cloningStrength;

  /**
   * @var ?value-of<DubbingLiveInputFormat> $inputFormat
   */
  public ?string $inputFormat;

  /**
   * @var ?value-of<DubbingLiveInputNumChannels> $inputNumChannels
   */
  public ?int $inputNumChannels;

  /**
   * @var ?value-of<DubbingLiveOutputFormat> $outputFormat
   */
  public ?string $outputFormat;

  /**
   * @var ?string $clientSessionId
   */
  public ?string $clientSessionId;

  /**
   * @param array{
   *   authorization?: ?string,
   *   targetLanguage: string,
   *   sourceLanguage: string,
   *   maxLagS?: ?value-of<DubbingLiveMaxLagS>,
   *   cloningStrength?: ?int,
   *   inputFormat?: ?value-of<DubbingLiveInputFormat>,
   *   inputNumChannels?: ?value-of<DubbingLiveInputNumChannels>,
   *   outputFormat?: ?value-of<DubbingLiveOutputFormat>,
   *   clientSessionId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->authorization = $values['authorization'] ?? null;
    $this->targetLanguage = $values['targetLanguage'];
    $this->sourceLanguage = $values['sourceLanguage'];
    $this->maxLagS = $values['maxLagS'] ?? null;
    $this->cloningStrength = $values['cloningStrength'] ?? null;
    $this->inputFormat = $values['inputFormat'] ?? null;
    $this->inputNumChannels = $values['inputNumChannels'] ?? null;
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->clientSessionId = $values['clientSessionId'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'authorization' => $data['authorization'] ?? null,
      'targetLanguage' => $data['target_language'],
      'sourceLanguage' => $data['source_language'],
      'maxLagS' => $data['max_lag_s'] ?? null,
      'cloningStrength' => $data['cloning_strength'] ?? null,
      'inputFormat' => $data['input_format'] ?? null,
      'inputNumChannels' => $data['input_num_channels'] ?? null,
      'outputFormat' => $data['output_format'] ?? null,
      'clientSessionId' => $data['client_session_id'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->authorization !== null) {
      $result['authorization'] = $this->authorization;
    }
    $result['target_language'] = $this->targetLanguage;
    $result['source_language'] = $this->sourceLanguage;
    if ($this->maxLagS !== null) {
      $result['max_lag_s'] = $this->maxLagS;
    }
    if ($this->cloningStrength !== null) {
      $result['cloning_strength'] = $this->cloningStrength;
    }
    if ($this->inputFormat !== null) {
      $result['input_format'] = $this->inputFormat;
    }
    if ($this->inputNumChannels !== null) {
      $result['input_num_channels'] = $this->inputNumChannels;
    }
    if ($this->outputFormat !== null) {
      $result['output_format'] = $this->outputFormat;
    }
    if ($this->clientSessionId !== null) {
      $result['client_session_id'] = $this->clientSessionId;
    }
    return $result;
  }
}
