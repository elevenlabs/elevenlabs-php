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
class ChapterContentBlockTtsNodeResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ChapterContentBlockTtsNodeResponseModelType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('project_voice_ref_id', required: true)]
  public string $projectVoiceRefId;

  #[JsonProperty('text', required: true)]
  public string $text;

  #[JsonProperty('voice_id')]
  public ?string $voiceId;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\ChapterContentBlockTtsNodeResponseModelType>,
   *   projectVoiceRefId: string,
   *   text: string,
   *   voiceId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->projectVoiceRefId = $values['projectVoiceRefId'];
    $this->text = $values['text'];
    $this->voiceId = $values['voiceId'] ?? null;

    $this->_dirtyFields = [
      'type' => true,
      'project_voice_ref_id' => true,
      'text' => true
    ];
    if (array_key_exists('voiceId', $values)) {
      $this->_dirtyFields['voice_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'project_voice_ref_id',
      'contents' => $this->projectVoiceRefId
    ];

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    if ($this->voiceId !== null) {
      $parts[] = [
        'name' => 'voice_id',
        'contents' => $this->voiceId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
