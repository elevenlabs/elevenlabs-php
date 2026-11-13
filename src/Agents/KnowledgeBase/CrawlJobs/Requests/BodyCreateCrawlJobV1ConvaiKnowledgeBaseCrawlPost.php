<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\CrawlJobs\Requests;

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
class BodyCreateCrawlJobV1ConvaiKnowledgeBaseCrawlPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * URL to a page of documentation that the agent will have access to in order to interact with users.
   */
  #[JsonProperty('url', required: true)]
  public string $url;

  /**
   * Deprecated - this field is a no-op and will be removed in a future version.
   */
  #[JsonProperty('max_depth')]
  public ?int $maxDepth;

  /**
   * Maximum number of pages to crawl (1-10,000), defaults to 1000.
   */
  #[JsonProperty('max_pages')]
  public ?int $maxPages;

  /**
   * If set, only URLs that match this pattern are included.
   */
  #[JsonProperty('pattern')]
  public ?string $pattern;

  /**
   * @var string[]|null
   * If set, URLs that match any of these patterns are skipped, even if they match `pattern`.
   */
  #[JsonProperty('exclude_patterns'), ArrayType(['string'])]
  public ?array $excludePatterns;

  /**
   * @var string[]|null
   * List of URLs to crawl from sitemap (optional, overrides automatic URL discovery).
   */
  #[JsonProperty('sitemap_urls'), ArrayType(['string'])]
  public ?array $sitemapUrls;

  /**
   * If set, the created document or folder will be placed inside the given folder.
   */
  #[JsonProperty('parent_folder_id')]
  public ?string $parentFolderId;

  /**
   * Whether to enable auto-sync for this URL document.
   */
  #[JsonProperty('enable_auto_sync')]
  public ?bool $enableAutoSync;

  /**
   * Whether to automatically remove the document if the URL becomes unavailable. Only applicable when auto-sync is enabled.
   */
  #[JsonProperty('auto_remove')]
  public ?bool $autoRemove;

  /**
   * Automatically discover and add new pages during auto-sync: pages linked from already-crawled pages for website crawls, or new sitemap entries matching `pattern` and `exclude_patterns` for sitemap crawls. Requires enable_auto_sync=true.
   */
  #[JsonProperty('auto_discover')]
  public ?bool $autoDiscover;

  /**
   * Minimum frequency (in days) at which the underlying eligible documents are refreshed. The actual interval may be shorter, never longer. Defaults to 7, tightened to the parent folder's frequency if that is stricter. Only applicable when auto-sync is enabled.
   */
  #[JsonProperty('minimum_frequency_days')]
  public ?int $minimumFrequencyDays;

  /**
   * @param array{
   *   url: string,
   *   maxDepth?: ?int,
   *   maxPages?: ?int,
   *   pattern?: ?string,
   *   excludePatterns?: string[]|null,
   *   sitemapUrls?: string[]|null,
   *   parentFolderId?: ?string,
   *   enableAutoSync?: ?bool,
   *   autoRemove?: ?bool,
   *   autoDiscover?: ?bool,
   *   minimumFrequencyDays?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->url = $values['url'];
    $this->maxDepth = $values['maxDepth'] ?? null;
    $this->maxPages = $values['maxPages'] ?? null;
    $this->pattern = $values['pattern'] ?? null;
    $this->excludePatterns = $values['excludePatterns'] ?? null;
    $this->sitemapUrls = $values['sitemapUrls'] ?? null;
    $this->parentFolderId = $values['parentFolderId'] ?? null;
    $this->enableAutoSync = $values['enableAutoSync'] ?? null;
    $this->autoRemove = $values['autoRemove'] ?? null;
    $this->autoDiscover = $values['autoDiscover'] ?? null;
    $this->minimumFrequencyDays = $values['minimumFrequencyDays'] ?? null;

    $this->_dirtyFields = [
      'url' => true
    ];
    if (array_key_exists('maxDepth', $values)) {
      $this->_dirtyFields['max_depth'] = true;
    }
    if (array_key_exists('maxPages', $values)) {
      $this->_dirtyFields['max_pages'] = true;
    }
    if (array_key_exists('pattern', $values)) {
      $this->_dirtyFields['pattern'] = true;
    }
    if (array_key_exists('excludePatterns', $values)) {
      $this->_dirtyFields['exclude_patterns'] = true;
    }
    if (array_key_exists('sitemapUrls', $values)) {
      $this->_dirtyFields['sitemap_urls'] = true;
    }
    if (array_key_exists('parentFolderId', $values)) {
      $this->_dirtyFields['parent_folder_id'] = true;
    }
    if (array_key_exists('enableAutoSync', $values)) {
      $this->_dirtyFields['enable_auto_sync'] = true;
    }
    if (array_key_exists('autoRemove', $values)) {
      $this->_dirtyFields['auto_remove'] = true;
    }
    if (array_key_exists('autoDiscover', $values)) {
      $this->_dirtyFields['auto_discover'] = true;
    }
    if (array_key_exists('minimumFrequencyDays', $values)) {
      $this->_dirtyFields['minimum_frequency_days'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'url',
      'contents' => $this->url
    ];

    if ($this->maxDepth !== null) {
      $parts[] = [
        'name' => 'max_depth',
        'contents' => (string) $this->maxDepth
      ];
    }

    if ($this->maxPages !== null) {
      $parts[] = [
        'name' => 'max_pages',
        'contents' => (string) $this->maxPages
      ];
    }

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

    if ($this->sitemapUrls !== null) {
      foreach ($this->sitemapUrls ?? [] as $item) {
        $parts[] = [
          'name' => 'sitemap_urls',
          'contents' => $item
        ];
      }
    }

    if ($this->parentFolderId !== null) {
      $parts[] = [
        'name' => 'parent_folder_id',
        'contents' => $this->parentFolderId
      ];
    }

    if ($this->enableAutoSync !== null) {
      $parts[] = [
        'name' => 'enable_auto_sync',
        'contents' => $this->enableAutoSync ? 'true' : 'false'
      ];
    }

    if ($this->autoRemove !== null) {
      $parts[] = [
        'name' => 'auto_remove',
        'contents' => $this->autoRemove ? 'true' : 'false'
      ];
    }

    if ($this->autoDiscover !== null) {
      $parts[] = [
        'name' => 'auto_discover',
        'contents' => $this->autoDiscover ? 'true' : 'false'
      ];
    }

    if ($this->minimumFrequencyDays !== null) {
      $parts[] = [
        'name' => 'minimum_frequency_days',
        'contents' => (string) $this->minimumFrequencyDays
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->maxPages, 'max_pages', min: 1, max: 10000);
    Validator::validateString($this->pattern, 'pattern', maxLength: 2048);
    Validator::validateArray($this->excludePatterns, 'exclude_patterns', maxItems: 50);
    Validator::validateArray($this->sitemapUrls, 'sitemap_urls', maxItems: 10000);
    Validator::validateNumber(
      $this->minimumFrequencyDays,
      'minimum_frequency_days',
      min: 1,
      max: 180
    );
  }
}
