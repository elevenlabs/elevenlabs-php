<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Definition for a tool the client can call.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class Tool extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('title')]
  public ?string $title;

  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var array<string, mixed>
   */
  #[JsonProperty('inputSchema', required: true), ArrayType(['string' => 'mixed'])]
  public array $inputSchema;

  #[JsonProperty('execution')]
  public ?\ElevenLabs\Types\ToolExecution $execution;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('outputSchema'), ArrayType(['string' => 'mixed'])]
  public ?array $outputSchema;

  /**
   * @var \ElevenLabs\Types\Icon[]|null
   */
  #[JsonProperty('icons'), ArrayType([\ElevenLabs\Types\Icon::class])]
  public ?array $icons;

  #[JsonProperty('annotations')]
  public ?\ElevenLabs\Types\ToolAnnotations $annotations;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('_meta'), ArrayType(['string' => 'mixed'])]
  public ?array $meta;

  /**
   * @param array{
   *   name: string,
   *   inputSchema: array<string, mixed>,
   *   title?: ?string,
   *   description?: ?string,
   *   execution?: ?\ElevenLabs\Types\ToolExecution,
   *   outputSchema?: array<string, mixed>|null,
   *   icons?: \ElevenLabs\Types\Icon[]|null,
   *   annotations?: ?\ElevenLabs\Types\ToolAnnotations,
   *   meta?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->title = $values['title'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->inputSchema = $values['inputSchema'];
    $this->execution = $values['execution'] ?? null;
    $this->outputSchema = $values['outputSchema'] ?? null;
    $this->icons = $values['icons'] ?? null;
    $this->annotations = $values['annotations'] ?? null;
    $this->meta = $values['meta'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'inputSchema' => true
    ];
    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('execution', $values)) {
      $this->_dirtyFields['execution'] = true;
    }
    if (array_key_exists('outputSchema', $values)) {
      $this->_dirtyFields['outputSchema'] = true;
    }
    if (array_key_exists('icons', $values)) {
      $this->_dirtyFields['icons'] = true;
    }
    if (array_key_exists('annotations', $values)) {
      $this->_dirtyFields['annotations'] = true;
    }
    if (array_key_exists('meta', $values)) {
      $this->_dirtyFields['_meta'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->title !== null) {
      $parts[] = [
        'name' => 'title',
        'contents' => $this->title
      ];
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    $parts[] = [
      'name' => 'inputSchema',
      'contents' => json_encode($this->inputSchema),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->execution !== null) {
      $parts[] = [
        'name' => 'execution',
        'contents' => json_encode($this->execution),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->outputSchema !== null) {
      $parts[] = [
        'name' => 'outputSchema',
        'contents' => json_encode($this->outputSchema),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->icons !== null) {
      $parts[] = [
        'name' => 'icons',
        'contents' => json_encode($this->icons),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->annotations !== null) {
      $parts[] = [
        'name' => 'annotations',
        'contents' => json_encode($this->annotations),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->meta !== null) {
      $parts[] = [
        'name' => '_meta',
        'contents' => json_encode($this->meta),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->execution?->validate();
    foreach ($this->icons ?? [] as $item) {
      $item->validate();
    }
    $this->annotations?->validate();
  }
}
