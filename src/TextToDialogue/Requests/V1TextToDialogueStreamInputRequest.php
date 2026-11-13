<?php

declare(strict_types=1);

namespace ElevenLabs\TextToDialogue\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\TextToDialogueRealtimeApplyTextNormalization;

class V1TextToDialogueStreamInputRequest extends JsonSerializableType
{
  /**
   * @var ?string $modelId
   */
  public ?string $modelId;

  /**
   * @var ?string $outputFormat
   */
  public ?string $outputFormat;

  /**
   * @var ?string $languageCode
   */
  public ?string $languageCode;

  /**
   * @var ?bool $syncAlignment
   */
  public ?bool $syncAlignment;

  /**
   * @var ?value-of<TextToDialogueRealtimeApplyTextNormalization> $applyTextNormalization
   */
  public ?string $applyTextNormalization;

  /**
   * @var ?int $seed
   */
  public ?int $seed;

  /**
   * @var ?bool $enableLogging
   */
  public ?bool $enableLogging;

  /**
   * @param array{
   *   modelId?: ?string,
   *   outputFormat?: ?string,
   *   languageCode?: ?string,
   *   syncAlignment?: ?bool,
   *   applyTextNormalization?: ?value-of<TextToDialogueRealtimeApplyTextNormalization>,
   *   seed?: ?int,
   *   enableLogging?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->modelId = $values['modelId'] ?? null;
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->languageCode = $values['languageCode'] ?? null;
    $this->syncAlignment = $values['syncAlignment'] ?? null;
    $this->applyTextNormalization = $values['applyTextNormalization'] ?? null;
    $this->seed = $values['seed'] ?? null;
    $this->enableLogging = $values['enableLogging'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'modelId' => $data['model_id'] ?? null,
      'outputFormat' => $data['output_format'] ?? null,
      'languageCode' => $data['language_code'] ?? null,
      'syncAlignment' => $data['sync_alignment'] ?? null,
      'applyTextNormalization' => $data['apply_text_normalization'] ?? null,
      'seed' => $data['seed'] ?? null,
      'enableLogging' => $data['enable_logging'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->modelId !== null) {
      $result['model_id'] = $this->modelId;
    }
    if ($this->outputFormat !== null) {
      $result['output_format'] = $this->outputFormat;
    }
    if ($this->languageCode !== null) {
      $result['language_code'] = $this->languageCode;
    }
    if ($this->syncAlignment !== null) {
      $result['sync_alignment'] = $this->syncAlignment;
    }
    if ($this->applyTextNormalization !== null) {
      $result['apply_text_normalization'] = $this->applyTextNormalization;
    }
    if ($this->seed !== null) {
      $result['seed'] = $this->seed;
    }
    if ($this->enableLogging !== null) {
      $result['enable_logging'] = $this->enableLogging;
    }
    return $result;
  }
}
