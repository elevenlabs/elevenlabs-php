<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Wait;

use ElevenLabs\Flows\Video\VideoClient;
use ElevenLabs\Types\VideoGenerationRequest;
use ElevenLabs\Types\MediaGenerationResponse;

/**
 * `createAndWait` for `$client->flows->video`. Get one from `FlowsWaiter`.
 *
 * Hand-written (see `.fernignore`), mirroring `VideoClient.create_and_wait` in the Python SDK.
 */
final class VideoWaiter extends GenerationWaiter
{
  public function __construct(VideoClient $client, Poller $poller)
  {
    parent::__construct($client, '/v1/flows/video', $poller);
  }

  /**
   * Start a video generation and wait until it is `completed` or `failed`, then return the final generation.
   *
   * Between status checks this waits as long as the server's `Retry-After` header suggests, never
   * less than `$minPollIntervalInSeconds`, plus up to 20% jitter. This is meant for scripts and
   * quickstarts: in production, set `webhook` on the request passed to `create` and handle the
   * webhook event instead of holding a process open.
   *
   * A `failed` generation is returned, not thrown; check `status` (or `isFailed()`) on the result.
   *
   * @param VideoGenerationRequest $request
   * @param ?float $waitTimeoutInSeconds Seconds to wait in total before throwing `FlowsWaitTimeoutError`,
   *     which carries the generation ID so you can resume with `get`. Waits indefinitely when null
   *     (the default) or `INF`; must be at least 0 when set, and 0 throws straight after the create
   *     unless it already finished. Not to be confused with the `timeout` option, which limits each
   *     HTTP request.
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
   * @return MediaGenerationResponse The generation in its terminal state: `completed` or `failed`.
   * @throws FlowsWaitTimeoutError
   * @throws \ElevenLabs\Exceptions\ValidationException When `$waitTimeoutInSeconds` or `$minPollIntervalInSeconds` is out of range; thrown before any request.
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function createAndWait(
    VideoGenerationRequest $request,
    ?float $waitTimeoutInSeconds = null,
    float $minPollIntervalInSeconds = Poller::DEFAULT_MIN_POLL_INTERVAL_SECONDS,
    ?array $options = null,
  ): MediaGenerationResponse {
    return $this->run($request, $waitTimeoutInSeconds, $minPollIntervalInSeconds, $options);
  }
}
