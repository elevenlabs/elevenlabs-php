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
class CharacterMetadataResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('description')]
  public ?string $description;

  #[JsonProperty('sample_message')]
  public ?string $sampleMessage;

  #[JsonProperty('voice_creation_prompt_suggestion')]
  public ?string $voiceCreationPromptSuggestion;

  /**
   * @var ?value-of<\ElevenLabs\Types\CharacterGender>
   */
  #[JsonProperty('gender')]
  public ?string $gender;

  /**
   * @var ?value-of<\ElevenLabs\Types\CharacterAge>
   */
  #[JsonProperty('age')]
  public ?string $age;

  #[JsonProperty('accent')]
  public ?string $accent;

  /**
   * @var ?value-of<\ElevenLabs\Types\CharacterRole>
   */
  #[JsonProperty('role')]
  public ?string $role;

  /**
   * @param array{
   *   description?: ?string,
   *   sampleMessage?: ?string,
   *   voiceCreationPromptSuggestion?: ?string,
   *   gender?: ?value-of<\ElevenLabs\Types\CharacterGender>,
   *   age?: ?value-of<\ElevenLabs\Types\CharacterAge>,
   *   accent?: ?string,
   *   role?: ?value-of<\ElevenLabs\Types\CharacterRole>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->description = $values['description'] ?? null;
    $this->sampleMessage = $values['sampleMessage'] ?? null;
    $this->voiceCreationPromptSuggestion = $values['voiceCreationPromptSuggestion'] ?? null;
    $this->gender = $values['gender'] ?? null;
    $this->age = $values['age'] ?? null;
    $this->accent = $values['accent'] ?? null;
    $this->role = $values['role'] ?? null;

    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('sampleMessage', $values)) {
      $this->_dirtyFields['sample_message'] = true;
    }
    if (array_key_exists('voiceCreationPromptSuggestion', $values)) {
      $this->_dirtyFields['voice_creation_prompt_suggestion'] = true;
    }
    if (array_key_exists('gender', $values)) {
      $this->_dirtyFields['gender'] = true;
    }
    if (array_key_exists('age', $values)) {
      $this->_dirtyFields['age'] = true;
    }
    if (array_key_exists('accent', $values)) {
      $this->_dirtyFields['accent'] = true;
    }
    if (array_key_exists('role', $values)) {
      $this->_dirtyFields['role'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->sampleMessage !== null) {
      $parts[] = [
        'name' => 'sample_message',
        'contents' => $this->sampleMessage
      ];
    }

    if ($this->voiceCreationPromptSuggestion !== null) {
      $parts[] = [
        'name' => 'voice_creation_prompt_suggestion',
        'contents' => $this->voiceCreationPromptSuggestion
      ];
    }

    if ($this->gender !== null) {
      $parts[] = [
        'name' => 'gender',
        'contents' => $this->gender
      ];
    }

    if ($this->age !== null) {
      $parts[] = [
        'name' => 'age',
        'contents' => $this->age
      ];
    }

    if ($this->accent !== null) {
      $parts[] = [
        'name' => 'accent',
        'contents' => $this->accent
      ];
    }

    if ($this->role !== null) {
      $parts[] = [
        'name' => 'role',
        'contents' => $this->role
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
