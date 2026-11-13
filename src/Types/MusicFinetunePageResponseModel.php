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
class MusicFinetunePageResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\MusicFinetuneResponseModel[]
   * The finetunes in this page.
   */
  #[
    JsonProperty('finetunes', required: true),
    ArrayType([\ElevenLabs\Types\MusicFinetuneResponseModel::class])
  ]
  public array $finetunes;

  /**
   * Cursor to pass as `cursor` to fetch the next page; `null` when there are no more results.
   */
  #[JsonProperty('next_cursor', required: true)]
  public ?string $nextCursor;

  /**
   * Whether more finetunes are available beyond this page.
   */
  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * @param array{
   *   finetunes: \ElevenLabs\Types\MusicFinetuneResponseModel[],
   *   nextCursor: ?string,
   *   hasMore: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->finetunes = $values['finetunes'];
    $this->nextCursor = $values['nextCursor'];
    $this->hasMore = $values['hasMore'];

    $this->_dirtyFields = [
      'finetunes' => true,
      'next_cursor' => true,
      'has_more' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'finetunes',
      'contents' => json_encode($this->finetunes),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'next_cursor',
      'contents' => $this->nextCursor
    ];

    $parts[] = [
      'name' => 'has_more',
      'contents' => $this->hasMore ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->finetunes as $item) {
      $item->validate();
    }
  }
}
