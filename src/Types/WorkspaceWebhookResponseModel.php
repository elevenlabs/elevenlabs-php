<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkspaceWebhookResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The display name for this webhook.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The unique ID for this webhook.
   */
  #[JsonProperty('webhook_id', required: true)]
  public string $webhookId;

  /**
   * The HTTPS callback URL that is called when this webhook is triggered in the platform.
   */
  #[JsonProperty('webhook_url', required: true)]
  public string $webhookUrl;

  /**
   * Whether the webhook has been manually disabled by a user.
   */
  #[JsonProperty('is_disabled', required: true)]
  public bool $isDisabled;

  /**
   * Whether the webhook has been automatically disabled due to repeated consecutive failures over a long period of time.
   */
  #[JsonProperty('is_auto_disabled', required: true)]
  public bool $isAutoDisabled;

  /**
   * Original creation time of the webhook.
   */
  #[JsonProperty('created_at_unix', required: true)]
  public int $createdAtUnix;

  /**
   * @var value-of<\ElevenLabs\Types\WebhookAuthMethodType>
   */
  #[JsonProperty('auth_type', required: true)]
  public string $authType;

  /**
   * @var \ElevenLabs\Types\WorkspaceWebhookUsageResponseModel[]|null
   * The list of products that are currently configured to trigger this webhook.
   */
  #[JsonProperty('usage'), ArrayType([\ElevenLabs\Types\WorkspaceWebhookUsageResponseModel::class])]
  public ?array $usage;

  /**
   * @var array<value-of<\ElevenLabs\Types\WorkspaceWebhookEventType>>|null
   * The workspace-level events this webhook is currently subscribed to. Only populated when usages are requested.
   */
  #[JsonProperty('events'), ArrayType(['string'])]
  public ?array $events;

  /**
   * The most recent error code returned from the callback URL.
   */
  #[JsonProperty('most_recent_failure_error_code')]
  public ?int $mostRecentFailureErrorCode;

  /**
   * The most recent time the webhook failed, failures are any non-200 codes returned by the callback URL.
   */
  #[JsonProperty('most_recent_failure_timestamp')]
  public ?int $mostRecentFailureTimestamp;

  /**
   * @param array{
   *   name: string,
   *   webhookId: string,
   *   webhookUrl: string,
   *   isDisabled: bool,
   *   isAutoDisabled: bool,
   *   createdAtUnix: int,
   *   authType: value-of<\ElevenLabs\Types\WebhookAuthMethodType>,
   *   usage?: \ElevenLabs\Types\WorkspaceWebhookUsageResponseModel[]|null,
   *   events?: array<value-of<\ElevenLabs\Types\WorkspaceWebhookEventType>>|null,
   *   mostRecentFailureErrorCode?: ?int,
   *   mostRecentFailureTimestamp?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->webhookId = $values['webhookId'];
    $this->webhookUrl = $values['webhookUrl'];
    $this->isDisabled = $values['isDisabled'];
    $this->isAutoDisabled = $values['isAutoDisabled'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->authType = $values['authType'];
    $this->usage = $values['usage'] ?? null;
    $this->events = $values['events'] ?? null;
    $this->mostRecentFailureErrorCode = $values['mostRecentFailureErrorCode'] ?? null;
    $this->mostRecentFailureTimestamp = $values['mostRecentFailureTimestamp'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'webhook_id' => true,
      'webhook_url' => true,
      'is_disabled' => true,
      'is_auto_disabled' => true,
      'created_at_unix' => true,
      'auth_type' => true
    ];
    if (array_key_exists('usage', $values)) {
      $this->_dirtyFields['usage'] = true;
    }
    if (array_key_exists('events', $values)) {
      $this->_dirtyFields['events'] = true;
    }
    if (array_key_exists('mostRecentFailureErrorCode', $values)) {
      $this->_dirtyFields['most_recent_failure_error_code'] = true;
    }
    if (array_key_exists('mostRecentFailureTimestamp', $values)) {
      $this->_dirtyFields['most_recent_failure_timestamp'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'webhook_id',
      'contents' => $this->webhookId
    ];

    $parts[] = [
      'name' => 'webhook_url',
      'contents' => $this->webhookUrl
    ];

    $parts[] = [
      'name' => 'is_disabled',
      'contents' => $this->isDisabled ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'is_auto_disabled',
      'contents' => $this->isAutoDisabled ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'created_at_unix',
      'contents' => (string) $this->createdAtUnix
    ];

    $parts[] = [
      'name' => 'auth_type',
      'contents' => $this->authType
    ];

    if ($this->usage !== null) {
      $parts[] = [
        'name' => 'usage',
        'contents' => json_encode($this->usage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->events !== null) {
      foreach ($this->events ?? [] as $item) {
        $parts[] = [
          'name' => 'events',
          'contents' => $item
        ];
      }
    }

    if ($this->mostRecentFailureErrorCode !== null) {
      $parts[] = [
        'name' => 'most_recent_failure_error_code',
        'contents' => (string) $this->mostRecentFailureErrorCode
      ];
    }

    if ($this->mostRecentFailureTimestamp !== null) {
      $parts[] = [
        'name' => 'most_recent_failure_timestamp',
        'contents' => (string) $this->mostRecentFailureTimestamp
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->usage ?? [] as $item) {
      $item->validate();
    }
  }
}
