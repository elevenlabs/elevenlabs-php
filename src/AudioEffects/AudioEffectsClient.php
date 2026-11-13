<?php

declare(strict_types=1);

namespace ElevenLabs\AudioEffects;

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
class AudioEffectsClient extends BaseService
{
  /** @var array|null Method-level configuration for getCatalog */
  protected ?array $getCatalogConfig = null;

  /**
   * Set method-level configuration for getCatalog.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetCatalogConfig(array $config): static
  {
    $this->getCatalogConfig = $config;
    return $this;
  }

  /**
   * Lists the filter presets, reverb environments, and background noises that `audio_effects` can reference in Text to Speech, Text to Dialogue, and agent configurations.
   *
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AudioEffectsCatalogResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getCatalog(
    ?array $options = null
  ): ?\ElevenLabs\Types\AudioEffectsCatalogResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->getCatalogConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/audio-effects/catalog',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AudioEffectsCatalogResponseModel::class
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
