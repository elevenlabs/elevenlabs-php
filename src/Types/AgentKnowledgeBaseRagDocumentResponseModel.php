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
class AgentKnowledgeBaseRagDocumentResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the knowledge base document.
   */
  #[JsonProperty('document_id', required: true)]
  public string $documentId;

  /**
   * Name of the knowledge base document.
   */
  #[JsonProperty('document_name', required: true)]
  public string $documentName;

  /**
   * Tracked source URL for URL documents, or null for other document types.
   */
  #[JsonProperty('source_url', required: true)]
  public ?string $sourceUrl;

  /**
   * Content the agent would read, cut to the maximum documents length. Empty when the document has no extractable content.
   */
  #[JsonProperty('content', required: true)]
  public string $content;

  /**
   * Whether the content was cut to the maximum documents length.
   */
  #[JsonProperty('truncated', required: true)]
  public bool $truncated;

  /**
   * @var value-of<\ElevenLabs\Types\ContentFormat>
   * Canonical representation of a knowledge base document's stored content.
   *
   * HTML is the legacy default; documents created before this field existed are
   * interpreted as HTML.
   */
  #[JsonProperty('content_format', required: true)]
  public string $contentFormat;

  /**
   * @var value-of<\ElevenLabs\Types\KnowledgeBaseDocumentType>
   */
  #[JsonProperty('document_type', required: true)]
  public string $documentType;

  /**
   * @param array{
   *   documentId: string,
   *   documentName: string,
   *   sourceUrl: ?string,
   *   content: string,
   *   truncated: bool,
   *   contentFormat: value-of<\ElevenLabs\Types\ContentFormat>,
   *   documentType: value-of<\ElevenLabs\Types\KnowledgeBaseDocumentType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->documentId = $values['documentId'];
    $this->documentName = $values['documentName'];
    $this->sourceUrl = $values['sourceUrl'];
    $this->content = $values['content'];
    $this->truncated = $values['truncated'];
    $this->contentFormat = $values['contentFormat'];
    $this->documentType = $values['documentType'];

    $this->_dirtyFields = [
      'document_id' => true,
      'document_name' => true,
      'source_url' => true,
      'content' => true,
      'truncated' => true,
      'content_format' => true,
      'document_type' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'document_id',
      'contents' => $this->documentId
    ];

    $parts[] = [
      'name' => 'document_name',
      'contents' => $this->documentName
    ];

    $parts[] = [
      'name' => 'source_url',
      'contents' => $this->sourceUrl
    ];

    $parts[] = [
      'name' => 'content',
      'contents' => $this->content
    ];

    $parts[] = [
      'name' => 'truncated',
      'contents' => $this->truncated ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'content_format',
      'contents' => $this->contentFormat
    ];

    $parts[] = [
      'name' => 'document_type',
      'contents' => $this->documentType
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
