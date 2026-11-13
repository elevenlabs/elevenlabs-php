<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DeliverableInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * A time-limited URL to download the delivered file.
   */
  #[JsonProperty('signed_url', required: true)]
  public string $signedUrl;

  /**
   * The MIME type of the delivered file (e.g. 'video/mp4').
   */
  #[JsonProperty('content_type', required: true)]
  public string $contentType;

  /**
   * The name of the delivered file.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The version number of the deliverable.
   */
  #[JsonProperty('version')]
  public ?int $version;

  /**
   * @param array{
   *   signedUrl: string,
   *   contentType: string,
   *   name: string,
   *   version?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->signedUrl = $values['signedUrl'];
    $this->contentType = $values['contentType'];
    $this->name = $values['name'];
    $this->version = $values['version'] ?? null;

    $this->_dirtyFields = [
      'signed_url' => true,
      'content_type' => true,
      'name' => true
    ];
    if (array_key_exists('version', $values)) {
      $this->_dirtyFields['version'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'signed_url',
      'contents' => $this->signedUrl
    ];

    $parts[] = [
      'name' => 'content_type',
      'contents' => $this->contentType
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->version !== null) {
      $parts[] = [
        'name' => 'version',
        'contents' => (string) $this->version
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
