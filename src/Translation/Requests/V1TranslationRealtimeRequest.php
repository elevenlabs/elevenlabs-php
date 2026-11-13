<?php

declare(strict_types=1);

namespace ElevenLabs\Translation\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\TranslationRealtimeApplyTextNormalization;
use ElevenLabs\Types\TranslationRealtimeEagerness;
use ElevenLabs\Types\TranslationRealtimeInputFormat;
use ElevenLabs\Types\TranslationRealtimeOutputFormat;
use ElevenLabs\Types\TranslationRealtimeTtsModelId;

class V1TranslationRealtimeRequest extends JsonSerializableType
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
   * @var ?string $sourceLanguage
   */
  public ?string $sourceLanguage;

  /**
   * @var string $voiceId
   */
  public string $voiceId;

  /**
   * @var ?value-of<TranslationRealtimeInputFormat> $inputFormat
   */
  public ?string $inputFormat;

  /**
   * @var ?value-of<TranslationRealtimeOutputFormat> $outputFormat
   */
  public ?string $outputFormat;

  /**
   * @var ?value-of<TranslationRealtimeTtsModelId> $ttsModelId
   */
  public ?string $ttsModelId;

  /**
   * @var ?value-of<TranslationRealtimeApplyTextNormalization> $applyTextNormalization
   */
  public ?string $applyTextNormalization;

  /**
   * @var ?value-of<TranslationRealtimeEagerness> $eagerness
   */
  public ?string $eagerness;

  /**
   * @var ?string $clientSessionId
   */
  public ?string $clientSessionId;

  /**
   * @var ?bool $enableZrm
   */
  public ?bool $enableZrm;

  /**
   * @param array{
   *   authorization?: ?string,
   *   targetLanguage: string,
   *   sourceLanguage?: ?string,
   *   voiceId: string,
   *   inputFormat?: ?value-of<TranslationRealtimeInputFormat>,
   *   outputFormat?: ?value-of<TranslationRealtimeOutputFormat>,
   *   ttsModelId?: ?value-of<TranslationRealtimeTtsModelId>,
   *   applyTextNormalization?: ?value-of<TranslationRealtimeApplyTextNormalization>,
   *   eagerness?: ?value-of<TranslationRealtimeEagerness>,
   *   clientSessionId?: ?string,
   *   enableZrm?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->authorization = $values['authorization'] ?? null;
    $this->targetLanguage = $values['targetLanguage'];
    $this->sourceLanguage = $values['sourceLanguage'] ?? null;
    $this->voiceId = $values['voiceId'];
    $this->inputFormat = $values['inputFormat'] ?? null;
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->ttsModelId = $values['ttsModelId'] ?? null;
    $this->applyTextNormalization = $values['applyTextNormalization'] ?? null;
    $this->eagerness = $values['eagerness'] ?? null;
    $this->clientSessionId = $values['clientSessionId'] ?? null;
    $this->enableZrm = $values['enableZrm'] ?? null;
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
      'sourceLanguage' => $data['source_language'] ?? null,
      'voiceId' => $data['voice_id'],
      'inputFormat' => $data['input_format'] ?? null,
      'outputFormat' => $data['output_format'] ?? null,
      'ttsModelId' => $data['tts_model_id'] ?? null,
      'applyTextNormalization' => $data['apply_text_normalization'] ?? null,
      'eagerness' => $data['eagerness'] ?? null,
      'clientSessionId' => $data['client_session_id'] ?? null,
      'enableZrm' => $data['enable_zrm'] ?? null
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
    if ($this->sourceLanguage !== null) {
      $result['source_language'] = $this->sourceLanguage;
    }
    $result['voice_id'] = $this->voiceId;
    if ($this->inputFormat !== null) {
      $result['input_format'] = $this->inputFormat;
    }
    if ($this->outputFormat !== null) {
      $result['output_format'] = $this->outputFormat;
    }
    if ($this->ttsModelId !== null) {
      $result['tts_model_id'] = $this->ttsModelId;
    }
    if ($this->applyTextNormalization !== null) {
      $result['apply_text_normalization'] = $this->applyTextNormalization;
    }
    if ($this->eagerness !== null) {
      $result['eagerness'] = $this->eagerness;
    }
    if ($this->clientSessionId !== null) {
      $result['client_session_id'] = $this->clientSessionId;
    }
    if ($this->enableZrm !== null) {
      $result['enable_zrm'] = $this->enableZrm;
    }
    return $result;
  }
}
