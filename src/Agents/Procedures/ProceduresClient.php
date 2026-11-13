<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Procedures;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

use ElevenLabs\Agents\Procedures\Drafts\DraftsClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class ProceduresClient extends BaseService
{
  public DraftsClient $drafts;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->drafts = new DraftsClient($client, $options);
  }

  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for compile */
  protected ?array $compileConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for remove */
  protected ?array $removeConfig = null;

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
   * Set method-level configuration for compile.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCompileConfig(array $config): static
  {
    $this->compileConfig = $config;
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
   * Set method-level configuration for remove.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRemoveConfig(array $config): static
  {
    $this->removeConfig = $config;
    return $this;
  }

  /**
   * List the procedures attached to this agent branch. By default, unpublished drafts take precedence over the latest committed version. Pass agent_version_id to list a published snapshot instead. has_draft is true when a procedure has unpublished draft changes on this branch. Procedure content is not included; use Get Procedure to read a procedure's body.
   *
   * @param string $agentId Agent ID to get the procedure draft from
   * @param string $branchId Branch ID to get the procedure draft from
   * @param \ElevenLabs\Agents\Procedures\Requests\ListProceduresRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ListProceduresResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    string $agentId,
    string $branchId,
    \ElevenLabs\Agents\Procedures\Requests\ListProceduresRequest $request = new \ElevenLabs\Agents\Procedures\Requests\ListProceduresRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\ListProceduresResponseModel {
    $agentVersionId = $request->agentVersionId;

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/branches/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($branchId) .
          '/procedures',
        method: HttpMethod::GET,
        query: [
          'agent_version_id' => $agentVersionId
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ListProceduresResponseModel::class
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
   * Create a new procedure for the agent on a branch.
   *
   * @param string $agentId Agent ID to get the procedure draft from
   * @param string $branchId Branch ID to get the procedure draft from
   * @param ?\ElevenLabs\Types\CreateProcedureRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CreateProcedureResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    string $agentId,
    string $branchId,
    ?\ElevenLabs\Types\CreateProcedureRequestModel $request = null,
    ?array $options = null
  ): ?\ElevenLabs\Types\CreateProcedureResponseModel {
    $request?->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/branches/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($branchId) .
          '/procedures',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\CreateProcedureResponseModel::class
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
   * Legacy. Do not use. Saving an agent draft (`POST /v1/convai/agents/{agent_id}/drafts`) and publishing an agent (`PATCH /v1/convai/agents/{agent_id}`) compile structured procedures into workflow nodes and edges, save the compiled workflow with the draft or version, and return validation errors, so a separate compile call is no longer needed. This endpoint remains available for the time being so existing callers do not break, as a dry-run that compiles the current procedure drafts into a workflow without persisting anything. It will eventually be deprecated.
   *
   * @param string $agentId Agent ID to get the procedure draft from
   * @param string $branchId Branch ID to get the procedure draft from
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CompileProceduresResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function compile(
    string $agentId,
    string $branchId,
    ?array $options = null
  ): ?\ElevenLabs\Types\CompileProceduresResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->compileConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/branches/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($branchId) .
          '/procedures/compile',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\CompileProceduresResponseModel::class
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
   * Retrieve a procedure at a specific version or the current branch HEAD.
   *
   * @param string $agentId Agent ID to get the procedure draft from
   * @param string $branchId Branch ID to get the procedure draft from
   * @param string $procedureId The procedure ID
   * @param \ElevenLabs\Agents\Procedures\Requests\GetProceduresRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ProcedureAtVersionResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $agentId,
    string $branchId,
    string $procedureId,
    \ElevenLabs\Agents\Procedures\Requests\GetProceduresRequest $request = new \ElevenLabs\Agents\Procedures\Requests\GetProceduresRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\ProcedureAtVersionResponseModel {
    $versionId = $request->versionId;
    $agentVersionId = $request->agentVersionId;

    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/branches/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($branchId) .
          '/procedures/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($procedureId),
        method: HttpMethod::GET,
        query: [
          'version_id' => $versionId,
          'agent_version_id' => $agentVersionId
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ProcedureAtVersionResponseModel::class
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
   * Remove a procedure from the agent's draft working set. Removing a folder cascades to its entire subtree, rejected if any procedure outside the subtree hands off into it.
   *
   * @param string $agentId Agent ID to get the procedure draft from
   * @param string $branchId Branch ID to get the procedure draft from
   * @param string $procedureId The procedure ID
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return mixed
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function remove(
    string $agentId,
    string $branchId,
    string $procedureId,
    ?array $options = null
  ): mixed {
    $resolvedConfig = $this->getResolvedConfig($this->removeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/branches/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($branchId) .
          '/procedures/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($procedureId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = $this->decodeJson($data);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
