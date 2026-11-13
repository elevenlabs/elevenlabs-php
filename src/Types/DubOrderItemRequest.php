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
class DubOrderItemRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\DubOrderItemRequestKind>
   * The type of order item.
   */
  #[JsonProperty('kind')]
  public ?string $kind;

  #[JsonProperty('media_id', required: true)]
  public string $mediaId;

  /**
   * The language code of the source media (e.g. 'en', 'es').
   */
  #[JsonProperty('source_language', required: true)]
  public string $sourceLanguage;

  /**
   * @var string[]
   * List of target language codes to dub the media into.
   */
  #[JsonProperty('destination_languages', required: true), ArrayType(['string'])]
  public array $destinationLanguages;

  /**
   * Whether to generate captions for the dubbed outputs.
   */
  #[JsonProperty('include_captions', required: true)]
  public bool $includeCaptions;

  /**
   * Whether to generate captions for the source language.
   */
  #[JsonProperty('include_source_captions', required: true)]
  public bool $includeSourceCaptions;

  /**
   * Optional free-text instructions for the dubbing team.
   */
  #[JsonProperty('instructions')]
  public ?string $instructions;

  /**
   * Whether captions should use SDH format, which includes descriptions for deaf and hard-of-hearing viewers.
   */
  #[JsonProperty('captions_sdh')]
  public ?bool $captionsSdh;

  /**
   * @param array{
   *   mediaId: string,
   *   sourceLanguage: string,
   *   destinationLanguages: string[],
   *   includeCaptions: bool,
   *   includeSourceCaptions: bool,
   *   kind?: ?value-of<\ElevenLabs\Types\DubOrderItemRequestKind>,
   *   instructions?: ?string,
   *   captionsSdh?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->kind = $values['kind'] ?? 'dub';
    $this->mediaId = $values['mediaId'];
    $this->sourceLanguage = $values['sourceLanguage'];
    $this->destinationLanguages = $values['destinationLanguages'];
    $this->includeCaptions = $values['includeCaptions'];
    $this->includeSourceCaptions = $values['includeSourceCaptions'];
    $this->instructions = $values['instructions'] ?? null;
    $this->captionsSdh = $values['captionsSdh'] ?? null;

    $this->_dirtyFields = [
      'media_id' => true,
      'source_language' => true,
      'destination_languages' => true,
      'include_captions' => true,
      'include_source_captions' => true
    ];
    if (array_key_exists('kind', $values)) {
      $this->_dirtyFields['kind'] = true;
    }
    if (array_key_exists('instructions', $values)) {
      $this->_dirtyFields['instructions'] = true;
    }
    if (array_key_exists('captionsSdh', $values)) {
      $this->_dirtyFields['captions_sdh'] = true;
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

    $parts[] = [
      'name' => 'media_id',
      'contents' => $this->mediaId
    ];

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

    $parts[] = [
      'name' => 'include_captions',
      'contents' => $this->includeCaptions ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'include_source_captions',
      'contents' => $this->includeSourceCaptions ? 'true' : 'false'
    ];

    if ($this->instructions !== null) {
      $parts[] = [
        'name' => 'instructions',
        'contents' => $this->instructions
      ];
    }

    if ($this->captionsSdh !== null) {
      $parts[] = [
        'name' => 'captions_sdh',
        'contents' => $this->captionsSdh ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->mediaId, 'media_id', pattern: '^prodmedia_[a-z0-9]{26}$');
  }
}
