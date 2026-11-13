<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Projects\Chapters\Snapshots;

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
class SnapshotsClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for stream */
  protected ?array $streamConfig = null;

  /**
   * Set method-level configuration for list.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setListConfig(array $config): static
  {
    $this->listConfig = $config;
    return $this;
  }

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
   * Set method-level configuration for stream.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setStreamConfig(array $config): static
  {
    $this->streamConfig = $config;
    return $this;
  }

  /**
   * Gets information about all the snapshots of a chapter. Each snapshot can be downloaded as audio. Whenever a chapter is converted a snapshot will automatically be created.
   *
   * @param string $projectId The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
   * @param string $chapterId The ID of the chapter to be used. You can use the [List project chapters](/docs/api-reference/studio/get-chapters) endpoint to list all the available chapters.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ChapterSnapshotsResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    string $projectId,
    string $chapterId,
    ?array $options = null
  ): ?\ElevenLabs\Types\ChapterSnapshotsResponse {
    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/studio/projects/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/chapters/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($chapterId) .
          '/snapshots',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ChapterSnapshotsResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Returns the chapter snapshot.
   *
   * @param string $projectId The ID of the Studio project.
   * @param string $chapterId The ID of the chapter.
   * @param string $chapterSnapshotId The ID of the chapter snapshot.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ChapterSnapshotExtendedResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $projectId,
    string $chapterId,
    string $chapterSnapshotId,
    ?array $options = null
  ): ?\ElevenLabs\Types\ChapterSnapshotExtendedResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/studio/projects/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/chapters/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($chapterId) .
          '/snapshots/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($chapterSnapshotId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ChapterSnapshotExtendedResponseModel::class
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
   * Stream the audio from a chapter snapshot. Use `GET /v1/studio/projects/{project_id}/chapters/{chapter_id}/snapshots` to return the snapshots of a chapter.
   *
   * @param string $projectId The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
   * @param string $chapterId The ID of the chapter to be used. You can use the [List project chapters](/docs/api-reference/studio/get-chapters) endpoint to list all the available chapters.
   * @param string $chapterSnapshotId The ID of the chapter snapshot to be used. You can use the [List project chapter snapshots](/docs/api-reference/studio/get-snapshots) endpoint to list all the available snapshots.
   * @param \ElevenLabs\Studio\Projects\Chapters\Snapshots\Requests\BodyStreamChapterAudioV1StudioProjectsProjectIdChaptersChapterIdSnapshotsChapterSnapshotIdStreamPost $request Request body
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
  public function stream(
    string $projectId,
    string $chapterId,
    string $chapterSnapshotId,
    \ElevenLabs\Studio\Projects\Chapters\Snapshots\Requests\BodyStreamChapterAudioV1StudioProjectsProjectIdChaptersChapterIdSnapshotsChapterSnapshotIdStreamPost $request = new \ElevenLabs\Studio\Projects\Chapters\Snapshots\Requests\BodyStreamChapterAudioV1StudioProjectsProjectIdChaptersChapterIdSnapshotsChapterSnapshotIdStreamPost(),
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->streamConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/studio/projects/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/chapters/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($chapterId) .
          '/snapshots/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($chapterSnapshotId) .
          '/stream',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }
}
