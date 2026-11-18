<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

use ElevenLabs\AgentTools\Models\WebhookApiSchemaModel;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\WebhookToolConfigInput;

/**
 * A tool the server runs by calling an HTTP endpoint. Create one with {@see Tool::webhook()}.
 * Each method returns the tool, so a tool is written as one chain.
 *
 * Hand-written (see `.fernignore`), mirroring the tool builder in the Python/TS SDKs.
 */
final class WebhookTool extends Tool
{
  private const OPTIONS = [
    ...self::COMMON_OPTIONS,
    'dynamicVariablePlaceholders',
    'executionMode',
    'contentType',
    'responseFilter',
    'followRedirects',
    'followRedirectsAllowedDomains',
  ];
  private const ENV_VAR_TEMPLATE = '/\{\{system__env_[a-z][a-z0-9_]*\}\}/';
  private const PLACEHOLDER = '/\{([^{}]+)\}/';

  /** @var array<string, Schema> */
  private array $pathParams = [];
  /** An object, unless a loaded `query_params_schema` declares another type (reported by `build()`). */
  private ?Schema $query = null;
  /** Whether the query schema's `type` is the builder's, not loaded, so it isn't written. */
  private bool $queryTypeAdded = true;
  private ?Schema $body = null;
  private ?Schema $response = null;
  /** @var array<string, mixed> */
  private array $headers = [];

  /**
   * @internal Use {@see Tool::webhook()} or {@see Tool::fromJson()}.
   * @param array<string, mixed> $config
   * @param array<string, mixed> $api The `api_schema` fields not kept in their own fields: url,
   *   method, auth connection, content type and so on.
   */
  public function __construct(array $config, private array $api)
  {
    parent::__construct($config);
  }

  /**
   * @internal
   * @param array<string, mixed> $config A wire-format webhook config, without `type`.
   */
  public static function load(array $config): self
  {
    $api = ToolWire::schemaWire($config['api_schema'] ?? null) ?? [];
    unset($config['api_schema']);
    $pathParams = $api['path_params_schema'] ?? null;
    $query = $api['query_params_schema'] ?? null;
    $body = $api['request_body_schema'] ?? null;
    $response = $api['response_body_schema'] ?? null;
    $headers = $api['request_headers'] ?? null;
    unset(
      $api['path_params_schema'],
      $api['query_params_schema'],
      $api['request_body_schema'],
      $api['response_body_schema'],
      $api['request_headers'],
    );
    $tool = new self($config, $api);
    foreach (is_array($pathParams) ? $pathParams : [] as $name => $model) {
      $tool->pathParams[(string) $name] = Schema::fromWire(is_array($model) ? $model : []);
    }
    $query = ToolWire::schemaWire($query);
    if ($query !== null) {
      $tool->query = self::loadContainer($query);
      $tool->queryTypeAdded = !array_key_exists('type', $query);
    }
    $body = ToolWire::schemaWire($body);
    if ($body !== null) {
      $tool->body = self::loadContainer($body);
    }
    $response = ToolWire::schemaWire($response);
    if ($response !== null) {
      $tool->response = self::loadContainer($response);
    }
    foreach (is_array($headers) ? $headers : [] as $name => $value) {
      $tool->headers[(string) $name] = $value;
    }
    return $tool;
  }

  public function kind(): string
  {
    return 'webhook';
  }

  /** Sends a `GET` to `$url`. `{name}` placeholders in the URL are filled from path params. */
  public function get(string $url): self
  {
    return $this->request('GET', $url);
  }

  /** Sends a `POST` to `$url`. */
  public function post(string $url): self
  {
    return $this->request('POST', $url);
  }

  /** Sends a `PUT` to `$url`. */
  public function put(string $url): self
  {
    return $this->request('PUT', $url);
  }

  /** Sends a `PATCH` to `$url`. */
  public function patch(string $url): self
  {
    return $this->request('PATCH', $url);
  }

  /** Sends a `DELETE` to `$url`. */
  public function delete(string $url): self
  {
    return $this->request('DELETE', $url);
  }

  /** Sets the path param `$name`, filling the `{name}` placeholder in the URL. Literal schemas only. */
  public function pathParam(string $name, Schema $schema): self
  {
    $this->pathParams[$name] = $schema;
    return $this;
  }

