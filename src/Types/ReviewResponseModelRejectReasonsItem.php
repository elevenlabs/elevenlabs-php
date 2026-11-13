<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ReviewResponseModelRejectReasonsItem: string
{
  case LacksStructure = 'lacks_structure';
  case DoesntOpen = 'doesnt_open';
  case NotLiteraryWork = 'not_literary_work';
  case LanguageNotSupported = 'language_not_supported';
  case TooShort = 'too_short';
  case Duplicate = 'duplicate';
  case Promotional = 'promotional';
  case FormattingIssues = 'formatting_issues';
  case LowQuality = 'low_quality';
  case MetadataIncomplete = 'metadata_incomplete';
  case MetadataInaccurate = 'metadata_inaccurate';
  case Typos = 'typos';
  case ReviewError = 'review_error';
  case Spam = 'spam';
  case LegalViolation = 'legal_violation';
  case ContentPolicy = 'content_policy';
  case PublicDomain = 'public_domain';
  case Other = 'other';
}
