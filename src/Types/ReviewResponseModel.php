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
class ReviewResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ReviewResponseModelReviewStatus>
   */
  #[JsonProperty('review_status', required: true)]
  public string $reviewStatus;

  #[JsonProperty('reviewed_at_unix', required: true)]
  public int $reviewedAtUnix;

  #[JsonProperty('reviewed_by')]
  public ?string $reviewedBy;

  /**
   * @var array<value-of<\ElevenLabs\Types\ReviewResponseModelRejectReasonsItem>>|null
   */
  #[JsonProperty('reject_reasons'), ArrayType(['string'])]
  public ?array $rejectReasons;

  /**
   * @var array<string, int>|null
   */
  #[JsonProperty('scores_breakdown'), ArrayType(['string' => 'integer'])]
  public ?array $scoresBreakdown;

  #[JsonProperty('rejected_details')]
  public ?string $rejectedDetails;

  #[JsonProperty('explanation')]
  public ?string $explanation;

  /**
   * @param array{
   *   reviewStatus: value-of<\ElevenLabs\Types\ReviewResponseModelReviewStatus>,
   *   reviewedAtUnix: int,
   *   reviewedBy?: ?string,
   *   rejectReasons?: array<value-of<\ElevenLabs\Types\ReviewResponseModelRejectReasonsItem>>|null,
   *   scoresBreakdown?: array<string, int>|null,
   *   rejectedDetails?: ?string,
   *   explanation?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->reviewStatus = $values['reviewStatus'];
    $this->reviewedAtUnix = $values['reviewedAtUnix'];
    $this->reviewedBy = $values['reviewedBy'] ?? null;
    $this->rejectReasons = $values['rejectReasons'] ?? null;
    $this->scoresBreakdown = $values['scoresBreakdown'] ?? null;
    $this->rejectedDetails = $values['rejectedDetails'] ?? null;
    $this->explanation = $values['explanation'] ?? null;

    $this->_dirtyFields = [
      'review_status' => true,
      'reviewed_at_unix' => true
    ];
    if (array_key_exists('reviewedBy', $values)) {
      $this->_dirtyFields['reviewed_by'] = true;
    }
    if (array_key_exists('rejectReasons', $values)) {
      $this->_dirtyFields['reject_reasons'] = true;
    }
    if (array_key_exists('scoresBreakdown', $values)) {
      $this->_dirtyFields['scores_breakdown'] = true;
    }
    if (array_key_exists('rejectedDetails', $values)) {
      $this->_dirtyFields['rejected_details'] = true;
    }
    if (array_key_exists('explanation', $values)) {
      $this->_dirtyFields['explanation'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'review_status',
      'contents' => $this->reviewStatus
    ];

    $parts[] = [
      'name' => 'reviewed_at_unix',
      'contents' => (string) $this->reviewedAtUnix
    ];

    if ($this->reviewedBy !== null) {
      $parts[] = [
        'name' => 'reviewed_by',
        'contents' => $this->reviewedBy
      ];
    }

    if ($this->rejectReasons !== null) {
      foreach ($this->rejectReasons ?? [] as $item) {
        $parts[] = [
          'name' => 'reject_reasons',
          'contents' => $item
        ];
      }
    }

    if ($this->scoresBreakdown !== null) {
      $parts[] = [
        'name' => 'scores_breakdown',
        'contents' => json_encode($this->scoresBreakdown),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->rejectedDetails !== null) {
      $parts[] = [
        'name' => 'rejected_details',
        'contents' => $this->rejectedDetails
      ];
    }

    if ($this->explanation !== null) {
      $parts[] = [
        'name' => 'explanation',
        'contents' => $this->explanation
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
