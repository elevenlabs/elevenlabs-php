<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechToText\Transcripts;

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
class TranscriptsClient extends BaseService
{
  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /**
   * Set method-level configuration for get.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetConfig(array $config): static
  {
    $this->getConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for delete.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDeleteConfig(array $config): static
  {
    $this->deleteConfig = $config;
    return $this;
  }

  /**
   * Retrieve a previously generated transcript by its ID.
   *
   * @param string $transcriptionId The unique ID of the transcript to retrieve
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return \ElevenLabs\Types\SpeechToTextChunkResponseModel|\ElevenLabs\Types\MultichannelSpeechToTextResponseModel|null
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $transcriptionId,
    ?array $options = null
  ): \ElevenLabs\Types\SpeechToTextChunkResponseModel|\ElevenLabs\Types\MultichannelSpeechToTextResponseModel|null {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/speech-to-text/transcripts/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($transcriptionId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = \ElevenLabs\Core\Json\JsonDeserializer::deserializeUnion(
        $this->decodeJson($data),
        new \ElevenLabs\Core\Types\Union(
          \ElevenLabs\Types\SpeechToTextChunkResponseModel::class,
          \ElevenLabs\Types\MultichannelSpeechToTextResponseModel::class
        )
      );
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Delete a previously generated transcript by its ID.
   *
   * @param string $transcriptionId The unique ID of the transcript to delete
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
  public function delete(string $transcriptionId, ?array $options = null): mixed
  {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/speech-to-text/transcripts/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($transcriptionId),
        method: HttpMethod::DELETE
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
