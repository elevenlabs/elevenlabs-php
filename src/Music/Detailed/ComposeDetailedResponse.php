<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Detailed;

/**
 * A composed song from `MusicDetailed::composeDetailed()`: the metadata the API returns with it,
 * the audio file, and its name.
 *
 * Hand-written (see `.fernignore`), mirroring `MultipartResponse` in the Python and TypeScript SDKs.
 */
final class ComposeDetailedResponse
{
  /**
   * @param array<mixed> $json The JSON metadata part as the API sent it (snake_case keys):
   *     `composition_plan`, `song_metadata` (title, description, genres, languages, is_explicit),
   *     `words_timestamps` (null unless `with_timestamps` is set) and, with
   *     `with_waveform_visual`, `waveform_visual`.
   * @param string $audio The audio file's bytes, in the requested `output_format`.
   * @param string $filename The file name the API suggests for the audio, or `generated_music.mp3`.
   * @param ?string $songId The `song-id` response header, sent when `store_for_inpainting` is set.
   */
  public function __construct(
    public readonly array $json,
    public readonly string $audio,
    public readonly string $filename,
    public readonly ?string $songId = null,
  ) {
  }
}
