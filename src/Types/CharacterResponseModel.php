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
class CharacterResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('character_id', required: true)]
  public string $characterId;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('metadata', required: true)]
  public ?\ElevenLabs\Types\CharacterMetadataResponseModel $metadata;

  /**
   * @var string[]|null
   */
  #[JsonProperty('recommended_voice_ids'), ArrayType(['string'])]
  public ?array $recommendedVoiceIds;

  /**
   * @param array{
   *   characterId: string,
   *   name: string,
   *   metadata: ?\ElevenLabs\Types\CharacterMetadataResponseModel,
   *   recommendedVoiceIds?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->characterId = $values['characterId'];
    $this->name = $values['name'];
    $this->metadata = $values['metadata'];
    $this->recommendedVoiceIds = $values['recommendedVoiceIds'] ?? null;

    $this->_dirtyFields = [
      'character_id' => true,
      'name' => true,
      'metadata' => true
    ];
    if (array_key_exists('recommendedVoiceIds', $values)) {
      $this->_dirtyFields['recommended_voice_ids'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'character_id',
      'contents' => $this->characterId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'metadata',
      'contents' => json_encode($this->metadata),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->recommendedVoiceIds !== null) {
      foreach ($this->recommendedVoiceIds ?? [] as $item) {
        $parts[] = [
          'name' => 'recommended_voice_ids',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->metadata?->validate();
  }
}
