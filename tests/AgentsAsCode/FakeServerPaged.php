<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\AgentsAsCode;

use Nyholm\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/** A fake server that returns the tool list one tool per page. */
final class FakeServerPaged extends FakeServer
{
  public function sendRequest(RequestInterface $request): ResponseInterface
  {
    $response = parent::sendRequest($request);
    if ($request->getMethod() !== 'GET' || $request->getUri()->getPath() !== '/v1/convai/tools') {
      return $response;
    }
    parse_str($request->getUri()->getQuery(), $query);
    $page = $query['cursor'] ?? 'page_1';
    /** @var array{tools: list<mixed>} $body */
    $body = json_decode((string) $response->getBody(), true);
    $index = (int) substr((string) $page, 5) - 1;
    $tools = array_slice($body['tools'], $index, 1);
    $more = $index + 1 < count($body['tools']);
    return new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
      'tools' => $tools,
      'has_more' => $more,
      'next_cursor' => $more ? 'page_' . ($index + 2) : null,
    ]));
  }
}
