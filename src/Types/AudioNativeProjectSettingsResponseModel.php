<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AudioNativeProjectSettingsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The title of the project.
   */
  #[JsonProperty('title', required: true)]
  public string $title;

  /**
   * The image of the project.
   */
  #[JsonProperty('image', required: true)]
  public string $image;

  /**
   * The author of the project.
   */
  #[JsonProperty('author', required: true)]
  public string $author;

  /**
   * Whether the project is small.
   */
  #[JsonProperty('small', required: true)]
  public bool $small;

  /**
   * The text color of the project.
   */
  #[JsonProperty('text_color', required: true)]
  public string $textColor;

  /**
   * The background color of the project.
   */
  #[JsonProperty('background_color', required: true)]
  public string $backgroundColor;

  /**
   * The sessionization of the project. Specifies for how many minutes to persist the session across page reloads.
   */
  #[JsonProperty('sessionization', required: true)]
  public int $sessionization;

  /**
   * The path of the audio file.
   */
  #[JsonProperty('audio_path')]
  public ?string $audioPath;

  /**
   * The URL of the audio file.
   */
  #[JsonProperty('audio_url')]
  public ?string $audioUrl;

  /**
   * @var ?value-of<\ElevenLabs\Types\AudioNativeProjectSettingsResponseModelStatus>
   * Current state of the project
   */
  #[JsonProperty('status')]
  public ?string $status;

  /**
   * @param array{
   *   title: string,
   *   image: string,
   *   author: string,
   *   small: bool,
   *   textColor: string,
   *   backgroundColor: string,
   *   sessionization: int,
   *   audioPath?: ?string,
   *   audioUrl?: ?string,
   *   status?: ?value-of<\ElevenLabs\Types\AudioNativeProjectSettingsResponseModelStatus>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->title = $values['title'];
    $this->image = $values['image'];
    $this->author = $values['author'];
    $this->small = $values['small'];
    $this->textColor = $values['textColor'];
    $this->backgroundColor = $values['backgroundColor'];
    $this->sessionization = $values['sessionization'];
    $this->audioPath = $values['audioPath'] ?? null;
    $this->audioUrl = $values['audioUrl'] ?? null;
    $this->status = $values['status'] ?? null;

    $this->_dirtyFields = [
      'title' => true,
      'image' => true,
      'author' => true,
      'small' => true,
      'text_color' => true,
      'background_color' => true,
      'sessionization' => true
    ];
    if (array_key_exists('audioPath', $values)) {
      $this->_dirtyFields['audio_path'] = true;
    }
    if (array_key_exists('audioUrl', $values)) {
      $this->_dirtyFields['audio_url'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'title',
      'contents' => $this->title
    ];

    $parts[] = [
      'name' => 'image',
      'contents' => $this->image
    ];

    $parts[] = [
      'name' => 'author',
      'contents' => $this->author
    ];

    $parts[] = [
      'name' => 'small',
      'contents' => $this->small ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'text_color',
      'contents' => $this->textColor
    ];

    $parts[] = [
      'name' => 'background_color',
      'contents' => $this->backgroundColor
    ];

    $parts[] = [
      'name' => 'sessionization',
      'contents' => (string) $this->sessionization
    ];

    if ($this->audioPath !== null) {
      $parts[] = [
        'name' => 'audio_path',
        'contents' => $this->audioPath
      ];
    }

    if ($this->audioUrl !== null) {
      $parts[] = [
        'name' => 'audio_url',
        'contents' => $this->audioUrl
      ];
    }

    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
