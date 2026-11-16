<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\AgentWorkflows;

use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\AgentWorkflows\Workflow;
use ElevenLabs\AgentWorkflows\WorkflowValidationError;
use ElevenLabs\Types\AgentWorkflowRequestModel;
use PHPUnit\Framework\TestCase;

class WorkflowBuilderTest extends TestCase
{
  public function testBuildReturnsGeneratedRequestModel(): void
  {
    $wf = new Workflow();
    $wf->converse('support', 'Help the caller')->end();

    $model = $wf->build();
    $this->assertInstanceOf(AgentWorkflowRequestModel::class, $model);
  }

  public function testBuildThrowsOnValidationError(): void
  {
    $wf = new Workflow();
    $wf->converse('dup', 'first');
    $wf->when('again')->converse('dup', 'second'); // duplicate_node_id

    $this->expectException(WorkflowValidationError::class);
    $wf->build();
  }

  public function testToJsonStringIsSortedTwoSpaceWithTrailingNewline(): void
  {
    $wf = new Workflow();
    $wf->converse('support', 'Help')->end();

    $json = $wf->toJsonString();
    $this->assertStringEndsWith("\n", $json);
    $this->assertStringContainsString("\n  \"edges\": {", $json); // 2-space indent, edges first (sorted)
    // Keys are sorted at every level: "edges" sorts before "nodes".
    $this->assertLessThan(strpos($json, '"nodes"'), strpos($json, '"edges"'));
  }

  public function testEncoderMatchesCanonicalJsStringify(): void
  {
    $value = Wire::canonical([
      'b' => 1,
      'a' => ['x' => 300.0, 'list' => [1, 2]],
      'empty' => new \stdClass(),
    ]);

    $expected = <<<'JSON'
{
  "a": {
    "list": [
      1,
      2
    ],
    "x": 300
  },
  "b": 1,
  "empty": {}
}
JSON;
    $this->assertSame($expected . "\n", Wire::encode($value));
  }

  public function testRoundTripThroughFromJson(): void
  {
    $wf = new Workflow();
    $wf->converse('a', 'first')->when('done')->end();
    $json = $wf->toJsonString();

    $reloaded = Workflow::fromJson($json)->toJsonString();
    $this->assertSame($json, $reloaded);
  }

  public function testNodeIdsAndStartId(): void
  {
    $wf = new Workflow();
    $wf->converse('a', 'x')->converse('b', 'y');

    $this->assertSame('start_node', $wf->startId());
    $this->assertSame(['start_node', 'a', 'b'], $wf->nodeIds());
  }
}
