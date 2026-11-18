<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Wait;

use ElevenLabs\Exceptions\ElevenlabsException;

/**
 * Thrown by `createAndWait` when a generation or template run is still unfinished after
 * `waitTimeoutInSeconds` seconds.
 *
 * The work keeps running on the server. Resume waiting by calling `get` with `$id` (and
 * `$templateId` for a template run), or let a webhook deliver the result.
 *
 * Hand-written (see `.fernignore`), mirroring `FlowsWaitTimeoutError` in the Python/TS SDKs.
 */
class FlowsWaitTimeoutError extends ElevenlabsException
{
  /** The status of the last response seen before the wait ran out, such as `pending` or `generating`. */
  public readonly string $lastStatus;

  public function __construct(
    /** The generation ID, or the run ID for a template run. */
    public readonly string $id,
    /** The total wait that ran out, in seconds. */
    public readonly float $waitTimeoutInSeconds,
    /**
     * The last response seen: a `MediaGenerationCreateResponse` or `MediaGenerationResponse` for a
     * generation, a `TemplateRunResponse` for a template run.
     */
    public readonly object $lastResponse,
    /** The template ID for a template run, null for a generation. */
    public readonly ?string $templateId = null,
  ) {
    $this->lastStatus = Poller::statusOf($lastResponse);
    $after = self::formatSeconds($waitTimeoutInSeconds);
    if ($templateId !== null) {
      $message = "Template run {$id} of template {$templateId} is still {$this->lastStatus} after {$after}s; "
        . 'call `runs->get` with the template ID and run ID to keep waiting';
    } else {
      $message = "Generation {$id} is still {$this->lastStatus} after {$after}s; "
        . 'call `get` with this ID to keep waiting';
    }
    parent::__construct($message);
  }

  private static function formatSeconds(float $seconds): string
  {
    // `10` rather than `10.0`, but keep fractions such as `2.5`.
    return rtrim(rtrim(sprintf('%.3F', $seconds), '0'), '.');
  }
}
