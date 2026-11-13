<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Files;

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
class FilesClient extends BaseService
{
  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

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
   * Set method-level configuration for create.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateConfig(array $config): static
  {
    $this->createConfig = $config;
    return $this;
  }

  /**
   * Download a file the user attached to a conversation, including while the conversation is still active.
   *
   * @param string $conversationId The id of the conversation you're taking the action on.
   * @param string $fileId The file ID returned when it was uploaded.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return \Psr\Http\Message\StreamInterface The response body, read as it arrives. getContents() or (string) returns the whole body. Call close() if you stop reading early.
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $conversationId,
    string $fileId,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationId) .
          '/files/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($fileId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }

  /**
   * Remove a file upload from a conversation. Only possible if the file hasn't already been used in the conversation.
   *
   * @param string $conversationId
   * @param string $fileId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ConvAiFileUploadResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function delete(
    string $conversationId,
    string $fileId,
    ?array $options = null
  ): ?\ElevenLabs\Types\ConvAiFileUploadResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationId) .
          '/files/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($fileId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ConvAiFileUploadResponseModel::class
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
   * Upload an image, PDF, or text file for a conversation. Returns a unique file ID that can be used to reference the file in the conversation.
   *
   * @param string $conversationId
   * @param \ElevenLabs\Agents\Conversations\Files\Requests\BodyUploadFileV1ConvaiConversationsConversationIdFilesPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ConvAiFileUploadResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    string $conversationId,
    \ElevenLabs\Agents\Conversations\Files\Requests\BodyUploadFileV1ConvaiConversationsConversationIdFilesPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ConvAiFileUploadResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/convai/conversations/' .
        \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationId) .
        '/files',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ConvAiFileUploadResponseModel::class
      );
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
