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
class ConversationConfigWorkflowOverrideInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * If enabled audio will not be processed and only text will be used, use to avoid audio pricing.
   */
  #[JsonProperty('text_only')]
  public ?bool $textOnly;

  /**
   * The maximum duration of a conversation in seconds
   */
  #[JsonProperty('max_duration_seconds')]
  public ?int $maxDurationSeconds;

  /**
   * @var array<value-of<\ElevenLabs\Types\ClientEvent>>|null
   * The events that will be sent to the client
   */
  #[JsonProperty('client_events'), ArrayType(['string'])]
  public ?array $clientEvents;

  /**
   * Configuration for file input (image/PDF uploads) during conversations.
   */
  #[JsonProperty('file_input')]
  public ?\ElevenLabs\Types\FileInputConfigWorkflowOverride $fileInput;

  /**
   * Enable real-time monitoring of conversations via WebSocket
   */
  #[JsonProperty('monitoring_enabled')]
  public ?bool $monitoringEnabled;

  /**
   * @var array<value-of<\ElevenLabs\Types\ClientEvent>>|null
   * The events that will be sent to monitoring connections.
   */
  #[JsonProperty('monitoring_events'), ArrayType(['string'])]
  public ?array $monitoringEvents;

  /**
   * Configure DTMF (keypad) input collection during phone calls
   */
  #[JsonProperty('dtmf_input_settings')]
  public ?\ElevenLabs\Types\DtmfInputConfig $dtmfInputSettings;

  /**
   * Configuration for background sound during conversations.
   */
  #[JsonProperty('background_sound')]
  public ?\ElevenLabs\Types\BackgroundSoundConfigWorkflowOverride $backgroundSound;

  /**
   * When enabled and knowledge base content is present, the LLM is instructed to report which sources it used.
   */
  #[JsonProperty('source_attribution')]
  public ?bool $sourceAttribution;

  /**
   * @param array{
   *   textOnly?: ?bool,
   *   maxDurationSeconds?: ?int,
   *   clientEvents?: array<value-of<\ElevenLabs\Types\ClientEvent>>|null,
   *   fileInput?: ?\ElevenLabs\Types\FileInputConfigWorkflowOverride,
   *   monitoringEnabled?: ?bool,
   *   monitoringEvents?: array<value-of<\ElevenLabs\Types\ClientEvent>>|null,
   *   dtmfInputSettings?: ?\ElevenLabs\Types\DtmfInputConfig,
   *   backgroundSound?: ?\ElevenLabs\Types\BackgroundSoundConfigWorkflowOverride,
   *   sourceAttribution?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->textOnly = $values['textOnly'] ?? null;
    $this->maxDurationSeconds = $values['maxDurationSeconds'] ?? null;
    $this->clientEvents = $values['clientEvents'] ?? null;
    $this->fileInput = $values['fileInput'] ?? null;
    $this->monitoringEnabled = $values['monitoringEnabled'] ?? null;
    $this->monitoringEvents = $values['monitoringEvents'] ?? null;
    $this->dtmfInputSettings = $values['dtmfInputSettings'] ?? null;
    $this->backgroundSound = $values['backgroundSound'] ?? null;
    $this->sourceAttribution = $values['sourceAttribution'] ?? null;

    if (array_key_exists('textOnly', $values)) {
      $this->_dirtyFields['text_only'] = true;
    }
    if (array_key_exists('maxDurationSeconds', $values)) {
      $this->_dirtyFields['max_duration_seconds'] = true;
    }
    if (array_key_exists('clientEvents', $values)) {
      $this->_dirtyFields['client_events'] = true;
    }
    if (array_key_exists('fileInput', $values)) {
      $this->_dirtyFields['file_input'] = true;
    }
    if (array_key_exists('monitoringEnabled', $values)) {
      $this->_dirtyFields['monitoring_enabled'] = true;
    }
    if (array_key_exists('monitoringEvents', $values)) {
      $this->_dirtyFields['monitoring_events'] = true;
    }
    if (array_key_exists('dtmfInputSettings', $values)) {
      $this->_dirtyFields['dtmf_input_settings'] = true;
    }
    if (array_key_exists('backgroundSound', $values)) {
      $this->_dirtyFields['background_sound'] = true;
    }
    if (array_key_exists('sourceAttribution', $values)) {
      $this->_dirtyFields['source_attribution'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->textOnly !== null) {
      $parts[] = [
        'name' => 'text_only',
        'contents' => $this->textOnly ? 'true' : 'false'
      ];
    }

    if ($this->maxDurationSeconds !== null) {
      $parts[] = [
        'name' => 'max_duration_seconds',
        'contents' => (string) $this->maxDurationSeconds
      ];
    }

    if ($this->clientEvents !== null) {
      foreach ($this->clientEvents ?? [] as $item) {
        $parts[] = [
          'name' => 'client_events',
          'contents' => $item
        ];
      }
    }

    if ($this->fileInput !== null) {
      $parts[] = [
        'name' => 'file_input',
        'contents' => json_encode($this->fileInput),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->monitoringEnabled !== null) {
      $parts[] = [
        'name' => 'monitoring_enabled',
        'contents' => $this->monitoringEnabled ? 'true' : 'false'
      ];
    }

    if ($this->monitoringEvents !== null) {
      foreach ($this->monitoringEvents ?? [] as $item) {
        $parts[] = [
          'name' => 'monitoring_events',
          'contents' => $item
        ];
      }
    }

    if ($this->dtmfInputSettings !== null) {
      $parts[] = [
        'name' => 'dtmf_input_settings',
        'contents' => json_encode($this->dtmfInputSettings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->backgroundSound !== null) {
      $parts[] = [
        'name' => 'background_sound',
        'contents' => json_encode($this->backgroundSound),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->sourceAttribution !== null) {
      $parts[] = [
        'name' => 'source_attribution',
        'contents' => $this->sourceAttribution ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->fileInput?->validate();
    $this->dtmfInputSettings?->validate();
    $this->backgroundSound?->validate();
  }
}