  /** Sets the query param `$name`. Required unless the schema is `optional()`. Literal schemas only. */
  public function queryParam(string $name, Schema $schema): self
  {
    // A loaded query schema of another type can't take params; build() reports it.
    if ($this->query === null || $this->query instanceof ObjectSchema) {
      $this->query = ($this->query ?? Schema::object())->property($name, $schema);
    }
    return $this;
  }

  /** Sets the request body schema. Must be an object. */
  public function body(Schema $schema): self
  {
    $this->body = $schema;
    return $this;
  }

  /** Sets the response body schema. Must be an object. */
  public function response(Schema $schema): self
  {
    $this->response = $schema;
    return $this;
  }

  /** Sets the request header `$name`. */
  public function header(string $name, Header $value): self
  {
    $this->headers[$name] = $value->toWire();
    return $this;
  }

  /** Authenticates requests with an auth connection. */
  public function auth(AuthConnection $connection): self
  {
    $this->api['auth_connection'] = $connection->toWire();
    return $this;
  }

  /**
   * Stores the value at `$valuePath` in the response (dot notation, e.g. `"order.status"`) in
   * `$variable`. `$sanitize` removes the value from the response before the LLM and the
   * transcript see it; `$preserveNativeType` stores lists and objects as they are instead of as
   * JSON strings.
   */
  public function assign(
    string $variable,
    string $valuePath,
    ?bool $sanitize = null,
    ?bool $preserveNativeType = null,
  ): self {
    $assignment = ['source' => 'response', 'dynamic_variable' => $variable, 'value_path' => $valuePath];
    if ($sanitize !== null) {
      $assignment['sanitize'] = $sanitize;
    }
    if ($preserveNativeType !== null) {
      $assignment['preserve_native_type'] = $preserveNativeType;
    }
    $assignments = is_array($this->config['assignments'] ?? null) ? $this->config['assignments'] : [];
    $assignments[] = $assignment;
    $this->config['assignments'] = array_values($assignments);
    return $this;
  }

  /** Removes the path param `$name`. Removing one that doesn't exist does nothing. */
  public function removePathParam(string $name): self
  {
    unset($this->pathParams[$name]);
    return $this;
  }

  /** Removes the query param `$name`. Removing one that doesn't exist does nothing. */
  public function removeQueryParam(string $name): self
  {
    if ($this->query instanceof ObjectSchema && $this->query->propertySchema($name) !== null) {
      $query = $this->query->without($name);
      // Removing the last param leaves the query schema out.
      $this->query = $query->propertyNames() === [] ? null : $query;
    }
    return $this;
  }

  /** Removes the request header `$name`. Removing one that doesn't exist does nothing. */
  public function removeHeader(string $name): self
  {
    unset($this->headers[$name]);
    return $this;
  }

  /** Removes every assignment to `$variable`. */
  public function removeAssignment(string $variable): self
  {
    $assignments = $this->config['assignments'] ?? null;
    if (!is_array($assignments)) {
      return $this;
    }
    $kept = array_values(array_filter(
      $assignments,
      static fn(mixed $a): bool => !is_array($a) || ($a['dynamic_variable'] ?? null) !== $variable
    ));
    if (count($kept) === count($assignments)) {
      return $this;
    }
    // Removing the last assignment leaves the field out.
    if ($kept === []) {
      unset($this->config['assignments']);
    } else {
      $this->config['assignments'] = $kept;
    }
    return $this;
  }

  /** The request body schema, for editing and setting again with `body()`. */
  public function bodySchema(): ?Schema
  {
    return $this->body;
  }

  /** The response body schema, for editing and setting again with `response()`. */
  public function responseSchema(): ?Schema
  {
    return $this->response;
  }

  /**
   * Validates the tool and returns only its config. See {@see Tool::buildConfig()}.
   *
   * @param null|callable(ToolIssue): mixed $onWarning
   * @throws ToolValidationError
   */
  public function buildConfig(?callable $onWarning = null): WebhookToolConfigInput
  {
    /** @var WebhookToolConfigInput */
    return parent::buildConfig($onWarning);
  }

