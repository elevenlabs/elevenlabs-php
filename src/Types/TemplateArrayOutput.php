<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * An `array` output, delivered as `content` once completed: one output per
 * element, each an output in its own right with its own `status`. A list can
 * be arbitrarily long, so `content` is its first page; when `has_more` is
 * true, `next_cursor` leads to the rest.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TemplateArrayOutput extends JsonSerializableType
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
   * @var ?value-of<\ElevenLabs\Types\TemplateArrayOutputFailureReason>
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
   * @var value-of<\ElevenLabs\Types\TemplateArrayOutputType>
   * The kind of output: the `type` of the port's `content_schema`.
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @var \ElevenLabs\Types\TemplateOutput[]|null
   * The first elements of the list, in order, each following the shape of the schema's `items`. Present only when `status` is `completed`. When `has_more` is true this is not the whole list. Reserved: no template produces this kind of output yet; it is published so that templates which do can be run with the same client.
   */
  #[JsonProperty('content'), ArrayType([\ElevenLabs\Types\TemplateOutput::class])]
  public ?array $content;

  /**
   * Pass as `cursor` to a later endpoint to fetch the elements after `content`. `null` when `content` holds the whole list, or before the output completes. Reserved: no template produces this kind of output yet; it is published so that templates which do can be run with the same client.
   */
  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  /**
   * Whether the list has elements beyond `content`.
   */
  #[JsonProperty('has_more')]
  public ?bool $hasMore;

  /**
   * @param array{
   *   id: string,
   *   status: value-of<\ElevenLabs\Types\TemplateRunStatus>,
   *   type: value-of<\ElevenLabs\Types\TemplateArrayOutputType>,
   *   failureReason?: ?value-of<\ElevenLabs\Types\TemplateArrayOutputFailureReason>,
   *   errorMessage?: ?string,
   *   content?: \ElevenLabs\Types\TemplateOutput[]|null,
   *   nextCursor?: ?string,
   *   hasMore?: ?bool,
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
    $this->nextCursor = $values['nextCursor'] ?? null;
    $this->hasMore = $values['hasMore'] ?? null;

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
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
    if (array_key_exists('hasMore', $values)) {
      $this->_dirtyFields['has_more'] = true;
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
        'contents' => json_encode($this->content),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    if ($this->hasMore !== null) {
      $parts[] = [
        'name' => 'has_more',
        'contents' => $this->hasMore ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
