<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Commit strategy for speech segmentation. 'manual' (the default for all models) requires explicit commits, 'vad' automatically segments speech using silence detection, 'turn_prediction' additionally commits as soon as the model predicts the speaker has finished their turn (only for models that predict turns).
 */
enum SpeechToTextRealtimeCommitStrategy: string
{
  case Manual = 'manual';
  case Vad = 'vad';
  case TurnPrediction = 'turn_prediction';
}
