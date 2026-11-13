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
class TurnConfigWorkflowOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Maximum wait time for the user's reply before re-engaging the user
   */
  #[JsonProperty('turn_timeout')]
  public ?float $turnTimeout;

  /**
   * How long the agent will wait for the user to start the conversation if the first message is empty. If not set, uses the regular turn_timeout.
   */
  #[JsonProperty('initial_wait_time')]
  public ?float $initialWaitTime;

  /**
   * Maximum wait time since the user last spoke before terminating the call
   */
  #[JsonProperty('silence_end_call_timeout')]
  public ?float $silenceEndCallTimeout;

  /**
   * @var ?value-of<\ElevenLabs\Types\TurnEagerness>
   * Controls how eager the agent is to respond. Low = less eager (waits longer), Standard = default eagerness, High = more eager (responds sooner)
   */
  #[JsonProperty('turn_eagerness')]
  public ?string $turnEagerness;

  /**
   * @var ?value-of<\ElevenLabs\Types\SpellingPatience>
   * Controls if the agent should be more patient when user is spelling numbers and named entities. Auto = model based, Off = never wait extra
   */
  #[JsonProperty('spelling_patience')]
  public ?string $spellingPatience;

  /**
   * When enabled, starts generating LLM responses during silence before full turn confidence is reached, reducing perceived latency. May increase LLM costs.
   */
  #[JsonProperty('speculative_turn')]
  public ?bool $speculativeTurn;

  /**
   * When enabled, if VAD detects no speech, attempts to re-transcribe accumulated audio at turn timeout. Disables silence discount billing while enabled for the active agent or workflow node.
   */
  #[JsonProperty('retranscribe_on_turn_timeout')]
  public ?bool $retranscribeOnTurnTimeout;

  /**
   * @var ?value-of<\ElevenLabs\Types\TurnModel>
   * Version of the turn detection model to use.
   */
  #[JsonProperty('turn_model')]
  public ?string $turnModel;

  /**
   * @var string[]|null
   * List of terms that should not trigger an interruption when spoken by the user (e.g. 'gotcha', 'understood'). Uses case-insensitive exact matching.
   */
  #[JsonProperty('interruption_ignore_terms'), ArrayType(['string'])]
  public ?array $interruptionIgnoreTerms;

  /**
   * @var string[]|null
   * Language codes for which preset ignore-term categories have been activated. Stored explicitly so display is not inferred from term overlap.
   */
  #[JsonProperty('interruption_ignore_term_languages'), ArrayType(['string'])]
  public ?array $interruptionIgnoreTermLanguages;

  /**
   * When enabled, the curated default terms for interruption_ignore_term_languages are used in addition to interruption_ignore_terms.
   */
  #[JsonProperty('merge_with_default_ignore_terms')]
  public ?bool $mergeWithDefaultIgnoreTerms;

  /**
   * When interruptions are disabled, still transcribe what the user says so it can carry into the next turn. When off, user speech during a non-interruptible turn is ignored and won't trigger a turn.
   */
  #[JsonProperty('transcribe_on_disabled_interruptions')]
  public ?bool $transcribeOnDisabledInterruptions;

  /**
   * Configuration for soft timeout functionality. Provides immediate feedback during longer LLM responses.
   */
  #[JsonProperty('soft_timeout_config')]
  public ?\ElevenLabs\Types\SoftTimeoutConfigWorkflowOverride $softTimeoutConfig;

  /**
   * What the agent says when it detects a noisy environment.
   */
  #[JsonProperty('noisy_environment_message')]
  public ?string $noisyEnvironmentMessage;

  /**
   * @param array{
   *   turnTimeout?: ?float,
   *   initialWaitTime?: ?float,
   *   silenceEndCallTimeout?: ?float,
   *   turnEagerness?: ?value-of<\ElevenLabs\Types\TurnEagerness>,
   *   spellingPatience?: ?value-of<\ElevenLabs\Types\SpellingPatience>,
   *   speculativeTurn?: ?bool,
   *   retranscribeOnTurnTimeout?: ?bool,
   *   turnModel?: ?value-of<\ElevenLabs\Types\TurnModel>,
   *   interruptionIgnoreTerms?: string[]|null,
   *   interruptionIgnoreTermLanguages?: string[]|null,
   *   mergeWithDefaultIgnoreTerms?: ?bool,
   *   transcribeOnDisabledInterruptions?: ?bool,
   *   softTimeoutConfig?: ?\ElevenLabs\Types\SoftTimeoutConfigWorkflowOverride,
   *   noisyEnvironmentMessage?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->turnTimeout = $values['turnTimeout'] ?? null;
    $this->initialWaitTime = $values['initialWaitTime'] ?? null;
    $this->silenceEndCallTimeout = $values['silenceEndCallTimeout'] ?? null;
    $this->turnEagerness = $values['turnEagerness'] ?? null;
    $this->spellingPatience = $values['spellingPatience'] ?? null;
    $this->speculativeTurn = $values['speculativeTurn'] ?? null;
    $this->retranscribeOnTurnTimeout = $values['retranscribeOnTurnTimeout'] ?? null;
    $this->turnModel = $values['turnModel'] ?? null;
    $this->interruptionIgnoreTerms = $values['interruptionIgnoreTerms'] ?? null;
    $this->interruptionIgnoreTermLanguages = $values['interruptionIgnoreTermLanguages'] ?? null;
    $this->mergeWithDefaultIgnoreTerms = $values['mergeWithDefaultIgnoreTerms'] ?? null;
    $this->transcribeOnDisabledInterruptions = $values['transcribeOnDisabledInterruptions'] ?? null;
    $this->softTimeoutConfig = $values['softTimeoutConfig'] ?? null;
    $this->noisyEnvironmentMessage = $values['noisyEnvironmentMessage'] ?? null;

    if (array_key_exists('turnTimeout', $values)) {
      $this->_dirtyFields['turn_timeout'] = true;
    }
    if (array_key_exists('initialWaitTime', $values)) {
      $this->_dirtyFields['initial_wait_time'] = true;
    }
    if (array_key_exists('silenceEndCallTimeout', $values)) {
      $this->_dirtyFields['silence_end_call_timeout'] = true;
    }
    if (array_key_exists('turnEagerness', $values)) {
      $this->_dirtyFields['turn_eagerness'] = true;
    }
    if (array_key_exists('spellingPatience', $values)) {
      $this->_dirtyFields['spelling_patience'] = true;
    }
    if (array_key_exists('speculativeTurn', $values)) {
      $this->_dirtyFields['speculative_turn'] = true;
    }
    if (array_key_exists('retranscribeOnTurnTimeout', $values)) {
      $this->_dirtyFields['retranscribe_on_turn_timeout'] = true;
    }
    if (array_key_exists('turnModel', $values)) {
      $this->_dirtyFields['turn_model'] = true;
    }
    if (array_key_exists('interruptionIgnoreTerms', $values)) {
      $this->_dirtyFields['interruption_ignore_terms'] = true;
    }
    if (array_key_exists('interruptionIgnoreTermLanguages', $values)) {
      $this->_dirtyFields['interruption_ignore_term_languages'] = true;
    }
    if (array_key_exists('mergeWithDefaultIgnoreTerms', $values)) {
      $this->_dirtyFields['merge_with_default_ignore_terms'] = true;
    }
    if (array_key_exists('transcribeOnDisabledInterruptions', $values)) {
      $this->_dirtyFields['transcribe_on_disabled_interruptions'] = true;
    }
    if (array_key_exists('softTimeoutConfig', $values)) {
      $this->_dirtyFields['soft_timeout_config'] = true;
    }
    if (array_key_exists('noisyEnvironmentMessage', $values)) {
      $this->_dirtyFields['noisy_environment_message'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->turnTimeout !== null) {
      $parts[] = [
        'name' => 'turn_timeout',
        'contents' => (string) $this->turnTimeout
      ];
    }

    if ($this->initialWaitTime !== null) {
      $parts[] = [
        'name' => 'initial_wait_time',
        'contents' => (string) $this->initialWaitTime
      ];
    }

    if ($this->silenceEndCallTimeout !== null) {
      $parts[] = [
        'name' => 'silence_end_call_timeout',
        'contents' => (string) $this->silenceEndCallTimeout
      ];
    }

    if ($this->turnEagerness !== null) {
      $parts[] = [
        'name' => 'turn_eagerness',
        'contents' => $this->turnEagerness
      ];
    }

    if ($this->spellingPatience !== null) {
      $parts[] = [
        'name' => 'spelling_patience',
        'contents' => $this->spellingPatience
      ];
    }

    if ($this->speculativeTurn !== null) {
      $parts[] = [
        'name' => 'speculative_turn',
        'contents' => $this->speculativeTurn ? 'true' : 'false'
      ];
    }

    if ($this->retranscribeOnTurnTimeout !== null) {
      $parts[] = [
        'name' => 'retranscribe_on_turn_timeout',
        'contents' => $this->retranscribeOnTurnTimeout ? 'true' : 'false'
      ];
    }

    if ($this->turnModel !== null) {
      $parts[] = [
        'name' => 'turn_model',
        'contents' => $this->turnModel
      ];
    }

    if ($this->interruptionIgnoreTerms !== null) {
      foreach ($this->interruptionIgnoreTerms ?? [] as $item) {
        $parts[] = [
          'name' => 'interruption_ignore_terms',
          'contents' => $item
        ];
      }
    }

    if ($this->interruptionIgnoreTermLanguages !== null) {
      foreach ($this->interruptionIgnoreTermLanguages ?? [] as $item) {
        $parts[] = [
          'name' => 'interruption_ignore_term_languages',
          'contents' => $item
        ];
      }
    }

    if ($this->mergeWithDefaultIgnoreTerms !== null) {
      $parts[] = [
        'name' => 'merge_with_default_ignore_terms',
        'contents' => $this->mergeWithDefaultIgnoreTerms ? 'true' : 'false'
      ];
    }

    if ($this->transcribeOnDisabledInterruptions !== null) {
      $parts[] = [
        'name' => 'transcribe_on_disabled_interruptions',
        'contents' => $this->transcribeOnDisabledInterruptions ? 'true' : 'false'
      ];
    }

    if ($this->softTimeoutConfig !== null) {
      $parts[] = [
        'name' => 'soft_timeout_config',
        'contents' => json_encode($this->softTimeoutConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->noisyEnvironmentMessage !== null) {
      $parts[] = [
        'name' => 'noisy_environment_message',
        'contents' => $this->noisyEnvironmentMessage
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->softTimeoutConfig?->validate();
  }
}
