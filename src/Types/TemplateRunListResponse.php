<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * One page of the caller's public-API template runs, newest first.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TemplateRunListResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\TemplateRunResponse[]
   * The runs on this page, newest first. Each item has the same shape as `GET /v1/flows/templates/{template_id}/runs/{run_id}`.
   */
  #[JsonProperty('runs', required: true), ArrayType([\ElevenLabs\Types\TemplateRunResponse::class])]
  public array $runs;

  /**
   * Pass as `cursor` to fetch the next page. `null` when there is no further page.
   */
  #[JsonProperty('next_cursor', required: true)]
  public ?string $nextCursor;

  /**
   * Whether more runs exist beyond this page.
   */
  #[JsonProperty('has_more')]
  public ?bool $hasMore;

  /**
   * @param array{
   *   runs: \ElevenLabs\Types\TemplateRunResponse[],
   *   nextCursor: ?string,
   *   hasMore?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->runs = $values['runs'];
    $this->nextCursor = $values['nextCursor'];
    $this->hasMore = $values['hasMore'] ?? null;

    $this->_dirtyFields = [
      'runs' => true,
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
      'name' => 'runs',
      'contents' => json_encode($this->runs),
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
    foreach ($this->runs as $item) {
      $item->validate();
    }
  }
}
