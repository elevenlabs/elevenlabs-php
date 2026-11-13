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
class WidgetLanguagePreset extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The text contents for the selected language
   */
  #[JsonProperty('text_contents')]
  public ?\ElevenLabs\Types\WidgetTextContents $textContents;

  /**
   * The translation cache for the text contents
   */
  #[JsonProperty('text_contents_translation')]
  public ?\ElevenLabs\Types\WidgetTextContentsTranslation $textContentsTranslation;

  /**
   * The text to display for terms and conditions in this language
   */
  #[JsonProperty('terms_text')]
  public ?string $termsText;

  /**
   * The HTML to display for terms and conditions in this language
   */
  #[JsonProperty('terms_html')]
  public ?string $termsHtml;

  /**
   * The key to display for terms and conditions in this language
   */
  #[JsonProperty('terms_key')]
  public ?string $termsKey;

  /**
   * The translation cache for the terms
   */
  #[JsonProperty('terms_translation')]
  public ?\ElevenLabs\Types\WidgetTermsTranslation $termsTranslation;

  /**
   * @param array{
   *   textContents?: ?\ElevenLabs\Types\WidgetTextContents,
   *   textContentsTranslation?: ?\ElevenLabs\Types\WidgetTextContentsTranslation,
   *   termsText?: ?string,
   *   termsHtml?: ?string,
   *   termsKey?: ?string,
   *   termsTranslation?: ?\ElevenLabs\Types\WidgetTermsTranslation,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->textContents = $values['textContents'] ?? null;
    $this->textContentsTranslation = $values['textContentsTranslation'] ?? null;
    $this->termsText = $values['termsText'] ?? null;
    $this->termsHtml = $values['termsHtml'] ?? null;
    $this->termsKey = $values['termsKey'] ?? null;
    $this->termsTranslation = $values['termsTranslation'] ?? null;

    if (array_key_exists('textContents', $values)) {
      $this->_dirtyFields['text_contents'] = true;
    }
    if (array_key_exists('textContentsTranslation', $values)) {
      $this->_dirtyFields['text_contents_translation'] = true;
    }
    if (array_key_exists('termsText', $values)) {
      $this->_dirtyFields['terms_text'] = true;
    }
    if (array_key_exists('termsHtml', $values)) {
      $this->_dirtyFields['terms_html'] = true;
    }
    if (array_key_exists('termsKey', $values)) {
      $this->_dirtyFields['terms_key'] = true;
    }
    if (array_key_exists('termsTranslation', $values)) {
      $this->_dirtyFields['terms_translation'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->textContents !== null) {
      $parts[] = [
        'name' => 'text_contents',
        'contents' => json_encode($this->textContents),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->textContentsTranslation !== null) {
      $parts[] = [
        'name' => 'text_contents_translation',
        'contents' => json_encode($this->textContentsTranslation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->termsText !== null) {
      $parts[] = [
        'name' => 'terms_text',
        'contents' => $this->termsText
      ];
    }

    if ($this->termsHtml !== null) {
      $parts[] = [
        'name' => 'terms_html',
        'contents' => $this->termsHtml
      ];
    }

    if ($this->termsKey !== null) {
      $parts[] = [
        'name' => 'terms_key',
        'contents' => $this->termsKey
      ];
    }

    if ($this->termsTranslation !== null) {
      $parts[] = [
        'name' => 'terms_translation',
        'contents' => json_encode($this->termsTranslation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->textContents?->validate();
    $this->textContentsTranslation?->validate();
    $this->termsTranslation?->validate();
  }
}
