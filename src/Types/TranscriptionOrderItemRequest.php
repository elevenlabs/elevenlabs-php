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
class TranscriptionOrderItemRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TranscriptionOrderItemRequestKind>
   * The type of order item.
   */
  #[JsonProperty('kind')]
  public ?string $kind;

  /**
   * @var string[]
   * The IDs of the uploaded media files to transcribe.
   */
  #[JsonProperty('media_ids', required: true), ArrayType(['string'])]
  public array $mediaIds;

  /**
   * The language code of the source media (e.g. 'en', 'es').
   */
  #[JsonProperty('source_language', required: true)]
  public string $sourceLanguage;

  /**
   * Whether to transcribe every word exactly, including filler words.
   */
  #[JsonProperty('verbatim')]
  public ?bool $verbatim;

  /**
   * Optional free-text instructions for the transcription team.
   */
  #[JsonProperty('instructions')]
  public ?string $instructions;

  /**
   * @param array{
   *   mediaIds: string[],
   *   sourceLanguage: string,
   *   kind?: ?value-of<\ElevenLabs\Types\TranscriptionOrderItemRequestKind>,
   *   verbatim?: ?bool,
   *   instructions?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->kind = $values['kind'] ?? 'transcription';
    $this->mediaIds = $values['mediaIds'];
    $this->sourceLanguage = $values['sourceLanguage'];
    $this->verbatim = $values['verbatim'] ?? null;
    $this->instructions = $values['instructions'] ?? null;

    $this->_dirtyFields = [
      'media_ids' => true,
      'source_language' => true
    ];
    if (array_key_exists('kind', $values)) {
      $this->_dirtyFields['kind'] = true;
    }
    if (array_key_exists('verbatim', $values)) {
      $this->_dirtyFields['verbatim'] = true;
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

    if ($this->verbatim !== null) {
      $parts[] = [
        'name' => 'verbatim',
        'contents' => $this->verbatim ? 'true' : 'false'
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
  }
}
