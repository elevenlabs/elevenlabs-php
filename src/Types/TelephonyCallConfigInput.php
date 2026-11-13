<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TelephonyCallConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * How long to ring the recipient before giving up, in seconds. Note that this will also be limited by the provider's own constraints.
   */
  #[JsonProperty('ringing_timeout_secs')]
  public ?int $ringingTimeoutSecs;

  /**
   * Whether to record the call using Twilio call recording. Ignored for non-Twilio providers. Recordings are stored in your Twilio account.
   */
  #[JsonProperty('twilio_call_recording_enabled')]
  public ?bool $twilioCallRecordingEnabled;

  /**
   * Configuration for Twilio's carrier-level answering machine detection (AMD). Omit or set to null to disable it. Ignored for non-Twilio providers and for inbound calls. The resulting verdict is delivered as its own `answering_machine_detection` webhook event, which requires that event to be enabled on the workspace or agent webhook settings; it is not part of the conversation or the post-call webhook. Detection runs asynchronously so it never delays the start of the conversation, and the verdict can arrive at any point during the call -- with `detect_message_end`, even after it has ended. Twilio bills separately for AMD.
   */
  #[JsonProperty('twilio_machine_detection')]
  public ?\ElevenLabs\Types\TwilioMachineDetectionConfig $twilioMachineDetection;

  /**
   * @param array{
   *   ringingTimeoutSecs?: ?int,
   *   twilioCallRecordingEnabled?: ?bool,
   *   twilioMachineDetection?: ?\ElevenLabs\Types\TwilioMachineDetectionConfig,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->ringingTimeoutSecs = $values['ringingTimeoutSecs'] ?? null;
    $this->twilioCallRecordingEnabled = $values['twilioCallRecordingEnabled'] ?? null;
    $this->twilioMachineDetection = $values['twilioMachineDetection'] ?? null;

    if (array_key_exists('ringingTimeoutSecs', $values)) {
      $this->_dirtyFields['ringing_timeout_secs'] = true;
    }
    if (array_key_exists('twilioCallRecordingEnabled', $values)) {
      $this->_dirtyFields['twilio_call_recording_enabled'] = true;
    }
    if (array_key_exists('twilioMachineDetection', $values)) {
      $this->_dirtyFields['twilio_machine_detection'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->ringingTimeoutSecs !== null) {
      $parts[] = [
        'name' => 'ringing_timeout_secs',
        'contents' => (string) $this->ringingTimeoutSecs
      ];
    }

    if ($this->twilioCallRecordingEnabled !== null) {
      $parts[] = [
        'name' => 'twilio_call_recording_enabled',
        'contents' => $this->twilioCallRecordingEnabled ? 'true' : 'false'
      ];
    }

    if ($this->twilioMachineDetection !== null) {
      $parts[] = [
        'name' => 'twilio_machine_detection',
        'contents' => json_encode($this->twilioMachineDetection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->ringingTimeoutSecs, 'ringing_timeout_secs', min: 1, max: 999);
    $this->twilioMachineDetection?->validate();
  }
}
