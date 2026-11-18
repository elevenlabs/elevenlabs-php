<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Flows\Wait;

use ElevenLabs\ElevenLabs;
use ElevenLabs\Exceptions\ElevenlabsApiException;
use ElevenLabs\Exceptions\ValidationException;
use ElevenLabs\Flows\Templates\Runs\Requests\TemplateRunCreateRequest;
use ElevenLabs\Flows\Wait\FlowsWaiter;
use ElevenLabs\Flows\Wait\FlowsWaitTimeoutError;
use ElevenLabs\Flows\Wait\Poller;
use ElevenLabs\Types\ImageGenerationRequest;
use ElevenLabs\Types\TextToSpeechGenerationRequest;
use ElevenLabs\Types\VideoGenerationRequest;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;

class CreateAndWaitTest extends TestCase
{
  private MockHandler $replies;
  /** @var list<array{request: \Psr\Http\Message\RequestInterface}> */
  private array $history = [];
  private GuzzleClient $http;
  private FakeClock $clock;
  private FlowsWaiter $flows;

  protected function setUp(): void
  {
    // Guzzle rather than the generated MockHttpClient: services pass a default `timeout`, which
    // the transport only forwards to clients that support it.
    $this->replies = new MockHandler();
    $this->history = [];
    $stack = HandlerStack::create($this->replies);
    $stack->push(Middleware::history($this->history));
    $this->http = new GuzzleClient(['handler' => $stack]);
    $this->clock = new FakeClock();
    $client = new ElevenLabs('test-key', ['client' => $this->http, 'maxRetries' => 0]);
    $this->flows = new FlowsWaiter($client, $this->clock);
  }

  /**
   * @param array<string, mixed> $body
   * @param array<string, string> $headers
   */
  private function reply(array $body, array $headers = [], int $status = 200): void
  {
    $this->replies->append(new Response($status, ['Content-Type' => 'application/json'] + $headers, json_encode($body, JSON_THROW_ON_ERROR)));
  }

  /** @return array<string, mixed> */
  private static function completedGeneration(string $id = 'gen_1'): array
  {
    return ['id' => $id, 'status' => 'completed', 'content_url' => 'https://example.com/out.png', 'content_mime_type' => 'image/png'];
  }

  /** @return array<string, mixed> */
  private static function templateRun(string $status): array
  {
    return ['id' => 'run_1', 'template_id' => 'tpl_1', 'version_id' => 'ver_1', 'status' => $status, 'outputs' => new \stdClass()];
  }

  private static function imageRequest(): ImageGenerationRequest
  {
    return ImageGenerationRequest::fromArray(['model_id' => 'gpt-image-1', 'prompt' => 'a lighthouse']);
  }

  private static function runRequest(): TemplateRunCreateRequest
  {
    return new TemplateRunCreateRequest(['inputs' => []]);
  }

  /** @return list<string> */
  private function requestLines(): array
  {
    $lines = [];
    foreach ($this->requests() as $request) {
      $lines[] = $request->getMethod() . ' ' . $request->getUri()->getPath();
    }
    return $lines;
  }

  /** @return list<\Psr\Http\Message\RequestInterface> */
  private function requests(): array
  {
    return array_map(static fn(array $entry) => $entry['request'], $this->history);
  }

  public function testImagePollsUntilCompletedHonouringRetryAfterSeconds(): void
  {
    $this->reply(['id' => 'gen_1', 'status' => 'pending'], ['Retry-After' => '3']);
    $this->reply(['id' => 'gen_1', 'status' => 'generating'], ['Retry-After' => '7']);
    $this->reply(self::completedGeneration());

    $result = $this->flows->image->createAndWait(self::imageRequest());

    $this->assertTrue($result->isCompleted());
    $this->assertSame('gen_1', $result->asCompleted()->id);
    $this->assertSame([3.0, 7.0], $this->clock->sleeps);
    $this->assertSame(['POST /v1/flows/image', 'GET /v1/flows/image/gen_1', 'GET /v1/flows/image/gen_1'], $this->requestLines());
  }

