<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * An `audio` output, downloaded from `content_url` once completed.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TemplateAudioOutput extends JsonSerializableType
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
   * @var ?value-of<\ElevenLabs\Types\TemplateAudioOutputFailureReason>
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
   * A signed URL to download the generated media from. Present only when `status` is `completed`. It expires about an hour after this response is returned; fetch the run again for a fresh URL.
   */
  #[JsonProperty('content_url')]
  public ?string $contentUrl;

  /**
   * The MIME type of the generated media. Present only when `status` is `completed`.
   */
  #[JsonProperty('content_mime_type')]
  public ?string $contentMimeType;

  /**
   * @var value-of<\ElevenLabs\Types\TemplateAudioOutputType>
   * The kind of output: the `type` of the port's `content_schema`.
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @param array{
   *   id: string,
   *   status: value-of<\ElevenLabs\Types\TemplateRunStatus>,
   *   type: value-of<\ElevenLabs\Types\TemplateAudioOutputType>,
   *   failureReason?: ?value-of<\ElevenLabs\Types\TemplateAudioOutputFailureReason>,
   *   errorMessage?: ?string,
   *   contentUrl?: ?string,
   *   contentMimeType?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->status = $values['status'];
    $this->failureReason = $values['failureReason'] ?? null;
    $this->errorMessage = $values['errorMessage'] ?? null;
    $this->contentUrl = $values['contentUrl'] ?? null;
    $this->contentMimeType = $values['contentMimeType'] ?? null;
    $this->type = $values['type'];

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
    if (array_key_exists('contentUrl', $values)) {
      $this->_dirtyFields['content_url'] = true;
    }
    if (array_key_exists('contentMimeType', $values)) {
      $this->_dirtyFields['content_mime_type'] = true;
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

    if ($this->contentUrl !== null) {
      $parts[] = [
        'name' => 'content_url',
        'contents' => $this->contentUrl
      ];
    }

    if ($this->contentMimeType !== null) {
      $parts[] = [
        'name' => 'content_mime_type',
        'contents' => $this->contentMimeType
      ];
    }

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
