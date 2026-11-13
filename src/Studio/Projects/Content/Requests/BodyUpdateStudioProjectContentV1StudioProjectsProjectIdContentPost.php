<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Projects\Content\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyUpdateStudioProjectContentV1StudioProjectsProjectIdContentPost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * An optional URL from which we will extract content to initialize the Studio project. If this is set, 'from_url' and 'from_content' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.
   */
  #[JsonProperty('from_url')]
  public ?string $fromUrl;

  /**
   * @var ?\ElevenLabs\Utils\File
   * An optional .epub, .pdf, .txt or similar file can be provided. If provided, we will initialize the Studio project with its content. If this is set, 'from_url' and 'from_content' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.
   */
  #[JsonProperty('from_document')]
  public ?\ElevenLabs\Utils\File $fromDocument;

  /**
   *
   *     An optional content to initialize the Studio project with. If this is set, 'from_url' and 'from_document' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.
   *
   *     Example:
   *     [{"name": "Chapter A", "blocks": [{"sub_type": "p", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "A", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "B", "type": "tts_node"}]}, {"sub_type": "h1", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "C", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "D", "type": "tts_node"}]}]}, {"name": "Chapter B", "blocks": [{"sub_type": "p", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "E", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "F", "type": "tts_node"}]}, {"sub_type": "h2", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "G", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "H", "type": "tts_node"}]}]}]
   *
   */
  #[JsonProperty('from_content_json')]
  public ?string $fromContentJson;

  /**
   * Whether to auto convert the Studio project to audio or not.
   */
  #[JsonProperty('auto_convert')]
  public ?bool $autoConvert;

  /**
   * @param array{
   *   fromUrl?: ?string,
   *   fromDocument?: ?\ElevenLabs\Utils\File,
   *   fromContentJson?: ?string,
   *   autoConvert?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->fromUrl = $values['fromUrl'] ?? null;
    $this->fromDocument = $values['fromDocument'] ?? null;
    $this->fromContentJson = $values['fromContentJson'] ?? null;
    $this->autoConvert = $values['autoConvert'] ?? null;

    if (array_key_exists('fromUrl', $values)) {
      $this->_dirtyFields['from_url'] = true;
    }
    if (array_key_exists('fromDocument', $values)) {
      $this->_dirtyFields['from_document'] = true;
    }
    if (array_key_exists('fromContentJson', $values)) {
      $this->_dirtyFields['from_content_json'] = true;
    }
    if (array_key_exists('autoConvert', $values)) {
      $this->_dirtyFields['auto_convert'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->fromUrl !== null) {
      $parts[] = [
        'name' => 'from_url',
        'contents' => $this->fromUrl
      ];
    }

    if ($this->fromDocument !== null) {
      $parts[] = $this->fromDocument->toMultipartFormDataPart('from_document')->toGuzzlePart();
    }

    if ($this->fromContentJson !== null) {
      $parts[] = [
        'name' => 'from_content_json',
        'contents' => $this->fromContentJson
      ];
    }

    if ($this->autoConvert !== null) {
      $parts[] = [
        'name' => 'auto_convert',
        'contents' => $this->autoConvert ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
