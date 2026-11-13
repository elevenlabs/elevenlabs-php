<?php

declare(strict_types=1);

namespace ElevenLabs\TextToVoice\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyCreateANewVoiceFromVoicePreviewV1TextToVoicePost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Name to use for the created voice.
   */
  #[JsonProperty('voice_name', required: true)]
  public string $voiceName;

  /**
   * Description to use for the created voice.
   */
  #[JsonProperty('voice_description', required: true)]
  public string $voiceDescription;

  /**
   * The generated_voice_id to create; obtain it from POST /v1/text-to-voice/design, POST /v1/text-to-voice/:voice_id/remix, or the response headers when generating previews.
   */
  #[JsonProperty('generated_voice_id', required: true)]
  public string $generatedVoiceId;

  /**
   * @var array<string, string>|null
   * Optional, metadata to add to the created voice. Defaults to None.
   */
  #[JsonProperty('labels'), ArrayType(['string' => 'string'])]
  public ?array $labels;

  /**
   * @var string[]|null
   * List of voice ids that the user has played but not selected. Used for RLHF.
   */
  #[JsonProperty('played_not_selected_voice_ids'), ArrayType(['string'])]
  public ?array $playedNotSelectedVoiceIds;

  /**
   * @param array{
   *   voiceName: string,
   *   voiceDescription: string,
   *   generatedVoiceId: string,
   *   labels?: array<string, string>|null,
   *   playedNotSelectedVoiceIds?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->voiceName = $values['voiceName'];
    $this->voiceDescription = $values['voiceDescription'];
    $this->generatedVoiceId = $values['generatedVoiceId'];
    $this->labels = $values['labels'] ?? null;
    $this->playedNotSelectedVoiceIds = $values['playedNotSelectedVoiceIds'] ?? null;

    $this->_dirtyFields = [
      'voice_name' => true,
      'voice_description' => true,
      'generated_voice_id' => true
    ];
    if (array_key_exists('labels', $values)) {
      $this->_dirtyFields['labels'] = true;
    }
    if (array_key_exists('playedNotSelectedVoiceIds', $values)) {
      $this->_dirtyFields['played_not_selected_voice_ids'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'voice_name',
      'contents' => $this->voiceName
    ];

    $parts[] = [
      'name' => 'voice_description',
      'contents' => $this->voiceDescription
    ];

    $parts[] = [
      'name' => 'generated_voice_id',
      'contents' => $this->generatedVoiceId
    ];

    if ($this->labels !== null) {
      $parts[] = [
        'name' => 'labels',
        'contents' => json_encode($this->labels),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->playedNotSelectedVoiceIds !== null) {
      foreach ($this->playedNotSelectedVoiceIds ?? [] as $item) {
        $parts[] = [
          'name' => 'played_not_selected_voice_ids',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString(
      $this->voiceDescription,
      'voice_description',
      minLength: 20,
      maxLength: 1000
    );
  }
}
