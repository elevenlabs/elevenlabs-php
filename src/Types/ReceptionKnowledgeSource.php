<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A file or web page the receptionists learn from.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionKnowledgeSource extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\KnowledgeSourceType>
   * Type of knowledge source.
   */
  #[JsonProperty('source_type')]
  public ?string $sourceType;

  /**
   * The page or site URL for 'url' sources.
   */
  #[JsonProperty('source_url')]
  public ?string $sourceUrl;

  /**
   * When the URL was last read, as a Unix timestamp in seconds.
   */
  #[JsonProperty('last_scraped_at_unix')]
  public ?int $lastScrapedAtUnix;

  /**
   * The uploaded file's name for 'file' sources; empty for URLs.
   */
  #[JsonProperty('original_filename')]
  public ?string $originalFilename;

  /**
   * The uploaded file's MIME type; empty for URLs.
   */
  #[JsonProperty('content_type')]
  public ?string $contentType;

  /**
   * The uploaded file's size in bytes; 0 for URLs.
   */
  #[JsonProperty('file_size_bytes')]
  public ?int $fileSizeBytes;

  /**
   * @var ?value-of<\ElevenLabs\Types\KnowledgeSourceStatus>
   * Processing status for knowledge sources.
   *
   * - `processing`: the file or site is being read.
   * - `ready`: done; the results are available.
   * - `error`: it failed and can be retried.
   *
   * See `progress` for detail.
   */
  #[JsonProperty('status')]
  public ?string $status;

  /**
   * Why processing failed, when status is 'error'.
   */
  #[JsonProperty('error_message')]
  public ?string $errorMessage;

  /**
   * @var ?value-of<\ElevenLabs\Types\IngestFailure>
   * Machine-readable cause of the failure, when status is 'error'.
   */
  #[JsonProperty('failure_reason')]
  public ?string $failureReason;

  /**
   * Whether the whole site was crawled rather than the single page at source_url.
   */
  #[JsonProperty('crawl_entire_site')]
  public ?bool $crawlEntireSite;

  /**
   * How many pages were read for 'url' sources.
   */
  #[JsonProperty('scraped_pages_count')]
  public ?int $scrapedPagesCount;

  /**
   * A short plain-text preview of the content.
   */
  #[JsonProperty('content_preview')]
  public ?string $contentPreview;

  /**
   * When processing started, as a Unix timestamp in seconds.
   */
  #[JsonProperty('processing_started_at_unix')]
  public ?int $processingStartedAtUnix;

  /**
   * The knowledge source's ID.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * Unix timestamp (seconds since epoch)
   */
  #[JsonProperty('created_at_unix')]
  public ?int $createdAtUnix;

  /**
   * Unix timestamp (seconds since epoch)
   */
  #[JsonProperty('updated_at_unix')]
  public ?int $updatedAtUnix;

  /**
   * @param array{
   *   id: string,
   *   sourceType?: ?value-of<\ElevenLabs\Types\KnowledgeSourceType>,
   *   sourceUrl?: ?string,
   *   lastScrapedAtUnix?: ?int,
   *   originalFilename?: ?string,
   *   contentType?: ?string,
   *   fileSizeBytes?: ?int,
   *   status?: ?value-of<\ElevenLabs\Types\KnowledgeSourceStatus>,
   *   errorMessage?: ?string,
   *   failureReason?: ?value-of<\ElevenLabs\Types\IngestFailure>,
   *   crawlEntireSite?: ?bool,
   *   scrapedPagesCount?: ?int,
   *   contentPreview?: ?string,
   *   processingStartedAtUnix?: ?int,
   *   createdAtUnix?: ?int,
   *   updatedAtUnix?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->sourceType = $values['sourceType'] ?? null;
    $this->sourceUrl = $values['sourceUrl'] ?? null;
    $this->lastScrapedAtUnix = $values['lastScrapedAtUnix'] ?? null;
    $this->originalFilename = $values['originalFilename'] ?? null;
    $this->contentType = $values['contentType'] ?? null;
    $this->fileSizeBytes = $values['fileSizeBytes'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->errorMessage = $values['errorMessage'] ?? null;
    $this->failureReason = $values['failureReason'] ?? null;
    $this->crawlEntireSite = $values['crawlEntireSite'] ?? null;
    $this->scrapedPagesCount = $values['scrapedPagesCount'] ?? null;
    $this->contentPreview = $values['contentPreview'] ?? null;
    $this->processingStartedAtUnix = $values['processingStartedAtUnix'] ?? null;
    $this->id = $values['id'];
    $this->createdAtUnix = $values['createdAtUnix'] ?? null;
    $this->updatedAtUnix = $values['updatedAtUnix'] ?? null;

    $this->_dirtyFields = [
      'id' => true
    ];
    if (array_key_exists('sourceType', $values)) {
      $this->_dirtyFields['source_type'] = true;
    }
    if (array_key_exists('sourceUrl', $values)) {
      $this->_dirtyFields['source_url'] = true;
    }
    if (array_key_exists('lastScrapedAtUnix', $values)) {
      $this->_dirtyFields['last_scraped_at_unix'] = true;
    }
    if (array_key_exists('originalFilename', $values)) {
      $this->_dirtyFields['original_filename'] = true;
    }
    if (array_key_exists('contentType', $values)) {
      $this->_dirtyFields['content_type'] = true;
    }
    if (array_key_exists('fileSizeBytes', $values)) {
      $this->_dirtyFields['file_size_bytes'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('errorMessage', $values)) {
      $this->_dirtyFields['error_message'] = true;
    }
    if (array_key_exists('failureReason', $values)) {
      $this->_dirtyFields['failure_reason'] = true;
    }
    if (array_key_exists('crawlEntireSite', $values)) {
      $this->_dirtyFields['crawl_entire_site'] = true;
    }
    if (array_key_exists('scrapedPagesCount', $values)) {
      $this->_dirtyFields['scraped_pages_count'] = true;
    }
    if (array_key_exists('contentPreview', $values)) {
      $this->_dirtyFields['content_preview'] = true;
    }
    if (array_key_exists('processingStartedAtUnix', $values)) {
      $this->_dirtyFields['processing_started_at_unix'] = true;
    }
    if (array_key_exists('createdAtUnix', $values)) {
      $this->_dirtyFields['created_at_unix'] = true;
    }
    if (array_key_exists('updatedAtUnix', $values)) {
      $this->_dirtyFields['updated_at_unix'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->sourceType !== null) {
      $parts[] = [
        'name' => 'source_type',
        'contents' => $this->sourceType
      ];
    }

    if ($this->sourceUrl !== null) {
      $parts[] = [
        'name' => 'source_url',
        'contents' => $this->sourceUrl
      ];
    }

    if ($this->lastScrapedAtUnix !== null) {
      $parts[] = [
        'name' => 'last_scraped_at_unix',
        'contents' => (string) $this->lastScrapedAtUnix
      ];
    }

    if ($this->originalFilename !== null) {
      $parts[] = [
        'name' => 'original_filename',
        'contents' => $this->originalFilename
      ];
    }

    if ($this->contentType !== null) {
      $parts[] = [
        'name' => 'content_type',
        'contents' => $this->contentType
      ];
    }

    if ($this->fileSizeBytes !== null) {
      $parts[] = [
        'name' => 'file_size_bytes',
        'contents' => (string) $this->fileSizeBytes
      ];
    }

    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    if ($this->errorMessage !== null) {
      $parts[] = [
        'name' => 'error_message',
        'contents' => $this->errorMessage
      ];
    }

    if ($this->failureReason !== null) {
      $parts[] = [
        'name' => 'failure_reason',
        'contents' => $this->failureReason
      ];
    }

    if ($this->crawlEntireSite !== null) {
      $parts[] = [
        'name' => 'crawl_entire_site',
        'contents' => $this->crawlEntireSite ? 'true' : 'false'
      ];
    }

    if ($this->scrapedPagesCount !== null) {
      $parts[] = [
        'name' => 'scraped_pages_count',
        'contents' => (string) $this->scrapedPagesCount
      ];
    }

    if ($this->contentPreview !== null) {
      $parts[] = [
        'name' => 'content_preview',
        'contents' => $this->contentPreview
      ];
    }

    if ($this->processingStartedAtUnix !== null) {
      $parts[] = [
        'name' => 'processing_started_at_unix',
        'contents' => (string) $this->processingStartedAtUnix
      ];
    }

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    if ($this->createdAtUnix !== null) {
      $parts[] = [
        'name' => 'created_at_unix',
        'contents' => (string) $this->createdAtUnix
      ];
    }

    if ($this->updatedAtUnix !== null) {
      $parts[] = [
        'name' => 'updated_at_unix',
        'contents' => (string) $this->updatedAtUnix
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
