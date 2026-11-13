<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\AuditLogs;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class AuditLogsClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

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
   * Returns the audit log for the workspace. Requires enterprise tier and the audit_log_read permission.
   *
   * @param \ElevenLabs\Workspace\AuditLogs\Requests\ListAuditLogsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\WorkspaceAuditLogsPageResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Workspace\AuditLogs\Requests\ListAuditLogsRequest $request = new \ElevenLabs\Workspace\AuditLogs\Requests\ListAuditLogsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\WorkspaceAuditLogsPageResponse {
    $limit = $request->limit;
    $cursor = $request->cursor;
    $timeFromUnixMs = $request->timeFromUnixMs;
    $timeToUnixMs = $request->timeToUnixMs;
    $actorUid = $request->actorUid;
    $className = $request->className;
    $activityName = $request->activityName;

    Validator::validateNumber($limit, 'limit', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/audit-logs',
        method: HttpMethod::GET,
        query: [
          'limit' => $limit,
          'cursor' => $cursor,
          'time_from_unix_ms' => $timeFromUnixMs,
          'time_to_unix_ms' => $timeToUnixMs,
          'actor_uid' => $actorUid,
          'class_name' => $className,
          'activity_name' => $activityName
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\WorkspaceAuditLogsPageResponse::class
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
