<?php

declare(strict_types=1);

namespace ElevenLabs\Webhooks\Requests;

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
class BodyUpdateWorkspaceWebhookV1WorkspaceWebhooksWebhookIdPatch extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether to disable or enable the webhook
   */
  #[JsonProperty('is_disabled', required: true)]
  public bool $isDisabled;

  /**
   * The display name of the webhook (used for display purposes only).
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * Whether to enable automatic retries for transient failures (5xx, 429, timeout)
   */
  #[JsonProperty('retry_enabled')]
  public ?bool $retryEnabled;

  /**
   * @var array<string, string>|null
   * A list of request headers to include with the webhook delivery (optional)
   */
  #[JsonProperty('request_headers'), ArrayType(['string' => 'string'])]
  public ?array $requestHeaders;

  /**
   * @var array<value-of<\ElevenLabs\Types\WorkspaceWebhookEventType>>|null
   * The complete set of workspace-level events this webhook should be subscribed to. The webhook is added to the events in the list and removed from any not in the list. Omit to leave the current event subscriptions unchanged.
   */
  #[JsonProperty('events'), ArrayType(['string'])]
  public ?array $events;

  /**
   * @param array{
   *   isDisabled: bool,
   *   name: string,
   *   retryEnabled?: ?bool,
   *   requestHeaders?: array<string, string>|null,
   *   events?: array<value-of<\ElevenLabs\Types\WorkspaceWebhookEventType>>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->isDisabled = $values['isDisabled'];
    $this->name = $values['name'];
    $this->retryEnabled = $values['retryEnabled'] ?? null;
    $this->requestHeaders = $values['requestHeaders'] ?? null;
    $this->events = $values['events'] ?? null;

    $this->_dirtyFields = [
      'is_disabled' => true,
      'name' => true
    ];
    if (array_key_exists('retryEnabled', $values)) {
      $this->_dirtyFields['retry_enabled'] = true;
    }
    if (array_key_exists('requestHeaders', $values)) {
      $this->_dirtyFields['request_headers'] = true;
    }
    if (array_key_exists('events', $values)) {
      $this->_dirtyFields['events'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'is_disabled',
      'contents' => $this->isDisabled ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->retryEnabled !== null) {
      $parts[] = [
        'name' => 'retry_enabled',
        'contents' => $this->retryEnabled ? 'true' : 'false'
      ];
    }

    if ($this->requestHeaders !== null) {
      $parts[] = [
        'name' => 'request_headers',
        'contents' => json_encode($this->requestHeaders),
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

    return $parts;
  }

  public function validate(): void
  {
  }
}
