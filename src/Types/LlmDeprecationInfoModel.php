<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\Date;
use DateTime;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class LlmDeprecationInfoModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\Llm>
   */
  #[JsonProperty('llm', required: true)]
  public string $llm;

  /**
   * Whether this model is currently deprecated. True if the model is immediately deprecated or within the warning period.
   */
  #[JsonProperty('is_deprecated', required: true)]
  public bool $isDeprecated;

  /**
   * Whether this model is currently in the warning period before deprecation.
   */
  #[JsonProperty('is_in_warning_period')]
  public ?bool $isInWarningPeriod;

  /**
   * Whether traffic is currently being progressively routed to the replacement model.
   */
  #[JsonProperty('is_in_fallback_period')]
  public ?bool $isInFallbackPeriod;

  /**
   * Current percentage of traffic being routed to the replacement model (0-100).
   */
  #[JsonProperty('fallback_percentage')]
  public ?int $fallbackPercentage;

  /**
   * The date when the model provider will deprecate this model. Null for immediately deprecated models.
   */
  #[JsonProperty('provider_deprecation_date'), Date(Date::TYPE_DATETIME)]
  public ?DateTime $providerDeprecationDate;

  /**
   * @var ?value-of<\ElevenLabs\Types\Llm>
   * The model that replaces this deprecated model. Traffic will be automatically routed to this model.
   */
  #[JsonProperty('replacement_model')]
  public ?string $replacementModel;

  /**
   * Custom deprecation timing configuration for this model. Null if using the default configuration.
   */
  #[JsonProperty('deprecation_config')]
  public ?\ElevenLabs\Types\LlmDeprecationConfigModel $deprecationConfig;

  /**
   * @param array{
   *   llm: value-of<\ElevenLabs\Types\Llm>,
   *   isDeprecated: bool,
   *   isInWarningPeriod?: ?bool,
   *   isInFallbackPeriod?: ?bool,
   *   fallbackPercentage?: ?int,
   *   providerDeprecationDate?: ?DateTime,
   *   replacementModel?: ?value-of<\ElevenLabs\Types\Llm>,
   *   deprecationConfig?: ?\ElevenLabs\Types\LlmDeprecationConfigModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->llm = $values['llm'];
    $this->isDeprecated = $values['isDeprecated'];
    $this->isInWarningPeriod = $values['isInWarningPeriod'] ?? null;
    $this->isInFallbackPeriod = $values['isInFallbackPeriod'] ?? null;
    $this->fallbackPercentage = $values['fallbackPercentage'] ?? null;
    $this->providerDeprecationDate = $values['providerDeprecationDate'] ?? null;
    $this->replacementModel = $values['replacementModel'] ?? null;
    $this->deprecationConfig = $values['deprecationConfig'] ?? null;

    $this->_dirtyFields = [
      'llm' => true,
      'is_deprecated' => true
    ];
    if (array_key_exists('isInWarningPeriod', $values)) {
      $this->_dirtyFields['is_in_warning_period'] = true;
    }
    if (array_key_exists('isInFallbackPeriod', $values)) {
      $this->_dirtyFields['is_in_fallback_period'] = true;
    }
    if (array_key_exists('fallbackPercentage', $values)) {
      $this->_dirtyFields['fallback_percentage'] = true;
    }
    if (array_key_exists('providerDeprecationDate', $values)) {
      $this->_dirtyFields['provider_deprecation_date'] = true;
    }
    if (array_key_exists('replacementModel', $values)) {
      $this->_dirtyFields['replacement_model'] = true;
    }
    if (array_key_exists('deprecationConfig', $values)) {
      $this->_dirtyFields['deprecation_config'] = true;
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
      'name' => 'is_deprecated',
      'contents' => $this->isDeprecated ? 'true' : 'false'
    ];

    if ($this->isInWarningPeriod !== null) {
      $parts[] = [
        'name' => 'is_in_warning_period',
        'contents' => $this->isInWarningPeriod ? 'true' : 'false'
      ];
    }

    if ($this->isInFallbackPeriod !== null) {
      $parts[] = [
        'name' => 'is_in_fallback_period',
        'contents' => $this->isInFallbackPeriod ? 'true' : 'false'
      ];
    }

    if ($this->fallbackPercentage !== null) {
      $parts[] = [
        'name' => 'fallback_percentage',
        'contents' => (string) $this->fallbackPercentage
      ];
    }

    if ($this->providerDeprecationDate !== null) {
      $parts[] = [
        'name' => 'provider_deprecation_date',
        'contents' => $this->providerDeprecationDate
      ];
    }

    if ($this->replacementModel !== null) {
      $parts[] = [
        'name' => 'replacement_model',
        'contents' => $this->replacementModel
      ];
    }

    if ($this->deprecationConfig !== null) {
      $parts[] = [
        'name' => 'deprecation_config',
        'contents' => json_encode($this->deprecationConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->deprecationConfig?->validate();
  }
}
