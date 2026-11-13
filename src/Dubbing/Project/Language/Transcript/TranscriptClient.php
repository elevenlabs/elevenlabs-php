<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Project\Language\Transcript;

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

  /** @var array|null Method-level configuration for updateSegments */
  protected ?array $updateSegmentsConfig = null;

  /** @var array|null Method-level configuration for regenerate */
  protected ?array $regenerateConfig = null;

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
   * Set method-level configuration for regenerate.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRegenerateConfig(array $config): static
  {
    $this->regenerateConfig = $config;
    return $this;
  }

  /**
   * A language target's transcript: source segments with their translations. Available once the target has produced an output. Returns a conflict while the target is still on its first dub, since it has no translations to return yet.
   *
   * @param string $projectId Identifier of the dubbing project.
   * @param string $languageId Identifier of the language target.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DubbingTargetTranscriptResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $projectId,
    string $languageId,
    ?array $options = null
  ): ?\ElevenLabs\Types\DubbingTargetTranscriptResponse {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/dubbing/project/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/language/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($languageId) .
          '/transcript',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\DubbingTargetTranscriptResponse::class
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
   * Enterprise only. Edit a segment's translation for a language target. Omitted fields are left unchanged; an explicit null clears the field. Bumps the target's `revision` and marks it `stale` if it had already completed. The source transcript and the project's other languages are untouched, and no audio changes until you regenerate the target.
   *
   * @param string $projectId Identifier of the dubbing project.
   * @param string $languageId Identifier of the language target.
   * @param string $segmentId Identifier of the segment to edit.
   * @param \ElevenLabs\Types\DubbingTargetSegmentUpdateRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DubbingTargetSegmentUpdateResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function updateSegment(
    string $projectId,
    string $languageId,
    string $segmentId,
    \ElevenLabs\Types\DubbingTargetSegmentUpdateRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\DubbingTargetSegmentUpdateResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateSegmentConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/dubbing/project/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/language/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($languageId) .
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
        \ElevenLabs\Types\DubbingTargetSegmentUpdateResponse::class
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
   * Enterprise only. Edit several segments' translations for a language target in one atomic request: every edit applies or none does. Bumps the target's `revision` and marks it `stale` if it had already completed. The source transcript and the project's other languages are untouched, and no audio changes until you regenerate the target.
   *
   * @param string $projectId Identifier of the dubbing project.
   * @param string $languageId Identifier of the language target.
   * @param \ElevenLabs\Dubbing\Project\Language\Transcript\Requests\DubbingBulkTargetSegmentUpdateRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DubbingBulkTargetSegmentUpdateResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function updateSegments(
    string $projectId,
    string $languageId,
    \ElevenLabs\Dubbing\Project\Language\Transcript\Requests\DubbingBulkTargetSegmentUpdateRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\DubbingBulkTargetSegmentUpdateResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateSegmentsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/dubbing/project/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/language/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($languageId) .
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
        \ElevenLabs\Types\DubbingBulkTargetSegmentUpdateResponse::class
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
   * Enterprise only. Re-dub a target from its edited transcript, re-synthesizing only the edited regions (charged like a generation, less the free-regeneration allowance). Accepted asynchronously: the target returns to `processing` and sends a `dubbing_language_completed` event to the project's `webhook_ids` when the re-dub lands, carrying the new output URLs. Returns a conflict when the target has no edits to apply — nothing is dispatched and nothing is charged.
   *
   * @param string $projectId Identifier of the dubbing project.
   * @param string $languageId Identifier of the language target.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DubbingRegenerateResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function regenerate(
    string $projectId,
    string $languageId,
    ?array $options = null
  ): ?\ElevenLabs\Types\DubbingRegenerateResponse {
    $resolvedConfig = $this->getResolvedConfig($this->regenerateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/dubbing/project/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/language/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($languageId) .
          '/transcript/regenerate',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\DubbingRegenerateResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
