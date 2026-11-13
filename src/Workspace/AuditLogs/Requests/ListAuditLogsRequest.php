<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\AuditLogs\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\AuditActivityName;
use ElevenLabs\Types\AuditClassName;

class ListAuditLogsRequest extends JsonSerializableType
{
  /**
   * @var ?int $limit Maximum number of entries per page
   */
  public ?int $limit;

  /**
   * @var ?string $cursor Cursor for the next page (from previous response)
   */
  public ?string $cursor;

  /**
   * @var ?int $timeFromUnixMs Only include entries at or after this time (ms since epoch)
   */
  public ?int $timeFromUnixMs;

  /**
   * @var ?int $timeToUnixMs Only include entries at or before this time (ms since epoch)
   */
  public ?int $timeToUnixMs;

  /**
   * @var ?string $actorUid Filter by actor user ID
   */
  public ?string $actorUid;

  /**
   * @var ?value-of<AuditClassName> $className Filter by OCSF event class name
   */
  public ?string $className;

  /**
   * @var ?value-of<AuditActivityName> $activityName Filter by audit activity name
   */
  public ?string $activityName;

  /**
   * @param array{
   *   limit?: ?int,
   *   cursor?: ?string,
   *   timeFromUnixMs?: ?int,
   *   timeToUnixMs?: ?int,
   *   actorUid?: ?string,
   *   className?: ?value-of<AuditClassName>,
   *   activityName?: ?value-of<AuditActivityName>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->limit = $values['limit'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
    $this->timeFromUnixMs = $values['timeFromUnixMs'] ?? null;
    $this->timeToUnixMs = $values['timeToUnixMs'] ?? null;
    $this->actorUid = $values['actorUid'] ?? null;
    $this->className = $values['className'] ?? null;
    $this->activityName = $values['activityName'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'limit' => $data['limit'] ?? null,
      'cursor' => $data['cursor'] ?? null,
      'timeFromUnixMs' => $data['time_from_unix_ms'] ?? null,
      'timeToUnixMs' => $data['time_to_unix_ms'] ?? null,
      'actorUid' => $data['actor_uid'] ?? null,
      'className' => $data['class_name'] ?? null,
      'activityName' => $data['activity_name'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->limit !== null) {
      $result['limit'] = $this->limit;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    if ($this->timeFromUnixMs !== null) {
      $result['time_from_unix_ms'] = $this->timeFromUnixMs;
    }
    if ($this->timeToUnixMs !== null) {
      $result['time_to_unix_ms'] = $this->timeToUnixMs;
    }
    if ($this->actorUid !== null) {
      $result['actor_uid'] = $this->actorUid;
    }
    if ($this->className !== null) {
      $result['class_name'] = $this->className;
    }
    if ($this->activityName !== null) {
      $result['activity_name'] = $this->activityName;
    }
    return $result;
  }
}
