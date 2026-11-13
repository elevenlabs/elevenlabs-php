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
class OpenAiTurnDetection extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TurnDetectionType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var ?value-of<\ElevenLabs\Types\Eagerness>
   */
  #[JsonProperty('eagerness')]
  public ?string $eagerness;

  #[JsonProperty('create_response')]
  public ?bool $createResponse;

  #[JsonProperty('interrupt_response')]
  public ?bool $interruptResponse;

  #[JsonProperty('threshold')]
  public ?float $threshold;

  #[JsonProperty('prefix_padding_ms')]
  public ?int $prefixPaddingMs;

  #[JsonProperty('silence_duration_ms')]
  public ?int $silenceDurationMs;

  #[JsonProperty('turn_timeout')]
  public ?float $turnTimeout;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\TurnDetectionType>,
   *   eagerness?: ?value-of<\ElevenLabs\Types\Eagerness>,
   *   createResponse?: ?bool,
   *   interruptResponse?: ?bool,
   *   threshold?: ?float,
   *   prefixPaddingMs?: ?int,
   *   silenceDurationMs?: ?int,
   *   turnTimeout?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? null;
    $this->eagerness = $values['eagerness'] ?? null;
    $this->createResponse = $values['createResponse'] ?? null;
    $this->interruptResponse = $values['interruptResponse'] ?? null;
    $this->threshold = $values['threshold'] ?? null;
    $this->prefixPaddingMs = $values['prefixPaddingMs'] ?? null;
    $this->silenceDurationMs = $values['silenceDurationMs'] ?? null;
    $this->turnTimeout = $values['turnTimeout'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('eagerness', $values)) {
      $this->_dirtyFields['eagerness'] = true;
    }
    if (array_key_exists('createResponse', $values)) {
      $this->_dirtyFields['create_response'] = true;
    }
    if (array_key_exists('interruptResponse', $values)) {
      $this->_dirtyFields['interrupt_response'] = true;
    }
    if (array_key_exists('threshold', $values)) {
      $this->_dirtyFields['threshold'] = true;
    }
    if (array_key_exists('prefixPaddingMs', $values)) {
      $this->_dirtyFields['prefix_padding_ms'] = true;
    }
    if (array_key_exists('silenceDurationMs', $values)) {
      $this->_dirtyFields['silence_duration_ms'] = true;
    }
    if (array_key_exists('turnTimeout', $values)) {
      $this->_dirtyFields['turn_timeout'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->eagerness !== null) {
      $parts[] = [
        'name' => 'eagerness',
        'contents' => $this->eagerness
      ];
    }

    if ($this->createResponse !== null) {
      $parts[] = [
        'name' => 'create_response',
        'contents' => $this->createResponse ? 'true' : 'false'
      ];
    }

    if ($this->interruptResponse !== null) {
      $parts[] = [
        'name' => 'interrupt_response',
        'contents' => $this->interruptResponse ? 'true' : 'false'
      ];
    }

    if ($this->threshold !== null) {
      $parts[] = [
        'name' => 'threshold',
        'contents' => (string) $this->threshold
      ];
    }

    if ($this->prefixPaddingMs !== null) {
      $parts[] = [
        'name' => 'prefix_padding_ms',
        'contents' => (string) $this->prefixPaddingMs
      ];
    }

    if ($this->silenceDurationMs !== null) {
      $parts[] = [
        'name' => 'silence_duration_ms',
        'contents' => (string) $this->silenceDurationMs
      ];
    }

    if ($this->turnTimeout !== null) {
      $parts[] = [
        'name' => 'turn_timeout',
        'contents' => (string) $this->turnTimeout
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
