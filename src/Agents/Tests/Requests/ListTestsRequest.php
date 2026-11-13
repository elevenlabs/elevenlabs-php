<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tests\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Agents\Tests\Types\ListTestsRequestSortMode;
use ElevenLabs\Types\TestSharingMode;

class ListTestsRequest extends JsonSerializableType
{
  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @var ?int $pageSize How many Tests to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?string $search Search query to filter tests and folders by name.
   */
  public ?string $search;

  /**
   * @var ?string $parentFolderId Filter by parent folder ID. Use 'root' to get items in the root folder.
   */
  public ?string $parentFolderId;

  /**
   * @var ?array $types If present, the endpoint will return only tests/folders of the given types.
   */
  public ?array $types;

  /**
   * @var ?bool $includeFolders Deprecated. Use the `types` query param and include `folder` instead.
   */
  public ?bool $includeFolders;

  /**
   * @var ?value-of<ListTestsRequestSortMode> $sortMode Sort mode for listing tests. Use 'folders_first' to place folders before tests.
   */
  public ?string $sortMode;

  /**
   * @var ?value-of<TestSharingMode> $sharingMode Filter test visibility. Use `shared_with_me` to return only tests/folders shared with the current user that they did not create.
   */
  public ?string $sharingMode;

  /**
   * @var ?string $createdByUserId Filter tests and folders by creator user ID. Use '@me' to refer to the authenticated user.
   */
  public ?string $createdByUserId;

  /**
   * @param array{
   *   cursor?: ?string,
   *   pageSize?: ?int,
   *   search?: ?string,
   *   parentFolderId?: ?string,
   *   types?: ?array,
   *   includeFolders?: ?bool,
   *   sortMode?: ?value-of<ListTestsRequestSortMode>,
   *   sharingMode?: ?value-of<TestSharingMode>,
   *   createdByUserId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->cursor = $values['cursor'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->search = $values['search'] ?? null;
    $this->parentFolderId = $values['parentFolderId'] ?? null;
    $this->types = $values['types'] ?? null;
    $this->includeFolders = $values['includeFolders'] ?? null;
    $this->sortMode = $values['sortMode'] ?? null;
    $this->sharingMode = $values['sharingMode'] ?? null;
    $this->createdByUserId = $values['createdByUserId'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'cursor' => $data['cursor'] ?? null,
      'pageSize' => $data['page_size'] ?? null,
      'search' => $data['search'] ?? null,
      'parentFolderId' => $data['parent_folder_id'] ?? null,
      'types' => $data['types'] ?? null,
      'includeFolders' => $data['include_folders'] ?? null,
      'sortMode' => $data['sort_mode'] ?? null,
      'sharingMode' => $data['sharing_mode'] ?? null,
      'createdByUserId' => $data['created_by_user_id'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    if ($this->parentFolderId !== null) {
      $result['parent_folder_id'] = $this->parentFolderId;
    }
    if ($this->types !== null) {
      $result['types'] = $this->types;
    }
    if ($this->includeFolders !== null) {
      $result['include_folders'] = $this->includeFolders;
    }
    if ($this->sortMode !== null) {
      $result['sort_mode'] = $this->sortMode;
    }
    if ($this->sharingMode !== null) {
      $result['sharing_mode'] = $this->sharingMode;
    }
    if ($this->createdByUserId !== null) {
      $result['created_by_user_id'] = $this->createdByUserId;
    }
    return $result;
  }
}
