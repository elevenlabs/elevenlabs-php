<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tests\Types;

/**
 * Sort mode for listing tests. Use 'folders_first' to place folders before tests.
 */
enum ListTestsRequestSortMode: string
{
  case Default_ = 'default';
  case FoldersFirst = 'folders_first';
}
