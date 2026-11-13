<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Per-document timing data for one crawled page.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class InternalKbCrawlPageTiming extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('url', required: true)]
  public string $url;

  #[JsonProperty('doc_id', required: true)]
  public string $docId;

  #[JsonProperty('read_ms')]
  public ?int $readMs;

  #[JsonProperty('index_ms')]
  public ?int $indexMs;

  #[JsonProperty('html_len')]
  public ?int $htmlLen;

  #[JsonProperty('skipped')]
  public ?bool $skipped;

  #[JsonProperty('error')]
  public ?bool $error;

  /**
   * @param array{
   *   url: string,
   *   docId: string,
   *   readMs?: ?int,
   *   indexMs?: ?int,
   *   htmlLen?: ?int,
   *   skipped?: ?bool,
   *   error?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->url = $values['url'];
    $this->docId = $values['docId'];
    $this->readMs = $values['readMs'] ?? null;
    $this->indexMs = $values['indexMs'] ?? null;
    $this->htmlLen = $values['htmlLen'] ?? null;
    $this->skipped = $values['skipped'] ?? null;
    $this->error = $values['error'] ?? null;

    $this->_dirtyFields = [
      'url' => true,
      'doc_id' => true
    ];
    if (array_key_exists('readMs', $values)) {
      $this->_dirtyFields['read_ms'] = true;
    }
    if (array_key_exists('indexMs', $values)) {
      $this->_dirtyFields['index_ms'] = true;
    }
    if (array_key_exists('htmlLen', $values)) {
      $this->_dirtyFields['html_len'] = true;
    }
    if (array_key_exists('skipped', $values)) {
      $this->_dirtyFields['skipped'] = true;
    }
    if (array_key_exists('error', $values)) {
      $this->_dirtyFields['error'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'url',
      'contents' => $this->url
    ];

    $parts[] = [
      'name' => 'doc_id',
      'contents' => $this->docId
    ];

    if ($this->readMs !== null) {
      $parts[] = [
        'name' => 'read_ms',
        'contents' => (string) $this->readMs
      ];
    }

    if ($this->indexMs !== null) {
      $parts[] = [
        'name' => 'index_ms',
        'contents' => (string) $this->indexMs
      ];
    }

    if ($this->htmlLen !== null) {
      $parts[] = [
        'name' => 'html_len',
        'contents' => (string) $this->htmlLen
      ];
    }

    if ($this->skipped !== null) {
      $parts[] = [
        'name' => 'skipped',
        'contents' => $this->skipped ? 'true' : 'false'
      ];
    }

    if ($this->error !== null) {
      $parts[] = [
        'name' => 'error',
        'contents' => $this->error ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
