<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * OCSF URL object.
 *
 * Spec: https://schema.ocsf.io/1.6.0/objects/url
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UrlModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Full URL string
   */
  #[JsonProperty('url_string')]
  public ?string $urlString;

  /**
   * URL scheme (e.g., https)
   */
  #[JsonProperty('scheme')]
  public ?string $scheme;

  /**
   * URL hostname
   */
  #[JsonProperty('hostname')]
  public ?string $hostname;

  /**
   * URL port
   */
  #[JsonProperty('port')]
  public ?int $port;

  /**
   * URL path
   */
  #[JsonProperty('path')]
  public ?string $path;

  /**
   * URL query string
   */
  #[JsonProperty('query_string')]
  public ?string $queryString;

  /**
   * @param array{
   *   urlString?: ?string,
   *   scheme?: ?string,
   *   hostname?: ?string,
   *   port?: ?int,
   *   path?: ?string,
   *   queryString?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->urlString = $values['urlString'] ?? null;
    $this->scheme = $values['scheme'] ?? null;
    $this->hostname = $values['hostname'] ?? null;
    $this->port = $values['port'] ?? null;
    $this->path = $values['path'] ?? null;
    $this->queryString = $values['queryString'] ?? null;

    if (array_key_exists('urlString', $values)) {
      $this->_dirtyFields['url_string'] = true;
    }
    if (array_key_exists('scheme', $values)) {
      $this->_dirtyFields['scheme'] = true;
    }
    if (array_key_exists('hostname', $values)) {
      $this->_dirtyFields['hostname'] = true;
    }
    if (array_key_exists('port', $values)) {
      $this->_dirtyFields['port'] = true;
    }
    if (array_key_exists('path', $values)) {
      $this->_dirtyFields['path'] = true;
    }
    if (array_key_exists('queryString', $values)) {
      $this->_dirtyFields['query_string'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->urlString !== null) {
      $parts[] = [
        'name' => 'url_string',
        'contents' => $this->urlString
      ];
    }

    if ($this->scheme !== null) {
      $parts[] = [
        'name' => 'scheme',
        'contents' => $this->scheme
      ];
    }

    if ($this->hostname !== null) {
      $parts[] = [
        'name' => 'hostname',
        'contents' => $this->hostname
      ];
    }

    if ($this->port !== null) {
      $parts[] = [
        'name' => 'port',
        'contents' => (string) $this->port
      ];
    }

    if ($this->path !== null) {
      $parts[] = [
        'name' => 'path',
        'contents' => $this->path
      ];
    }

    if ($this->queryString !== null) {
      $parts[] = [
        'name' => 'query_string',
        'contents' => $this->queryString
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
