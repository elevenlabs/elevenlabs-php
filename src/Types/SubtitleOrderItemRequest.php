<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

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
class SubtitleOrderItemRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SubtitleOrderItemRequestKind>
   * The type of order item.
   */
  #[JsonProperty('kind')]
  public ?string $kind;

  /**
   * @var string[]
   * The IDs of the uploaded media files to generate subtitles for.
   */
  #[JsonProperty('media_ids', required: true), ArrayType(['string'])]
  public array $mediaIds;

  /**
   * The language code of the source media (e.g. 'en', 'es').
   */
  #[JsonProperty('source_language', required: true)]
  public string $sourceLanguage;

  /**
   * @var string[]
   * List of target language codes. Subtitles will be generated for each media file in each destination language.
   */
  #[JsonProperty('destination_languages', required: true), ArrayType(['string'])]
  public array $destinationLanguages;

  #[JsonProperty('cue_options')]
  public ?\ElevenLabs\Types\CueOptionsRequest $cueOptions;

  /**
   * Whether subtitles should use SDH format, which includes descriptions for deaf and hard-of-hearing viewers.
   */
  #[JsonProperty('sdh')]
  public ?bool $sdh;

  /**
   * Optional free-text instructions for the subtitling team.
   */
  #[JsonProperty('instructions')]
  public ?string $instructions;

  /**
   * @param array{
   *   mediaIds: string[],
   *   sourceLanguage: string,
   *   destinationLanguages: string[],
   *   kind?: ?value-of<\ElevenLabs\Types\SubtitleOrderItemRequestKind>,
   *   cueOptions?: ?\ElevenLabs\Types\CueOptionsRequest,
   *   sdh?: ?bool,
   *   instructions?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->kind = $values['kind'] ?? 'subtitles';
    $this->mediaIds = $values['mediaIds'];
    $this->sourceLanguage = $values['sourceLanguage'];
    $this->destinationLanguages = $values['destinationLanguages'];
    $this->cueOptions = $values['cueOptions'] ?? null;
    $this->sdh = $values['sdh'] ?? null;
    $this->instructions = $values['instructions'] ?? null;

    $this->_dirtyFields = [
      'media_ids' => true,
      'source_language' => true,
      'destination_languages' => true
    ];
    if (array_key_exists('kind', $values)) {
      $this->_dirtyFields['kind'] = true;
    }
    if (array_key_exists('cueOptions', $values)) {
      $this->_dirtyFields['cue_options'] = true;
    }
    if (array_key_exists('sdh', $values)) {
      $this->_dirtyFields['sdh'] = true;
    }
    if (array_key_exists('instructions', $values)) {
      $this->_dirtyFields['instructions'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->kind !== null) {
      $parts[] = [
        'name' => 'kind',
        'contents' => $this->kind
      ];
    }

    foreach ($this->mediaIds as $item) {
      $parts[] = [
        'name' => 'media_ids',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'source_language',
      'contents' => $this->sourceLanguage
    ];

    foreach ($this->destinationLanguages as $item) {
      $parts[] = [
        'name' => 'destination_languages',
        'contents' => $item
      ];
    }

    if ($this->cueOptions !== null) {
      $parts[] = [
        'name' => 'cue_options',
        'contents' => json_encode($this->cueOptions),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->sdh !== null) {
      $parts[] = [
        'name' => 'sdh',
        'contents' => $this->sdh ? 'true' : 'false'
      ];
    }

    if ($this->instructions !== null) {
      $parts[] = [
        'name' => 'instructions',
        'contents' => $this->instructions
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->mediaIds, 'media_ids', maxItems: 50);
    $this->cueOptions?->validate();
  }
}
