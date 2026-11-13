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
class PartialTranscript extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\PartialTranscriptMessageType>
   */
  #[JsonProperty('message_type')]
  public ?string $messageType;

  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * Probability that the speaker has finished their turn. Only sent for models that predict turns.
   */
  #[JsonProperty('turn_probability')]
  public ?float $turnProbability;

  /**
   * @var \ElevenLabs\Types\PartialTranscriptWordsItem[]|null
   * Draft words with speaker IDs when diarize is enabled. Speaker IDs and timestamps may change as more audio is received.
   */
  #[JsonProperty('words'), ArrayType([\ElevenLabs\Types\PartialTranscriptWordsItem::class])]
  public ?array $words;

  /**
   * @param array{
   *   text: string,
   *   messageType?: ?value-of<\ElevenLabs\Types\PartialTranscriptMessageType>,
   *   turnProbability?: ?float,
   *   words?: \ElevenLabs\Types\PartialTranscriptWordsItem[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'] ?? 'partial_transcript';
    $this->text = $values['text'];
    $this->turnProbability = $values['turnProbability'] ?? null;
    $this->words = $values['words'] ?? null;

    $this->_dirtyFields = [
      'text' => true
    ];
    if (array_key_exists('messageType', $values)) {
      $this->_dirtyFields['message_type'] = true;
    }
    if (array_key_exists('turnProbability', $values)) {
      $this->_dirtyFields['turn_probability'] = true;
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

    if ($this->turnProbability !== null) {
      $parts[] = [
        'name' => 'turn_probability',
        'contents' => (string) $this->turnProbability
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
