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
class SpeechHistoryItemResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the history item.
   */
  #[JsonProperty('history_item_id', required: true)]
  public string $historyItemId;

  /**
   * The ID of the request.
   */
  #[JsonProperty('request_id')]
  public ?string $requestId;

  /**
   * The ID of the voice used.
   */
  #[JsonProperty('voice_id')]
  public ?string $voiceId;

  /**
   * The ID of the model.
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * The name of the voice.
   */
  #[JsonProperty('voice_name')]
  public ?string $voiceName;

  /**
   * @var ?value-of<\ElevenLabs\Types\SpeechHistoryItemResponseVoiceCategory>
   * The category of the voice. Either 'premade', 'cloned', 'generated' or 'professional'.
   */
  #[JsonProperty('voice_category')]
  public ?string $voiceCategory;

  /**
   * The text used to generate the audio item.
   */
  #[JsonProperty('text')]
  public ?string $text;

  /**
   * Unix timestamp of when the item was created.
   */
  #[JsonProperty('date_unix', required: true)]
  public int $dateUnix;

  /**
   * The character count change from.
   */
  #[JsonProperty('character_count_change_from', required: true)]
  public int $characterCountChangeFrom;

  /**
   * The character count change to.
   */
  #[JsonProperty('character_count_change_to', required: true)]
  public int $characterCountChangeTo;

  /**
   * The content type of the generated item.
   */
  #[JsonProperty('content_type', required: true)]
  public string $contentType;

  #[JsonProperty('state', required: true)]
  public mixed $state;

  /**
   * @var array<string, mixed>|null
   * The settings of the history item.
   */
  #[JsonProperty('settings'), ArrayType(['string' => 'mixed'])]
  public ?array $settings;

  /**
   * The ID of the share link.
   */
  #[JsonProperty('share_link_id')]
  public ?string $shareLinkId;

  /**
   * @var ?value-of<\ElevenLabs\Types\SpeechHistoryItemResponseSource>
   * The source of the history item. Either TTS (text to speech), STS (speech to text), AN (audio native), Projects, Dubbing, PlayAPI, PD (pronunciation dictionary) or ConvAI (Agents Platform).
   */
  #[JsonProperty('source')]
  public ?string $source;

  /**
   * The alignments of the history item.
   */
  #[JsonProperty('alignments')]
  public ?\ElevenLabs\Types\HistoryAlignmentsResponseModel $alignments;

  /**
   * @var \ElevenLabs\Types\DialogueInputResponseModel[]|null
   * The dialogue (voice and text pairs) used to generate the audio item. If this is set then the top level `text` and `voice_id` fields will be empty.
   */
  #[JsonProperty('dialogue'), ArrayType([\ElevenLabs\Types\DialogueInputResponseModel::class])]
  public ?array $dialogue;

  /**
   * The output format the audio was originally generated in.
   */
  #[JsonProperty('output_format')]
  public ?string $outputFormat;

  /**
   * @param array{
   *   historyItemId: string,
   *   dateUnix: int,
   *   characterCountChangeFrom: int,
   *   characterCountChangeTo: int,
   *   contentType: string,
   *   state: mixed,
   *   requestId?: ?string,
   *   voiceId?: ?string,
   *   modelId?: ?string,
   *   voiceName?: ?string,
   *   voiceCategory?: ?value-of<\ElevenLabs\Types\SpeechHistoryItemResponseVoiceCategory>,
   *   text?: ?string,
   *   settings?: array<string, mixed>|null,
   *   shareLinkId?: ?string,
   *   source?: ?value-of<\ElevenLabs\Types\SpeechHistoryItemResponseSource>,
   *   alignments?: ?\ElevenLabs\Types\HistoryAlignmentsResponseModel,
   *   dialogue?: \ElevenLabs\Types\DialogueInputResponseModel[]|null,
   *   outputFormat?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->historyItemId = $values['historyItemId'];
    $this->requestId = $values['requestId'] ?? null;
    $this->voiceId = $values['voiceId'] ?? null;
    $this->modelId = $values['modelId'] ?? null;
    $this->voiceName = $values['voiceName'] ?? null;
    $this->voiceCategory = $values['voiceCategory'] ?? null;
    $this->text = $values['text'] ?? null;
    $this->dateUnix = $values['dateUnix'];
    $this->characterCountChangeFrom = $values['characterCountChangeFrom'];
    $this->characterCountChangeTo = $values['characterCountChangeTo'];
    $this->contentType = $values['contentType'];
    $this->state = $values['state'];
    $this->settings = $values['settings'] ?? null;
    $this->shareLinkId = $values['shareLinkId'] ?? null;
    $this->source = $values['source'] ?? null;
    $this->alignments = $values['alignments'] ?? null;
    $this->dialogue = $values['dialogue'] ?? null;
    $this->outputFormat = $values['outputFormat'] ?? null;

    $this->_dirtyFields = [
      'history_item_id' => true,
      'date_unix' => true,
      'character_count_change_from' => true,
      'character_count_change_to' => true,
      'content_type' => true,
      'state' => true
    ];
    if (array_key_exists('requestId', $values)) {
      $this->_dirtyFields['request_id'] = true;
    }
    if (array_key_exists('voiceId', $values)) {
      $this->_dirtyFields['voice_id'] = true;
    }
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('voiceName', $values)) {
      $this->_dirtyFields['voice_name'] = true;
    }
    if (array_key_exists('voiceCategory', $values)) {
      $this->_dirtyFields['voice_category'] = true;
    }
    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
    if (array_key_exists('settings', $values)) {
      $this->_dirtyFields['settings'] = true;
    }
    if (array_key_exists('shareLinkId', $values)) {
      $this->_dirtyFields['share_link_id'] = true;
    }
    if (array_key_exists('source', $values)) {
      $this->_dirtyFields['source'] = true;
    }
    if (array_key_exists('alignments', $values)) {
      $this->_dirtyFields['alignments'] = true;
    }
    if (array_key_exists('dialogue', $values)) {
      $this->_dirtyFields['dialogue'] = true;
    }
    if (array_key_exists('outputFormat', $values)) {
      $this->_dirtyFields['output_format'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'history_item_id',
      'contents' => $this->historyItemId
    ];

    if ($this->requestId !== null) {
      $parts[] = [
        'name' => 'request_id',
        'contents' => $this->requestId
      ];
    }

    if ($this->voiceId !== null) {
      $parts[] = [
        'name' => 'voice_id',
        'contents' => $this->voiceId
      ];
    }

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    if ($this->voiceName !== null) {
      $parts[] = [
        'name' => 'voice_name',
        'contents' => $this->voiceName
      ];
    }

    if ($this->voiceCategory !== null) {
      $parts[] = [
        'name' => 'voice_category',
        'contents' => $this->voiceCategory
      ];
    }

    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => $this->text
      ];
    }

    $parts[] = [
      'name' => 'date_unix',
      'contents' => (string) $this->dateUnix
    ];

    $parts[] = [
      'name' => 'character_count_change_from',
      'contents' => (string) $this->characterCountChangeFrom
    ];

    $parts[] = [
      'name' => 'character_count_change_to',
      'contents' => (string) $this->characterCountChangeTo
    ];

    $parts[] = [
      'name' => 'content_type',
      'contents' => $this->contentType
    ];

    $parts[] = [
      'name' => 'state',
      'contents' => json_encode($this->state),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->settings !== null) {
      $parts[] = [
        'name' => 'settings',
        'contents' => json_encode($this->settings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->shareLinkId !== null) {
      $parts[] = [
        'name' => 'share_link_id',
        'contents' => $this->shareLinkId
      ];
    }

    if ($this->source !== null) {
      $parts[] = [
        'name' => 'source',
        'contents' => $this->source
      ];
    }

    if ($this->alignments !== null) {
      $parts[] = [
        'name' => 'alignments',
        'contents' => json_encode($this->alignments),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dialogue !== null) {
      $parts[] = [
        'name' => 'dialogue',
        'contents' => json_encode($this->dialogue),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->outputFormat !== null) {
      $parts[] = [
        'name' => 'output_format',
        'contents' => $this->outputFormat
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->alignments?->validate();
    foreach ($this->dialogue ?? [] as $item) {
      $item->validate();
    }
  }
}
