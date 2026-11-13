<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * An `integer` output, delivered as `content` once completed.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TemplateIntegerOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The id of the generation behind this output. Pass it as a `generation` reference to use the output as an input elsewhere.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var value-of<\ElevenLabs\Types\TemplateRunStatus>
   * Where a run, or one of its outputs, is in its lifecycle. The run's is rolled
   * up from its outputs' (``aggregate_output_statuses``). A class rather than a
   * ``Literal`` so it publishes as one named enum instead of being inlined into
   * every kind.
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @var ?value-of<\ElevenLabs\Types\TemplateIntegerOutputFailureReason>
   * The category of failure. Present only when `status` is `failed`.
   */
  #[JsonProperty('failure_reason')]
  public ?string $failureReason;

  /**
   * A human-readable description of the failure. Present only when `status` is `failed`. Failed generations are not charged.
   */
  #[JsonProperty('error_message')]
  public ?string $errorMessage;

  /**
   * @var value-of<\ElevenLabs\Types\TemplateIntegerOutputType>
   * The kind of output: the `type` of the port's `content_schema`.
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * The generated integer. Present only when `status` is `completed`. Reserved: no template produces this kind of output yet; it is published so that templates which do can be run with the same client.
   */
  #[JsonProperty('content')]
  public ?int $content;

  /**
   * @param array{
   *   id: string,
   *   status: value-of<\ElevenLabs\Types\TemplateRunStatus>,
   *   type: value-of<\ElevenLabs\Types\TemplateIntegerOutputType>,
   *   failureReason?: ?value-of<\ElevenLabs\Types\TemplateIntegerOutputFailureReason>,
   *   errorMessage?: ?string,
   *   content?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->status = $values['status'];
    $this->failureReason = $values['failureReason'] ?? null;
    $this->errorMessage = $values['errorMessage'] ?? null;
    $this->type = $values['type'];
    $this->content = $values['content'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'status' => true,
      'type' => true
    ];
    if (array_key_exists('failureReason', $values)) {
      $this->_dirtyFields['failure_reason'] = true;
    }
    if (array_key_exists('errorMessage', $values)) {
      $this->_dirtyFields['error_message'] = true;
    }
    if (array_key_exists('content', $values)) {
      $this->_dirtyFields['content'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    if ($this->failureReason !== null) {
      $parts[] = [
        'name' => 'failure_reason',
        'contents' => $this->failureReason
      ];
    }

    if ($this->errorMessage !== null) {
      $parts[] = [
        'name' => 'error_message',
        'contents' => $this->errorMessage
      ];
    }

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    if ($this->content !== null) {
      $parts[] = [
        'name' => 'content',
        'contents' => (string) $this->content
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
