<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CustomLlm extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The URL of the Chat Completions compatible endpoint
   */
  #[JsonProperty('url', required: true)]
  public string $url;

  /**
   * The model ID to be used if URL serves multiple models
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * The API key for authentication. Either a workspace secret reference {'secret_id': '...'} or an environment variable reference {'env_var_label': '...'}.
   */
  #[
    JsonProperty('api_key'),
    Union(
      \ElevenLabs\Types\ConvAiSecretLocator::class,
      \ElevenLabs\Types\ConvAiEnvVarLocator::class,
      'null'
    )
  ]
  public \ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiEnvVarLocator|null $apiKey;

  /**
   * Optional workspace auth connection for authentication. Only auth connections that produce an Authorization Bearer token are supported; Basic auth, mTLS, custom header, and URL secret auth connections are not supported.
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
   * The API version to use for the request
   */
  #[JsonProperty('api_version')]
  public ?string $apiVersion;

  /**
   * @var ?value-of<\ElevenLabs\Types\CustomLlmapiType>
   */
  #[JsonProperty('api_type')]
  public ?string $apiType;

  /**
   * @param array{
   *   url: string,
   *   modelId?: ?string,
   *   apiKey?: \ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiEnvVarLocator|null,
   *   authConnection?: \ElevenLabs\Types\AuthConnectionLocator|\ElevenLabs\Types\EnvironmentAuthConnectionLocator|null,
   *   requestHeaders?: array<string, string|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiDynamicVariable|\ElevenLabs\Types\ConvAiEnvVarLocator>|null,
   *   apiVersion?: ?string,
   *   apiType?: ?value-of<\ElevenLabs\Types\CustomLlmapiType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->url = $values['url'];
    $this->modelId = $values['modelId'] ?? null;
    $this->apiKey = $values['apiKey'] ?? null;
    $this->authConnection = $values['authConnection'] ?? null;
    $this->requestHeaders = $values['requestHeaders'] ?? null;
    $this->apiVersion = $values['apiVersion'] ?? null;
    $this->apiType = $values['apiType'] ?? null;

    $this->_dirtyFields = [
      'url' => true
    ];
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('apiKey', $values)) {
      $this->_dirtyFields['api_key'] = true;
    }
    if (array_key_exists('authConnection', $values)) {
      $this->_dirtyFields['auth_connection'] = true;
    }
    if (array_key_exists('requestHeaders', $values)) {
      $this->_dirtyFields['request_headers'] = true;
    }
    if (array_key_exists('apiVersion', $values)) {
      $this->_dirtyFields['api_version'] = true;
    }
    if (array_key_exists('apiType', $values)) {
      $this->_dirtyFields['api_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'url',
      'contents' => $this->url
    ];

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    if ($this->apiKey !== null) {
      $parts[] = [
        'name' => 'api_key',
        'contents' => json_encode($this->apiKey),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->authConnection !== null) {
      $parts[] = [
        'name' => 'auth_connection',
        'contents' => json_encode($this->authConnection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->requestHeaders !== null) {
      $parts[] = [
        'name' => 'request_headers',
        'contents' => json_encode($this->requestHeaders),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->apiVersion !== null) {
      $parts[] = [
        'name' => 'api_version',
        'contents' => $this->apiVersion
      ];
    }

    if ($this->apiType !== null) {
      $parts[] = [
        'name' => 'api_type',
        'contents' => $this->apiType
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
