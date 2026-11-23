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
class MultimodalMessageText extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id')]
  public ?string $id;

  /**
   * @var ?value-of<\ElevenLabs\Types\UserMessageInputItemType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('text')]
  public ?string $text;

  #[JsonProperty('user_identifier')]
  public ?string $userIdentifier;

  /**
   * @var ?value-of<\ElevenLabs\Types\MultimodalMessageTextSourceMedium>
   */
  #[JsonProperty('source_medium')]
  public ?string $sourceMedium;

  /**
   * @param array{
   *   id?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\UserMessageInputItemType>,
   *   text?: ?string,
   *   userIdentifier?: ?string,
   *   sourceMedium?: ?value-of<\ElevenLabs\Types\MultimodalMessageTextSourceMedium>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->id = $values['id'] ?? null;
    $this->type = $values['type'] ?? 'user_message';
    $this->text = $values['text'] ?? null;
    $this->userIdentifier = $values['userIdentifier'] ?? null;
    $this->sourceMedium = $values['sourceMedium'] ?? null;

    if (array_key_exists('id', $values)) {
      $this->_dirtyFields['id'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
    if (array_key_exists('userIdentifier', $values)) {
      $this->_dirtyFields['user_identifier'] = true;
    }
    if (array_key_exists('sourceMedium', $values)) {
      $this->_dirtyFields['source_medium'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->id !== null) {
      $parts[] = [
        'name' => 'id',
        'contents' => $this->id
      ];
    }

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => $this->text
      ];
    }

    if ($this->userIdentifier !== null) {
      $parts[] = [
        'name' => 'user_identifier',
        'contents' => $this->userIdentifier
      ];
    }

    if ($this->sourceMedium !== null) {
      $parts[] = [
        'name' => 'source_medium',
        'contents' => $this->sourceMedium
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
