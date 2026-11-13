<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * HTTP request details.
 *
 * Spec: https://schema.ocsf.io/1.6.0/objects/http_request
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class HttpRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * HTTP method (GET, POST, etc.)
   */
  #[JsonProperty('http_method', required: true)]
  public string $httpMethod;

  /**
   * OCSF URL object.
   *
   * Spec: https://schema.ocsf.io/1.6.0/objects/url
   */
  #[JsonProperty('url', required: true)]
  public \ElevenLabs\Types\UrlModel $url;

  /**
   * User agent string
   */
  #[JsonProperty('user_agent')]
  public ?string $userAgent;

  /**
   * @var string[]|null
   * X-Forwarded-For header as a list
   */
  #[JsonProperty('x_forwarded_for'), ArrayType(['string'])]
  public ?array $xForwardedFor;

  /**
   * @param array{
   *   httpMethod: string,
   *   url: \ElevenLabs\Types\UrlModel,
   *   userAgent?: ?string,
   *   xForwardedFor?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->httpMethod = $values['httpMethod'];
    $this->url = $values['url'];
    $this->userAgent = $values['userAgent'] ?? null;
    $this->xForwardedFor = $values['xForwardedFor'] ?? null;

    $this->_dirtyFields = [
      'http_method' => true,
      'url' => true
    ];
    if (array_key_exists('userAgent', $values)) {
      $this->_dirtyFields['user_agent'] = true;
    }
    if (array_key_exists('xForwardedFor', $values)) {
      $this->_dirtyFields['x_forwarded_for'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'http_method',
      'contents' => $this->httpMethod
    ];

    $parts[] = [
      'name' => 'url',
      'contents' => json_encode($this->url),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->userAgent !== null) {
      $parts[] = [
        'name' => 'user_agent',
        'contents' => $this->userAgent
      ];
    }

    if ($this->xForwardedFor !== null) {
      foreach ($this->xForwardedFor ?? [] as $item) {
        $parts[] = [
          'name' => 'x_forwarded_for',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->url->validate();
  }
}
