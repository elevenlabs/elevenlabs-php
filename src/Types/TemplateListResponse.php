<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * One page of the templates the caller can run, most recently updated first.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TemplateListResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\TemplateSummary[]
   * The templates on this page, most recently updated first. A page can hold fewer than `page_size` templates, or none at all, because templates you cannot run are filtered out after the page is read — keep paging while `has_more` is true.
   */
  #[
    JsonProperty('templates', required: true),
    ArrayType([\ElevenLabs\Types\TemplateSummary::class])
  ]
  public array $templates;

  /**
   * Pass as `cursor` to fetch the next page. `null` when there is no further page.
   */
  #[JsonProperty('next_cursor', required: true)]
  public ?string $nextCursor;

  /**
   * Whether more templates exist beyond this page.
   */
  #[JsonProperty('has_more')]
  public ?bool $hasMore;

  /**
   * @param array{
   *   templates: \ElevenLabs\Types\TemplateSummary[],
   *   nextCursor: ?string,
   *   hasMore?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->templates = $values['templates'];
    $this->nextCursor = $values['nextCursor'];
    $this->hasMore = $values['hasMore'] ?? null;

    $this->_dirtyFields = [
      'templates' => true,
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
      'name' => 'templates',
      'contents' => json_encode($this->templates),
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
    foreach ($this->templates as $item) {
      $item->validate();
    }
  }
}
