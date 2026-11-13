<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Groups\Members;

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
  /** @var array|null Method-level configuration for remove */
  protected ?array $removeConfig = null;

  /** @var array|null Method-level configuration for add */
  protected ?array $addConfig = null;

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
   * Set method-level configuration for add.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setAddConfig(array $config): static
  {
    $this->addConfig = $config;
    return $this;
  }

  /**
   * Removes a member from the specified group. Requires `group_members_manage` permission.
   *
   * @param string $groupId The ID of the target group.
   * @param \ElevenLabs\Workspace\Groups\Members\Requests\BodyDeleteMemberFromUserGroupV1WorkspaceGroupsGroupIdMembersRemovePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DeleteWorkspaceGroupMemberResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function remove(
    string $groupId,
    \ElevenLabs\Workspace\Groups\Members\Requests\BodyDeleteMemberFromUserGroupV1WorkspaceGroupsGroupIdMembersRemovePost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\DeleteWorkspaceGroupMemberResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->removeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/groups/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($groupId) .
          '/members/remove',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\DeleteWorkspaceGroupMemberResponseModel::class
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
   * Adds a member of your workspace to the specified group. Requires `group_members_manage` permission.
   *
   * @param string $groupId The ID of the target group.
   * @param \ElevenLabs\Workspace\Groups\Members\Requests\AddMemberToGroupRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AddWorkspaceGroupMemberResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function add(
    string $groupId,
    \ElevenLabs\Workspace\Groups\Members\Requests\AddMemberToGroupRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AddWorkspaceGroupMemberResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->addConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/groups/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($groupId) .
          '/members',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AddWorkspaceGroupMemberResponseModel::class
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
