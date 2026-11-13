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
class CommittedTranscriptWithTimestamps extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\CommittedTranscriptWithTimestampsMessageType>
   */
  #[JsonProperty('message_type')]
  public ?string $messageType;

  #[JsonProperty('text', required: true)]
  public string $text;

  #[JsonProperty('language_code')]
  public ?string $languageCode;

  /**
   * @var \ElevenLabs\Types\CommittedTranscriptWithTimestampsWordsItem[]|null
   */
  #[
    JsonProperty('words'),
    ArrayType([\ElevenLabs\Types\CommittedTranscriptWithTimestampsWordsItem::class])
  ]
  public ?array $words;

  /**
   * @param array{
   *   text: string,
   *   messageType?: ?value-of<\ElevenLabs\Types\CommittedTranscriptWithTimestampsMessageType>,
   *   languageCode?: ?string,
   *   words?: \ElevenLabs\Types\CommittedTranscriptWithTimestampsWordsItem[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'] ?? 'committed_transcript_with_timestamps';
    $this->text = $values['text'];
    $this->languageCode = $values['languageCode'] ?? null;
    $this->words = $values['words'] ?? null;

    $this->_dirtyFields = [
      'text' => true
    ];
    if (array_key_exists('messageType', $values)) {
      $this->_dirtyFields['message_type'] = true;
    }
    if (array_key_exists('languageCode', $values)) {
      $this->_dirtyFields['language_code'] = true;
    }
    if (array_key_exists('words', $values)) {
      $this->_dirtyFields['words'] = true;
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

    if ($this->languageCode !== null) {
      $parts[] = [
        'name' => 'language_code',
        'contents' => $this->languageCode
      ];
    }

    if ($this->words !== null) {
      $parts[] = [
        'name' => 'words',
        'contents' => json_encode($this->words),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->words ?? [] as $item) {
      $item->validate();
    }
  }
}
