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
class VoicesNotPermittedWarning extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\VoicesNotPermittedWarningType>
   * Identifies this warning; branch on it to read the other fields.
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @var string[]
   * Speakers whose voices were not permitted for cloning. The dub used a replacement voice for each of them; all other speakers are unaffected.
   */
  #[JsonProperty('speaker_ids', required: true), ArrayType(['string'])]
  public array $speakerIds;

  /**
   * Human-readable description of the warning, for display. The wording may change at any time, so we recommend branching on `type` instead.
   */
  #[JsonProperty('message', required: true)]
  public string $message;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\VoicesNotPermittedWarningType>,
   *   speakerIds: string[],
   *   message: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->speakerIds = $values['speakerIds'];
    $this->message = $values['message'];

    $this->_dirtyFields = [
      'type' => true,
      'speaker_ids' => true,
      'message' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    foreach ($this->speakerIds as $item) {
      $parts[] = [
        'name' => 'speaker_ids',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'message',
      'contents' => $this->message
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
