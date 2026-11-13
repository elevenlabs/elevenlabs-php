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
class SpeechToTextWebhookResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The message of the webhook response.
   */
  #[JsonProperty('message', required: true)]
  public string $message;

  /**
   * The request ID of the webhook response.
   */
  #[JsonProperty('request_id', required: true)]
  public string $requestId;

  /**
   * The transcription ID of the webhook response.
   */
  #[JsonProperty('transcription_id')]
  public ?string $transcriptionId;

  /**
   * @param array{
   *   message: string,
   *   requestId: string,
   *   transcriptionId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->message = $values['message'];
    $this->requestId = $values['requestId'];
    $this->transcriptionId = $values['transcriptionId'] ?? null;

    $this->_dirtyFields = [
      'message' => true,
      'request_id' => true
    ];
    if (array_key_exists('transcriptionId', $values)) {
      $this->_dirtyFields['transcription_id'] = true;
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
      'name' => 'request_id',
      'contents' => $this->requestId
    ];

    if ($this->transcriptionId !== null) {
      $parts[] = [
        'name' => 'transcription_id',
        'contents' => $this->transcriptionId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
