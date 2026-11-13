<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class SearchVoicesRequest extends JsonSerializableType
{
  /**
   * @var ?string $nextPageToken The next page token to use for pagination. Returned from the previous request. Use this in combination with the has_more flag for reliable pagination.
   */
  public ?string $nextPageToken;

  /**
   * @var ?int $pageSize How many voices to return at maximum. Can not exceed 100, defaults to 10. Page 0 may include more voices due to default voices being included.
   */
  public ?int $pageSize;

  /**
   * @var ?string $search Search term to filter voices by. Searches in name, description, labels, category.
   */
  public ?string $search;

  /**
   * @var ?string $sort Which field to sort by, one of 'created_at_unix' or 'name'. 'created_at_unix' may not be available for older voices.
   */
  public ?string $sort;

  /**
   * @var ?string $sortDirection Which direction to sort the voices in. 'asc' or 'desc'.
   */
  public ?string $sortDirection;

  /**
   * @var ?string $voiceType Type of the voice to filter by. One of 'personal', 'community', 'default', 'workspace', 'non-default', 'non-community', 'saved'. 'non-default' is equal to all but 'default'. 'non-community' is equal to 'personal' and 'workspace' combined (excludes library copies). 'saved' is equal to non-default, but includes default voices if they have been added to a collection.
   */
  public ?string $voiceType;

  /**
   * @var ?string $category Category of the voice to filter by. One of 'premade', 'cloned', 'generated', 'professional'
   */
  public ?string $category;

  /**
   * @var ?string $fineTuningState State of the voice's fine tuning to filter by. Applicable only to professional voices clones. One of 'draft', 'not_verified', 'not_started', 'queued', 'fine_tuning', 'fine_tuned', 'failed', 'delayed'
   */
  public ?string $fineTuningState;

  /**
   * @var ?string $collectionId Collection ID to filter voices by.
   */
  public ?string $collectionId;

  /**
   * @var ?string $gender Gender used for filtering, based on the voice's 'gender' label.
   */
  public ?string $gender;

  /**
   * @var ?string $age Age used for filtering, based on the voice's 'age' label.
   */
  public ?string $age;

  /**
   * @var ?array $language Languages used for filtering, based on the voice's 'language' label. Voices matching any of the given languages are returned.
   */
  public ?array $language;

  /**
   * @var ?string $accent Accent used for filtering, based on the voice's 'accent' label.
   */
  public ?string $accent;

  /**
   * @var ?array $useCases Use cases used for filtering, based on the voice's 'use_case' label. Voices matching any of the given use cases are returned.
   */
  public ?array $useCases;

  /**
   * @var ?int $minNoticePeriodDays Filter to voices whose sharing notice period is at least the given number of days.
   */
  public ?int $minNoticePeriodDays;

  /**
   * @var ?bool $includeCustomRates Whether to include voices that have a custom sharing rate. Defaults to including them.
   */
  public ?bool $includeCustomRates;

  /**
   * @var ?bool $includeLiveModerated Whether to include voices that have live moderation enabled. Defaults to including them.
   */
  public ?bool $includeLiveModerated;

  /**
   * @var ?bool $highQuality When true, only return studio-quality voices (those whose category is 'high_quality').
   */
  public ?bool $highQuality;

  /**
   * @var ?bool $includeTotalCount Whether to include the total count of voices found in the response. NOTE: The total_count value is a live snapshot and may change between requests as users create, modify, or delete voices. For pagination, rely on the has_more flag instead. Only enable this when you actually need the total count (e.g., for display purposes), as it incurs a performance cost.
   */
  public ?bool $includeTotalCount;

  /**
   * @var ?array $voiceIds Voice IDs to lookup by. Maximum 100 voice IDs.
   */
  public ?array $voiceIds;

  /**
   * @param array{
   *   nextPageToken?: ?string,
   *   pageSize?: ?int,
   *   search?: ?string,
   *   sort?: ?string,
   *   sortDirection?: ?string,
   *   voiceType?: ?string,
   *   category?: ?string,
   *   fineTuningState?: ?string,
   *   collectionId?: ?string,
   *   gender?: ?string,
   *   age?: ?string,
   *   language?: ?array,
   *   accent?: ?string,
   *   useCases?: ?array,
   *   minNoticePeriodDays?: ?int,
   *   includeCustomRates?: ?bool,
   *   includeLiveModerated?: ?bool,
   *   highQuality?: ?bool,
   *   includeTotalCount?: ?bool,
   *   voiceIds?: ?array,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->nextPageToken = $values['nextPageToken'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->search = $values['search'] ?? null;
    $this->sort = $values['sort'] ?? null;
    $this->sortDirection = $values['sortDirection'] ?? null;
    $this->voiceType = $values['voiceType'] ?? null;
    $this->category = $values['category'] ?? null;
    $this->fineTuningState = $values['fineTuningState'] ?? null;
    $this->collectionId = $values['collectionId'] ?? null;
    $this->gender = $values['gender'] ?? null;
    $this->age = $values['age'] ?? null;
    $this->language = $values['language'] ?? null;
    $this->accent = $values['accent'] ?? null;
    $this->useCases = $values['useCases'] ?? null;
    $this->minNoticePeriodDays = $values['minNoticePeriodDays'] ?? null;
    $this->includeCustomRates = $values['includeCustomRates'] ?? null;
    $this->includeLiveModerated = $values['includeLiveModerated'] ?? null;
    $this->highQuality = $values['highQuality'] ?? null;
    $this->includeTotalCount = $values['includeTotalCount'] ?? null;
    $this->voiceIds = $values['voiceIds'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'nextPageToken' => $data['next_page_token'] ?? null,
      'pageSize' => $data['page_size'] ?? null,
      'search' => $data['search'] ?? null,
      'sort' => $data['sort'] ?? null,
      'sortDirection' => $data['sort_direction'] ?? null,
      'voiceType' => $data['voice_type'] ?? null,
      'category' => $data['category'] ?? null,
      'fineTuningState' => $data['fine_tuning_state'] ?? null,
      'collectionId' => $data['collection_id'] ?? null,
      'gender' => $data['gender'] ?? null,
      'age' => $data['age'] ?? null,
      'language' => $data['language'] ?? null,
      'accent' => $data['accent'] ?? null,
      'useCases' => $data['use_cases'] ?? null,
      'minNoticePeriodDays' => $data['min_notice_period_days'] ?? null,
      'includeCustomRates' => $data['include_custom_rates'] ?? null,
      'includeLiveModerated' => $data['include_live_moderated'] ?? null,
      'highQuality' => $data['high_quality'] ?? null,
      'includeTotalCount' => $data['include_total_count'] ?? null,
      'voiceIds' => $data['voice_ids'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->nextPageToken !== null) {
      $result['next_page_token'] = $this->nextPageToken;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    if ($this->sort !== null) {
      $result['sort'] = $this->sort;
    }
    if ($this->sortDirection !== null) {
      $result['sort_direction'] = $this->sortDirection;
    }
    if ($this->voiceType !== null) {
      $result['voice_type'] = $this->voiceType;
    }
    if ($this->category !== null) {
      $result['category'] = $this->category;
    }
    if ($this->fineTuningState !== null) {
      $result['fine_tuning_state'] = $this->fineTuningState;
    }
    if ($this->collectionId !== null) {
      $result['collection_id'] = $this->collectionId;
    }
    if ($this->gender !== null) {
      $result['gender'] = $this->gender;
    }
    if ($this->age !== null) {
      $result['age'] = $this->age;
    }
    if ($this->language !== null) {
      $result['language'] = $this->language;
    }
    if ($this->accent !== null) {
      $result['accent'] = $this->accent;
    }
    if ($this->useCases !== null) {
      $result['use_cases'] = $this->useCases;
    }
    if ($this->minNoticePeriodDays !== null) {
      $result['min_notice_period_days'] = $this->minNoticePeriodDays;
    }
    if ($this->includeCustomRates !== null) {
      $result['include_custom_rates'] = $this->includeCustomRates;
    }
    if ($this->includeLiveModerated !== null) {
      $result['include_live_moderated'] = $this->includeLiveModerated;
    }
    if ($this->highQuality !== null) {
      $result['high_quality'] = $this->highQuality;
    }
    if ($this->includeTotalCount !== null) {
      $result['include_total_count'] = $this->includeTotalCount;
    }
    if ($this->voiceIds !== null) {
      $result['voice_ids'] = $this->voiceIds;
    }
    return $result;
  }
}
