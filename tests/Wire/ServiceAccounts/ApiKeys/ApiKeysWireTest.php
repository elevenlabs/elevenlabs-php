<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\ServiceAccounts\ApiKeys;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ApiKeysWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
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
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->serviceAccounts->apiKeys->list(serviceAccountUserId: 'service_account_user_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/service-accounts/[^/]+/api-keys$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "xi-api-key": "test-value",
          "key_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $bodyCreateServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysPostPermissions =
      \ElevenLabs\ServiceAccounts\ApiKeys\Types\Permissions21::All->value;

    $request = new \ElevenLabs\ServiceAccounts\ApiKeys\Requests\BodyCreateServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysPost(
      [
        'name' => 'name',
        'permissions' => $bodyCreateServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysPostPermissions,
        'characterLimit' => 10,
        'allowedIps' => ['allowed_ips'],
        'thirdPartyDisableAllowed' => true,
        'ttsConcurrencyLimit' => 8,
        'dubbingConcurrencyLimit' => 3,
        'musicConcurrencyLimit' => 6,
        'expiresAtUnix' => 4
      ]
    );
    $sdk->serviceAccounts->apiKeys->create(
      request: $request,
      serviceAccountUserId: 'service_account_user_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/service-accounts/[^/]+/api-keys$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchIsEnabled =
      \ElevenLabs\ServiceAccounts\ApiKeys\Types\IsEnabled2::NoUpdate->value;

    $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchPermissions =
      \ElevenLabs\ServiceAccounts\ApiKeys\Types\Permissions22::All->value;

    $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchCharacterLimit =
      \ElevenLabs\ServiceAccounts\ApiKeys\Types\CharacterLimit2::Clear->value;

    $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchAllowedIps =
      \ElevenLabs\ServiceAccounts\ApiKeys\Types\AllowedIps2::Clear->value;

    $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchThirdPartyDisableAllowed =
      \ElevenLabs\ServiceAccounts\ApiKeys\Types\ThirdPartyDisableAllowed2::Clear->value;

    $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchTtsConcurrencyLimit =
      \ElevenLabs\ServiceAccounts\ApiKeys\Types\TtsConcurrencyLimit2::Clear->value;

    $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchDubbingConcurrencyLimit =
      \ElevenLabs\ServiceAccounts\ApiKeys\Types\DubbingConcurrencyLimit2::Clear->value;

    $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchMusicConcurrencyLimit =
      \ElevenLabs\ServiceAccounts\ApiKeys\Types\MusicConcurrencyLimit2::Clear->value;

    $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchExpiresAtUnix =
      \ElevenLabs\ServiceAccounts\ApiKeys\Types\ExpiresAtUnix2::Clear->value;

    $request = new \ElevenLabs\ServiceAccounts\ApiKeys\Requests\BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatch(
      [
        'isEnabled' => $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchIsEnabled,
        'name' => 'name',
        'permissions' => $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchPermissions,
        'characterLimit' => $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchCharacterLimit,
        'allowedIps' => $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchAllowedIps,
        'thirdPartyDisableAllowed' => $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchThirdPartyDisableAllowed,
        'ttsConcurrencyLimit' => $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchTtsConcurrencyLimit,
        'dubbingConcurrencyLimit' => $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchDubbingConcurrencyLimit,
        'musicConcurrencyLimit' => $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchMusicConcurrencyLimit,
        'expiresAtUnix' => $bodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchExpiresAtUnix
      ]
    );
    $sdk->serviceAccounts->apiKeys->update(
      request: $request,
      serviceAccountUserId: 'service_account_user_id',
      apiKeyId: 'api_key_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/service-accounts/[^/]+/api-keys/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->serviceAccounts->apiKeys->delete(
      serviceAccountUserId: 'service_account_user_id',
      apiKeyId: 'api_key_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/service-accounts/[^/]+/api-keys/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testDisableSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->serviceAccounts->apiKeys->disable(
      serviceAccountUserId: 'service_account_user_id',
      apiKeyId: 'api_key_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/service-accounts/[^/]+/api-keys/[^/]+/disable$#',
      rawurldecode($sent->getUri()->getPath())
    );
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
