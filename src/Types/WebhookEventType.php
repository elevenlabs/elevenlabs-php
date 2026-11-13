<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WebhookEventType: string
{
  case Transcript = 'transcript';
  case Audio = 'audio';
  case CallInitiationFailure = 'call_initiation_failure';
  case AnsweringMachineDetection = 'answering_machine_detection';
  case UnredactedTranscript = 'unredacted_transcript';
  case UnredactedAudio = 'unredacted_audio';
}
