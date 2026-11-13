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
class ConversationProgress extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Calls due to be placed that haven't started.
   */
  #[JsonProperty('scheduled', required: true)]
  public int $scheduled;

  /**
   * @var array<string, int>
   * Scheduled calls by call type. Missing keys mean none.
   */
  #[JsonProperty('scheduled_by_type', required: true), ArrayType(['string' => 'integer'])]
  public array $scheduledByType;

  /**
   * WhatsApp calls waiting on the contact to grant call permission.
   */
  #[JsonProperty('awaiting_permission', required: true)]
  public int $awaitingPermission;

  /**
   * Calls under way.
   */
  #[JsonProperty('in_progress', required: true)]
  public int $inProgress;

  /**
   * Ended calls whose analysis the campaign is waiting on.
   */
  #[JsonProperty('awaiting_analysis', required: true)]
  public int $awaitingAnalysis;

  /**
   * @param array{
   *   scheduled: int,
   *   scheduledByType: array<string, int>,
   *   awaitingPermission: int,
   *   inProgress: int,
   *   awaitingAnalysis: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->scheduled = $values['scheduled'];
    $this->scheduledByType = $values['scheduledByType'];
    $this->awaitingPermission = $values['awaitingPermission'];
    $this->inProgress = $values['inProgress'];
    $this->awaitingAnalysis = $values['awaitingAnalysis'];

    $this->_dirtyFields = [
      'scheduled' => true,
      'scheduled_by_type' => true,
      'awaiting_permission' => true,
      'in_progress' => true,
      'awaiting_analysis' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'scheduled',
      'contents' => (string) $this->scheduled
    ];

    $parts[] = [
      'name' => 'scheduled_by_type',
      'contents' => json_encode($this->scheduledByType),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'awaiting_permission',
      'contents' => (string) $this->awaitingPermission
    ];

    $parts[] = [
      'name' => 'in_progress',
      'contents' => (string) $this->inProgress
    ];

    $parts[] = [
      'name' => 'awaiting_analysis',
      'contents' => (string) $this->awaitingAnalysis
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
