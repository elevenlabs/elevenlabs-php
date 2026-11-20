<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\KnowledgeSources\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * A web page or site to learn from.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AddUrlRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * The HTTPS page or site to read.
   */
  #[JsonProperty('url', required: true)]
  public string $url;

  /**
   * Crawl the whole site instead of only the page at url.
   */
  #[JsonProperty('crawl_entire_site')]
  public ?bool $crawlEntireSite;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   url: string,
   *   crawlEntireSite?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->url = $values['url'];
    $this->crawlEntireSite = $values['crawlEntireSite'] ?? null;

    $this->_dirtyFields = [
      'url' => true
    ];
    if (array_key_exists('crawlEntireSite', $values)) {
      $this->_dirtyFields['crawl_entire_site'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'url',
      'contents' => $this->url
    ];

    if ($this->crawlEntireSite !== null) {
      $parts[] = [
        'name' => 'crawl_entire_site',
        'contents' => $this->crawlEntireSite ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->url, 'url', minLength: 1, maxLength: 2048);
  }
}
