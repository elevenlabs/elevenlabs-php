<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\ServiceAccounts;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ServiceAccountsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "service-accounts": [
              {
                  "service_account_user_id": "test-value",
                  "name": "test-value",
                  "created_at_unix": 1,
                  "api-keys": [
                      {
                          "name": "test-value",
                          "hint": "test-value",
                          "key_id": "test-value",
                          "service_account_user_id": "test-value",
                          "created_at_unix": 1,
                          "is_disabled": true,
                          "permissions": [
                              "text_to_speech"
                          ],
                          "disable_reason": "trial_ended",
                          "character_limit": 1,
                          "character_count": 1,
                          "hashed_xi_api_key": "test-value",
                          "allowed_ips": [
                              "test-value"
                          ],
                          "third_party_disable_allowed": true,
                          "platform_limits": {
                              "credits": {
                                  "limit": 1,
                                  "usage": 1
                              },
                              "pvc": {
                                  "limit": 1
                              },
                              "concurrency": {
                                  "limit": 1
                              },
                              "dubbing_concurrency": {
                                  "limit": 1
                              },
                              "music_concurrency": {
                                  "limit": 1
                              }
                          },
                          "expires_at_unix": 1
                      }
                  ],
                  "default_sharing_groups": [
                      {
                          "group": {
                              "name": "test-value",
                              "id": "test-value",
                              "members": [
                                  "test-value"
                              ],
                              "permissions": [
                                  "text_to_speech"
                              ],
                              "group_usage_limit": 1,
                              "group_pvc_limit": 1,
                              "group_concurrency_limit": 1,
                              "group_dubbing_concurrency_limit": 1,
                              "group_music_concurrency_limit": 1,
                              "character_count": 1,
                              "is_scim_synced": true,
                              "scim_group": {
                                  "scim_external_id": "test-value",
                                  "display_name": "test-value",
                                  "created_at_unix": 1,
                                  "updated_at_unix": 1,
                                  "seat_type": "workspace_admin"
                              },
                              "scim_frozen": true
                          },
                          "permission_level": "admin"
                      }
                  ]
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->serviceAccounts->list();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/service-accounts$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "service-account-user-id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $defaultSharingGroupConfigPermissionLevel =
      \ElevenLabs\Types\DefaultSharingGroupConfigPermissionLevel::Admin->value;

    $defaultSharingGroupConfig = new \ElevenLabs\Types\DefaultSharingGroupConfig([
      'groupId' => 'group_id',
      'permissionLevel' => $defaultSharingGroupConfigPermissionLevel
    ]);

    $request = new \ElevenLabs\ServiceAccounts\Requests\BodyCreateServiceAccountV1ServiceAccountsPost(
      [
        'name' => 'name',
        'defaultSharingGroups' => []
      ]
    );
    $sdk->serviceAccounts->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/service-accounts$#',
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
