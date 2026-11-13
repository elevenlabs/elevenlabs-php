<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Information about the source of conversation initiation
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationInitiationSourceInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationInitiationSource>
   * Source of the conversation initiation
   */
  #[JsonProperty('source')]
  public ?string $source;

  /**
   * The SDK version number
   */
  #[JsonProperty('version')]
  public ?string $version;

  /**
   * @param array{
   *   source?: ?value-of<\ElevenLabs\Types\ConversationInitiationSource>,
   *   version?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->source = $values['source'] ?? null;
    $this->version = $values['version'] ?? null;

    if (array_key_exists('source', $values)) {
      $this->_dirtyFields['source'] = true;
    }
    if (array_key_exists('version', $values)) {
      $this->_dirtyFields['version'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->source !== null) {
      $parts[] = [
        'name' => 'source',
        'contents' => $this->source
      ];
    }

    if ($this->version !== null) {
      $parts[] = [
        'name' => 'version',
        'contents' => $this->version
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->version, 'version', maxLength: 50);
  }
}
