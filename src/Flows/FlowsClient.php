<?php

declare(strict_types=1);

namespace ElevenLabs\Flows;

use ElevenLabs\Flows\TextToSpeech\TextToSpeechClient;
use ElevenLabs\Flows\Video\VideoClient;
use ElevenLabs\Flows\Image\ImageClient;
use ElevenLabs\Flows\Templates\TemplatesClient;

/**
 * Groups the `flows` resources.
 *
 * It owns no endpoints of its own: every operation lives on one of the clients below, so this class
 * exists only so they are reached as `$client->flows->{child}`.
 */
class FlowsClient
{
  public TextToSpeechClient $textToSpeech;
  public VideoClient $video;
  public ImageClient $image;
  public TemplatesClient $templates;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    $this->textToSpeech = new TextToSpeechClient($client, $options);
    $this->video = new VideoClient($client, $options);
    $this->image = new ImageClient($client, $options);
    $this->templates = new TemplatesClient($client, $options);
  }
}
