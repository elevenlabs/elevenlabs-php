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
class LeadsProgress extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('total', required: true)]
  public int $total;

  /**
   * Unfinished leads whose first call hasn't been placed yet.
   */
  #[JsonProperty('uncalled', required: true)]
  public int $uncalled;

  /**
   * Unfinished leads whose next call an attention item holds back.
   */
  #[JsonProperty('leads_needing_attention', required: true)]
  public int $leadsNeedingAttention;

  /**
   * Other unfinished leads: a call under way, awaiting analysis or a follow-up.
   */
  #[JsonProperty('active', required: true)]
  public int $active;

  /**
   * Leads that won't be called again.
   */
  #[JsonProperty('finished', required: true)]
  public int $finished;

  /**
   * @var array<string, int>
   * Finished leads by why they finished. Missing keys mean none.
   */
  #[JsonProperty('finished_by_disposition', required: true), ArrayType(['string' => 'integer'])]
  public array $finishedByDisposition;

  /**
   * @param array{
   *   total: int,
   *   uncalled: int,
   *   leadsNeedingAttention: int,
   *   active: int,
   *   finished: int,
   *   finishedByDisposition: array<string, int>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->total = $values['total'];
    $this->uncalled = $values['uncalled'];
    $this->leadsNeedingAttention = $values['leadsNeedingAttention'];
    $this->active = $values['active'];
    $this->finished = $values['finished'];
    $this->finishedByDisposition = $values['finishedByDisposition'];

    $this->_dirtyFields = [
      'total' => true,
      'uncalled' => true,
      'leads_needing_attention' => true,
      'active' => true,
      'finished' => true,
      'finished_by_disposition' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'total',
      'contents' => (string) $this->total
    ];

    $parts[] = [
      'name' => 'uncalled',
      'contents' => (string) $this->uncalled
    ];

    $parts[] = [
      'name' => 'leads_needing_attention',
      'contents' => (string) $this->leadsNeedingAttention
    ];

    $parts[] = [
      'name' => 'active',
      'contents' => (string) $this->active
    ];

    $parts[] = [
      'name' => 'finished',
      'contents' => (string) $this->finished
    ];

    $parts[] = [
      'name' => 'finished_by_disposition',
      'contents' => json_encode($this->finishedByDisposition),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
