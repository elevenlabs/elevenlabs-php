<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\AgentWorkflows;

use ElevenLabs\AgentWorkflows\Condition;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\AgentWorkflows\Workflow;
use ElevenLabs\AgentWorkflows\WorkflowValidationError;
use PHPUnit\Framework\TestCase;

/**
 * Backward-condition validation (a second transition target → source stored on the same edge),
 * out-of-range whole-float canonicalization, and empty-object identity through decode.
 */
class WorkflowBackwardTest extends TestCase
{
  /**
   * @return list<string>
   */
  private function buildErrorCodes(Workflow $wf): array
  {
    try {
      $wf->build();
      $this->fail('expected build to fail');
    } catch (WorkflowValidationError $e) {
      return array_map(static fn($issue) => $issue->code, $e->issues);
    }
  }

  public function testBackwardConditionIntoStartIsRejected(): void
  {
    $wf = new Workflow();
    // start --"Begin"--> greet, with a backward greet --"Restart"--> start.
    $wf->when('Begin', 'Restart')->converse('greet', 'Hello');
    $this->assertContains('edge_into_start', $this->buildErrorCodes($wf));
  }

  public function testBackwardConditionOutOfEndIsRejected(): void
  {
    $wf = new Workflow();
    // triage --"Done"--> end, with a backward end --"Resume"--> triage.
    $wf->converse('triage', 'Triage')->when('Done', 'Resume')->end();
    $this->assertContains('end_has_outgoing_edges', $this->buildErrorCodes($wf));
  }

  public function testBackwardLoopBetweenConverseNodesIsAllowed(): void
  {
    $wf = new Workflow();
    $wf->converse('a', 'A')->when('To B', 'Back to A')->converse('b', 'B')->end();
    $wf->build(); // must not throw
    $this->addToAssertionCount(1);
  }

  public function testCanonicalLeavesOutOfRangeWholeFloatAsFloat(): void
  {
    // 1e20 is a whole float beyond PHP's int range; casting it to int would wrap/truncate it.
    $out = Wire::canonical(1e20);
    $this->assertIsFloat($out);
    $this->assertSame(1e20, $out);
  }

  public function testCanonicalConvertsInRangeWholeFloatToInt(): void
  {
    $this->assertSame(300, Wire::canonical(300.0));
  }

  public function testInsertBetweenBidirectionalEdgeIsRejected(): void
  {
    $wf = new Workflow();
    $wf->converse('a', 'A')->when('to b', 'back to a')->converse('b', 'B'); // a <-> b
    $result = $wf->insertBetween('a', 'b', fn($br) => $br->converse('mid', 'M'));
    $this->assertNull($result, 'inserting into a bidirectional edge must be rejected');
    $this->assertContains('cannot_insert_bidirectional', $this->buildErrorCodes($wf));
  }

  public function testPositionAcceptedForUnmappedNodeTypes(): void
  {
    $fc = Condition::llm('go')->toWire();
    $wire = [
      'nodes' => [
        'start_node' => ['type' => 'start'],
        'announce' => ['type' => 'say', 'text' => 'hello'],
      ],
      'edges' => [
        'start_node__announce' => ['source' => 'start_node', 'target' => 'announce', 'forward_condition' => $fc],
      ],
    ];
    $wf = Workflow::fromJson($wire);
    $wf->node('announce')->update(position: ['x' => 10, 'y' => 20]);
    // toJson validates (it would throw invalid_option before the fix) without deserializing the say
    // node into its typed model, which isolates the position-acceptance behaviour.
    $wf->toJson();
    $this->addToAssertionCount(1);
  }

  public function testLoadedBackwardOnlyEdgeHasNoForwardTransition(): void
  {
    $fc = Condition::llm('go')->toWire();
    $bc = Condition::llm('restart')->toWire();
    $wire = [
      'nodes' => [
        'start_node' => ['type' => 'start'],
        'hub' => ['type' => 'override_agent', 'label' => 'hub', 'additional_prompt' => 'H'],
        'x' => ['type' => 'override_agent', 'label' => 'x', 'additional_prompt' => 'X'],
        'end' => ['type' => 'end'],
      ],
      'edges' => [
        'e1' => ['source' => 'start_node', 'target' => 'hub', 'forward_condition' => $fc],
        'e2' => ['source' => 'hub', 'target' => 'x', 'forward_condition' => $fc],
        'e3' => ['source' => 'hub', 'target' => 'end', 'forward_condition' => $fc],
        'e4' => ['source' => 'x', 'target' => 'start_node', 'backward_condition' => $bc],
      ],
    ];
    $out = Workflow::fromJson($wire)->toJson();
    $this->assertNotContains('e4', $out['nodes']['x']['edge_order'], 'x has no forward transition via e4');
  }

  public function testDecodeJsonPreservesEmptyObjectVsEmptyArray(): void
  {
    // An empty JSON object must survive as `{}`, not collapse to `[]`.
    $decoded = Wire::decodeJson('{"config": {}, "items": []}');
    $encoded = Wire::encode(Wire::canonical($decoded));
    $this->assertSame("{\n  \"config\": {},\n  \"items\": []\n}\n", $encoded);
  }

  public function testEdgelessWorkflowRoundTripsThroughFromJson(): void
  {
    // `toJsonString()` emits `"edges": {}` for an edgeless workflow; preserving `{}` as \stdClass must
    // not break the loader, which needs the top-level edge map as an array.
    $json = (new Workflow())->toJsonString();
    $reloaded = Workflow::fromJson($json);
    $this->assertSame($json, $reloaded->toJsonString());
  }

  public function testNestedEmptyObjectSurvivesWorkflowRoundTrip(): void
  {
    $wf = new Workflow();
    $wf->converse('agent', 'Help', conversationConfig: new \stdClass())->end();
    $json = $wf->toJsonString();
    $this->assertStringContainsString('"conversation_config": {}', $json);
    // The empty object must still be `{}` after a load/save round-trip, not `[]`.
    $this->assertSame($json, Workflow::fromJson($json)->toJsonString());
  }
}
