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
class SpeechEngineAuthConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * If true, starting a conversation with the speech engine requires a signed URL or token from an authorized caller, rather than only its ID
   */
  #[JsonProperty('enable_auth')]
  public ?bool $enableAuth;

  /**
   * @param array{
   *   enableAuth?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enableAuth = $values['enableAuth'] ?? null;

    if (array_key_exists('enableAuth', $values)) {
      $this->_dirtyFields['enable_auth'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->enableAuth !== null) {
      $parts[] = [
        'name' => 'enable_auth',
        'contents' => $this->enableAuth ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
