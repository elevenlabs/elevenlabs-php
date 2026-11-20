<?php

declare(strict_types=1);

namespace ElevenLabs\AgentsAsCode;

/**
 * Thrown when a project's files can't be read or written: a missing or malformed file, a path
 * outside the project, or a format the SDK can't read yet (YAML and TOML configs).
 *
 * Hand-written (see `.fernignore`).
 */
final class AgentProjectError extends \RuntimeException
{
}
