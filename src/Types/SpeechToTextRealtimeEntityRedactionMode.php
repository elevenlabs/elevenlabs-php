<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How to format redacted entities. 'redacted' replaces with {REDACTED}, 'entity_type' replaces with {ENTITY_TYPE}, 'enumerated_entity_type' replaces with {ENTITY_TYPE_N} where N enumerates each occurrence. Only used when entity_redaction is set.
 */
enum SpeechToTextRealtimeEntityRedactionMode: string
{
  case EntityType = 'entity_type';
  case EnumeratedEntityType = 'enumerated_entity_type';
  case Redacted = 'redacted';
}
