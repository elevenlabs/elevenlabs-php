<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationChargingCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('dev_discount')]
  public ?bool $devDiscount;

  #[JsonProperty('is_burst')]
  public ?bool $isBurst;

  #[JsonProperty('tier')]
  public ?string $tier;

  /**
   * LLM usage of a conversation, split by whether the generated response reached the user.
   */
  #[JsonProperty('llm_usage')]
  public ?\ElevenLabs\Types\LlmCategoryUsage $llmUsage;

  /**
   * Total LLM price in USD. Equals the sum of the prices in `llm_usage.initiated_generation`.
   */
  #[JsonProperty('llm_price')]
  public ?float $llmPrice;

  /**
   * Credits charged for LLM usage.
   */
  #[JsonProperty('llm_charge')]
  public ?int $llmCharge;

  #[JsonProperty('call_charge')]
  public ?int $callCharge;

  #[JsonProperty('platform_charge')]
  public ?int $platformCharge;

  /**
   * Per-category breakdown of ``platform_charge`` (the analogue of ``llm_usage``).
   */
  #[JsonProperty('platform_usage')]
  public ?\ElevenLabs\Types\PlatformUsage $platformUsage;

  #[JsonProperty('platform_price')]
  public ?float $platformPrice;

  #[JsonProperty('free_minutes_consumed')]
  public ?float $freeMinutesConsumed;

  #[JsonProperty('free_llm_dollars_consumed')]
  public ?float $freeLlmDollarsConsumed;

  #[JsonProperty('tts_usage')]
  public ?\ElevenLabs\Types\ConversationTtsUsageModel $ttsUsage;

  #[JsonProperty('asr_usage')]
  public ?\ElevenLabs\Types\ConversationAsrUsageModel $asrUsage;

  #[JsonProperty('analysis')]
  public ?\ElevenLabs\Types\AnalysisCharging $analysis;

  /**
   * Credits charged as the voice actor reward for the Voice Library voices this conversation used. It is not included in `cost`.
   */
  #[JsonProperty('voice_surcharge_charge')]
  public ?int $voiceSurchargeCharge;

  /**
   * @param array{
   *   devDiscount?: ?bool,
   *   isBurst?: ?bool,
   *   tier?: ?string,
   *   llmUsage?: ?\ElevenLabs\Types\LlmCategoryUsage,
   *   llmPrice?: ?float,
   *   llmCharge?: ?int,
   *   callCharge?: ?int,
   *   platformCharge?: ?int,
   *   platformUsage?: ?\ElevenLabs\Types\PlatformUsage,
   *   platformPrice?: ?float,
   *   freeMinutesConsumed?: ?float,
   *   freeLlmDollarsConsumed?: ?float,
   *   ttsUsage?: ?\ElevenLabs\Types\ConversationTtsUsageModel,
   *   asrUsage?: ?\ElevenLabs\Types\ConversationAsrUsageModel,
   *   analysis?: ?\ElevenLabs\Types\AnalysisCharging,
   *   voiceSurchargeCharge?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->devDiscount = $values['devDiscount'] ?? null;
    $this->isBurst = $values['isBurst'] ?? null;
    $this->tier = $values['tier'] ?? null;
    $this->llmUsage = $values['llmUsage'] ?? null;
    $this->llmPrice = $values['llmPrice'] ?? null;
    $this->llmCharge = $values['llmCharge'] ?? null;
    $this->callCharge = $values['callCharge'] ?? null;
    $this->platformCharge = $values['platformCharge'] ?? null;
    $this->platformUsage = $values['platformUsage'] ?? null;
    $this->platformPrice = $values['platformPrice'] ?? null;
    $this->freeMinutesConsumed = $values['freeMinutesConsumed'] ?? null;
    $this->freeLlmDollarsConsumed = $values['freeLlmDollarsConsumed'] ?? null;
    $this->ttsUsage = $values['ttsUsage'] ?? null;
    $this->asrUsage = $values['asrUsage'] ?? null;
    $this->analysis = $values['analysis'] ?? null;
    $this->voiceSurchargeCharge = $values['voiceSurchargeCharge'] ?? null;

    if (array_key_exists('devDiscount', $values)) {
      $this->_dirtyFields['dev_discount'] = true;
    }
    if (array_key_exists('isBurst', $values)) {
      $this->_dirtyFields['is_burst'] = true;
    }
    if (array_key_exists('tier', $values)) {
      $this->_dirtyFields['tier'] = true;
    }
    if (array_key_exists('llmUsage', $values)) {
      $this->_dirtyFields['llm_usage'] = true;
    }
    if (array_key_exists('llmPrice', $values)) {
      $this->_dirtyFields['llm_price'] = true;
    }
    if (array_key_exists('llmCharge', $values)) {
      $this->_dirtyFields['llm_charge'] = true;
    }
    if (array_key_exists('callCharge', $values)) {
      $this->_dirtyFields['call_charge'] = true;
    }
    if (array_key_exists('platformCharge', $values)) {
      $this->_dirtyFields['platform_charge'] = true;
    }
    if (array_key_exists('platformUsage', $values)) {
      $this->_dirtyFields['platform_usage'] = true;
    }
    if (array_key_exists('platformPrice', $values)) {
      $this->_dirtyFields['platform_price'] = true;
    }
    if (array_key_exists('freeMinutesConsumed', $values)) {
      $this->_dirtyFields['free_minutes_consumed'] = true;
    }
    if (array_key_exists('freeLlmDollarsConsumed', $values)) {
      $this->_dirtyFields['free_llm_dollars_consumed'] = true;
    }
    if (array_key_exists('ttsUsage', $values)) {
      $this->_dirtyFields['tts_usage'] = true;
    }
    if (array_key_exists('asrUsage', $values)) {
      $this->_dirtyFields['asr_usage'] = true;
    }
    if (array_key_exists('analysis', $values)) {
      $this->_dirtyFields['analysis'] = true;
    }
    if (array_key_exists('voiceSurchargeCharge', $values)) {
      $this->_dirtyFields['voice_surcharge_charge'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->devDiscount !== null) {
      $parts[] = [
        'name' => 'dev_discount',
        'contents' => $this->devDiscount ? 'true' : 'false'
      ];
    }

    if ($this->isBurst !== null) {
      $parts[] = [
        'name' => 'is_burst',
        'contents' => $this->isBurst ? 'true' : 'false'
      ];
    }

    if ($this->tier !== null) {
      $parts[] = [
        'name' => 'tier',
        'contents' => $this->tier
      ];
    }

    if ($this->llmUsage !== null) {
      $parts[] = [
        'name' => 'llm_usage',
        'contents' => json_encode($this->llmUsage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->llmPrice !== null) {
      $parts[] = [
        'name' => 'llm_price',
        'contents' => (string) $this->llmPrice
      ];
    }

    if ($this->llmCharge !== null) {
      $parts[] = [
        'name' => 'llm_charge',
        'contents' => (string) $this->llmCharge
      ];
    }

    if ($this->callCharge !== null) {
      $parts[] = [
        'name' => 'call_charge',
        'contents' => (string) $this->callCharge
      ];
    }

    if ($this->platformCharge !== null) {
      $parts[] = [
        'name' => 'platform_charge',
        'contents' => (string) $this->platformCharge
      ];
    }

    if ($this->platformUsage !== null) {
      $parts[] = [
        'name' => 'platform_usage',
        'contents' => json_encode($this->platformUsage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->platformPrice !== null) {
      $parts[] = [
        'name' => 'platform_price',
        'contents' => (string) $this->platformPrice
      ];
    }

    if ($this->freeMinutesConsumed !== null) {
      $parts[] = [
        'name' => 'free_minutes_consumed',
        'contents' => (string) $this->freeMinutesConsumed
      ];
    }

    if ($this->freeLlmDollarsConsumed !== null) {
      $parts[] = [
        'name' => 'free_llm_dollars_consumed',
        'contents' => (string) $this->freeLlmDollarsConsumed
      ];
    }

    if ($this->ttsUsage !== null) {
      $parts[] = [
        'name' => 'tts_usage',
        'contents' => json_encode($this->ttsUsage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->asrUsage !== null) {
      $parts[] = [
        'name' => 'asr_usage',
        'contents' => json_encode($this->asrUsage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->analysis !== null) {
      $parts[] = [
        'name' => 'analysis',
        'contents' => json_encode($this->analysis),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->voiceSurchargeCharge !== null) {
      $parts[] = [
        'name' => 'voice_surcharge_charge',
        'contents' => (string) $this->voiceSurchargeCharge
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->llmUsage?->validate();
    $this->platformUsage?->validate();
    $this->ttsUsage?->validate();
    $this->asrUsage?->validate();
    $this->analysis?->validate();
  }
}
