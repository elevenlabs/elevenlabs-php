<?php

declare(strict_types=1);

namespace ElevenLabs\TextToSpeech\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\TextToSpeechRealtimeApplyTextNormalization;

class V1TextToSpeechVoiceIdStreamInputRequest extends JsonSerializableType
{
  /**
   * @var ?string $authorization
   */
  public ?string $authorization;

  /**
   * @var ?string $singleUseToken
   */
  public ?string $singleUseToken;

  /**
   * @var ?string $modelId
   */
  public ?string $modelId;

  /**
   * @var ?string $languageCode
   */
  public ?string $languageCode;

  /**
   * @var ?bool $enableLogging
   */
  public ?bool $enableLogging;

  /**
   * @var ?string $outputFormat
   */
  public ?string $outputFormat;

  /**
   * @var ?int $inactivityTimeout
   */
  public ?int $inactivityTimeout;

  /**
   * @var ?bool $syncAlignment
   */
  public ?bool $syncAlignment;

  /**
   * @var ?bool $autoMode
   */
  public ?bool $autoMode;

  /**
   * @var ?value-of<TextToSpeechRealtimeApplyTextNormalization> $applyTextNormalization
   */
  public ?string $applyTextNormalization;

  /**
   * @var ?int $seed
   */
  public ?int $seed;

  /**
   * @var ?bool $enableSsmlParsing
   */
  public ?bool $enableSsmlParsing;

  /**
   * @param array{
   *   authorization?: ?string,
   *   singleUseToken?: ?string,
   *   modelId?: ?string,
   *   languageCode?: ?string,
   *   enableLogging?: ?bool,
   *   outputFormat?: ?string,
   *   inactivityTimeout?: ?int,
   *   syncAlignment?: ?bool,
   *   autoMode?: ?bool,
   *   applyTextNormalization?: ?value-of<TextToSpeechRealtimeApplyTextNormalization>,
   *   seed?: ?int,
   *   enableSsmlParsing?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->authorization = $values['authorization'] ?? null;
    $this->singleUseToken = $values['singleUseToken'] ?? null;
    $this->modelId = $values['modelId'] ?? null;
    $this->languageCode = $values['languageCode'] ?? null;
    $this->enableLogging = $values['enableLogging'] ?? null;
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->inactivityTimeout = $values['inactivityTimeout'] ?? null;
    $this->syncAlignment = $values['syncAlignment'] ?? null;
    $this->autoMode = $values['autoMode'] ?? null;
    $this->applyTextNormalization = $values['applyTextNormalization'] ?? null;
    $this->seed = $values['seed'] ?? null;
    $this->enableSsmlParsing = $values['enableSsmlParsing'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'authorization' => $data['authorization'] ?? null,
      'singleUseToken' => $data['single_use_token'] ?? null,
      'modelId' => $data['model_id'] ?? null,
      'languageCode' => $data['language_code'] ?? null,
      'enableLogging' => $data['enable_logging'] ?? null,
      'outputFormat' => $data['output_format'] ?? null,
      'inactivityTimeout' => $data['inactivity_timeout'] ?? null,
      'syncAlignment' => $data['sync_alignment'] ?? null,
      'autoMode' => $data['auto_mode'] ?? null,
      'applyTextNormalization' => $data['apply_text_normalization'] ?? null,
      'seed' => $data['seed'] ?? null,
      'enableSsmlParsing' => $data['enable_ssml_parsing'] ?? null
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
    if ($this->singleUseToken !== null) {
      $result['single_use_token'] = $this->singleUseToken;
    }
    if ($this->modelId !== null) {
      $result['model_id'] = $this->modelId;
    }
    if ($this->languageCode !== null) {
      $result['language_code'] = $this->languageCode;
    }
    if ($this->enableLogging !== null) {
      $result['enable_logging'] = $this->enableLogging;
    }
    if ($this->outputFormat !== null) {
      $result['output_format'] = $this->outputFormat;
    }
    if ($this->inactivityTimeout !== null) {
      $result['inactivity_timeout'] = $this->inactivityTimeout;
    }
    if ($this->syncAlignment !== null) {
      $result['sync_alignment'] = $this->syncAlignment;
    }
    if ($this->autoMode !== null) {
      $result['auto_mode'] = $this->autoMode;
    }
    if ($this->applyTextNormalization !== null) {
      $result['apply_text_normalization'] = $this->applyTextNormalization;
    }
    if ($this->seed !== null) {
      $result['seed'] = $this->seed;
    }
    if ($this->enableSsmlParsing !== null) {
      $result['enable_ssml_parsing'] = $this->enableSsmlParsing;
    }
    return $result;
  }
}
