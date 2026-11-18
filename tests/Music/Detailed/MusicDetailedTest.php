<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Music\Detailed;

use ElevenLabs\ElevenLabs;
use ElevenLabs\Exceptions\ElevenlabsApiException;
use ElevenLabs\Exceptions\ElevenlabsException;
use ElevenLabs\Music\Detailed\MultipartParser;
use ElevenLabs\Music\Detailed\MusicDetailed;
use ElevenLabs\Music\Requests\BodyComposeMusicWithADetailedResponseV1MusicDetailedPost;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;

class MusicDetailedTest extends TestCase
{
  private const BOUNDARY = '--boundary123';

  /** @var array<string, mixed> */
  private const METADATA = [
    'composition_plan' => ['positive_global_styles' => ['pop'], 'negative_global_styles' => [], 'sections' => []],
    'song_metadata' => [
      'title' => 'Test',
      'description' => 'A test song',
      'genres' => ['pop'],
      'languages' => ['en'],
      'is_explicit' => false,
    ],
    'words_timestamps' => null,
  ];

  private MockHandler $replies;
  /** @var list<array{request: \Psr\Http\Message\RequestInterface}> */
  private array $history = [];
  private MusicDetailed $music;

  protected function setUp(): void
  {
    $this->replies = new MockHandler();
    $this->history = [];
    $stack = HandlerStack::create($this->replies);
    $stack->push(Middleware::history($this->history));
    $client = new ElevenLabs('test-key', ['client' => new GuzzleClient(['handler' => $stack]), 'maxRetries' => 0]);
    $this->music = new MusicDetailed($client);
  }

  /** Every byte value, so an off-by-one at either end of the audio part shows up. */
  private static function audio(): string
  {
    return str_repeat(implode('', array_map('chr', range(0, 255))), 4);
  }

  private static function multipart(string $nl, ?string $json = null, bool $disposition = true): string
  {
    $b = self::BOUNDARY;
    return $b . $nl
      . 'Content-Type: application/json' . $nl
      . $nl
      . ($json ?? json_encode(self::METADATA, JSON_THROW_ON_ERROR)) . $nl
      . $b . $nl
      . 'Content-Type: audio/mpeg' . $nl
      . ($disposition ? 'Content-Disposition: attachment; filename="test_song.mp3"' . $nl : '')
      . $nl
      . self::audio()
      . $nl . $b . '--' . $nl;
  }

  /** @param array<string, string> $headers */
  private function reply(string $body, array $headers = [], int $status = 200): void
  {
    $this->replies->append(new Response($status, ['Content-Type' => 'multipart/mixed; boundary=boundary123'] + $headers, $body));
  }

  private static function request(): BodyComposeMusicWithADetailedResponseV1MusicDetailedPost
  {
    return new BodyComposeMusicWithADetailedResponseV1MusicDetailedPost([
      'prompt' => 'Epic orchestral music',
      'musicLengthMs' => 10000,
      'outputFormat' => 'mp3_44100_128',
    ]);
  }

  public function testParsesMetadataAndExactAudioWithCrlfLineEndings(): void
  {
    $this->reply(self::multipart("\r\n"), ['song-id' => 'song_abc']);

    $song = $this->music->composeDetailed(self::request());

    $this->assertSame(self::METADATA, $song->json);
    $this->assertSame(self::audio(), $song->audio, 'audio must be byte-for-byte, with the closing delimiter stripped');
    $this->assertSame('test_song.mp3', $song->filename);
    $this->assertSame('song_abc', $song->songId);
  }

  public function testParsesLfLineEndings(): void
  {
    $this->reply(self::multipart("\n"));

    $song = $this->music->composeDetailed(self::request());

    $this->assertSame(self::METADATA, $song->json);
    $this->assertSame(self::audio(), $song->audio);
    $this->assertSame('test_song.mp3', $song->filename);
  }

  public function testSendsTheGeneratedRequest(): void
  {
    $this->reply(self::multipart("\r\n"));

    $this->music->composeDetailed(self::request());

    $request = $this->history[0]['request'];
    $this->assertSame('POST', $request->getMethod());
    $this->assertSame('/v1/music/detailed', $request->getUri()->getPath());
    $this->assertStringContainsString('output_format=mp3_44100_128', $request->getUri()->getQuery());
    $body = json_decode((string) $request->getBody(), true, 512, JSON_THROW_ON_ERROR);
    $this->assertSame('Epic orchestral music', $body['prompt']);
    $this->assertSame(10000, $body['music_length_ms']);
    $this->assertArrayNotHasKey('output_format', $body, 'output_format is a query parameter, not a body field');
  }

