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
class RedactedTranscript extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\RedactedTranscriptMessageType>
   */
  #[JsonProperty('message_type')]
  public ?string $messageType;

  #[JsonProperty('text', required: true)]
  public string $text;

  #[JsonProperty('redacted_text', required: true)]
  public string $redactedText;

  /**
   * @param array{
   *   text: string,
   *   redactedText: string,
   *   messageType?: ?value-of<\ElevenLabs\Types\RedactedTranscriptMessageType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'] ?? 'redacted_transcript';
    $this->text = $values['text'];
    $this->redactedText = $values['redactedText'];

    $this->_dirtyFields = [
      'text' => true,
      'redacted_text' => true
    ];
    if (array_key_exists('messageType', $values)) {
      $this->_dirtyFields['message_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->messageType !== null) {
      $parts[] = [
        'name' => 'message_type',
        'contents' => $this->messageType
      ];
    }

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'redacted_text',
      'contents' => $this->redactedText
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
