<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * A template run and its outputs. Every output exists from the moment the
 * run is created and reports its own `status`; the run's `status` rolls them
 * up, and the run is finished once it is `completed` or `failed`.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TemplateRunResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The unique identifier of the run.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * The template this run executed, so a webhook consumer running several templates can tell their runs apart without keeping a run-to-template map.
   */
  #[JsonProperty('template_id', required: true)]
  public string $templateId;

  /**
   * The template version this run executed. Resolved when the run is created, so a run started with `latest` records the concrete version it ran.
   */
  #[JsonProperty('version_id', required: true)]
  public string $versionId;

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
   * @var array<string, \ElevenLabs\Types\TemplateOutput>
   * The run's outputs, keyed by output port id. Each is a `TemplateOutput` discriminated on `type`, the `type` of its port's `content_schema`.
   */
  #[
    JsonProperty('outputs', required: true),
    ArrayType(['string' => \ElevenLabs\Types\TemplateOutput::class])
  ]
  public array $outputs;

  /**
   * @param array{
   *   id: string,
   *   templateId: string,
   *   versionId: string,
   *   status: value-of<\ElevenLabs\Types\TemplateRunStatus>,
   *   outputs: array<string, \ElevenLabs\Types\TemplateOutput>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->templateId = $values['templateId'];
    $this->versionId = $values['versionId'];
    $this->status = $values['status'];
    $this->outputs = $values['outputs'];

    $this->_dirtyFields = [
      'id' => true,
      'template_id' => true,
      'version_id' => true,
      'status' => true,
      'outputs' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'template_id',
      'contents' => $this->templateId
    ];

    $parts[] = [
      'name' => 'version_id',
      'contents' => $this->versionId
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'outputs',
      'contents' => json_encode($this->outputs),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
