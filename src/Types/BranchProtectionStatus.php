<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum BranchProtectionStatus: string
{
  case WriterPermsRequired = 'writer_perms_required';
  case AdminPermsRequired = 'admin_perms_required';
}
