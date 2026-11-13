<?php

declare(strict_types=1);

namespace ElevenLabs\AudioNative\Requests;

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
class BodyCreatesAudioNativeEnabledProjectV1AudioNativePost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Project name.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * (Deprecated) Image URL used in the player. If not provided, default image set in the Player settings is used.
   */
  #[JsonProperty('image')]
  public ?string $image;

  /**
   * Author used in the player and inserted at the start of the uploaded article. If not provided, the default author set in the Player settings is used.
   */
  #[JsonProperty('author')]
  public ?string $author;

  /**
   * Title used in the player and inserted at the top of the uploaded article. If not provided, the default title set in the Player settings is used.
   */
  #[JsonProperty('title')]
  public ?string $title;

  /**
   * (Deprecated) Whether to use small player or not. If not provided, default value set in the Player settings is used.
   */
  #[JsonProperty('small')]
  public ?bool $small;

  /**
   * Text color used in the player. If not provided, default text color set in the Player settings is used.
   */
  #[JsonProperty('text_color')]
  public ?string $textColor;

  /**
   * Background color used in the player. If not provided, default background color set in the Player settings is used.
   */
  #[JsonProperty('background_color')]
  public ?string $backgroundColor;

  /**
   * (Deprecated) Specifies for how many minutes to persist the session across page reloads. If not provided, default sessionization set in the Player settings is used.
   */
  #[JsonProperty('sessionization')]
  public ?int $sessionization;

  /**
   * Voice ID used to voice the content. If not provided, default voice ID set in the Player settings is used.
   */
  #[JsonProperty('voice_id')]
  public ?string $voiceId;

  /**
   * TTS Model ID used in the player. If not provided, default model ID set in the Player settings is used.
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * @var ?\ElevenLabs\Utils\File
   * Either txt or HTML input file containing the article content. HTML should be formatted as follows '&lt;html&gt;&lt;body&gt;&lt;div&gt;&lt;p&gt;Your content&lt;/p&gt;&lt;h3&gt;More of your content&lt;/h3&gt;&lt;p&gt;Some more of your content&lt;/p&gt;&lt;/div&gt;&lt;/body&gt;&lt;/html&gt;'
   */
  #[JsonProperty('file')]
  public ?\ElevenLabs\Utils\File $file;

  /**
   * Whether to auto convert the project to audio or not.
   */
  #[JsonProperty('auto_convert')]
  public ?bool $autoConvert;

  /**
   * @var ?value-of<\ElevenLabs\AudioNative\Types\CreateAudioNativeRequestApplyTextNormalization>
   *
   *     This parameter controls text normalization with four modes: 'auto', 'on', 'apply_english' and 'off'.
   *     When set to 'auto', the system will automatically decide whether to apply text normalization
   *     (e.g., spelling out numbers). With 'on', text normalization will always be applied, while
   *     with 'off', it will be skipped. 'apply_english' is the same as 'on' but will assume that text is in English.
   *
   */
  #[JsonProperty('apply_text_normalization')]
  public ?string $applyTextNormalization;

  /**
   * @var string[]|null
   * A list of pronunciation dictionary locators (pronunciation_dictionary_id, version_id) encoded as a list of JSON strings for pronunciation dictionaries to be applied to the text. A list of json encoded strings is required as adding projects may occur through formData as opposed to jsonBody. To specify multiple dictionaries use multiple --form lines in your curl, such as --form 'pronunciation_dictionary_locators="{\"pronunciation_dictionary_id\":\"Vmd4Zor6fplcA7WrINey\",\"version_id\":\"hRPaxjlTdR7wFMhV4w0b\"}"' --form 'pronunciation_dictionary_locators="{\"pronunciation_dictionary_id\":\"JzWtcGQMJ6bnlWwyMo7e\",\"version_id\":\"lbmwxiLu4q6txYxgdZqn\"}"'.
   */
  #[JsonProperty('pronunciation_dictionary_locators'), ArrayType(['string'])]
  public ?array $pronunciationDictionaryLocators;

  /**
   * @param array{
   *   name: string,
   *   image?: ?string,
   *   author?: ?string,
   *   title?: ?string,
   *   small?: ?bool,
   *   textColor?: ?string,
   *   backgroundColor?: ?string,
   *   sessionization?: ?int,
   *   voiceId?: ?string,
   *   modelId?: ?string,
   *   file?: ?\ElevenLabs\Utils\File,
   *   autoConvert?: ?bool,
   *   applyTextNormalization?: ?value-of<\ElevenLabs\AudioNative\Types\CreateAudioNativeRequestApplyTextNormalization>,
   *   pronunciationDictionaryLocators?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->image = $values['image'] ?? null;
    $this->author = $values['author'] ?? null;
    $this->title = $values['title'] ?? null;
    $this->small = $values['small'] ?? null;
    $this->textColor = $values['textColor'] ?? null;
    $this->backgroundColor = $values['backgroundColor'] ?? null;
    $this->sessionization = $values['sessionization'] ?? null;
    $this->voiceId = $values['voiceId'] ?? null;
    $this->modelId = $values['modelId'] ?? null;
    $this->file = $values['file'] ?? null;
    $this->autoConvert = $values['autoConvert'] ?? null;
    $this->applyTextNormalization = $values['applyTextNormalization'] ?? null;
    $this->pronunciationDictionaryLocators = $values['pronunciationDictionaryLocators'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('image', $values)) {
      $this->_dirtyFields['image'] = true;
    }
    if (array_key_exists('author', $values)) {
      $this->_dirtyFields['author'] = true;
    }
    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('small', $values)) {
      $this->_dirtyFields['small'] = true;
    }
    if (array_key_exists('textColor', $values)) {
      $this->_dirtyFields['text_color'] = true;
    }
    if (array_key_exists('backgroundColor', $values)) {
      $this->_dirtyFields['background_color'] = true;
    }
    if (array_key_exists('sessionization', $values)) {
      $this->_dirtyFields['sessionization'] = true;
    }
    if (array_key_exists('voiceId', $values)) {
      $this->_dirtyFields['voice_id'] = true;
    }
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('file', $values)) {
      $this->_dirtyFields['file'] = true;
    }
    if (array_key_exists('autoConvert', $values)) {
      $this->_dirtyFields['auto_convert'] = true;
    }
    if (array_key_exists('applyTextNormalization', $values)) {
      $this->_dirtyFields['apply_text_normalization'] = true;
    }
    if (array_key_exists('pronunciationDictionaryLocators', $values)) {
      $this->_dirtyFields['pronunciation_dictionary_locators'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->image !== null) {
      $parts[] = [
        'name' => 'image',
        'contents' => $this->image
      ];
    }

    if ($this->author !== null) {
      $parts[] = [
        'name' => 'author',
        'contents' => $this->author
      ];
    }

    if ($this->title !== null) {
      $parts[] = [
        'name' => 'title',
        'contents' => $this->title
      ];
    }

    if ($this->small !== null) {
      $parts[] = [
        'name' => 'small',
        'contents' => $this->small ? 'true' : 'false'
      ];
    }

    if ($this->textColor !== null) {
      $parts[] = [
        'name' => 'text_color',
        'contents' => $this->textColor
      ];
    }

    if ($this->backgroundColor !== null) {
      $parts[] = [
        'name' => 'background_color',
        'contents' => $this->backgroundColor
      ];
    }

    if ($this->sessionization !== null) {
      $parts[] = [
        'name' => 'sessionization',
        'contents' => (string) $this->sessionization
      ];
    }

    if ($this->voiceId !== null) {
      $parts[] = [
        'name' => 'voice_id',
        'contents' => $this->voiceId
      ];
    }

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    if ($this->file !== null) {
      $parts[] = $this->file->toMultipartFormDataPart('file')->toGuzzlePart();
    }

    if ($this->autoConvert !== null) {
      $parts[] = [
        'name' => 'auto_convert',
        'contents' => $this->autoConvert ? 'true' : 'false'
      ];
    }

    if ($this->applyTextNormalization !== null) {
      $parts[] = [
        'name' => 'apply_text_normalization',
        'contents' => $this->applyTextNormalization
      ];
    }

    if ($this->pronunciationDictionaryLocators !== null) {
      foreach ($this->pronunciationDictionaryLocators ?? [] as $item) {
        $parts[] = [
          'name' => 'pronunciation_dictionary_locators',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
