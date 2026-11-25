<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\MergeProposals;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class MergeProposalsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "results": [
              {
                  "id": "test-value",
                  "agent_id": "test-value",
                  "source_branch_id": "test-value",
                  "target_branch_id": "test-value",
                  "source_tip_version_id_at_creation": "test-value",
                  "title": "test-value",
                  "description": "test-value",
                  "requested_reviewer_user_ids": [
                      "test-value"
                  ],
                  "reviews": [
                      {
                          "user_id": "test-value",
                          "state": "approved",
                          "submitted_at": 1,
                          "comment": "test-value",
                          "reviewer_role": "admin"
                      }
                  ],
                  "comments": [
                      {
                          "id": "test-value",
                          "user_id": "test-value",
                          "body": "test-value",
                          "created_at": 1
                      }
                  ],
                  "outcome": {
                      "status": "open"
                  },
                  "created_at": 1,
                  "updated_at": 1,
                  "author_user_id": "test-value",
                  "access_info": {
                      "is_creator": true,
                      "creator_name": "test-value",
                      "creator_email": "test-value",
                      "role": "admin",
                      "anonymous_access_level_override": "admin",
                      "access_source": "creator"
                  }
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $status = \ElevenLabs\Types\MergeProposalStatus::Open;
    $sdk->agents->mergeProposals->list(
      request: new \ElevenLabs\Agents\MergeProposals\Requests\ListMergeProposalsRequest([
        'status' => $status->value,
        'sourceBranchId' => 'source_branch_id',
        'targetBranchId' => 'target_branch_id',
        'search' => 'search',
        'pageSize' => 100,
        'cursor' => 'cursor'
      ]),
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/merge-proposals$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "created_merge_proposal_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\MergeProposals\Requests\BodyCreateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsPost(
      [
        'sourceBranchId' => 'source_branch_id',
        'targetBranchId' => 'target_branch_id',
        'title' => 'title',
        'description' => 'description',
        'requestedReviewerUserIds' => [],
        'triageTicketId' => 'triage_ticket_id'
      ]
    );
    $sdk->agents->mergeProposals->create(
      request: $request,
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/merge-proposals$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "agent_id": "test-value",
          "source_branch_id": "test-value",
          "target_branch_id": "test-value",
          "source_tip_version_id_at_creation": "test-value",
          "title": "test-value",
          "description": "test-value",
          "requested_reviewer_user_ids": [
              "test-value"
          ],
          "reviews": [
              {
                  "user_id": "test-value",
                  "state": "approved",
                  "submitted_at": 1,
                  "comment": "test-value",
                  "reviewer_role": "admin"
              }
          ],
          "comments": [
              {
                  "id": "test-value",
                  "user_id": "test-value",
                  "body": "test-value",
                  "created_at": 1
              }
          ],
          "outcome": {
              "status": "open"
          },
          "created_at": 1,
          "updated_at": 1,
          "author_user_id": "test-value",
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->mergeProposals->get(
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      mergeProposalId: 'agtmprop_8901k4t9z5defmb8vh3e9361y7nj'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/merge-proposals/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "agent_id": "test-value",
          "source_branch_id": "test-value",
          "target_branch_id": "test-value",
          "source_tip_version_id_at_creation": "test-value",
          "title": "test-value",
          "description": "test-value",
          "requested_reviewer_user_ids": [
              "test-value"
          ],
          "reviews": [
              {
                  "user_id": "test-value",
                  "state": "approved",
                  "submitted_at": 1,
                  "comment": "test-value",
                  "reviewer_role": "admin"
              }
          ],
          "comments": [
              {
                  "id": "test-value",
                  "user_id": "test-value",
                  "body": "test-value",
                  "created_at": 1
              }
          ],
          "outcome": {
              "status": "open"
          },
          "created_at": 1,
          "updated_at": 1,
          "author_user_id": "test-value",
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\MergeProposals\Requests\BodyUpdateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdPatch(
      [
        'title' => 'title',
        'description' => 'description',
        'requestedReviewerUserIds' => [],
        'close' => false
      ]
    );
    $sdk->agents->mergeProposals->update(
      request: $request,
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      mergeProposalId: 'agtmprop_8901k4t9z5defmb8vh3e9361y7nj'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/merge-proposals/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testSubmitReviewSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "agent_id": "test-value",
          "source_branch_id": "test-value",
          "target_branch_id": "test-value",
          "source_tip_version_id_at_creation": "test-value",
          "title": "test-value",
          "description": "test-value",
          "requested_reviewer_user_ids": [
              "test-value"
          ],
          "reviews": [
              {
                  "user_id": "test-value",
                  "state": "approved",
                  "submitted_at": 1,
                  "comment": "test-value",
                  "reviewer_role": "admin"
              }
          ],
          "comments": [
              {
                  "id": "test-value",
                  "user_id": "test-value",
                  "body": "test-value",
                  "created_at": 1
              }
          ],
          "outcome": {
              "status": "open"
          },
          "created_at": 1,
          "updated_at": 1,
          "author_user_id": "test-value",
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $mergeProposalReviewState = \ElevenLabs\Types\MergeProposalReviewState::Approved->value;

    $request = new \ElevenLabs\Agents\MergeProposals\Requests\BodyReviewAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdReviewsPost(
      [
        'state' => $mergeProposalReviewState,
        'comment' => 'comment'
      ]
    );
    $sdk->agents->mergeProposals->submitReview(
      request: $request,
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      mergeProposalId: 'agtmprop_8901k4t9z5defmb8vh3e9361y7nj'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/merge-proposals/[^/]+/reviews$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testAddCommentSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "agent_id": "test-value",
          "source_branch_id": "test-value",
          "target_branch_id": "test-value",
          "source_tip_version_id_at_creation": "test-value",
          "title": "test-value",
          "description": "test-value",
          "requested_reviewer_user_ids": [
              "test-value"
          ],
          "reviews": [
              {
                  "user_id": "test-value",
                  "state": "approved",
                  "submitted_at": 1,
                  "comment": "test-value",
                  "reviewer_role": "admin"
              }
          ],
          "comments": [
              {
                  "id": "test-value",
                  "user_id": "test-value",
                  "body": "test-value",
                  "created_at": 1
              }
          ],
          "outcome": {
              "status": "open"
          },
          "created_at": 1,
          "updated_at": 1,
          "author_user_id": "test-value",
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\MergeProposals\Requests\BodyCommentOnAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdCommentsPost(
      [
        'body' => 'body'
      ]
    );
    $sdk->agents->mergeProposals->addComment(
      request: $request,
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      mergeProposalId: 'agtmprop_8901k4t9z5defmb8vh3e9361y7nj'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/merge-proposals/[^/]+/comments$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testMergeSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "agent_id": "test-value",
          "source_branch_id": "test-value",
          "target_branch_id": "test-value",
          "source_tip_version_id_at_creation": "test-value",
          "title": "test-value",
          "description": "test-value",
          "requested_reviewer_user_ids": [
              "test-value"
          ],
          "reviews": [
              {
                  "user_id": "test-value",
                  "state": "approved",
                  "submitted_at": 1,
                  "comment": "test-value",
                  "reviewer_role": "admin"
              }
          ],
          "comments": [
              {
                  "id": "test-value",
                  "user_id": "test-value",
                  "body": "test-value",
                  "created_at": 1
              }
          ],
          "outcome": {
              "status": "open"
          },
          "created_at": 1,
          "updated_at": 1,
          "author_user_id": "test-value",
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\MergeProposals\Requests\BodyMergeAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdMergePost(
      [
        'archiveSourceBranch' => true,
        'force' => false
      ]
    );
    $sdk->agents->mergeProposals->merge(
      request: $request,
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      mergeProposalId: 'agtmprop_8901k4t9z5defmb8vh3e9361y7nj'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/merge-proposals/[^/]+/merge$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  /**
   * @return ClientInterface&object{requests: list<RequestInterface>}
   */
  private function transport(int $status, string $body): ClientInterface
  {
    return new class ($status, $body) implements ClientInterface {
      /** @var list<RequestInterface> */
      public array $requests = [];

      public function __construct(private int $status, private string $body)
      {
      }

      public function sendRequest(RequestInterface $request): ResponseInterface
      {
        $this->requests[] = $request;

        return new \GuzzleHttp\Psr7\Response(
          $this->status,
          ['Content-Type' => 'application/json'],
          $this->body
        );
      }
    };
  }
}