  public function testInfiniteWaitTimeoutPollsUntilCompleted(): void
  {
    $this->reply(['id' => 'gen_1', 'status' => 'pending'], ['Retry-After' => '3']);
    $this->reply(self::completedGeneration());

    $result = $this->flows->image->createAndWait(self::imageRequest(), waitTimeoutInSeconds: INF);

    $this->assertTrue($result->isCompleted());
    $this->assertSame([3.0], $this->clock->sleeps);
  }

  public function testFailedGenerationIsReturnedNotThrown(): void
  {
    $this->reply(['id' => 'gen_1', 'status' => 'pending']);
    $this->reply(['id' => 'gen_1', 'status' => 'failed', 'failure_reason' => 'model_error', 'error_message' => 'boom']);

    $result = $this->flows->video->createAndWait(
      VideoGenerationRequest::fromArray(['model_id' => 'veo-3.1-generate-001', 'prompt' => 'waves'])
    );

    $this->assertTrue($result->isFailed());
    $this->assertSame('boom', $result->asFailed()->errorMessage);
    // No Retry-After: the default 3s minimum.
    $this->assertSame([3.0], $this->clock->sleeps);
    $this->assertSame(['POST /v1/flows/video', 'GET /v1/flows/video/gen_1'], $this->requestLines());
  }

  public function testTextToSpeechPollsItsOwnPath(): void
  {
    $this->reply(['id' => 'gen_1', 'status' => 'pending']);
    $this->reply(self::completedGeneration());

    $result = $this->flows->textToSpeech->createAndWait(
      TextToSpeechGenerationRequest::fromArray(['model_id' => 'eleven_flash_v2_5', 'text' => 'hi', 'voice' => 'voice_1'])
    );

    $this->assertTrue($result->isCompleted());
    $this->assertSame(['POST /v1/flows/text-to-speech', 'GET /v1/flows/text-to-speech/gen_1'], $this->requestLines());
  }

  public function testRetryAfterAsHttpDate(): void
  {
    // 10s after the fake wall clock.
    $date = gmdate('D, d M Y H:i:s \G\M\T', 1_000_000_010);
    $this->reply(['id' => 'gen_1', 'status' => 'pending'], ['Retry-After' => $date]);
    $this->reply(self::completedGeneration());

    $this->flows->image->createAndWait(self::imageRequest());

    $this->assertEqualsWithDelta([10.0], $this->clock->sleeps, 1e-6);
  }

  public function testRetryAfterParsing(): void
  {
    $now = 1_000_000_000.0;
    $parse = static fn(string $value): ?float => Poller::parseRetryAfter(new Response(200, ['Retry-After' => $value]), $now);

    $this->assertSame(12.0, $parse(' 12 '));
    $this->assertEqualsWithDelta(10.0, $parse(gmdate('D, d M Y H:i:s \G\M\T', 1_000_000_010)), 1e-6);
    $this->assertEqualsWithDelta(10.0, $parse(gmdate('l, d-M-y H:i:s \G\M\T', 1_000_000_010)), 1e-6);
    $this->assertEqualsWithDelta(10.0, $parse(gmdate('D M j H:i:s Y', 1_000_000_010)), 1e-6);
    // A date in the past means "now".
    $this->assertSame(0.0, $parse(gmdate('D, d M Y H:i:s \G\M\T', 999_999_990)));
    $this->assertNull($parse('-5'));
    $this->assertNull($parse('not-a-date'));
    $this->assertNull($parse('tomorrow'));
    $this->assertNull(Poller::parseRetryAfter(new Response(200), $now));
  }

  public function testMinPollIntervalIsAFloorUnderRetryAfter(): void
  {
    $this->reply(['id' => 'gen_1', 'status' => 'pending'], ['Retry-After' => '1']);
    $this->reply(['id' => 'gen_1', 'status' => 'pending'], ['Retry-After' => '0']);
    $this->reply(['id' => 'gen_1', 'status' => 'pending'], ['Retry-After' => gmdate('D, d M Y H:i:s \G\M\T', 999_999_000)]);
    $this->reply(['id' => 'gen_1', 'status' => 'pending'], ['Retry-After' => '8']);
    $this->reply(self::completedGeneration());

    $this->flows->image->createAndWait(self::imageRequest(), minPollIntervalInSeconds: 5.0);

    $this->assertSame([5.0, 5.0, 5.0, 8.0], $this->clock->sleeps);
  }

