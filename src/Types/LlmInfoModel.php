<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class LlmInfoModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\Llm>
   */
  #[JsonProperty('llm', required: true)]
  public string $llm;

  /**
   * Whether this is a pinned checkpoint version of a model rather than a top-level alias.
   */
  #[JsonProperty('is_checkpoint', required: true)]
  public bool $isCheckpoint;

  /**
   * Maximum number of output tokens the model can generate.
   */
  #[JsonProperty('max_tokens_limit', required: true)]
  public int $maxTokensLimit;

  /**
   * Maximum number of input context tokens the model supports.
   */
  #[JsonProperty('max_context_limit', required: true)]
  public int $maxContextLimit;

  /**
   * Whether the model supports image file inputs during conversations.
   */
  #[JsonProperty('supports_image_input', required: true)]
  public bool $supportsImageInput;

  /**
   * Whether the model supports document (PDF) file inputs during conversations.
   */
  #[JsonProperty('supports_document_input', required: true)]
  public bool $supportsDocumentInput;

  /**
   * Whether the model supports calling multiple tools in parallel.
   */
  #[JsonProperty('supports_parallel_tool_calls', required: true)]
  public bool $supportsParallelToolCalls;

  /**
   * @var array<value-of<\ElevenLabs\Types\LlmReasoningEffort>>|null
   * Available reasoning effort levels for this model. Null if the model does not support configurable reasoning.
   */
  #[JsonProperty('available_reasoning_efforts'), ArrayType(['string'])]
  public ?array $availableReasoningEfforts;

  /**
   * @var array<value-of<\ElevenLabs\Types\LlmServiceTier>>
   * Available service tiers for this model. Always includes at least the standard tier.
   */
  #[JsonProperty('available_service_tiers', required: true), ArrayType(['string'])]
  public array $availableServiceTiers;

  /**
   * Deprecation information if this model is deprecated or scheduled for deprecation. Null if the model is not affected.
   */
  #[JsonProperty('deprecation_info')]
  public ?\ElevenLabs\Types\LlmDeprecationInfoModel $deprecationInfo;

  /**
   * Regional processing surcharge details if this model has additional costs in the current deployment region. Null if no surcharge applies.
   */
  #[JsonProperty('regional_processing_surcharge')]
  public ?\ElevenLabs\Types\RegionalProcessingSurchargeInfo $regionalProcessingSurcharge;

  /**
   * @param array{
   *   llm: value-of<\ElevenLabs\Types\Llm>,
   *   isCheckpoint: bool,
   *   maxTokensLimit: int,
   *   maxContextLimit: int,
   *   supportsImageInput: bool,
   *   supportsDocumentInput: bool,
   *   supportsParallelToolCalls: bool,
   *   availableServiceTiers: array<value-of<\ElevenLabs\Types\LlmServiceTier>>,
   *   availableReasoningEfforts?: array<value-of<\ElevenLabs\Types\LlmReasoningEffort>>|null,
   *   deprecationInfo?: ?\ElevenLabs\Types\LlmDeprecationInfoModel,
   *   regionalProcessingSurcharge?: ?\ElevenLabs\Types\RegionalProcessingSurchargeInfo,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->llm = $values['llm'];
    $this->isCheckpoint = $values['isCheckpoint'];
    $this->maxTokensLimit = $values['maxTokensLimit'];
    $this->maxContextLimit = $values['maxContextLimit'];
    $this->supportsImageInput = $values['supportsImageInput'];
    $this->supportsDocumentInput = $values['supportsDocumentInput'];
    $this->supportsParallelToolCalls = $values['supportsParallelToolCalls'];
    $this->availableReasoningEfforts = $values['availableReasoningEfforts'] ?? null;
    $this->availableServiceTiers = $values['availableServiceTiers'];
    $this->deprecationInfo = $values['deprecationInfo'] ?? null;
    $this->regionalProcessingSurcharge = $values['regionalProcessingSurcharge'] ?? null;

    $this->_dirtyFields = [
      'llm' => true,
      'is_checkpoint' => true,
      'max_tokens_limit' => true,
      'max_context_limit' => true,
      'supports_image_input' => true,
      'supports_document_input' => true,
      'supports_parallel_tool_calls' => true,
      'available_service_tiers' => true
    ];
    if (array_key_exists('availableReasoningEfforts', $values)) {
      $this->_dirtyFields['available_reasoning_efforts'] = true;
    }
    if (array_key_exists('deprecationInfo', $values)) {
      $this->_dirtyFields['deprecation_info'] = true;
    }
    if (array_key_exists('regionalProcessingSurcharge', $values)) {
      $this->_dirtyFields['regional_processing_surcharge'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'llm',
      'contents' => $this->llm
    ];

    $parts[] = [
      'name' => 'is_checkpoint',
      'contents' => $this->isCheckpoint ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'max_tokens_limit',
      'contents' => (string) $this->maxTokensLimit
    ];

    $parts[] = [
      'name' => 'max_context_limit',
      'contents' => (string) $this->maxContextLimit
    ];

    $parts[] = [
      'name' => 'supports_image_input',
      'contents' => $this->supportsImageInput ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'supports_document_input',
      'contents' => $this->supportsDocumentInput ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'supports_parallel_tool_calls',
      'contents' => $this->supportsParallelToolCalls ? 'true' : 'false'
    ];

    if ($this->availableReasoningEfforts !== null) {
      foreach ($this->availableReasoningEfforts ?? [] as $item) {
        $parts[] = [
          'name' => 'available_reasoning_efforts',
          'contents' => $item
        ];
      }
    }

    foreach ($this->availableServiceTiers as $item) {
      $parts[] = [
        'name' => 'available_service_tiers',
        'contents' => $item
      ];
    }

    if ($this->deprecationInfo !== null) {
      $parts[] = [
        'name' => 'deprecation_info',
        'contents' => json_encode($this->deprecationInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->regionalProcessingSurcharge !== null) {
      $parts[] = [
        'name' => 'regional_processing_surcharge',
        'contents' => json_encode($this->regionalProcessingSurcharge),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->deprecationInfo?->validate();
    $this->regionalProcessingSurcharge?->validate();
  }
}
