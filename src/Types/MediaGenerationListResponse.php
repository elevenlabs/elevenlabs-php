<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * One page of the caller's generations, newest first.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MediaGenerationListResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\MediaGenerationResponse[]
   * The generations on this page, newest first. Each item has the same shape as the corresponding GET endpoint's response.
   */
  #[
    JsonProperty('generations', required: true),
    ArrayType([\ElevenLabs\Types\MediaGenerationResponse::class])
  ]
  public array $generations;

  /**
   * Pass as `cursor` to fetch the next page. `null` when there is no further page.
   */
  #[JsonProperty('next_cursor', required: true)]
  public ?string $nextCursor;

  /**
   * Whether more generations exist beyond this page.
   */
  #[JsonProperty('has_more')]
  public ?bool $hasMore;

  /**
   * @param array{
   *   generations: \ElevenLabs\Types\MediaGenerationResponse[],
   *   nextCursor: ?string,
   *   hasMore?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->generations = $values['generations'];
    $this->nextCursor = $values['nextCursor'];
    $this->hasMore = $values['hasMore'] ?? null;

    $this->_dirtyFields = [
      'generations' => true,
      'next_cursor' => true
    ];
    if (array_key_exists('hasMore', $values)) {
      $this->_dirtyFields['has_more'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'generations',
      'contents' => json_encode($this->generations),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'next_cursor',
      'contents' => $this->nextCursor
    ];

    if ($this->hasMore !== null) {
      $parts[] = [
        'name' => 'has_more',
        'contents' => $this->hasMore ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