  public function testSongIdIsNullWithoutTheHeader(): void
  {
    $this->reply(self::multipart("\r\n"));

    $this->assertNull($this->music->composeDetailed(self::request())->songId);
  }

  public function testDefaultsTheFilenameWithoutContentDisposition(): void
  {
    $this->reply(self::multipart("\r\n", disposition: false));

    $song = $this->music->composeDetailed(self::request());

    $this->assertSame(MultipartParser::DEFAULT_FILENAME, $song->filename);
    $this->assertSame(self::audio(), $song->audio);
  }

  public function testParsesPrettyPrintedJson(): void
  {
    $pretty = json_encode(self::METADATA, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
    $this->reply(self::multipart("\r\n", str_replace("\n", "\r\n", $pretty)));

    $this->assertSame(self::METADATA, $this->music->composeDetailed(self::request())->json);
  }

  public function testThrowsWithoutAJsonPart(): void
  {
    $b = self::BOUNDARY;
    $this->reply("{$b}\r\nContent-Type: audio/mpeg\r\n\r\n" . self::audio() . "\r\n{$b}--\r\n");

    $this->expectException(ElevenlabsException::class);
    $this->expectExceptionMessage('JSON part');
    $this->music->composeDetailed(self::request());
  }

  public function testThrowsWithoutAnAudioPart(): void
  {
    $b = self::BOUNDARY;
    $this->reply("{$b}\r\nContent-Type: application/json\r\n\r\n{}\r\n{$b}--\r\n");

    $this->expectException(ElevenlabsException::class);
    $this->expectExceptionMessage('audio part');
    $this->music->composeDetailed(self::request());
  }

  public function testApiErrorsKeepTheGeneratedErrorHandling(): void
  {
    $this->replies->append(new Response(422, ['Content-Type' => 'application/json'], '{"detail":"bad request"}'));

    $this->expectException(ElevenlabsApiException::class);
    $this->music->composeDetailed(self::request());
  }

  public function testThrowsWhenTheBodyEndsMidAudio(): void
  {
    $full = self::multipart("\r\n");
    // Cut inside the audio, so the closing delimiter never arrives.
    $this->reply(substr($full, 0, strlen($full) - strlen("\r\n" . self::BOUNDARY . "--\r\n") - 100));

    $this->expectException(ElevenlabsException::class);
    $this->expectExceptionMessage('incomplete');
    $this->music->composeDetailed(self::request());
  }

  public function testThrowsOnAPartialClosingBoundary(): void
  {
    $full = self::multipart("\r\n");
    $this->reply(substr($full, 0, strlen($full) - strlen("3--\r\n")));

    $this->expectException(ElevenlabsException::class);
    $this->expectExceptionMessage('incomplete');
    $this->music->composeDetailed(self::request());
  }

  public function testSkipsAPreambleUsingTheContentTypeBoundary(): void
  {
    $this->reply("This is a multipart message.\r\n" . self::multipart("\r\n"));

    $song = $this->music->composeDetailed(self::request());

    $this->assertSame(self::METADATA, $song->json);
    $this->assertSame(self::audio(), $song->audio);
  }

  public function testReadsTheBoundaryParameter(): void
  {
    $this->assertSame('abc', MultipartParser::boundaryFrom('multipart/mixed; boundary="abc"'));
    $this->assertSame('----boundaryf00', MultipartParser::boundaryFrom('multipart/mixed; boundary=----boundaryf00'));
    $this->assertNull(MultipartParser::boundaryFrom('application/json'));
  }

  public function testParserFindsTheAudioPartBeforeTheJsonPart(): void
  {
    $b = self::BOUNDARY;
    $body = "{$b}\r\nContent-Type: audio/mpeg\r\n\r\n" . self::audio()
      . "\r\n{$b}\r\nContent-Type: application/json\r\n\r\n{\"a\":1}\r\n{$b}--\r\n";

    $parsed = MultipartParser::parse($body);

    $this->assertSame(['a' => 1], $parsed['json']);
    $this->assertSame(self::audio(), $parsed['audio']);
  }
}
