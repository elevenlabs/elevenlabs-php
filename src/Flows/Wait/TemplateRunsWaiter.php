<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Wait;

use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Core\Client\RawClient;
use ElevenLabs\Flows\Templates\Runs\Requests\TemplateRunCreateRequest;
use ElevenLabs\Flows\Templates\Runs\RunsClient;
use ElevenLabs\Types\TemplateRunResponse;
use ElevenLabs\Utils\Serializer;
use Psr\Http\Message\ResponseInterface;

/**
 * `createAndWait` for `$client->flows->templates->runs`. Get one from `FlowsWaiter`.
 *
 * Hand-written (see `.fernignore`), mirroring `RunsClient.create_and_wait` in the Python SDK.
 */
final class TemplateRunsWaiter
{
  public function __construct(
    private readonly RunsClient $client,
    private readonly Poller $poller,
  ) {
  }

  /**
   * Start a run of a flows template and wait until its `status` is `completed` or `failed`, then
   * return the final run.
   *
   * Between status checks this waits as long as the server's `Retry-After` header suggests, never
   * less than `$minPollIntervalInSeconds`, plus up to 20% jitter. This is meant for scripts and
   * quickstarts: in production, pass `webhook` to `create` and handle the `flows_template_run`
   * webhook instead of holding a process open.
   *
   * A `failed` run is returned, not thrown; check `status` on the result and on each output.
   *
   * @param string $templateId The ID of the template, as shown in the ElevenLabs app or by `GET /v1/flows/templates`.
   * @param TemplateRunCreateRequest $request The run's `inputs`, and optionally `versionId` and `webhook`.
   * @param ?float $waitTimeoutInSeconds Seconds to wait in total before throwing `FlowsWaitTimeoutError`,
   *     which carries the run ID and template ID so you can resume with `get`. Waits indefinitely when
   *     null (the default) or `INF`; must be at least 0 when set, and 0 throws straight after the
   *     create unless it already finished. Not to be confused with the `timeout` option, which limits
   *     each HTTP request.
   * @param float $minPollIntervalInSeconds The shortest wait between status checks, in seconds, and the
   *     wait used when the server suggests none. Must be at least 0.5.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options Applied to the create call and to every status check, except `bodyProperties`, which
   *     only the create call gets. `timeout` and `maxRetries` apply to each request on its own;
   *     `$waitTimeoutInSeconds` bounds the whole wait.
   * @return TemplateRunResponse The run in its terminal state.
   * @throws FlowsWaitTimeoutError
   * @throws \ElevenLabs\Exceptions\ValidationException When `$waitTimeoutInSeconds` or `$minPollIntervalInSeconds` is out of range; thrown before any request.
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function createAndWait(
    string $templateId,
    TemplateRunCreateRequest $request,
    ?float $waitTimeoutInSeconds = null,
    float $minPollIntervalInSeconds = Poller::DEFAULT_MIN_POLL_INTERVAL_SECONDS,
    ?array $options = null,
  ): TemplateRunResponse {
    Poller::checkWaitOptions($waitTimeoutInSeconds, $minPollIntervalInSeconds);
    $request->validate();
    $startedAt = $this->poller->clock()->monotonic();

    $runsPath = '/v1/flows/templates/' . RawClient::encodePathParam($templateId) . '/runs';
    [$created, $createdHttp] = $this->exchange('createConfig', HttpMethod::POST, $runsPath, $request, $options);
    $runId = $created->id;
    $pollOptions = Poller::pollOptions($options);
    $runPath = $runsPath . '/' . RawClient::encodePathParam($runId);

    /** @var TemplateRunResponse */
    return $this->poller->wait(
      id: $runId,
      firstResponse: $created,
      firstHttpResponse: $createdHttp,
      get: fn(): array => $this->exchange('getConfig', HttpMethod::GET, $runPath, null, $pollOptions),
      startedAt: $startedAt,
      waitTimeoutInSeconds: $waitTimeoutInSeconds,
      minInterval: $minPollIntervalInSeconds,
      templateId: $templateId,
    );
  }

  /**
   * @param ?array<string, mixed> $options
   * @return array{TemplateRunResponse, ResponseInterface}
   */
  private function exchange(string $methodConfig, HttpMethod $method, string $path, mixed $body, ?array $options): array
  {
    $http = Poller::send($this->client, $methodConfig, $method, $path, $body, $options);
    $run = Poller::deserialize(
      $http,
      static fn(string $data): TemplateRunResponse => Serializer::deserialize($data, TemplateRunResponse::class)
    );
    return [$run, $http];
  }
}
