<?php

declare(strict_types=1);

namespace ElevenLabs\Music\CompositionPlan;

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
class CompositionPlanClient extends BaseService
{
  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

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
   * Create a composition plan for music generation. Usage of this endpoint does not cost any credits but is subject to rate limiting depending on your tier.
   *
   * @param \ElevenLabs\Music\CompositionPlan\Requests\BodyGenerateCompositionPlanV1MusicPlanPost $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return \ElevenLabs\Types\MusicPrompt|\ElevenLabs\Types\CompositionPlan|null
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\Music\CompositionPlan\Requests\BodyGenerateCompositionPlanV1MusicPlanPost $request,
    ?array $options = null
  ): \ElevenLabs\Types\MusicPrompt|\ElevenLabs\Types\CompositionPlan|null {
    $enableLogging = $request->enableLogging;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/music/plan',
        method: HttpMethod::POST,
        query: [
          'enable_logging' => $enableLogging
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = \ElevenLabs\Core\Json\JsonDeserializer::deserializeUnion(
        $this->decodeJson($data),
        new \ElevenLabs\Core\Types\Union(
          \ElevenLabs\Types\MusicPrompt::class,
          \ElevenLabs\Types\CompositionPlan::class
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
}
