<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Team\Members;

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
class MembersClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for updateRole */
  protected ?array $updateRoleConfig = null;

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
   * Set method-level configuration for updateRole.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUpdateRoleConfig(array $config): static
  {
    $this->updateRoleConfig = $config;
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
   * List the workspace's members, suspended members last.
   *
   * @param \ElevenLabs\Reception\Team\Members\Requests\ListMembersRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<\ElevenLabs\Types\ReceptionTeamMemberResponse>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Reception\Team\Members\Requests\ListMembersRequest $request,
    ?array $options = null
  ): ?array {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/team/members',
        method: HttpMethod::GET,
        headers: [
          'xi-workspace-id' => $xiWorkspaceId
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ReceptionTeamMemberResponse::class . '[]'
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
   * Promote a member to admin or demote an admin to member.
   *
   * @param string $userId User ID of the member to update
   * @param \ElevenLabs\Reception\Team\Members\Requests\BodySmbUpdateTeamMemberRole $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<string, string>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function updateRole(
    string $userId,
    \ElevenLabs\Reception\Team\Members\Requests\BodySmbUpdateTeamMemberRole $request,
    ?array $options = null
  ): ?array {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateRoleConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/team/members/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($userId),
        method: HttpMethod::PATCH,
        headers: [
          'xi-workspace-id' => $xiWorkspaceId
        ],
        body: $request
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

  /**
   * Remove a member from the workspace. Their seat goes to a suspended member, if any.
   *
   * @param string $userId User ID of the member to remove
   * @param \ElevenLabs\Reception\Team\Members\Requests\RemoveMembersRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<string, string>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function remove(
    string $userId,
    \ElevenLabs\Reception\Team\Members\Requests\RemoveMembersRequest $request,
    ?array $options = null
  ): ?array {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $resolvedConfig = $this->getResolvedConfig($this->removeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/team/members/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($userId),
        method: HttpMethod::DELETE,
        headers: [
          'xi-workspace-id' => $xiWorkspaceId
        ]
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
