<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

use ElevenLabs\Workspace\AuditLogs\AuditLogsClient;
use ElevenLabs\Workspace\AuthConnections\AuthConnectionsClient;
use ElevenLabs\Workspace\Groups\GroupsClient;
use ElevenLabs\Workspace\Members\MembersClient;
use ElevenLabs\Workspace\Invites\InvitesClient;
use ElevenLabs\Workspace\Resources\ResourcesClient;
use ElevenLabs\Workspace\Usage\UsageClient;
use ElevenLabs\Workspace\Analytics\AnalyticsClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class WorkspaceClient extends BaseService
{
  public AuditLogsClient $auditLogs;
  public AuthConnectionsClient $authConnections;
  public GroupsClient $groups;
  public MembersClient $members;
  public InvitesClient $invites;
  public ResourcesClient $resources;
  public UsageClient $usage;
  public AnalyticsClient $analytics;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->auditLogs = new AuditLogsClient($client, $options);
    $this->authConnections = new AuthConnectionsClient($client, $options);
    $this->groups = new GroupsClient($client, $options);
    $this->members = new MembersClient($client, $options);
    $this->invites = new InvitesClient($client, $options);
    $this->resources = new ResourcesClient($client, $options);
    $this->usage = new UsageClient($client, $options);
    $this->analytics = new AnalyticsClient($client, $options);
  }

  /** @var array|null Method-level configuration for setThirdPartyDisablingPolicy */
  protected ?array $setThirdPartyDisablingPolicyConfig = null;

  /**
   * Set method-level configuration for setThirdPartyDisablingPolicy.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setSetThirdPartyDisablingPolicyConfig(array $config): static
  {
    $this->setThirdPartyDisablingPolicyConfig = $config;
    return $this;
  }

  /**
   * Set the workspace-wide Third-Party Disabling policy. When set, it forces, for every API key in the workspace, whether the holder of a key (potentially a third party who found it) may disable it via the self-disable endpoint or when it leaks publicly — overriding each key's own setting. Pass `true` to allow it for all keys, `false` to forbid it for all keys, or `null` to clear the override so per-key values and the plan default apply again. Workspace admins only.
   *
   * @param \ElevenLabs\Workspace\Requests\BodySetWorkspaceThirdPartyDisablingPolicyV1WorkspacesApiKeysThirdPartyDisablingPost $request Request body
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
  public function setThirdPartyDisablingPolicy(
    \ElevenLabs\Workspace\Requests\BodySetWorkspaceThirdPartyDisablingPolicyV1WorkspacesApiKeysThirdPartyDisablingPost $request = new \ElevenLabs\Workspace\Requests\BodySetWorkspaceThirdPartyDisablingPolicyV1WorkspacesApiKeysThirdPartyDisablingPost(),
    ?array $options = null
  ): mixed {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->setThirdPartyDisablingPolicyConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspaces/api-keys/third-party-disabling',
        method: HttpMethod::POST,
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
}
