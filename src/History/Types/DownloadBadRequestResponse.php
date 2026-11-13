<?php

declare(strict_types=1);

namespace ElevenLabs\History\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DownloadBadRequestResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('error')]
  public ?string $error;

  #[JsonProperty('message')]
  public ?string $message;

  /**
   * @param array{
   *   error?: ?string,
   *   message?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->error = $values['error'] ?? null;
    $this->message = $values['message'] ?? null;

    if (array_key_exists('error', $values)) {
      $this->_dirtyFields['error'] = true;
    }
    if (array_key_exists('message', $values)) {
      $this->_dirtyFields['message'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->error !== null) {
      $parts[] = [
        'name' => 'error',
        'contents' => $this->error
      ];
    }

    if ($this->message !== null) {
      $parts[] = [
        'name' => 'message',
        'contents' => $this->message
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
