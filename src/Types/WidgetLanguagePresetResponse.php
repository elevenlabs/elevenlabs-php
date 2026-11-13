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
class WidgetLanguagePresetResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('first_message')]
  public ?string $firstMessage;

  /**
   * The text contents for the selected language
   */
  #[JsonProperty('text_contents')]
  public ?\ElevenLabs\Types\WidgetTextContents $textContents;

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
   * @param array{
   *   firstMessage?: ?string,
   *   textContents?: ?\ElevenLabs\Types\WidgetTextContents,
   *   termsText?: ?string,
   *   termsHtml?: ?string,
   *   termsKey?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->firstMessage = $values['firstMessage'] ?? null;
    $this->textContents = $values['textContents'] ?? null;
    $this->termsText = $values['termsText'] ?? null;
    $this->termsHtml = $values['termsHtml'] ?? null;
    $this->termsKey = $values['termsKey'] ?? null;

    if (array_key_exists('firstMessage', $values)) {
      $this->_dirtyFields['first_message'] = true;
    }
    if (array_key_exists('textContents', $values)) {
      $this->_dirtyFields['text_contents'] = true;
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
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->firstMessage !== null) {
      $parts[] = [
        'name' => 'first_message',
        'contents' => $this->firstMessage
      ];
    }

    if ($this->textContents !== null) {
      $parts[] = [
        'name' => 'text_contents',
        'contents' => json_encode($this->textContents),
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

    return $parts;
  }

  public function validate(): void
  {
    $this->textContents?->validate();
  }
}