  protected function configModel(array $wire): JsonSerializableType
  {
    // The generated deserializer reads nested schemas as literals, and writes maps keyed "0", "1"…
    // as arrays, so the schemas are built as the right models (see ToolWire::schemaModel()).
    /** @var array<string, mixed> $api */
    $api = ToolWire::schemaWire($wire['api_schema'] ?? null) ?? [];
    $query = ToolWire::schemaWire($api['query_params_schema'] ?? null);
    $body = ToolWire::schemaWire($api['request_body_schema'] ?? null);
    $response = ToolWire::schemaWire($api['response_body_schema'] ?? null);
    unset($api['query_params_schema'], $api['request_body_schema'], $api['response_body_schema']);
    $wire['api_schema'] = $api;
    $model = WebhookToolConfigInput::fromJson(ToolWire::json($wire));
    $apiModel = WebhookApiSchemaModel::fromJson(ToolWire::json($api));
    if ($query !== null) {
      $apiModel->queryParamsSchema = ToolWire::queryModel($query);
    }
    if ($body !== null) {
      $apiModel->requestBodySchema = ToolWire::objectModel($body);
    }
    if ($response !== null) {
      $apiModel->responseBodySchema = ToolWire::objectModel($response);
    }
    $model->apiSchema = $apiModel;
    return $model;
  }

  protected function allowedOptions(): array
  {
    return self::OPTIONS;
  }

  protected function setOption(string $key, mixed $value): void
  {
    if ($key === 'content_type' || $key === 'response_filter') {
      $this->api[$key] = $value;
      return;
    }
    parent::setOption($key, $value);
  }

