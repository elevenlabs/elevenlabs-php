<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Types;

enum ListDubbingRequestCreationSourcesItem: string
{
  case FlowNode = 'flow_node';
  case DubbingUi = 'dubbing_ui';
  case DubbingApi = 'dubbing_api';
}
