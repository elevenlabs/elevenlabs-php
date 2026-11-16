<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\AgentWorkflows;

use ElevenLabs\AgentWorkflows\Condition;
use ElevenLabs\AgentWorkflows\Destination;
use ElevenLabs\AgentWorkflows\Expr;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\AgentWorkflows\Workflow;
use ElevenLabs\AgentWorkflows\WorkflowBranch;
use ElevenLabs\AgentWorkflows\WorkflowChain;
use ElevenLabs\AgentWorkflows\WorkflowNode;
use ElevenLabs\AgentWorkflows\WorkflowValidationError;
use PHPUnit\Framework\TestCase;

/**
 * Runs the shared cross-SDK conformance fixtures (docs/agents-as-code/fixtures, copied into
 * tests/fixtures/agent_workflows) through the PHP builder. See workflow-spec.md, "Fixtures".
 */
class WorkflowFixtureTest extends TestCase
{
  /**
   * @return iterable<string, array{string}>
   */
  public static function fixtures(): iterable
  {
    $dir = __DIR__ . '/../fixtures/agent_workflows';
    foreach (glob("{$dir}/*.json") ?: [] as $path) {
      yield basename($path) => [$path];
    }
  }

  /**
   * @dataProvider fixtures
   */
  public function testFixture(string $path): void
  {
    /** @var array<string, mixed> $fixture */
    $fixture = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

    $wf = isset($fixture['from'])
      ? Workflow::fromJson($fixture['from'])
      : new Workflow(preventSubagentLoops: $fixture['workflow']['preventSubagentLoops'] ?? null);

    $this->runOps($wf, $fixture['ops'] ?? [], $wf);

    if (isset($fixture['errors'])) {
      try {
        $wf->toJsonString();
        $this->fail("Expected build to fail with errors for {$fixture['name']}");
      } catch (WorkflowValidationError $e) {
        $codes = array_map(static fn($issue) => $issue->code, $e->issues);
        sort($codes);
        $expected = $fixture['errors'];
        sort($expected);
        $this->assertSame($expected, $codes, $fixture['name']);
      }
      return;
    }

    $expected = Wire::encode(Wire::canonical($fixture['expected']));
    $this->assertSame($expected, $wf->toJsonString(), $fixture['name']);
  }

  /**
   * @param list<array<string, mixed>> $ops
   */
  private function runOps(Workflow $wf, array $ops, WorkflowChain $first): ?WorkflowNode
  {
    $previous = $first;
    $result = null;

    foreach ($ops as $op) {
      $type = $op['op'];

      if ($type === 'update') {
        $wf->node($op['node'])->update(...$this->options($op));
        continue;
      }
      if ($type === 'remove') {
        $wf->remove($op['node']);
        continue;
      }
      if ($type === 'onResult') {
        $node = !isset($op['at']) ? $previous : $wf->node($op['at']);
        /** @var WorkflowNode $node */
        $success = isset($op['success'])
          ? fn(WorkflowBranch $b) => $this->runOps($wf, $op['success'], $b)
          : null;
        $failure = isset($op['failure'])
          ? fn(WorkflowBranch $b) => $this->runOps($wf, $op['failure'], $b)
          : null;
        $node->onResult(success: $success, failure: $failure);
        continue;
      }
      if ($type === 'insertBetween') {
        $wf->insertBetween(
          $op['source'],
          $op['target'],
          fn(WorkflowBranch $from) => $this->runOps($wf, $op['ops'] ?? [], $from)
        );
        continue;
      }

      $base = !isset($op['at'])
        ? $previous
        : ($op['at'] === '$start' ? $wf : $wf->node($op['at']));

      $chain = $base;
      if (isset($op['when'])) {
        /** @var Workflow|WorkflowNode $base */
        $chain = $base->when(
          $this->condition($op['when']),
          isset($op['back']) ? $this->condition($op['back']) : null
        );
      } elseif (!empty($op['onSuccess'])) {
        /** @var WorkflowNode $base */
        $chain = $base->onSuccess();
      } elseif (!empty($op['onFailure'])) {
        /** @var WorkflowNode $base */
        $chain = $base->onFailure();
      }

      switch ($type) {
        case 'converse':
          $result = $chain->converse($op['id'], $op['prompt'], ...$this->options($op));
          break;
        case 'tool':
          $result = $chain->tool($op['id'], $op['toolIds'], ...$this->options($op));
          break;
        case 'transfer':
          $result = $chain->transfer($op['id'], $this->destination($op['destination']), ...$this->options($op));
          break;
        case 'end':
          $result = $chain->end(...$this->options($op));
          break;
        case 'goTo':
          $result = $chain->goTo($op['target'], isset($op['back']) ? $this->condition($op['back']) : null);
          break;
      }
      $previous = $result ?? $previous;
    }

    return $result;
  }

  /**
   * Canonical option keys for a verb, with the destination shorthand resolved. Spread as named
   * arguments into the verb, so keys must match the verb's parameter names (they do: the fixtures
   * use canonical camelCase).
   *
   * @param array<string, mixed> $op
   * @return array<string, mixed>
   */
  private function options(array $op): array
  {
    $opts = $op['options'] ?? [];
    if (isset($opts['destination'])) {
      $opts['destination'] = $this->destination($opts['destination']);
    }
    return $opts;
  }

  /**
   * @param mixed $raw
   */
  private function condition(mixed $raw): Condition|string
  {
    if (is_string($raw)) {
      return $raw;
    }
    if (isset($raw['llm'])) {
      return Condition::llm($raw['llm'], $raw['label'] ?? null);
    }
    return Condition::expr(Expr::fromModel($raw['expr']), $raw['label'] ?? null);
  }

  /**
   * @param array<string, mixed> $raw
   */
  private function destination(array $raw): Destination
  {
    if (isset($raw['phone'])) {
      return Destination::phone($raw['phone']);
    }
    if (isset($raw['phoneVariable'])) {
      return Destination::phoneVariable($raw['phoneVariable']);
    }
    if (isset($raw['sip'])) {
      return Destination::sip($raw['sip']);
    }
    if (isset($raw['sipVariable'])) {
      return Destination::sipVariable($raw['sipVariable']);
    }
    return Destination::agent($raw['agent'], $raw['nodeId'] ?? null);
  }
}