  public function testJitterAddsUpToTwentyPercent(): void
  {
    $this->clock->randomValue = 0.5;
    $this->reply(['id' => 'gen_1', 'status' => 'pending'], ['Retry-After' => '5']);
    $this->reply(self::completedGeneration());

    $this->flows->image->createAndWait(self::imageRequest());

    $this->assertEqualsWithDelta([5.5], $this->clock->sleeps, 1e-9);
  }

  public function testTimeoutThrowsWithGenerationId(): void
  {
    $this->reply(['id' => 'gen_1', 'status' => 'pending'], ['Retry-After' => '30']);
    $this->reply(['id' => 'gen_1', 'status' => 'generating'], ['Retry-After' => '30']);

    try {
      $this->flows->image->createAndWait(self::imageRequest(), waitTimeoutInSeconds: 10);
      $this->fail('Expected FlowsWaitTimeoutError');
    } catch (FlowsWaitTimeoutError $e) {
      // The 30s hint is cut to the 10s left on the deadline.
      $this->assertSame([10.0], $this->clock->sleeps);
      $this->assertSame('gen_1', $e->id);
      $this->assertNull($e->templateId);
      $this->assertSame('generating', $e->lastStatus);
      $this->assertSame(10.0, $e->waitTimeoutInSeconds);
      $this->assertSame('Generation gen_1 is still generating after 10s; call `get` with this ID to keep waiting', $e->getMessage());
      $this->assertCount(2, $this->requests());
    }
  }

  public function testZeroTimeoutThrowsStraightAfterCreate(): void
  {
    $this->reply(['id' => 'gen_1', 'status' => 'pending'], ['Retry-After' => '3']);

    try {
      $this->flows->image->createAndWait(self::imageRequest(), waitTimeoutInSeconds: 0);
      $this->fail('Expected FlowsWaitTimeoutError');
    } catch (FlowsWaitTimeoutError $e) {
      $this->assertSame('pending', $e->lastStatus);
      $this->assertSame([], $this->clock->sleeps);
      $this->assertSame(['POST /v1/flows/image'], $this->requestLines());
    }
  }

  /** @return array<string, array{?float, float}> */
  public static function invalidOptions(): array
  {
    return [
      'interval below floor' => [null, 0.4],
      'NaN interval' => [null, NAN],
      'infinite interval' => [null, INF],
      'negative timeout' => [-1.0, 3.0],
      'NaN timeout' => [NAN, 3.0],
    ];
  }

  /** @dataProvider invalidOptions */
  public function testInvalidOptionsAreRejectedBeforeAnyRequest(?float $waitTimeout, float $minInterval): void
  {
    try {
      $this->flows->image->createAndWait(self::imageRequest(), waitTimeoutInSeconds: $waitTimeout, minPollIntervalInSeconds: $minInterval);
      $this->fail('Expected ValidationException');
    } catch (ValidationException) {
      $this->assertSame([], $this->requests());
    }
    $this->expectException(ValidationException::class);
    $this->flows->templates->runs->createAndWait('tpl_1', self::runRequest(), waitTimeoutInSeconds: $waitTimeout, minPollIntervalInSeconds: $minInterval);
  }

  public function testSmallestMinIntervalIsAccepted(): void
  {
    $this->reply(['id' => 'gen_1', 'status' => 'pending']);
    $this->reply(self::completedGeneration());

    $this->flows->image->createAndWait(self::imageRequest(), minPollIntervalInSeconds: 0.5);

    $this->assertSame([0.5], $this->clock->sleeps);
  }

