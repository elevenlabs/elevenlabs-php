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
class ApiIntegrationWebhookOverrides extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\ApiIntegrationWebhookOverridesSchemaOverridesValue>|null
   */
  #[
    JsonProperty('schema_overrides'),
    ArrayType([
      'string' => \ElevenLabs\Types\ApiIntegrationWebhookOverridesSchemaOverridesValue::class
    ])
  ]
  public ?array $schemaOverrides;

  /**
   * @var ?value-of<\ElevenLabs\Types\ResponseFilterMode>
   */
  #[JsonProperty('response_filter_mode')]
  public ?string $responseFilterMode;

  /**
   * @var string[]|null
   */
  #[JsonProperty('response_filters'), ArrayType(['string'])]
  public ?array $responseFilters;

  /**
   * @var array<string, string|\ElevenLabs\Types\ConvAiDynamicVariable>|null
   */
  #[
    JsonProperty('request_headers'),
    ArrayType(['string' => new Union('string', \ElevenLabs\Types\ConvAiDynamicVariable::class)])
  ]
  public ?array $requestHeaders;

  /**
   * @param array{
   *   schemaOverrides?: array<string, \ElevenLabs\Types\ApiIntegrationWebhookOverridesSchemaOverridesValue>|null,
   *   responseFilterMode?: ?value-of<\ElevenLabs\Types\ResponseFilterMode>,
   *   responseFilters?: string[]|null,
   *   requestHeaders?: array<string, string|\ElevenLabs\Types\ConvAiDynamicVariable>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->schemaOverrides = $values['schemaOverrides'] ?? null;
    $this->responseFilterMode = $values['responseFilterMode'] ?? null;
    $this->responseFilters = $values['responseFilters'] ?? null;
    $this->requestHeaders = $values['requestHeaders'] ?? null;

    if (array_key_exists('schemaOverrides', $values)) {
      $this->_dirtyFields['schema_overrides'] = true;
    }
    if (array_key_exists('responseFilterMode', $values)) {
      $this->_dirtyFields['response_filter_mode'] = true;
    }
    if (array_key_exists('responseFilters', $values)) {
      $this->_dirtyFields['response_filters'] = true;
    }
    if (array_key_exists('requestHeaders', $values)) {
      $this->_dirtyFields['request_headers'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->schemaOverrides !== null) {
      $parts[] = [
        'name' => 'schema_overrides',
        'contents' => json_encode($this->schemaOverrides),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->responseFilterMode !== null) {
      $parts[] = [
        'name' => 'response_filter_mode',
        'contents' => $this->responseFilterMode
      ];
    }

    if ($this->responseFilters !== null) {
      foreach ($this->responseFilters ?? [] as $item) {
        $parts[] = [
          'name' => 'response_filters',
          'contents' => $item
        ];
      }
    }

    if ($this->requestHeaders !== null) {
      $parts[] = [
        'name' => 'request_headers',
        'contents' => json_encode($this->requestHeaders),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
