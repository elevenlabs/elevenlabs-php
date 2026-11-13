<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Represents a single voice part of a multi-voice message.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationHistoryMultivoiceMessagePartModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('text', required: true)]
  public string $text;

  #[JsonProperty('voice_label', required: true)]
  public ?string $voiceLabel;

  #[JsonProperty('time_in_call_secs', required: true)]
  public ?int $timeInCallSecs;

  /**
   * @param array{
   *   text: string,
   *   voiceLabel: ?string,
   *   timeInCallSecs: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->voiceLabel = $values['voiceLabel'];
    $this->timeInCallSecs = $values['timeInCallSecs'];

    $this->_dirtyFields = [
      'text' => true,
      'voice_label' => true,
      'time_in_call_secs' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'voice_label',
      'contents' => $this->voiceLabel
    ];

    $parts[] = [
      'name' => 'time_in_call_secs',
      'contents' => (string) $this->timeInCallSecs
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
