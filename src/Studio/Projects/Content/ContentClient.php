<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Projects\Content;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Utils\Serializer;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class ContentClient extends BaseService
{
  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /**
   * Set method-level configuration for update.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUpdateConfig(array $config): static
  {
    $this->updateConfig = $config;
    return $this;
  }

  /**
   * Updates Studio project content.
   *
   * @param string $projectId The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
   * @param \ElevenLabs\Studio\Projects\Content\Requests\BodyUpdateStudioProjectContentV1StudioProjectsProjectIdContentPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\EditProjectResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $projectId,
    \ElevenLabs\Studio\Projects\Content\Requests\BodyUpdateStudioProjectContentV1StudioProjectsProjectIdContentPost $request = new \ElevenLabs\Studio\Projects\Content\Requests\BodyUpdateStudioProjectContentV1StudioProjectsProjectIdContentPost(),
    ?array $options = null
  ): ?\ElevenLabs\Types\EditProjectResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/studio/projects/' .
        \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
        '/content',
      ['multipart' => $request?->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\EditProjectResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
