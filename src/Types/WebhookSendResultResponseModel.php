<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WebhookSendResultResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The delivery ID, also sent in the ElevenLabs-Webhook-Delivery-Id header.
   */
  #[JsonProperty('delivery_id', required: true)]
  public string $deliveryId;

  /**
   * @var value-of<\ElevenLabs\Types\WebhookOutcome>
   */
  #[JsonProperty('outcome', required: true)]
  public string $outcome;

  /**
   * The HTTP status your endpoint returned, if it answered.
   */
  #[JsonProperty('response_code', required: true)]
  public ?int $responseCode;

  /**
   * How long your endpoint took to answer, in milliseconds.
   */
  #[JsonProperty('latency_ms', required: true)]
  public ?int $latencyMs;

  /**
   * The Content-Type your endpoint answered with, if it answered.
   */
  #[JsonProperty('response_content_type', required: true)]
  public ?string $responseContentType;

  /**
   * The size of your endpoint's response body in bytes, if it answered. The body itself is never stored or returned.
   */
  #[JsonProperty('response_body_bytes', required: true)]
  public ?int $responseBodyBytes;

  /**
   * Where a failure came from: recipient, configuration, external_transport or timeout.
   */
  #[JsonProperty('failure_origin', required: true)]
  public ?string $failureOrigin;

  /**
   * @param array{
   *   deliveryId: string,
   *   outcome: value-of<\ElevenLabs\Types\WebhookOutcome>,
   *   responseCode: ?int,
   *   latencyMs: ?int,
   *   responseContentType: ?string,
   *   responseBodyBytes: ?int,
   *   failureOrigin: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->deliveryId = $values['deliveryId'];
    $this->outcome = $values['outcome'];
    $this->responseCode = $values['responseCode'];
    $this->latencyMs = $values['latencyMs'];
    $this->responseContentType = $values['responseContentType'];
    $this->responseBodyBytes = $values['responseBodyBytes'];
    $this->failureOrigin = $values['failureOrigin'];

    $this->_dirtyFields = [
      'delivery_id' => true,
      'outcome' => true,
      'response_code' => true,
      'latency_ms' => true,
      'response_content_type' => true,
      'response_body_bytes' => true,
      'failure_origin' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'delivery_id',
      'contents' => $this->deliveryId
    ];

    $parts[] = [
      'name' => 'outcome',
      'contents' => $this->outcome
    ];

    $parts[] = [
      'name' => 'response_code',
      'contents' => (string) $this->responseCode
    ];

    $parts[] = [
      'name' => 'latency_ms',
      'contents' => (string) $this->latencyMs
    ];

    $parts[] = [
      'name' => 'response_content_type',
      'contents' => $this->responseContentType
    ];

    $parts[] = [
      'name' => 'response_body_bytes',
      'contents' => (string) $this->responseBodyBytes
    ];

    $parts[] = [
      'name' => 'failure_origin',
      'contents' => $this->failureOrigin
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
