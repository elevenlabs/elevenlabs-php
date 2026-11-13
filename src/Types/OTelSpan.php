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
class OTelSpan extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('traceId', required: true)]
  public string $traceId;

  #[JsonProperty('spanId', required: true)]
  public string $spanId;

  #[JsonProperty('parentSpanId')]
  public ?string $parentSpanId;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('kind', required: true)]
  public int $kind;

  #[JsonProperty('startTimeUnixNano', required: true)]
  public string $startTimeUnixNano;

  #[JsonProperty('endTimeUnixNano', required: true)]
  public string $endTimeUnixNano;

  /**
   * @var \ElevenLabs\Types\OTelAttribute[]
   */
  #[JsonProperty('attributes', required: true), ArrayType([\ElevenLabs\Types\OTelAttribute::class])]
  public array $attributes;

  #[JsonProperty('status', required: true)]
  public \ElevenLabs\Types\OTelStatus $status;

  /**
   * @param array{
   *   traceId: string,
   *   spanId: string,
   *   name: string,
   *   kind: int,
   *   startTimeUnixNano: string,
   *   endTimeUnixNano: string,
   *   attributes: \ElevenLabs\Types\OTelAttribute[],
   *   status: \ElevenLabs\Types\OTelStatus,
   *   parentSpanId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->traceId = $values['traceId'];
    $this->spanId = $values['spanId'];
    $this->parentSpanId = $values['parentSpanId'] ?? null;
    $this->name = $values['name'];
    $this->kind = $values['kind'];
    $this->startTimeUnixNano = $values['startTimeUnixNano'];
    $this->endTimeUnixNano = $values['endTimeUnixNano'];
    $this->attributes = $values['attributes'];
    $this->status = $values['status'];

    $this->_dirtyFields = [
      'traceId' => true,
      'spanId' => true,
      'name' => true,
      'kind' => true,
      'startTimeUnixNano' => true,
      'endTimeUnixNano' => true,
      'attributes' => true,
      'status' => true
    ];
    if (array_key_exists('parentSpanId', $values)) {
      $this->_dirtyFields['parentSpanId'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'traceId',
      'contents' => $this->traceId
    ];

    $parts[] = [
      'name' => 'spanId',
      'contents' => $this->spanId
    ];

    if ($this->parentSpanId !== null) {
      $parts[] = [
        'name' => 'parentSpanId',
        'contents' => $this->parentSpanId
      ];
    }

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'kind',
      'contents' => (string) $this->kind
    ];

    $parts[] = [
      'name' => 'startTimeUnixNano',
      'contents' => $this->startTimeUnixNano
    ];

    $parts[] = [
      'name' => 'endTimeUnixNano',
      'contents' => $this->endTimeUnixNano
    ];

    $parts[] = [
      'name' => 'attributes',
      'contents' => json_encode($this->attributes),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => json_encode($this->status),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->attributes as $item) {
      $item->validate();
    }
    $this->status->validate();
  }
}
