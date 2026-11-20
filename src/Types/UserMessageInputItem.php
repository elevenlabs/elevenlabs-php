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
class UserMessageInputItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\UserMessageInputItemType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @var \ElevenLabs\Types\UserMessageInputItemContentItem[]
   * The parts of the message: at most one text part and up to 5 file parts.
   */
  #[
    JsonProperty('content', required: true),
    ArrayType([\ElevenLabs\Types\UserMessageInputItemContentItem::class])
  ]
  public array $content;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\UserMessageInputItemType>,
   *   content: \ElevenLabs\Types\UserMessageInputItemContentItem[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->content = $values['content'];

    $this->_dirtyFields = [
      'type' => true,
      'content' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'content',
      'contents' => json_encode($this->content),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->content, 'content', minItems: 1, maxItems: 6);
  }
}
