<?php

declare(strict_types=1);

namespace ElevenLabs\Core\Json;

use ElevenLabs\Core\Client\BaseApiRequest;
use ElevenLabs\Core\Client\HttpMethod;

class JsonApiRequest extends BaseApiRequest
{
  /**
   * @param string $baseUrl The base URL for the request
   * @param string $path The path for the request
   * @param HttpMethod $method The HTTP method for the request
   * @param array<string, mixed> $headers Additional headers for the request (optional)
   * @param array<string, mixed> $query Query parameters for the request (optional)
   * @param mixed|null $body The JSON request body (optional)
   */
  public function __construct(
    string $baseUrl,
    string $path,
    HttpMethod $method,
    array $headers = [],
    array $query = [],
    public readonly mixed $body = null
  ) {
    parent::__construct($baseUrl, $path, $method, $headers, $query);
  }
}
