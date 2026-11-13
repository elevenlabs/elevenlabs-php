<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * One input or output port of a published template version.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TemplatePort extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The port id. Input ids are the keys of the `inputs` map on `POST /v1/flows/templates/{template_id}/runs`; output ids are the keys of the `outputs` map on the run response.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('content_schema', required: true)]
  public \ElevenLabs\Types\ContentSchema $contentSchema;

  /**
   * @param array{
   *   id: string,
   *   contentSchema: \ElevenLabs\Types\ContentSchema,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->contentSchema = $values['contentSchema'];

    $this->_dirtyFields = [
      'id' => true,
      'content_schema' => true
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
      'name' => 'content_schema',
      'contents' => json_encode($this->contentSchema),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
