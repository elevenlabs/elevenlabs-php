<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Wait;

use ElevenLabs\ElevenLabs;
use ElevenLabs\Flows\FlowsClient;

/**
 * Adds `createAndWait` to the flows clients: start a generation or template run and poll until it
 * is `completed` or `failed`.
 *
 * ```php
 * $flows = new FlowsWaiter($client);
 * $generation = $flows->image->createAndWait($request, waitTimeoutInSeconds: 600);
 * $run = $flows->templates->runs->createAndWait($templateId, $runRequest);
 * ```
 *
 * Each waiter sends its requests through the matching generated client (`$client->flows->image`,
 * and so on), so base URL, credentials, retries and per-method config set on those clients apply.
 *
 * Hand-written rather than generated (see `.fernignore`): the generated methods return only the
 * response body, and the wait needs the `Retry-After` header. The generated root client is
 * regenerated on every release, so this is a separate entry point rather than a property on it.
 * Mirrors the `create_and_wait` helpers in the Python SDK.
 */
final class FlowsWaiter
{
  public readonly ImageWaiter $image;
  public readonly VideoWaiter $video;
  public readonly TextToSpeechWaiter $textToSpeech;
  public readonly TemplatesWaiter $templates;

  /**
   * @param ElevenLabs|FlowsClient $client The root client, or its `flows` client.
   * @param ?PollClock $clock @internal Replaces sleeping and the clock in tests.
   */
  public function __construct(ElevenLabs|FlowsClient $client, ?PollClock $clock = null)
  {
    $flows = $client instanceof ElevenLabs ? $client->flows : $client;
    $poller = new Poller($clock ?? new PollClock());
    $this->image = new ImageWaiter($flows->image, $poller);
    $this->video = new VideoWaiter($flows->video, $poller);
    $this->textToSpeech = new TextToSpeechWaiter($flows->textToSpeech, $poller);
    $this->templates = new TemplatesWaiter($flows->templates, $poller);
  }
}
