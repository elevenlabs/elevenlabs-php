<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Templates;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;

use ElevenLabs\Flows\Templates\Runs\RunsClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class TemplatesClient extends BaseService
{
  public RunsClient $runs;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->runs = new RunsClient($client, $options);
  }

  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

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
   * List the published flows templates in your workspace, together with each runnable version's inputs and outputs. Use the ids here as `template_id` / `version_id` on `POST /v1/flows/templates/{template_id}/runs`. Versions built on models that are not available to you through the API are left out, so `versions` is empty when none of a template's published versions is runnable through this API. Templates shared with you by link, or published to Explore from another workspace, are not listed but can still be fetched and run by `template_id`.
   *
   * @param \ElevenLabs\Flows\Templates\Requests\ListTemplatesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\TemplateListResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Flows\Templates\Requests\ListTemplatesRequest $request = new \ElevenLabs\Flows\Templates\Requests\ListTemplatesRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\TemplateListResponse {
    $cursor = $request->cursor;
    $pageSize = $request->pageSize;
    $versionsPerTemplate = $request->versionsPerTemplate;
    $search = $request->search;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 25);
    Validator::validateNumber($versionsPerTemplate, 'versions_per_template', min: 1, max: 10);
    Validator::validateString($search, 'search', maxLength: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/flows/templates',
        method: HttpMethod::GET,
        query: [
          'cursor' => $cursor,
          'page_size' => $pageSize,
          'versions_per_template' => $versionsPerTemplate,
          'search' => $search
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\TemplateListResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Retrieve one flows template, together with each runnable version's inputs and outputs. `versions` is empty when no published version is runnable through this API. Works for any template you can open, including templates shared with you by link or published to Explore from another workspace, which `GET /v1/flows/templates` does not list.
   *
   * @param string $templateId The ID of the template, as shown in the ElevenLabs app or by `GET /v1/flows/templates`.
   * @param \ElevenLabs\Flows\Templates\Requests\GetTemplatesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\TemplateSummary
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $templateId,
    \ElevenLabs\Flows\Templates\Requests\GetTemplatesRequest $request = new \ElevenLabs\Flows\Templates\Requests\GetTemplatesRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\TemplateSummary {
    $versionsPerTemplate = $request->versionsPerTemplate;

    Validator::validateNumber($versionsPerTemplate, 'versions_per_template', min: 1, max: 10);

    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/flows/templates/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($templateId),
        method: HttpMethod::GET,
        query: [
          'versions_per_template' => $versionsPerTemplate
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\TemplateSummary::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
