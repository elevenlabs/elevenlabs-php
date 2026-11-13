<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Project\Transcript;

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
class TranscriptClient extends BaseService
{
  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for updateSegment */
  protected ?array $updateSegmentConfig = null;

  /** @var array|null Method-level configuration for deleteSegment */
  protected ?array $deleteSegmentConfig = null;

  /** @var array|null Method-level configuration for updateSegments */
  protected ?array $updateSegmentsConfig = null;

  /** @var array|null Method-level configuration for createSegment */
  protected ?array $createSegmentConfig = null;

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
   * Set method-level configuration for updateSegment.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUpdateSegmentConfig(array $config): static
  {
    $this->updateSegmentConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for deleteSegment.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDeleteSegmentConfig(array $config): static
  {
    $this->deleteSegmentConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for updateSegments.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUpdateSegmentsConfig(array $config): static
  {
    $this->updateSegmentsConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for createSegment.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateSegmentConfig(array $config): static
  {
    $this->createSegmentConfig = $config;
    return $this;
  }

  /**
   * The project's source transcript, as editable segments. Available once the project is `ready`.
   *
   * @param string $projectId Identifier of the dubbing project.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DubbingSourceTranscriptResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $projectId,
    ?array $options = null
  ): ?\ElevenLabs\Types\DubbingSourceTranscriptResponse {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/dubbing/project/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/transcript',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\DubbingSourceTranscriptResponse::class
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
   * Enterprise only. Edit a source segment's text, speaker, or timing. Omitted fields are left unchanged. Bumps the project's `revision`, discards the affected translations in every language target, and marks any target that had already completed `stale`. No audio changes until you regenerate a target.
   *
   * @param string $projectId Identifier of the dubbing project.
   * @param string $segmentId Identifier of the segment to edit.
   * @param \ElevenLabs\Types\DubbingSegmentUpdateRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DubbingSourceSegmentUpdateResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function updateSegment(
    string $projectId,
    string $segmentId,
    \ElevenLabs\Types\DubbingSegmentUpdateRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\DubbingSourceSegmentUpdateResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateSegmentConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/dubbing/project/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/transcript/segment/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($segmentId),
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\DubbingSourceSegmentUpdateResponse::class
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
   * Enterprise only. Remove a source segment from the transcript so it is no longer dubbed. Bumps the project's `revision`, discards the affected translations in every language target, and marks any target that had already completed `stale`. No audio changes until you regenerate a target.
   *
   * @param string $projectId Identifier of the dubbing project.
   * @param string $segmentId Identifier of the segment to remove.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DubbingTranscriptRevisionResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function deleteSegment(
    string $projectId,
    string $segmentId,
    ?array $options = null
  ): ?\ElevenLabs\Types\DubbingTranscriptRevisionResponse {
    $resolvedConfig = $this->getResolvedConfig($this->deleteSegmentConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/dubbing/project/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/transcript/segment/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($segmentId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\DubbingTranscriptRevisionResponse::class
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
   * Enterprise only. Edit several source segments' text, speaker, or timing in one atomic request: every edit applies or none does. Bumps the project's `revision`, discards the affected translations in every language target, and marks any target that had already completed `stale`. No audio changes until you regenerate a target.
   *
   * @param string $projectId Identifier of the dubbing project.
   * @param \ElevenLabs\Dubbing\Project\Transcript\Requests\DubbingBulkSegmentUpdateRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DubbingBulkSourceSegmentUpdateResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function updateSegments(
    string $projectId,
    \ElevenLabs\Dubbing\Project\Transcript\Requests\DubbingBulkSegmentUpdateRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\DubbingBulkSourceSegmentUpdateResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateSegmentsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/dubbing/project/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/transcript/segments',
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\DubbingBulkSourceSegmentUpdateResponse::class
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
   * Enterprise only. Add a new source segment to the transcript. Its span must lie within the source media, last between 0.1 and 25 seconds, and not overlap another segment by the same speaker. Bumps the project's `revision`, discards the affected translations in every language target, and marks any target that had already completed `stale`. No audio changes until you regenerate a target.
   *
   * @param string $projectId Identifier of the dubbing project.
   * @param \ElevenLabs\Dubbing\Project\Transcript\Requests\DubbingSegmentCreateRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DubbingSourceSegmentUpdateResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function createSegment(
    string $projectId,
    \ElevenLabs\Dubbing\Project\Transcript\Requests\DubbingSegmentCreateRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\DubbingSourceSegmentUpdateResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createSegmentConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/dubbing/project/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/transcript/segment',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\DubbingSourceSegmentUpdateResponse::class
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
