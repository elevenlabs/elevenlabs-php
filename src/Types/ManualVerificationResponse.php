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
class ManualVerificationResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The extra text of the manual verification.
   */
  #[JsonProperty('extra_text', required: true)]
  public string $extraText;

  /**
   * The date of the manual verification in Unix time.
   */
  #[JsonProperty('request_time_unix', required: true)]
  public int $requestTimeUnix;

  /**
   * @var \ElevenLabs\Types\ManualVerificationFileResponse[]
   * The files of the manual verification.
   */
  #[
    JsonProperty('files', required: true),
    ArrayType([\ElevenLabs\Types\ManualVerificationFileResponse::class])
  ]
  public array $files;

  /**
   * @param array{
   *   extraText: string,
   *   requestTimeUnix: int,
   *   files: \ElevenLabs\Types\ManualVerificationFileResponse[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->extraText = $values['extraText'];
    $this->requestTimeUnix = $values['requestTimeUnix'];
    $this->files = $values['files'];

    $this->_dirtyFields = [
      'extra_text' => true,
      'request_time_unix' => true,
      'files' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'extra_text',
      'contents' => $this->extraText
    ];

    $parts[] = [
      'name' => 'request_time_unix',
      'contents' => (string) $this->requestTimeUnix
    ];

    $parts[] = [
      'name' => 'files',
      'contents' => json_encode($this->files),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->files as $item) {
      $item->validate();
    }
  }
}