  public function testTemplateRunCreateAndWait(): void
  {
    $this->reply(self::templateRun('pending'), ['Retry-After' => '2']);
    $this->reply(self::templateRun('generating'), ['Retry-After' => '4']);
    $this->reply(self::templateRun('completed'));

    $result = $this->flows->templates->runs->createAndWait('tpl_1', self::runRequest(), minPollIntervalInSeconds: 1.0);

    $this->assertSame('completed', $result->status);
    $this->assertSame([2.0, 4.0], $this->clock->sleeps);
    $this->assertSame([
      'POST /v1/flows/templates/tpl_1/runs',
      'GET /v1/flows/templates/tpl_1/runs/run_1',
      'GET /v1/flows/templates/tpl_1/runs/run_1',
    ], $this->requestLines());
  }

  public function testFailedTemplateRunIsReturned(): void
  {
    $this->reply(self::templateRun('pending'));
    $this->reply(self::templateRun('failed'));

    $result = $this->flows->templates->runs->createAndWait('tpl_1', self::runRequest());

    $this->assertSame('failed', $result->status);
  }

  public function testTemplateRunAlreadyTerminalOnCreateSkipsPolling(): void
  {
    $this->reply(self::templateRun('completed'));

    $result = $this->flows->templates->runs->createAndWait('tpl_1', self::runRequest());

    $this->assertSame('completed', $result->status);
    $this->assertSame([], $this->clock->sleeps);
    $this->assertCount(1, $this->requests());
  }

  public function testTemplateRunTimeoutCarriesTemplateId(): void
  {
    $this->reply(self::templateRun('pending'));

    try {
      $this->flows->templates->runs->createAndWait('tpl_1', self::runRequest(), waitTimeoutInSeconds: 0);
      $this->fail('Expected FlowsWaitTimeoutError');
    } catch (FlowsWaitTimeoutError $e) {
      $this->assertSame('run_1', $e->id);
      $this->assertSame('tpl_1', $e->templateId);
      $this->assertStringContainsString('of template tpl_1', $e->getMessage());
      $this->assertStringContainsString('call `runs->get` with the template ID and run ID', $e->getMessage());
    }
  }

  public function testBodyPropertiesGoToCreateOnlyAndOtherOptionsToEveryRequest(): void
  {
    $this->reply(['id' => 'gen_1', 'status' => 'pending']);
    $this->reply(self::completedGeneration());

    $this->flows->image->createAndWait(self::imageRequest(), options: [
      'bodyProperties' => ['extra' => 1],
      'headers' => ['X-Test' => '1'],
      'queryParameters' => ['trace' => 'yes'],
    ]);

    [$create, $get] = $this->requests();
    $this->assertStringContainsString('"extra"', (string) $create->getBody());
    $this->assertSame('', (string) $get->getBody());
    foreach ([$create, $get] as $request) {
      $this->assertSame('1', $request->getHeaderLine('X-Test'));
      $this->assertStringContainsString('trace=yes', $request->getUri()->getQuery());
    }
  }

  public function testPerMethodConfigOnTheGeneratedClientApplies(): void
  {
    $client = new ElevenLabs('test-key', ['client' => $this->http, 'maxRetries' => 0]);
    $client->flows->image->setGetConfig(['headers' => ['X-Get' => 'yes']]);
    $flows = new FlowsWaiter($client->flows, $this->clock);
    $this->reply(['id' => 'gen_1', 'status' => 'pending']);
    $this->reply(self::completedGeneration());

    $flows->image->createAndWait(self::imageRequest());

    [$create, $get] = $this->requests();
    $this->assertSame('', $create->getHeaderLine('X-Get'));
    $this->assertSame('yes', $get->getHeaderLine('X-Get'));
    $this->assertSame('test-key', $get->getHeaderLine('xi-api-key'));
  }

  public function testApiErrorsPropagate(): void
  {
    $this->reply(['id' => 'gen_1', 'status' => 'pending']);
    $this->reply(['detail' => 'not found'], [], 404);

    $this->expectException(ElevenlabsApiException::class);
    $this->flows->image->createAndWait(self::imageRequest());
  }
}
