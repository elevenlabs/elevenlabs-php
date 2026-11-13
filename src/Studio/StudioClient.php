<?php

declare(strict_types=1);

namespace ElevenLabs\Studio;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

use ElevenLabs\Studio\Projects\ProjectsClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class StudioClient extends BaseService
{
  public ProjectsClient $projects;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->projects = new ProjectsClient($client, $options);
  }

  /** @var array|null Method-level configuration for createPodcast */
  protected ?array $createPodcastConfig = null;

  /**
   * Set method-level configuration for createPodcast.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreatePodcastConfig(array $config): static
  {
    $this->createPodcastConfig = $config;
    return $this;
  }

  /**
   * Create and auto-convert a podcast project. Currently, the LLM cost is covered by us but you will still be charged for the audio generation. In the future, you will be charged for both the LLM and audio generation costs.
   *
   * @param \ElevenLabs\Studio\Requests\BodyCreatePodcastV1StudioPodcastsPost $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\PodcastProjectResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function createPodcast(
    \ElevenLabs\Studio\Requests\BodyCreatePodcastV1StudioPodcastsPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\PodcastProjectResponseModel {
    $safetyIdentifier = $request->safetyIdentifier;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createPodcastConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/studio/podcasts',
        method: HttpMethod::POST,
        headers: [
          'safety-identifier' => $safetyIdentifier
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\PodcastProjectResponseModel::class
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
