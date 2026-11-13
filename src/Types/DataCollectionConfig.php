<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The agent's data collection items that steer follow-up calls. Each defaults
 * to the built-in item for its purpose; `null` turns it off.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DataCollectionConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The item holding when the contact asked to be called back.
   */
  #[JsonProperty('callback_time')]
  public ?string $callbackTime;

  /**
   * The item holding another number the contact asked to be called on.
   */
  #[JsonProperty('redirect_phone_number')]
  public ?string $redirectPhoneNumber;

  /**
   * The item that is true when the contact asked not to be called again.
   */
  #[JsonProperty('stop')]
  public ?string $stop;

  /**
   * @var array<string, string>|null
   * Copies data collection results into dynamic variables for later calls: each key is a data collection item ID and its value the variable's name.
   */
  #[JsonProperty('mappings'), ArrayType(['string' => 'string'])]
  public ?array $mappings;

  /**
   * @param array{
   *   callbackTime?: ?string,
   *   redirectPhoneNumber?: ?string,
   *   stop?: ?string,
   *   mappings?: array<string, string>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->callbackTime = $values['callbackTime'] ?? null;
    $this->redirectPhoneNumber = $values['redirectPhoneNumber'] ?? null;
    $this->stop = $values['stop'] ?? null;
    $this->mappings = $values['mappings'] ?? null;

    if (array_key_exists('callbackTime', $values)) {
      $this->_dirtyFields['callback_time'] = true;
    }
    if (array_key_exists('redirectPhoneNumber', $values)) {
      $this->_dirtyFields['redirect_phone_number'] = true;
    }
    if (array_key_exists('stop', $values)) {
      $this->_dirtyFields['stop'] = true;
    }
    if (array_key_exists('mappings', $values)) {
      $this->_dirtyFields['mappings'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->callbackTime !== null) {
      $parts[] = [
        'name' => 'callback_time',
        'contents' => $this->callbackTime
      ];
    }

    if ($this->redirectPhoneNumber !== null) {
      $parts[] = [
        'name' => 'redirect_phone_number',
        'contents' => $this->redirectPhoneNumber
      ];
    }

    if ($this->stop !== null) {
      $parts[] = [
        'name' => 'stop',
        'contents' => $this->stop
      ];
    }

    if ($this->mappings !== null) {
      $parts[] = [
        'name' => 'mappings',
        'contents' => json_encode($this->mappings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->callbackTime, 'callback_time', minLength: 1);
    Validator::validateString($this->redirectPhoneNumber, 'redirect_phone_number', minLength: 1);
    Validator::validateString($this->stop, 'stop', minLength: 1);
  }
}
