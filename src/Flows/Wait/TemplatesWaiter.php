<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Wait;

use ElevenLabs\Flows\Templates\TemplatesClient;

/**
 * Mirrors `$client->flows->templates` so a template run reads `$waiter->templates->runs->createAndWait(...)`.
 *
 * Hand-written (see `.fernignore`).
 */
final class TemplatesWaiter
{
  public readonly TemplateRunsWaiter $runs;

  public function __construct(TemplatesClient $client, Poller $poller)
  {
    $this->runs = new TemplateRunsWaiter($client->runs, $poller);
  }
}
