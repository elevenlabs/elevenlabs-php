<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\KnowledgeBaseSortBy;
use ElevenLabs\Types\SortDirection;

class ListKnowledgeBaseRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize How many documents to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?string $search If specified, the endpoint returns only such knowledge base documents whose names start with this string.
   */
  public ?string $search;

  /**
   * @var ?bool $showOnlyOwnedDocuments If set to true, the endpoint will return only documents owned by you (and not shared from somebody else). Deprecated: use created_by_user_id instead.
   */
  public ?bool $showOnlyOwnedDocuments;

  /**
   * @var ?string $createdByUserId Filter documents by creator user ID. When set, only documents created by this user are returned. Takes precedence over show_only_owned_documents. Use '@me' to refer to the authenticated user.
   */
  public ?string $createdByUserId;

  /**
   * @var ?array $types If present, the endpoint will return only documents of the given types.
   */
  public ?array $types;

  /**
   * @var ?string $parentFolderId If set, the endpoint will return only documents that are direct children of the given folder.
   */
  public ?string $parentFolderId;

  /**
   * @var ?string $ancestorFolderId If set, the endpoint will return only documents that are descendants of the given folder.
   */
  public ?string $ancestorFolderId;

  /**
   * @var ?bool $foldersFirst Whether folders should be returned first in the list of documents.
   */
  public ?bool $foldersFirst;

  /**
   * @var ?value-of<SortDirection> $sortDirection The direction to sort the results
   */
  public ?string $sortDirection;

  /**
   * @var ?value-of<KnowledgeBaseSortBy> $sortBy The field to sort the results by
   */
  public ?string $sortBy;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   search?: ?string,
   *   showOnlyOwnedDocuments?: ?bool,
   *   createdByUserId?: ?string,
   *   types?: ?array,
   *   parentFolderId?: ?string,
   *   ancestorFolderId?: ?string,
   *   foldersFirst?: ?bool,
   *   sortDirection?: ?value-of<SortDirection>,
   *   sortBy?: ?value-of<KnowledgeBaseSortBy>,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->search = $values['search'] ?? null;
    $this->showOnlyOwnedDocuments = $values['showOnlyOwnedDocuments'] ?? null;
    $this->createdByUserId = $values['createdByUserId'] ?? null;
    $this->types = $values['types'] ?? null;
    $this->parentFolderId = $values['parentFolderId'] ?? null;
    $this->ancestorFolderId = $values['ancestorFolderId'] ?? null;
    $this->foldersFirst = $values['foldersFirst'] ?? null;
    $this->sortDirection = $values['sortDirection'] ?? null;
    $this->sortBy = $values['sortBy'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'pageSize' => $data['page_size'] ?? null,
      'search' => $data['search'] ?? null,
      'showOnlyOwnedDocuments' => $data['show_only_owned_documents'] ?? null,
      'createdByUserId' => $data['created_by_user_id'] ?? null,
      'types' => $data['types'] ?? null,
      'parentFolderId' => $data['parent_folder_id'] ?? null,
      'ancestorFolderId' => $data['ancestor_folder_id'] ?? null,
      'foldersFirst' => $data['folders_first'] ?? null,
      'sortDirection' => $data['sort_direction'] ?? null,
      'sortBy' => $data['sort_by'] ?? null,
      'cursor' => $data['cursor'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    if ($this->showOnlyOwnedDocuments !== null) {
      $result['show_only_owned_documents'] = $this->showOnlyOwnedDocuments;
    }
    if ($this->createdByUserId !== null) {
      $result['created_by_user_id'] = $this->createdByUserId;
    }
    if ($this->types !== null) {
      $result['types'] = $this->types;
    }
    if ($this->parentFolderId !== null) {
      $result['parent_folder_id'] = $this->parentFolderId;
    }
    if ($this->ancestorFolderId !== null) {
      $result['ancestor_folder_id'] = $this->ancestorFolderId;
    }
    if ($this->foldersFirst !== null) {
      $result['folders_first'] = $this->foldersFirst;
    }
    if ($this->sortDirection !== null) {
      $result['sort_direction'] = $this->sortDirection;
    }
    if ($this->sortBy !== null) {
      $result['sort_by'] = $this->sortBy;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
