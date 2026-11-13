<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WebhookToolApiSchemaConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, string|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiDynamicVariable|\ElevenLabs\Types\ConvAiEnvVarLocator>|null
   * Headers that should be included in the request
   */
  #[
    JsonProperty('request_headers'),
    ArrayType([
      'string' => new Union(
        'string',
        \ElevenLabs\Types\ConvAiSecretLocator::class,
        \ElevenLabs\Types\ConvAiDynamicVariable::class,
        \ElevenLabs\Types\ConvAiEnvVarLocator::class
      )
    ])
  ]
  public ?array $requestHeaders;

  /**
   * The URL that the webhook will be sent to. May include path parameters, e.g. https://example.com/agents/{agent_id}
   */
  #[JsonProperty('url', required: true)]
  public string $url;

  /**
   * @var ?value-of<\ElevenLabs\Types\WebhookToolApiSchemaConfigInputMethod>
   * The HTTP method to use for the webhook
   */
  #[JsonProperty('method')]
  public ?string $method;

  /**
   * @var array<string, \ElevenLabs\Types\LiteralJsonSchemaProperty>|null
   * Schema for path parameters, if any. The keys should match the placeholders in the URL.
   */
  #[
    JsonProperty('path_params_schema'),
    ArrayType(['string' => \ElevenLabs\Types\LiteralJsonSchemaProperty::class])
  ]
  public ?array $pathParamsSchema;

  /**
   * Schema for any query params, if any. These will be added to end of the URL as query params. Note: properties in a query param must all be literal types
   */
  #[JsonProperty('query_params_schema')]
  public ?\ElevenLabs\Types\QueryParamsJsonSchemaInput $queryParamsSchema;

  /**
   * Schema for the body parameters, if any. Used for POST/PATCH/PUT requests. The schema should be an object which will be sent as the json body
   */
  #[JsonProperty('request_body_schema')]
  public ?\ElevenLabs\Types\ObjectJsonSchemaPropertyInput $requestBodySchema;

  /**
   * Schema describing the expected response body structure. For documentation only; not surfaced to the LLM.
   */
  #[JsonProperty('response_body_schema')]
  public ?\ElevenLabs\Types\ObjectJsonSchemaPropertyInput $responseBodySchema;

  /**
   * Optional allow-list filter applied to the response before the LLM sees it, so large responses don't pollute the context. Defaults to the full response.
   */
  #[JsonProperty('response_filter')]
  public ?\ElevenLabs\Types\ResponseFilter $responseFilter;

  /**
   * @var ?value-of<\ElevenLabs\Types\WebhookToolApiSchemaConfigInputContentType>
   * Content type for the request body. Only applies to POST/PUT/PATCH requests.
   */
  #[JsonProperty('content_type')]
  public ?string $contentType;

  /**
   * @var string[]|null
   * URL placeholders resolved from the auth connection (e.g. secrets injected via UrlSecretAuthConnection) rather than from path_params_schema.
   */
  #[JsonProperty('auth_resolved_params'), ArrayType(['string'])]
  public ?array $authResolvedParams;

  /**
   * Optional auth connection to use for authentication with this webhook
   */
  #[
    JsonProperty('auth_connection'),
    Union(
      \ElevenLabs\Types\AuthConnectionLocator::class,
      \ElevenLabs\Types\EnvironmentAuthConnectionLocator::class,
      'null'
    )
  ]
  public \ElevenLabs\Types\AuthConnectionLocator|\ElevenLabs\Types\EnvironmentAuthConnectionLocator|null $authConnection;

  /**
   * @param array{
   *   url: string,
   *   requestHeaders?: array<string, string|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiDynamicVariable|\ElevenLabs\Types\ConvAiEnvVarLocator>|null,
   *   method?: ?value-of<\ElevenLabs\Types\WebhookToolApiSchemaConfigInputMethod>,
   *   pathParamsSchema?: array<string, \ElevenLabs\Types\LiteralJsonSchemaProperty>|null,
   *   queryParamsSchema?: ?\ElevenLabs\Types\QueryParamsJsonSchemaInput,
   *   requestBodySchema?: ?\ElevenLabs\Types\ObjectJsonSchemaPropertyInput,
   *   responseBodySchema?: ?\ElevenLabs\Types\ObjectJsonSchemaPropertyInput,
   *   responseFilter?: ?\ElevenLabs\Types\ResponseFilter,
   *   contentType?: ?value-of<\ElevenLabs\Types\WebhookToolApiSchemaConfigInputContentType>,
   *   authResolvedParams?: string[]|null,
   *   authConnection?: \ElevenLabs\Types\AuthConnectionLocator|\ElevenLabs\Types\EnvironmentAuthConnectionLocator|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->requestHeaders = $values['requestHeaders'] ?? null;
    $this->url = $values['url'];
    $this->method = $values['method'] ?? null;
    $this->pathParamsSchema = $values['pathParamsSchema'] ?? null;
    $this->queryParamsSchema = $values['queryParamsSchema'] ?? null;
    $this->requestBodySchema = $values['requestBodySchema'] ?? null;
    $this->responseBodySchema = $values['responseBodySchema'] ?? null;
    $this->responseFilter = $values['responseFilter'] ?? null;
    $this->contentType = $values['contentType'] ?? null;
    $this->authResolvedParams = $values['authResolvedParams'] ?? null;
    $this->authConnection = $values['authConnection'] ?? null;

    $this->_dirtyFields = [
      'url' => true
    ];
    if (array_key_exists('requestHeaders', $values)) {
      $this->_dirtyFields['request_headers'] = true;
    }
    if (array_key_exists('method', $values)) {
      $this->_dirtyFields['method'] = true;
    }
    if (array_key_exists('pathParamsSchema', $values)) {
      $this->_dirtyFields['path_params_schema'] = true;
    }
    if (array_key_exists('queryParamsSchema', $values)) {
      $this->_dirtyFields['query_params_schema'] = true;
    }
    if (array_key_exists('requestBodySchema', $values)) {
      $this->_dirtyFields['request_body_schema'] = true;
    }
    if (array_key_exists('responseBodySchema', $values)) {
      $this->_dirtyFields['response_body_schema'] = true;
    }
    if (array_key_exists('responseFilter', $values)) {
      $this->_dirtyFields['response_filter'] = true;
    }
    if (array_key_exists('contentType', $values)) {
      $this->_dirtyFields['content_type'] = true;
    }
    if (array_key_exists('authResolvedParams', $values)) {
      $this->_dirtyFields['auth_resolved_params'] = true;
    }
    if (array_key_exists('authConnection', $values)) {
      $this->_dirtyFields['auth_connection'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->requestHeaders !== null) {
      $parts[] = [
        'name' => 'request_headers',
        'contents' => json_encode($this->requestHeaders),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'url',
      'contents' => $this->url
    ];

    if ($this->method !== null) {
      $parts[] = [
        'name' => 'method',
        'contents' => $this->method
      ];
    }

    if ($this->pathParamsSchema !== null) {
      $parts[] = [
        'name' => 'path_params_schema',
        'contents' => json_encode($this->pathParamsSchema),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->queryParamsSchema !== null) {
      $parts[] = [
        'name' => 'query_params_schema',
        'contents' => json_encode($this->queryParamsSchema),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->requestBodySchema !== null) {
      $parts[] = [
        'name' => 'request_body_schema',
        'contents' => json_encode($this->requestBodySchema),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->responseBodySchema !== null) {
      $parts[] = [
        'name' => 'response_body_schema',
        'contents' => json_encode($this->responseBodySchema),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->responseFilter !== null) {
      $parts[] = [
        'name' => 'response_filter',
        'contents' => json_encode($this->responseFilter),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->contentType !== null) {
      $parts[] = [
        'name' => 'content_type',
        'contents' => $this->contentType
      ];
    }

    if ($this->authResolvedParams !== null) {
      foreach ($this->authResolvedParams ?? [] as $item) {
        $parts[] = [
          'name' => 'auth_resolved_params',
          'contents' => $item
        ];
      }
    }

    if ($this->authConnection !== null) {
      $parts[] = [
        'name' => 'auth_connection',
        'contents' => json_encode($this->authConnection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->queryParamsSchema?->validate();
    $this->requestBodySchema?->validate();
    $this->responseBodySchema?->validate();
    $this->responseFilter?->validate();
    Validator::validateArray($this->authResolvedParams, 'auth_resolved_params', uniqueItems: true);
  }
}
