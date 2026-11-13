<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Projects\PronunciationDictionaries;

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
class PronunciationDictionariesClient extends BaseService
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
   * Create a set of pronunciation dictionaries acting on a project. This will automatically mark text within this project as requiring reconverting where the new dictionary would apply or the old one no longer does.
   *
   * @param string $projectId The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
   * @param \ElevenLabs\Studio\Projects\PronunciationDictionaries\Requests\BodyCreatePronunciationDictionariesV1StudioProjectsProjectIdPronunciationDictionariesPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CreatePronunciationDictionaryResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    string $projectId,
    \ElevenLabs\Studio\Projects\PronunciationDictionaries\Requests\BodyCreatePronunciationDictionariesV1StudioProjectsProjectIdPronunciationDictionariesPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\CreatePronunciationDictionaryResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/studio/projects/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/pronunciation-dictionaries',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\CreatePronunciationDictionaryResponseModel::class
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
