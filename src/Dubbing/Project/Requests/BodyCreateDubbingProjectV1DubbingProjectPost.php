<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Project\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyCreateDubbingProjectV1DubbingProjectPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?\ElevenLabs\Utils\File
   * The source media file to dub: an audio or video file of at most 3 GiB. Provide this or `source_url`, not both.
   */
  #[JsonProperty('file')]
  public ?\ElevenLabs\Utils\File $file;

  /**
   * Public HTTP(S) URL the source media is fetched from server-side, subject to the same size and format limits as an upload. Provide this or `file`, not both.
   */
  #[JsonProperty('source_url')]
  public ?string $sourceUrl;

  /**
   * Optional free-form string (at most 500 characters) to identify the project on your end. Stored and echoed back verbatim; it does not affect the dub.
   */
  #[JsonProperty('reference')]
  public ?string $reference;

  /**
   * BCP-47 language tag of the source media; must be a language the transcription model supports. Any region or script subtag is ignored, since transcription is per-language. Omit to auto-detect.
   */
  #[JsonProperty('source_language')]
  public ?string $sourceLanguage;

  /**
   * Dubbing model (`dubbing_v1` or `dubbing_v2`) every language target of this project is dubbed with. Defaults to `dubbing_v2`. Fixed at create time — the source is prepared for this model, so neither the project nor an individual target can change it later.
   */
  #[JsonProperty('model_id'), Union('string', 'null')]
  public ?string $modelId;

  /**
   * @var string[]|null
   * Key terms to bias transcription and translation toward (for example, product or brand names). At most 1,000 terms; each term at most 50 characters and 5 words; the characters `<>{}[]\` are not allowed. Terms are trimmed and deduplicated. Repeat the field once per term, or pass a single JSON array.
   */
  #[JsonProperty('keyterms'), ArrayType(['string'])]
  public ?array $keyterms;

  /**
   * @var string[]|null
   * IDs of workspace webhooks to notify as this project progresses — the alternative to polling, and what we recommend. Each receives a `dubbing_project_ready` or `dubbing_project_failed` event for the project, and a `dubbing_language_completed` or `dubbing_language_failed` event for every language under it; `dubbing_language_completed` carries the output download URLs. At most 3 IDs, each already configured in your workspace — see [Webhooks](https://elevenlabs.io/docs/eleven-api/resources/webhooks) for how to create one and verify its signature. Repeat the field once per ID, or pass a single JSON array or comma-separated string. Delivery is best-effort and can repeat, so we recommend handling events idempotently.
   */
  #[JsonProperty('webhook_ids'), ArrayType(['string'])]
  public ?array $webhookIds;

  /**
   * Optional shortcut: also create a language target in this BCP-47 language, queued to start once the project is ready — equivalent to creating the project and then creating one language target. Must be one of the [languages the dubbing model supports](https://elevenlabs.io/docs/help-center/product/dubbing/which-languages-are-supported-in-dubbing), and a region-qualified tag must be one of the supported dialects. This is the first language target, so it consumes the project's minimum charge rather than adding to it. Its ID is returned in `language_ids`.
   */
  #[JsonProperty('target_language')]
  public ?string $targetLanguage;

  /**
   * @var ?\ElevenLabs\Utils\File
   * Enterprise only. Optional JSON transcript to use instead of transcribing the source: a `{"segments": [...]}` document, at most 20,000 segments and 4 MiB. See [Bring your own transcript](https://elevenlabs.io/docs/eleven-api/guides/how-to/dubbing/bring-your-own-transcript) for the segment fields and their constraints. `source_language` is required whenever a transcript is provided. If any segment carries a `translation`, `target_language` is required and every segment must carry one; those translations seed the target created via `target_language`, which then skips machine translation.
   */
  #[JsonProperty('transcript')]
  public ?\ElevenLabs\Utils\File $transcript;

  /**
   * @param array{
   *   file?: ?\ElevenLabs\Utils\File,
   *   sourceUrl?: ?string,
   *   reference?: ?string,
   *   sourceLanguage?: ?string,
   *   modelId?: ?string,
   *   keyterms?: string[]|null,
   *   webhookIds?: string[]|null,
   *   targetLanguage?: ?string,
   *   transcript?: ?\ElevenLabs\Utils\File,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->file = $values['file'] ?? null;
    $this->sourceUrl = $values['sourceUrl'] ?? null;
    $this->reference = $values['reference'] ?? null;
    $this->sourceLanguage = $values['sourceLanguage'] ?? null;
    $this->modelId = $values['modelId'] ?? null;
    $this->keyterms = $values['keyterms'] ?? null;
    $this->webhookIds = $values['webhookIds'] ?? null;
    $this->targetLanguage = $values['targetLanguage'] ?? null;
    $this->transcript = $values['transcript'] ?? null;

    if (array_key_exists('file', $values)) {
      $this->_dirtyFields['file'] = true;
    }
    if (array_key_exists('sourceUrl', $values)) {
      $this->_dirtyFields['source_url'] = true;
    }
    if (array_key_exists('reference', $values)) {
      $this->_dirtyFields['reference'] = true;
    }
    if (array_key_exists('sourceLanguage', $values)) {
      $this->_dirtyFields['source_language'] = true;
    }
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('keyterms', $values)) {
      $this->_dirtyFields['keyterms'] = true;
    }
    if (array_key_exists('webhookIds', $values)) {
      $this->_dirtyFields['webhook_ids'] = true;
    }
    if (array_key_exists('targetLanguage', $values)) {
      $this->_dirtyFields['target_language'] = true;
    }
    if (array_key_exists('transcript', $values)) {
      $this->_dirtyFields['transcript'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->file !== null) {
      $parts[] = $this->file->toMultipartFormDataPart('file')->toGuzzlePart();
    }

    if ($this->sourceUrl !== null) {
      $parts[] = [
        'name' => 'source_url',
        'contents' => $this->sourceUrl
      ];
    }

    if ($this->reference !== null) {
      $parts[] = [
        'name' => 'reference',
        'contents' => $this->reference
      ];
    }

    if ($this->sourceLanguage !== null) {
      $parts[] = [
        'name' => 'source_language',
        'contents' => $this->sourceLanguage
      ];
    }

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => json_encode($this->modelId),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->keyterms !== null) {
      foreach ($this->keyterms ?? [] as $item) {
        $parts[] = [
          'name' => 'keyterms',
          'contents' => $item
        ];
      }
    }

    if ($this->webhookIds !== null) {
      foreach ($this->webhookIds ?? [] as $item) {
        $parts[] = [
          'name' => 'webhook_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->targetLanguage !== null) {
      $parts[] = [
        'name' => 'target_language',
        'contents' => $this->targetLanguage
      ];
    }

    if ($this->transcript !== null) {
      $parts[] = $this->transcript->toMultipartFormDataPart('transcript')->toGuzzlePart();
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
