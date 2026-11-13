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
class Error extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('message', required: true)]
  public string $message;

  #[JsonProperty('error', required: true)]
  public string $error;

  #[JsonProperty('code', required: true)]
  public int $code;

  #[JsonProperty('param')]
  public ?string $param;

  /**
   * @param array{
   *   message: string,
   *   error: string,
   *   code: int,
   *   param?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->message = $values['message'];
    $this->error = $values['error'];
    $this->code = $values['code'];
    $this->param = $values['param'] ?? null;

    $this->_dirtyFields = [
      'message' => true,
      'error' => true,
      'code' => true
    ];
    if (array_key_exists('param', $values)) {
      $this->_dirtyFields['param'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'message',
      'contents' => $this->message
    ];

    $parts[] = [
      'name' => 'error',
      'contents' => $this->error
    ];

    $parts[] = [
      'name' => 'code',
      'contents' => (string) $this->code
    ];

    if ($this->param !== null) {
      $parts[] = [
        'name' => 'param',
        'contents' => $this->param
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
