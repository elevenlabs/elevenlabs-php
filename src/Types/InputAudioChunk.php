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
class InputAudioChunk extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('message_type')]
  public ?string $messageType;

  #[JsonProperty('audio_base_64', required: true)]
  public string $audioBase64;

  #[JsonProperty('commit')]
  public ?bool $commit;

  #[JsonProperty('previous_text')]
  public ?string $previousText;

  /**
   * @var string[]|null
   * A library of terms to recognize more accurately, supported by Scribe v3 Live models. Only set this on the first audio chunk, not as a query parameter. At most 10,000 terms are allowed, each at most 50 characters.
   */
  #[JsonProperty('keyterm_library'), ArrayType(['string'])]
  public ?array $keytermLibrary;

  /**
   * @param array{
   *   audioBase64: string,
   *   messageType?: ?string,
   *   commit?: ?bool,
   *   previousText?: ?string,
   *   keytermLibrary?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'] ?? null;
    $this->audioBase64 = $values['audioBase64'];
    $this->commit = $values['commit'] ?? null;
    $this->previousText = $values['previousText'] ?? null;
    $this->keytermLibrary = $values['keytermLibrary'] ?? null;

    $this->_dirtyFields = [
      'audio_base_64' => true
    ];
    if (array_key_exists('messageType', $values)) {
      $this->_dirtyFields['message_type'] = true;
    }
    if (array_key_exists('commit', $values)) {
      $this->_dirtyFields['commit'] = true;
    }
    if (array_key_exists('previousText', $values)) {
      $this->_dirtyFields['previous_text'] = true;
    }
    if (array_key_exists('keytermLibrary', $values)) {
      $this->_dirtyFields['keyterm_library'] = true;
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
      'name' => 'audio_base_64',
      'contents' => $this->audioBase64
    ];

    if ($this->commit !== null) {
      $parts[] = [
        'name' => 'commit',
        'contents' => $this->commit ? 'true' : 'false'
      ];
    }

    if ($this->previousText !== null) {
      $parts[] = [
        'name' => 'previous_text',
        'contents' => $this->previousText
      ];
    }

    if ($this->keytermLibrary !== null) {
      foreach ($this->keytermLibrary ?? [] as $item) {
        $parts[] = [
          'name' => 'keyterm_library',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
