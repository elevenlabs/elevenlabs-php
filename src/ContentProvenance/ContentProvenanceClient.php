<?php

declare(strict_types=1);

namespace ElevenLabs\ContentProvenance;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Utils\Serializer;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class ContentProvenanceClient extends BaseService
{
  /** @var array|null Method-level configuration for watermark */
  protected ?array $watermarkConfig = null;

  /**
   * Set method-level configuration for watermark.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setWatermarkConfig(array $config): static
  {
    $this->watermarkConfig = $config;
    return $this;
  }

  /**
   * Check an audio file for an embedded ElevenLabs watermark. This endpoint is in beta and may change.
   *
   * @param \ElevenLabs\ContentProvenance\Requests\BodyCheckWatermarkV1ContentProvenanceWatermarkPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\WatermarkCheck
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function watermark(
    \ElevenLabs\ContentProvenance\Requests\BodyCheckWatermarkV1ContentProvenanceWatermarkPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\WatermarkCheck {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->watermarkConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/content-provenance/watermark',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\WatermarkCheck::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
