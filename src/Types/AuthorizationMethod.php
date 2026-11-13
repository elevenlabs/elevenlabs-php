<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AuthorizationMethod: string
{
  case Invalid = 'invalid';
  case Public_ = 'public';
  case AuthorizationHeader = 'authorization_header';
  case SignedUrl = 'signed_url';
  case ShareableLink = 'shareable_link';
  case LivekitToken = 'livekit_token';
  case LivekitTokenWebsite = 'livekit_token_website';
  case GenesysApiKey = 'genesys_api_key';
  case AvayaApiKey = 'avaya_api_key';
  case AudiocodesApiKey = 'audiocodes_api_key';
  case Whatsapp = 'whatsapp';
  case Sms = 'sms';
}
