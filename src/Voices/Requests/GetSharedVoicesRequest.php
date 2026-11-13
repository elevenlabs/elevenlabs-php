<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Voices\Types\GetSharedVoicesRequestCategory;
use ElevenLabs\Voices\Types\GetSharedVoicesRequestSort;

class GetSharedVoicesRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize How many shared voices to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?value-of<GetSharedVoicesRequestCategory> $category Voice category used for filtering
   */
  public ?string $category;

  /**
   * @var ?string $gender Gender used for filtering
   */
  public ?string $gender;

  /**
   * @var ?string $age Age used for filtering
   */
  public ?string $age;

  /**
   * @var ?string $accent Accent used for filtering
   */
  public ?string $accent;

  /**
   * @var ?string $language Language used for filtering
   */
  public ?string $language;

  /**
   * @var ?string $locale Locale used for filtering
   */
  public ?string $locale;

  /**
   * @var ?string $search Search term used for filtering
   */
  public ?string $search;

  /**
   * @var ?array $useCases Use-case used for filtering
   */
  public ?array $useCases;

  /**
   * @var ?array $descriptives Search term used for filtering
   */
  public ?array $descriptives;

  /**
   * @var ?bool $featured Filter featured voices
   */
  public ?bool $featured;

  /**
   * @var ?int $minNoticePeriodDays Filter voices with a minimum notice period of the given number of days.
   */
  public ?int $minNoticePeriodDays;

  /**
   * @var ?bool $includeCustomRates Include/exclude voices with custom rates
   */
  public ?bool $includeCustomRates;

  /**
   * @var ?bool $includeLiveModerated Include/exclude voices that are live moderated
   */
  public ?bool $includeLiveModerated;

  /**
   * @var ?bool $readerAppEnabled Filter voices that are enabled for the reader app
   */
  public ?bool $readerAppEnabled;

  /**
   * @var ?string $ownerId Filter voices by public owner ID
   */
  public ?string $ownerId;

  /**
   * @var ?value-of<GetSharedVoicesRequestSort> $sort Sort criteria. Must be one of: created_date, usage_character_count_1y, trending, cloned_by_count.
   */
  public ?string $sort;

  /**
   * @var ?int $page
   */
  public ?int $page;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   category?: ?value-of<GetSharedVoicesRequestCategory>,
   *   gender?: ?string,
   *   age?: ?string,
   *   accent?: ?string,
   *   language?: ?string,
   *   locale?: ?string,
   *   search?: ?string,
   *   useCases?: ?array,
   *   descriptives?: ?array,
   *   featured?: ?bool,
   *   minNoticePeriodDays?: ?int,
   *   includeCustomRates?: ?bool,
   *   includeLiveModerated?: ?bool,
   *   readerAppEnabled?: ?bool,
   *   ownerId?: ?string,
   *   sort?: ?value-of<GetSharedVoicesRequestSort>,
   *   page?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->category = $values['category'] ?? null;
    $this->gender = $values['gender'] ?? null;
    $this->age = $values['age'] ?? null;
    $this->accent = $values['accent'] ?? null;
    $this->language = $values['language'] ?? null;
    $this->locale = $values['locale'] ?? null;
    $this->search = $values['search'] ?? null;
    $this->useCases = $values['useCases'] ?? null;
    $this->descriptives = $values['descriptives'] ?? null;
    $this->featured = $values['featured'] ?? null;
    $this->minNoticePeriodDays = $values['minNoticePeriodDays'] ?? null;
    $this->includeCustomRates = $values['includeCustomRates'] ?? null;
    $this->includeLiveModerated = $values['includeLiveModerated'] ?? null;
    $this->readerAppEnabled = $values['readerAppEnabled'] ?? null;
    $this->ownerId = $values['ownerId'] ?? null;
    $this->sort = $values['sort'] ?? null;
    $this->page = $values['page'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'pageSize' => $data['page_size'] ?? null,
      'category' => $data['category'] ?? null,
      'gender' => $data['gender'] ?? null,
      'age' => $data['age'] ?? null,
      'accent' => $data['accent'] ?? null,
      'language' => $data['language'] ?? null,
      'locale' => $data['locale'] ?? null,
      'search' => $data['search'] ?? null,
      'useCases' => $data['use_cases'] ?? null,
      'descriptives' => $data['descriptives'] ?? null,
      'featured' => $data['featured'] ?? null,
      'minNoticePeriodDays' => $data['min_notice_period_days'] ?? null,
      'includeCustomRates' => $data['include_custom_rates'] ?? null,
      'includeLiveModerated' => $data['include_live_moderated'] ?? null,
      'readerAppEnabled' => $data['reader_app_enabled'] ?? null,
      'ownerId' => $data['owner_id'] ?? null,
      'sort' => $data['sort'] ?? null,
      'page' => $data['page'] ?? null
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
    if ($this->category !== null) {
      $result['category'] = $this->category;
    }
    if ($this->gender !== null) {
      $result['gender'] = $this->gender;
    }
    if ($this->age !== null) {
      $result['age'] = $this->age;
    }
    if ($this->accent !== null) {
      $result['accent'] = $this->accent;
    }
    if ($this->language !== null) {
      $result['language'] = $this->language;
    }
    if ($this->locale !== null) {
      $result['locale'] = $this->locale;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    if ($this->useCases !== null) {
      $result['use_cases'] = $this->useCases;
    }
    if ($this->descriptives !== null) {
      $result['descriptives'] = $this->descriptives;
    }
    if ($this->featured !== null) {
      $result['featured'] = $this->featured;
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
    if ($this->readerAppEnabled !== null) {
      $result['reader_app_enabled'] = $this->readerAppEnabled;
    }
    if ($this->ownerId !== null) {
      $result['owner_id'] = $this->ownerId;
    }
    if ($this->sort !== null) {
      $result['sort'] = $this->sort;
    }
    if ($this->page !== null) {
      $result['page'] = $this->page;
    }
    return $result;
  }
}
