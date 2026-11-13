<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\PhoneNumbers\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\PhoneNumberSortBy;
use ElevenLabs\Types\SortDirection;
use ElevenLabs\Types\TelephonyProvider;

class ListV2PhoneNumbersRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize Number of phone numbers per page
   */
  public ?int $pageSize;

  /**
   * @var ?string $search Filter by phone number ID, label, or phone number. A phone number ID must match exactly; label and phone number matching is a case-insensitive substring.
   */
  public ?string $search;

  /**
   * @var ?string $label Filter by label. Matching is a case-insensitive substring.
   */
  public ?string $label;

  /**
   * @var ?string $phoneNumber Filter by phone number
   */
  public ?string $phoneNumber;

  /**
   * @var ?value-of<TelephonyProvider> $provider Filter by telephony provider
   */
  public ?string $provider;

  /**
   * @var ?bool $supportsOutbound Filter by whether the phone number can place outbound calls
   */
  public ?bool $supportsOutbound;

  /**
   * @var ?string $agentId Filter by assigned agent ID
   */
  public ?string $agentId;

  /**
   * @var ?string $branchId Filter by assigned branch ID
   */
  public ?string $branchId;

  /**
   * @var ?value-of<PhoneNumberSortBy> $sortBy The field to sort the results by
   */
  public ?string $sortBy;

  /**
   * @var ?value-of<SortDirection> $sortDirection The direction to sort the results
   */
  public ?string $sortDirection;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   search?: ?string,
   *   label?: ?string,
   *   phoneNumber?: ?string,
   *   provider?: ?value-of<TelephonyProvider>,
   *   supportsOutbound?: ?bool,
   *   agentId?: ?string,
   *   branchId?: ?string,
   *   sortBy?: ?value-of<PhoneNumberSortBy>,
   *   sortDirection?: ?value-of<SortDirection>,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->search = $values['search'] ?? null;
    $this->label = $values['label'] ?? null;
    $this->phoneNumber = $values['phoneNumber'] ?? null;
    $this->provider = $values['provider'] ?? null;
    $this->supportsOutbound = $values['supportsOutbound'] ?? null;
    $this->agentId = $values['agentId'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->sortBy = $values['sortBy'] ?? null;
    $this->sortDirection = $values['sortDirection'] ?? null;
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
      'label' => $data['label'] ?? null,
      'phoneNumber' => $data['phone_number'] ?? null,
      'provider' => $data['provider'] ?? null,
      'supportsOutbound' => $data['supports_outbound'] ?? null,
      'agentId' => $data['agent_id'] ?? null,
      'branchId' => $data['branch_id'] ?? null,
      'sortBy' => $data['sort_by'] ?? null,
      'sortDirection' => $data['sort_direction'] ?? null,
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
    if ($this->label !== null) {
      $result['label'] = $this->label;
    }
    if ($this->phoneNumber !== null) {
      $result['phone_number'] = $this->phoneNumber;
    }
    if ($this->provider !== null) {
      $result['provider'] = $this->provider;
    }
    if ($this->supportsOutbound !== null) {
      $result['supports_outbound'] = $this->supportsOutbound;
    }
    if ($this->agentId !== null) {
      $result['agent_id'] = $this->agentId;
    }
    if ($this->branchId !== null) {
      $result['branch_id'] = $this->branchId;
    }
    if ($this->sortBy !== null) {
      $result['sort_by'] = $this->sortBy;
    }
    if ($this->sortDirection !== null) {
      $result['sort_direction'] = $this->sortDirection;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
