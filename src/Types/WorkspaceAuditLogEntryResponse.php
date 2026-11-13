<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * Audit log entry with Firestore document ID for API responses.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkspaceAuditLogEntryResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, mixed>|null
   * Event metadata
   */
  #[JsonProperty('metadata'), ArrayType(['string' => 'mixed'])]
  public ?array $metadata;

  /**
   * Event time in milliseconds since epoch
   */
  #[JsonProperty('time')]
  public ?int $time;

  /**
   * Activity ID
   */
  #[JsonProperty('activity_id', required: true), Union('integer')]
  public int $activityId;

  /**
   * Activity name
   */
  #[JsonProperty('activity_name', required: true)]
  public string $activityName;

  /**
   * Event category
   */
  #[JsonProperty('category_name')]
  public ?string $categoryName;

  /**
   * Category UID for IAM
   */
  #[JsonProperty('category_uid')]
  public ?int $categoryUid;

  /**
   * Event class name
   */
  #[JsonProperty('class_name')]
  public ?string $className;

  /**
   * Event class UID
   */
  #[JsonProperty('class_uid')]
  public ?int $classUid;

  /**
   * @var ?value-of<\ElevenLabs\Types\SeverityId>
   * OCSF Severity levels.
   *
   * Spec: https://schema.ocsf.io/1.6.0/objects/severity_id
   */
  #[JsonProperty('severity_id')]
  public ?int $severityId;

  /**
   * @var value-of<\ElevenLabs\Types\StatusId>
   * OCSF Status levels.
   *
   * Spec: https://schema.ocsf.io/1.6.0/objects/status_id
   */
  #[JsonProperty('status_id', required: true)]
  public int $statusId;

  /**
   * OCSF Actor object - describes the entity that performed the action.
   *
   * Spec: https://schema.ocsf.io/1.6.0/objects/actor
   */
  #[JsonProperty('actor', required: true)]
  public \ElevenLabs\Types\ActorModel $actor;

  /**
   * Device information
   */
  #[JsonProperty('device')]
  public ?\ElevenLabs\Types\DeviceModel $device;

  /**
   * HTTP request details
   */
  #[JsonProperty('http_request')]
  public ?\ElevenLabs\Types\HttpRequestModel $httpRequest;

  /**
   * Human-readable event description
   */
  #[JsonProperty('message', required: true)]
  public string $message;

  /**
   * @var array<string, mixed>|null
   * Attributes not mapped to OCSF
   */
  #[JsonProperty('unmapped'), ArrayType(['string' => 'mixed'])]
  public ?array $unmapped;

  /**
   * Firestore document ID
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * Event time in human-readable RFC 3339 format, derived from 'time'.
   */
  #[JsonProperty('time_dt')]
  public ?string $timeDt;

  /**
   * OCSF type_uid is class_uid * 100 + activity_id.
   */
  #[JsonProperty('type_uid')]
  public ?int $typeUid;

  /**
   * OCSF type_name combines class_name and activity_name.
   */
  #[JsonProperty('type_name')]
  public ?string $typeName;

  /**
   * @param array{
   *   activityId: int,
   *   activityName: string,
   *   statusId: value-of<\ElevenLabs\Types\StatusId>,
   *   actor: \ElevenLabs\Types\ActorModel,
   *   message: string,
   *   id: string,
   *   metadata?: array<string, mixed>|null,
   *   time?: ?int,
   *   categoryName?: ?string,
   *   categoryUid?: ?int,
   *   className?: ?string,
   *   classUid?: ?int,
   *   severityId?: ?value-of<\ElevenLabs\Types\SeverityId>,
   *   device?: ?\ElevenLabs\Types\DeviceModel,
   *   httpRequest?: ?\ElevenLabs\Types\HttpRequestModel,
   *   unmapped?: array<string, mixed>|null,
   *   timeDt?: ?string,
   *   typeUid?: ?int,
   *   typeName?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->metadata = $values['metadata'] ?? null;
    $this->time = $values['time'] ?? null;
    $this->activityId = $values['activityId'];
    $this->activityName = $values['activityName'];
    $this->categoryName = $values['categoryName'] ?? null;
    $this->categoryUid = $values['categoryUid'] ?? null;
    $this->className = $values['className'] ?? null;
    $this->classUid = $values['classUid'] ?? null;
    $this->severityId = $values['severityId'] ?? null;
    $this->statusId = $values['statusId'];
    $this->actor = $values['actor'];
    $this->device = $values['device'] ?? null;
    $this->httpRequest = $values['httpRequest'] ?? null;
    $this->message = $values['message'];
    $this->unmapped = $values['unmapped'] ?? null;
    $this->id = $values['id'];
    $this->timeDt = $values['timeDt'] ?? null;
    $this->typeUid = $values['typeUid'] ?? null;
    $this->typeName = $values['typeName'] ?? null;

    $this->_dirtyFields = [
      'activity_id' => true,
      'activity_name' => true,
      'status_id' => true,
      'actor' => true,
      'message' => true,
      'id' => true
    ];
    if (array_key_exists('metadata', $values)) {
      $this->_dirtyFields['metadata'] = true;
    }
    if (array_key_exists('time', $values)) {
      $this->_dirtyFields['time'] = true;
    }
    if (array_key_exists('categoryName', $values)) {
      $this->_dirtyFields['category_name'] = true;
    }
    if (array_key_exists('categoryUid', $values)) {
      $this->_dirtyFields['category_uid'] = true;
    }
    if (array_key_exists('className', $values)) {
      $this->_dirtyFields['class_name'] = true;
    }
    if (array_key_exists('classUid', $values)) {
      $this->_dirtyFields['class_uid'] = true;
    }
    if (array_key_exists('severityId', $values)) {
      $this->_dirtyFields['severity_id'] = true;
    }
    if (array_key_exists('device', $values)) {
      $this->_dirtyFields['device'] = true;
    }
    if (array_key_exists('httpRequest', $values)) {
      $this->_dirtyFields['http_request'] = true;
    }
    if (array_key_exists('unmapped', $values)) {
      $this->_dirtyFields['unmapped'] = true;
    }
    if (array_key_exists('timeDt', $values)) {
      $this->_dirtyFields['time_dt'] = true;
    }
    if (array_key_exists('typeUid', $values)) {
      $this->_dirtyFields['type_uid'] = true;
    }
    if (array_key_exists('typeName', $values)) {
      $this->_dirtyFields['type_name'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->metadata !== null) {
      $parts[] = [
        'name' => 'metadata',
        'contents' => json_encode($this->metadata),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->time !== null) {
      $parts[] = [
        'name' => 'time',
        'contents' => (string) $this->time
      ];
    }

    $parts[] = [
      'name' => 'activity_id',
      'contents' => json_encode($this->activityId),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'activity_name',
      'contents' => $this->activityName
    ];

    if ($this->categoryName !== null) {
      $parts[] = [
        'name' => 'category_name',
        'contents' => $this->categoryName
      ];
    }

    if ($this->categoryUid !== null) {
      $parts[] = [
        'name' => 'category_uid',
        'contents' => (string) $this->categoryUid
      ];
    }

    if ($this->className !== null) {
      $parts[] = [
        'name' => 'class_name',
        'contents' => $this->className
      ];
    }

    if ($this->classUid !== null) {
      $parts[] = [
        'name' => 'class_uid',
        'contents' => (string) $this->classUid
      ];
    }

    if ($this->severityId !== null) {
      $parts[] = [
        'name' => 'severity_id',
        'contents' => (string) $this->severityId
      ];
    }

    $parts[] = [
      'name' => 'status_id',
      'contents' => (string) $this->statusId
    ];

    $parts[] = [
      'name' => 'actor',
      'contents' => json_encode($this->actor),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->device !== null) {
      $parts[] = [
        'name' => 'device',
        'contents' => json_encode($this->device),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->httpRequest !== null) {
      $parts[] = [
        'name' => 'http_request',
        'contents' => json_encode($this->httpRequest),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'message',
      'contents' => $this->message
    ];

    if ($this->unmapped !== null) {
      $parts[] = [
        'name' => 'unmapped',
        'contents' => json_encode($this->unmapped),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    if ($this->timeDt !== null) {
      $parts[] = [
        'name' => 'time_dt',
        'contents' => $this->timeDt
      ];
    }

    if ($this->typeUid !== null) {
      $parts[] = [
        'name' => 'type_uid',
        'contents' => (string) $this->typeUid
      ];
    }

    if ($this->typeName !== null) {
      $parts[] = [
        'name' => 'type_name',
        'contents' => $this->typeName
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->actor->validate();
    $this->device?->validate();
    $this->httpRequest?->validate();
  }
}
