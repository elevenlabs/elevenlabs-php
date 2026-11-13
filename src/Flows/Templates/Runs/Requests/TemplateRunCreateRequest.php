<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Templates\Runs\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Request body of ``POST /v1/flows/templates/{template_id}/runs``.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TemplateRunCreateRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\TemplateRunInput>
   * Input values keyed by input port id. Every input port of the version being run must be given; a missing or unknown id is rejected. Pass `{}` for a template with no inputs.
   */
  #[
    JsonProperty('inputs', required: true),
    ArrayType(['string' => \ElevenLabs\Types\TemplateRunInput::class])
  ]
  public array $inputs;

  /**
   * The template snapshot to run. Pass a specific version id to pin that snapshot, or `latest` (the default when omitted) to run the template's most recently published version. Only published versions can be pinned, except by the template's owner, who may also pin an unpublished saved snapshot to try it out before publishing. The live draft is never run through this API.
   */
  #[JsonProperty('version_id')]
  public ?string $versionId;

  /**
   * Include to send the run's result to the workspace's configured flows webhooks once the run's `status` reaches `completed` or `failed`. One event for the whole run: the `flows_template_run` event's `data` matches the terminal response of `GET /v1/flows/templates/{template_id}/runs/{run_id}`.
   */
  #[JsonProperty('webhook')]
  public ?\ElevenLabs\Types\WebhookTarget $webhook;

  /**
   * @param array{
   *   inputs: array<string, \ElevenLabs\Types\TemplateRunInput>,
   *   versionId?: ?string,
   *   webhook?: ?\ElevenLabs\Types\WebhookTarget,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->inputs = $values['inputs'];
    $this->versionId = $values['versionId'] ?? null;
    $this->webhook = $values['webhook'] ?? null;

    $this->_dirtyFields = [
      'inputs' => true
    ];
    if (array_key_exists('versionId', $values)) {
      $this->_dirtyFields['version_id'] = true;
    }
    if (array_key_exists('webhook', $values)) {
      $this->_dirtyFields['webhook'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'inputs',
      'contents' => json_encode($this->inputs),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->versionId !== null) {
      $parts[] = [
        'name' => 'version_id',
        'contents' => $this->versionId
      ];
    }

    if ($this->webhook !== null) {
      $parts[] = [
        'name' => 'webhook',
        'contents' => json_encode($this->webhook),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->versionId, 'version_id', minLength: 1);
  }
}
