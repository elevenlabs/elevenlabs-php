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
class DubbingTranscriptsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\DubbingTranscriptsResponseModelTranscriptFormat>
   */
  #[JsonProperty('transcript_format', required: true)]
  public string $transcriptFormat;

  #[JsonProperty('srt')]
  public ?string $srt;

  #[JsonProperty('webvtt')]
  public ?string $webvtt;

  #[JsonProperty('json')]
  public ?\ElevenLabs\Types\DubbingTranscript $json;

  /**
   * @param array{
   *   transcriptFormat: value-of<\ElevenLabs\Types\DubbingTranscriptsResponseModelTranscriptFormat>,
   *   srt?: ?string,
   *   webvtt?: ?string,
   *   json?: ?\ElevenLabs\Types\DubbingTranscript,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->transcriptFormat = $values['transcriptFormat'];
    $this->srt = $values['srt'] ?? null;
    $this->webvtt = $values['webvtt'] ?? null;
    $this->json = $values['json'] ?? null;

    $this->_dirtyFields = [
      'transcript_format' => true
    ];
    if (array_key_exists('srt', $values)) {
      $this->_dirtyFields['srt'] = true;
    }
    if (array_key_exists('webvtt', $values)) {
      $this->_dirtyFields['webvtt'] = true;
    }
    if (array_key_exists('json', $values)) {
      $this->_dirtyFields['json'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'transcript_format',
      'contents' => $this->transcriptFormat
    ];

    if ($this->srt !== null) {
      $parts[] = [
        'name' => 'srt',
        'contents' => $this->srt
      ];
    }

    if ($this->webvtt !== null) {
      $parts[] = [
        'name' => 'webvtt',
        'contents' => $this->webvtt
      ];
    }

    if ($this->json !== null) {
      $parts[] = [
        'name' => 'json',
        'contents' => json_encode($this->json),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->json?->validate();
  }
}
