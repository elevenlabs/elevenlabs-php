<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CustomLlmapiType: string
{
  case ChatCompletions = 'chat_completions';
  case Responses = 'responses';
  case Websocket = 'websocket';
}
