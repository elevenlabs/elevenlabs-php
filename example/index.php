<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use ElevenLabs\ElevenLabs;
use ElevenLabs\History\Requests\ListHistoryRequest;
use ElevenLabs\History\Types\ListHistoryRequestSortDirection;
use ElevenLabs\History\Types\ListHistoryRequestSource;

$client = new ElevenLabs();
$client->history->list(
  new ListHistoryRequest([
    'pageSize' => 1,
    'startAfterHistoryItemId' => 'start_after_history_item_id',
    'voiceId' => 'voice_id',
    'modelId' => 'eleven_turbo_v2',
    'dateBeforeUnix' => 1640995200,
    'dateAfterUnix' => 1640995200,
    'sortDirection' => ListHistoryRequestSortDirection::Asc->value,
    'search' => 'In the land far far away',
    'source' => ListHistoryRequestSource::Tts->value
  ])
);
