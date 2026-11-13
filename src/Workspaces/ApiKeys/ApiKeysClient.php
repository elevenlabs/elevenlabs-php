<?php

declare(strict_types=1);

namespace ElevenLabs\Workspaces\ApiKeys;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class ApiKeysClient extends BaseService
{
  /** @var array|null Method-level configuration for disable */
  protected ?array $disableConfig = null;

  /**
   * Set method-level configuration for disable.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDisableConfig(array $config): static
  {
    $this->disableConfig = $config;
    return $this;
  }

  /**
   * Disable the API key used to authenticate this request. Requires the query parameter `api_key_name=self` as an explicit confirmation.
   *
   * @param \ElevenLabs\Workspaces\ApiKeys\Requests\DisableApiKeysRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return mixed
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function disable(
    \ElevenLabs\Workspaces\ApiKeys\Requests\DisableApiKeysRequest $request,
    ?array $options = null
  ): mixed {
    $apiKeyName = $request->apiKeyName;

    $resolvedConfig = $this->getResolvedConfig($this->disableConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspaces/api-keys/disable',
        method: HttpMethod::POST,
        query: [
          'api_key_name' => $apiKeyName
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = $this->decodeJson($data);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
