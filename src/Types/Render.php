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
class Render extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('version', required: true)]
  public int $version;

  #[JsonProperty('language', required: true)]
  public ?string $language;

  /**
   * @var ?value-of<\ElevenLabs\Types\RenderType>
   */
  #[JsonProperty('type', required: true)]
  public ?string $type;

  #[JsonProperty('media_ref', required: true)]
  public ?\ElevenLabs\Types\DubbingMediaReference $mediaRef;

  /**
   * @var value-of<\ElevenLabs\Types\RenderStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @param array{
   *   id: string,
   *   version: int,
   *   language: ?string,
   *   type: ?value-of<\ElevenLabs\Types\RenderType>,
   *   mediaRef: ?\ElevenLabs\Types\DubbingMediaReference,
   *   status: value-of<\ElevenLabs\Types\RenderStatus>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->version = $values['version'];
    $this->language = $values['language'];
    $this->type = $values['type'];
    $this->mediaRef = $values['mediaRef'];
    $this->status = $values['status'];

    $this->_dirtyFields = [
      'id' => true,
      'version' => true,
      'language' => true,
      'type' => true,
      'media_ref' => true,
      'status' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'version',
      'contents' => (string) $this->version
    ];

    $parts[] = [
      'name' => 'language',
      'contents' => $this->language
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'media_ref',
      'contents' => json_encode($this->mediaRef),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->mediaRef?->validate();
  }
}
