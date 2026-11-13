<?php

declare(strict_types=1);

namespace ElevenLabs\PronunciationDictionaries\Types;

enum BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostWorkspaceAccess: string
{
  case Admin = 'admin';
  case Editor = 'editor';
  case Commenter = 'commenter';
  case Viewer = 'viewer';
}
