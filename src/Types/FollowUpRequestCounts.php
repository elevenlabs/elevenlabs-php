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
class FollowUpRequestCounts extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * How many times contacts asked.
   */
  #[JsonProperty('requested', required: true)]
  public int $requested;

  /**
   * @var array<string, int>
   * Requests by what the campaign did about them; adds up to `requested`. Missing keys mean none.
   */
  #[JsonProperty('requested_by_disposition', required: true), ArrayType(['string' => 'integer'])]
  public array $requestedByDisposition;

  /**
   * Leads that asked at least once.
   */
  #[JsonProperty('distinct_leads', required: true)]
  public int $distinctLeads;

  /**
   * @param array{
   *   requested: int,
   *   requestedByDisposition: array<string, int>,
   *   distinctLeads: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->requested = $values['requested'];
    $this->requestedByDisposition = $values['requestedByDisposition'];
    $this->distinctLeads = $values['distinctLeads'];

    $this->_dirtyFields = [
      'requested' => true,
      'requested_by_disposition' => true,
      'distinct_leads' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'requested',
      'contents' => (string) $this->requested
    ];

    $parts[] = [
      'name' => 'requested_by_disposition',
      'contents' => json_encode($this->requestedByDisposition),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'distinct_leads',
      'contents' => (string) $this->distinctLeads
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
