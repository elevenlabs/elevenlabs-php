<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechEngine;

/**
 * A single message in a Speech Engine conversation transcript.
 *
 * Hand-written (see `.fernignore`): the server-side session surface is not part
 * of the generated client. Mirrors `ConversationMessage` in the Python/TS SDKs.
 */
final class ConversationMessage
{
  public function __construct(
    /** Either "user" or "agent". */
    public readonly string $role,
    /** The text content of the message. */
    public readonly string $content,
  ) {
  }
}
