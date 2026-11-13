<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Configuration for DTMF (keypad) input collection during phone calls.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DtmfInputConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Timeout in seconds to wait for additional DTMF digits
   */
  #[JsonProperty('dtmf_input_timeout')]
  public ?float $dtmfInputTimeout;

  /**
   * If true, pressing # immediately completes DTMF input
   */
  #[JsonProperty('hash_terminator')]
  public ?bool $hashTerminator;

  /**
   * If true, replace the caller's DTMF (keypad) entries with a redaction marker in the transcript, conversation log and analysis. Digits the agent repeats back or passes to a tool are not affected.
   */
  #[JsonProperty('redact_input')]
  public ?bool $redactInput;

  /**
   * @param array{
   *   dtmfInputTimeout?: ?float,
   *   hashTerminator?: ?bool,
   *   redactInput?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->dtmfInputTimeout = $values['dtmfInputTimeout'] ?? null;
    $this->hashTerminator = $values['hashTerminator'] ?? null;
    $this->redactInput = $values['redactInput'] ?? null;

    if (array_key_exists('dtmfInputTimeout', $values)) {
      $this->_dirtyFields['dtmf_input_timeout'] = true;
    }
    if (array_key_exists('hashTerminator', $values)) {
      $this->_dirtyFields['hash_terminator'] = true;
    }
    if (array_key_exists('redactInput', $values)) {
      $this->_dirtyFields['redact_input'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->dtmfInputTimeout !== null) {
      $parts[] = [
        'name' => 'dtmf_input_timeout',
        'contents' => (string) $this->dtmfInputTimeout
      ];
    }

    if ($this->hashTerminator !== null) {
      $parts[] = [
        'name' => 'hash_terminator',
        'contents' => $this->hashTerminator ? 'true' : 'false'
      ];
    }

    if ($this->redactInput !== null) {
      $parts[] = [
        'name' => 'redact_input',
        'contents' => $this->redactInput ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->dtmfInputTimeout, 'dtmf_input_timeout', min: 0.5, max: 10);
  }
}