  protected function validate(): array
  {
    $issues = [];
    // An empty URL is as good as none.
    $url = is_string($this->api['url'] ?? null) && $this->api['url'] !== '' ? $this->api['url'] : null;
    if ($url === null) {
      $issues[] = ToolIssue::error('missing_url', null, 'Set the method and URL with get(), post(), put(), patch() or delete()');
    }
    // As the API does: env var templates aren't placeholders, and the auth connection fills
    // `auth_resolved_params`.
    preg_match_all(self::PLACEHOLDER, (string) preg_replace(self::ENV_VAR_TEMPLATE, 'env', $url ?? ''), $matches);
    $placeholders = array_map('strval', $matches[1]);
    $authResolved = is_array($this->api['auth_resolved_params'] ?? null)
      ? array_map('strval', $this->api['auth_resolved_params'])
      : [];
    $pathNames = array_map('strval', array_keys($this->pathParams));
    foreach ($placeholders as $name) {
      if (!in_array($name, $pathNames, true) && !in_array($name, $authResolved, true)) {
        $issues[] = ToolIssue::error('missing_path_param', "pathParams.{$name}", "The URL has {{$name}} but no pathParam(\"{$name}\")");
      }
    }
    foreach ($this->pathParams as $name => $schema) {
      $name = (string) $name;
      $path = "pathParams.{$name}";
      if ($url !== null && !in_array($name, $placeholders, true)) {
        $issues[] = ToolIssue::error('unknown_path_param', $path, "pathParam(\"{$name}\") has no {{$name}} in the URL");
      } elseif (in_array($name, $authResolved, true)) {
        $issues[] = ToolIssue::error('unknown_path_param', $path, "{{$name}} is filled by the auth connection, not a pathParam");
      }
      if (!$schema->isLiteral()) {
        $issues[] = ToolIssue::error('param_not_literal', $path, "Path param \"{$name}\" must be a string, integer, number or bool");
      }
      $schema->check($path, true, $issues);
    }
    if ($this->query !== null && !($this->query instanceof ObjectSchema)) {
      $issues[] = ToolIssue::error('body_not_object', 'query', 'The query params schema must be an object');
      $this->query->check('query', false, $issues);
    }
    if ($this->query instanceof ObjectSchema) {
      foreach ($this->query->propertyNames() as $name) {
        /** @var Schema $schema */
        $schema = $this->query->propertySchema($name);
        $path = "query.{$name}";
        if (!$schema->isLiteral()) {
          $issues[] = ToolIssue::error('param_not_literal', $path, "Query param \"{$name}\" must be a string, integer, number or bool");
        }
        $schema->check($path, true, $issues);
      }
    }
    foreach (['body' => $this->body, 'response' => $this->response] as $label => $schema) {
      if ($schema === null) {
        continue;
      }
      if ($schema->kind() !== 'object') {
        $issues[] = ToolIssue::error('body_not_object', $label, "The {$label} schema must be an object");
      }
      $schema->check($label, false, $issues);
    }
    $method = $this->api['method'] ?? null;
    if ($method === 'GET' && $this->body !== null) {
      $issues[] = ToolIssue::error('body_not_allowed', 'body', "A GET request can't have a body");
    }
    if (in_array($method, ['POST', 'PUT', 'PATCH'], true) && $this->body === null) {
      $issues[] = ToolIssue::error('missing_body', 'body', "A {$method} request needs a body");
    }
    $where = [];
    $locations = [
      'pathParams' => $pathNames,
      'query' => $this->query instanceof ObjectSchema ? $this->query->propertyNames() : [],
      'body' => $this->body instanceof ObjectSchema ? $this->body->propertyNames() : [],
    ];
    foreach ($locations as $location => $names) {
      foreach ($names as $name) {
        $first = $where[$name] ?? null;
        if ($first !== null) {
          $issues[] = ToolIssue::error(
            'duplicate_param',
            "{$location}.{$name}",
            "\"{$name}\" is in both {$first} and {$location}; param names must be unique across path, query and body"
          );
        } else {
          $where[$name] = $location;
        }
      }
    }
    $seen = [];
    foreach (array_keys($this->headers) as $name) {
      $name = (string) $name;
      $lower = strtolower($name);
      if (isset($seen[$lower])) {
        $issues[] = ToolIssue::error('duplicate_header', "headers.{$name}", "Headers \"{$seen[$lower]}\" and \"{$name}\" differ only in case");
      }
      $seen[$lower] = $name;
    }
    $timeout = $this->config['response_timeout_secs'] ?? null;
    if (is_int($timeout) || is_float($timeout)) {
      if ($timeout < 5 || $timeout > 300) {
        $issues[] = ToolIssue::error('invalid_option', 'responseTimeoutSecs', "A webhook tool's responseTimeoutSecs must be 5–300");
      }
    }
    $domains = $this->config['follow_redirects_allowed_domains'] ?? null;
    if (($this->config['follow_redirects'] ?? null) === true && (!is_array($domains) || $domains === [])) {
      $issues[] = ToolIssue::error('invalid_option', 'followRedirects', 'followRedirects needs followRedirectsAllowedDomains');
    }
    return $issues;
  }

  protected function toWire(): array
  {
    $api = $this->api;
    if ($this->pathParams !== []) {
      $pathParams = [];
      foreach ($this->pathParams as $name => $schema) {
        $pathParams[(string) $name] = $schema->toWire();
      }
      $api['path_params_schema'] = ToolWire::map($pathParams);
    }
    if ($this->query !== null) {
      // Every loaded field, but not a `type` the builder added: the API's query schema has none.
      $query = $this->query->toWire();
      if ($this->queryTypeAdded) {
        unset($query['type']);
      }
      $api['query_params_schema'] = $query === [] ? new \stdClass() : $query;
    }
    if ($this->body !== null) {
      $api['request_body_schema'] = $this->body->toWire();
    }
    if ($this->response !== null) {
      $api['response_body_schema'] = $this->response->toWire();
    }
    if ($this->headers !== []) {
      $api['request_headers'] = ToolWire::map($this->headers);
    }
    $wire = $this->config;
    $wire['type'] = 'webhook';
    $wire['api_schema'] = Wire::deepCopy($api);
    return $wire;
  }

  /**
   * A loaded body, response or query schema: an object when it has no `type`, or as declared.
   *
   * @param array<string, mixed> $wire
   */
  private static function loadContainer(array $wire): Schema
  {
    return Schema::fromWire($wire, false, array_key_exists('type', $wire) ? null : 'object');
  }

  private function request(string $method, string $url): self
  {
    $this->api['method'] = $method;
    $this->api['url'] = $url;
    return $this;
  }
}
