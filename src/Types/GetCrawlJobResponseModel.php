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
class GetCrawlJobResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\CrawlType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('seed_url', required: true)]
  public string $seedUrl;

  #[JsonProperty('pattern')]
  public ?string $pattern;

  /**
   * @var string[]|null
   * URLs matching any of these patterns are skipped, even if they match `pattern`.
   */
  #[JsonProperty('exclude_patterns'), ArrayType(['string'])]
  public ?array $excludePatterns;

  #[JsonProperty('max_pages', required: true)]
  public int $maxPages;

  /**
   * Whether to automatically discover and enqueue additional pages found while crawling.
   */
  #[JsonProperty('auto_discover')]
  public ?bool $autoDiscover;

  /**
   * @var ?value-of<\ElevenLabs\Types\CrawlStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  #[JsonProperty('pages_identified')]
  public ?int $pagesIdentified;

  #[JsonProperty('pages_scraped')]
  public ?int $pagesScraped;

  #[JsonProperty('pages_skipped')]
  public ?int $pagesSkipped;

  #[JsonProperty('pages_failed')]
  public ?int $pagesFailed;

  #[JsonProperty('root_folder_id', required: true)]
  public string $rootFolderId;

  #[JsonProperty('updated_at', required: true)]
  public int $updatedAt;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('created_at', required: true)]
  public int $createdAt;

  /**
   * @param array{
   *   seedUrl: string,
   *   maxPages: int,
   *   rootFolderId: string,
   *   updatedAt: int,
   *   id: string,
   *   createdAt: int,
   *   type?: ?value-of<\ElevenLabs\Types\CrawlType>,
   *   pattern?: ?string,
   *   excludePatterns?: string[]|null,
   *   autoDiscover?: ?bool,
   *   status?: ?value-of<\ElevenLabs\Types\CrawlStatus>,
   *   pagesIdentified?: ?int,
   *   pagesScraped?: ?int,
   *   pagesSkipped?: ?int,
   *   pagesFailed?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? null;
    $this->seedUrl = $values['seedUrl'];
    $this->pattern = $values['pattern'] ?? null;
    $this->excludePatterns = $values['excludePatterns'] ?? null;
    $this->maxPages = $values['maxPages'];
    $this->autoDiscover = $values['autoDiscover'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->pagesIdentified = $values['pagesIdentified'] ?? null;
    $this->pagesScraped = $values['pagesScraped'] ?? null;
    $this->pagesSkipped = $values['pagesSkipped'] ?? null;
    $this->pagesFailed = $values['pagesFailed'] ?? null;
    $this->rootFolderId = $values['rootFolderId'];
    $this->updatedAt = $values['updatedAt'];
    $this->id = $values['id'];
    $this->createdAt = $values['createdAt'];

    $this->_dirtyFields = [
      'seed_url' => true,
      'max_pages' => true,
      'root_folder_id' => true,
      'updated_at' => true,
      'id' => true,
      'created_at' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('pattern', $values)) {
      $this->_dirtyFields['pattern'] = true;
    }
    if (array_key_exists('excludePatterns', $values)) {
      $this->_dirtyFields['exclude_patterns'] = true;
    }
    if (array_key_exists('autoDiscover', $values)) {
      $this->_dirtyFields['auto_discover'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('pagesIdentified', $values)) {
      $this->_dirtyFields['pages_identified'] = true;
    }
    if (array_key_exists('pagesScraped', $values)) {
      $this->_dirtyFields['pages_scraped'] = true;
    }
    if (array_key_exists('pagesSkipped', $values)) {
      $this->_dirtyFields['pages_skipped'] = true;
    }
    if (array_key_exists('pagesFailed', $values)) {
      $this->_dirtyFields['pages_failed'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'seed_url',
      'contents' => $this->seedUrl
    ];

    if ($this->pattern !== null) {
      $parts[] = [
        'name' => 'pattern',
        'contents' => $this->pattern
      ];
    }

    if ($this->excludePatterns !== null) {
      foreach ($this->excludePatterns ?? [] as $item) {
        $parts[] = [
          'name' => 'exclude_patterns',
          'contents' => $item
        ];
      }
    }

    $parts[] = [
      'name' => 'max_pages',
      'contents' => (string) $this->maxPages
    ];

    if ($this->autoDiscover !== null) {
      $parts[] = [
        'name' => 'auto_discover',
        'contents' => $this->autoDiscover ? 'true' : 'false'
      ];
    }

    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    if ($this->pagesIdentified !== null) {
      $parts[] = [
        'name' => 'pages_identified',
        'contents' => (string) $this->pagesIdentified
      ];
    }

    if ($this->pagesScraped !== null) {
      $parts[] = [
        'name' => 'pages_scraped',
        'contents' => (string) $this->pagesScraped
      ];
    }

    if ($this->pagesSkipped !== null) {
      $parts[] = [
        'name' => 'pages_skipped',
        'contents' => (string) $this->pagesSkipped
      ];
    }

    if ($this->pagesFailed !== null) {
      $parts[] = [
        'name' => 'pages_failed',
        'contents' => (string) $this->pagesFailed
      ];
    }

    $parts[] = [
      'name' => 'root_folder_id',
      'contents' => $this->rootFolderId
    ];

    $parts[] = [
      'name' => 'updated_at',
      'contents' => (string) $this->updatedAt
    ];

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'created_at',
      'contents' => (string) $this->createdAt
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
