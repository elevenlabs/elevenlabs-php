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
class ConversationReasoningModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('summary')]
  public ?string $summary;

  #[JsonProperty('provider_redact')]
  public ?bool $providerRedact;

  /**
   * @param array{
   *   summary?: ?string,
   *   providerRedact?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->summary = $values['summary'] ?? null;
    $this->providerRedact = $values['providerRedact'] ?? null;

    if (array_key_exists('summary', $values)) {
      $this->_dirtyFields['summary'] = true;
    }
    if (array_key_exists('providerRedact', $values)) {
      $this->_dirtyFields['provider_redact'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->summary !== null) {
      $parts[] = [
        'name' => 'summary',
        'contents' => $this->summary
      ];
    }

    if ($this->providerRedact !== null) {
      $parts[] = [
        'name' => 'provider_redact',
        'contents' => $this->providerRedact ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
