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
class ListCrawlJobsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\GetCrawlJobResponseModel[]
   */
  #[
    JsonProperty('crawl_jobs', required: true),
    ArrayType([\ElevenLabs\Types\GetCrawlJobResponseModel::class])
  ]
  public array $crawlJobs;

  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  /**
   * @param array{
   *   crawlJobs: \ElevenLabs\Types\GetCrawlJobResponseModel[],
   *   nextCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->crawlJobs = $values['crawlJobs'];
    $this->nextCursor = $values['nextCursor'] ?? null;

    $this->_dirtyFields = [
      'crawl_jobs' => true
    ];
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'crawl_jobs',
      'contents' => json_encode($this->crawlJobs),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->crawlJobs as $item) {
      $item->validate();
    }
  }
}
