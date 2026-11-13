<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The template a business-initiated conversation opened with, and how far it got.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WhatsAppOpeningMessage extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('template_name', required: true)]
  public string $templateName;

  #[JsonProperty('wamid')]
  public ?string $wamid;

  #[JsonProperty('sent_at_unix', required: true)]
  public int $sentAtUnix;

  #[JsonProperty('delivered_at_unix')]
  public ?int $deliveredAtUnix;

  #[JsonProperty('read_at_unix')]
  public ?int $readAtUnix;

  #[JsonProperty('replied_at_unix')]
  public ?int $repliedAtUnix;

  #[JsonProperty('failed_at_unix')]
  public ?int $failedAtUnix;

  #[JsonProperty('error_code')]
  public ?string $errorCode;

  #[JsonProperty('pricing_category')]
  public ?string $pricingCategory;

  #[JsonProperty('billable')]
  public ?bool $billable;

  /**
   * @param array{
   *   templateName: string,
   *   sentAtUnix: int,
   *   wamid?: ?string,
   *   deliveredAtUnix?: ?int,
   *   readAtUnix?: ?int,
   *   repliedAtUnix?: ?int,
   *   failedAtUnix?: ?int,
   *   errorCode?: ?string,
   *   pricingCategory?: ?string,
   *   billable?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->templateName = $values['templateName'];
    $this->wamid = $values['wamid'] ?? null;
    $this->sentAtUnix = $values['sentAtUnix'];
    $this->deliveredAtUnix = $values['deliveredAtUnix'] ?? null;
    $this->readAtUnix = $values['readAtUnix'] ?? null;
    $this->repliedAtUnix = $values['repliedAtUnix'] ?? null;
    $this->failedAtUnix = $values['failedAtUnix'] ?? null;
    $this->errorCode = $values['errorCode'] ?? null;
    $this->pricingCategory = $values['pricingCategory'] ?? null;
    $this->billable = $values['billable'] ?? null;

    $this->_dirtyFields = [
      'template_name' => true,
      'sent_at_unix' => true
    ];
    if (array_key_exists('wamid', $values)) {
      $this->_dirtyFields['wamid'] = true;
    }
    if (array_key_exists('deliveredAtUnix', $values)) {
      $this->_dirtyFields['delivered_at_unix'] = true;
    }
    if (array_key_exists('readAtUnix', $values)) {
      $this->_dirtyFields['read_at_unix'] = true;
    }
    if (array_key_exists('repliedAtUnix', $values)) {
      $this->_dirtyFields['replied_at_unix'] = true;
    }
    if (array_key_exists('failedAtUnix', $values)) {
      $this->_dirtyFields['failed_at_unix'] = true;
    }
    if (array_key_exists('errorCode', $values)) {
      $this->_dirtyFields['error_code'] = true;
    }
    if (array_key_exists('pricingCategory', $values)) {
      $this->_dirtyFields['pricing_category'] = true;
    }
    if (array_key_exists('billable', $values)) {
      $this->_dirtyFields['billable'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'template_name',
      'contents' => $this->templateName
    ];

    if ($this->wamid !== null) {
      $parts[] = [
        'name' => 'wamid',
        'contents' => $this->wamid
      ];
    }

    $parts[] = [
      'name' => 'sent_at_unix',
      'contents' => (string) $this->sentAtUnix
    ];

    if ($this->deliveredAtUnix !== null) {
      $parts[] = [
        'name' => 'delivered_at_unix',
        'contents' => (string) $this->deliveredAtUnix
      ];
    }

    if ($this->readAtUnix !== null) {
      $parts[] = [
        'name' => 'read_at_unix',
        'contents' => (string) $this->readAtUnix
      ];
    }

    if ($this->repliedAtUnix !== null) {
      $parts[] = [
        'name' => 'replied_at_unix',
        'contents' => (string) $this->repliedAtUnix
      ];
    }

    if ($this->failedAtUnix !== null) {
      $parts[] = [
        'name' => 'failed_at_unix',
        'contents' => (string) $this->failedAtUnix
      ];
    }

    if ($this->errorCode !== null) {
      $parts[] = [
        'name' => 'error_code',
        'contents' => $this->errorCode
      ];
    }

    if ($this->pricingCategory !== null) {
      $parts[] = [
        'name' => 'pricing_category',
        'contents' => $this->pricingCategory
      ];
    }

    if ($this->billable !== null) {
      $parts[] = [
        'name' => 'billable',
        'contents' => $this->billable ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
