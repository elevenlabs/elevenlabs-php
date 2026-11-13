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
class RecipientDeliveryCounts extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('sent')]
  public ?int $sent;

  #[JsonProperty('delivered')]
  public ?int $delivered;

  #[JsonProperty('read')]
  public ?int $read;

  #[JsonProperty('replied')]
  public ?int $replied;

  #[JsonProperty('failed')]
  public ?int $failed;

  /**
   * @param array{
   *   sent?: ?int,
   *   delivered?: ?int,
   *   read?: ?int,
   *   replied?: ?int,
   *   failed?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->sent = $values['sent'] ?? null;
    $this->delivered = $values['delivered'] ?? null;
    $this->read = $values['read'] ?? null;
    $this->replied = $values['replied'] ?? null;
    $this->failed = $values['failed'] ?? null;

    if (array_key_exists('sent', $values)) {
      $this->_dirtyFields['sent'] = true;
    }
    if (array_key_exists('delivered', $values)) {
      $this->_dirtyFields['delivered'] = true;
    }
    if (array_key_exists('read', $values)) {
      $this->_dirtyFields['read'] = true;
    }
    if (array_key_exists('replied', $values)) {
      $this->_dirtyFields['replied'] = true;
    }
    if (array_key_exists('failed', $values)) {
      $this->_dirtyFields['failed'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->sent !== null) {
      $parts[] = [
        'name' => 'sent',
        'contents' => (string) $this->sent
      ];
    }

    if ($this->delivered !== null) {
      $parts[] = [
        'name' => 'delivered',
        'contents' => (string) $this->delivered
      ];
    }

    if ($this->read !== null) {
      $parts[] = [
        'name' => 'read',
        'contents' => (string) $this->read
      ];
    }

    if ($this->replied !== null) {
      $parts[] = [
        'name' => 'replied',
        'contents' => (string) $this->replied
      ];
    }

    if ($this->failed !== null) {
      $parts[] = [
        'name' => 'failed',
        'contents' => (string) $this->failed
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
