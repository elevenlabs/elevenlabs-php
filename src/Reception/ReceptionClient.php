<?php

declare(strict_types=1);

namespace ElevenLabs\Reception;

use ElevenLabs\Reception\Receptionists\ReceptionistsClient;
use ElevenLabs\Reception\Team\TeamClient;
use ElevenLabs\Reception\PhoneNumbers\PhoneNumbersClient;
use ElevenLabs\Reception\Assets\AssetsClient;
use ElevenLabs\Reception\Services\ServicesClient;
use ElevenLabs\Reception\Products\ProductsClient;
use ElevenLabs\Reception\Staff\StaffClient;
use ElevenLabs\Reception\Holidays\HolidaysClient;
use ElevenLabs\Reception\Locations\LocationsClient;
use ElevenLabs\Reception\BusinessProfile\BusinessProfileClient;
use ElevenLabs\Reception\KnowledgeSources\KnowledgeSourcesClient;
use ElevenLabs\Reception\Workspaces\WorkspacesClient;
use ElevenLabs\Reception\Subscriptions\SubscriptionsClient;
use ElevenLabs\Reception\Tiers\TiersClient;
use ElevenLabs\Reception\Billing\BillingClient;

/**
 * Groups the `reception` resources.
 *
 * It owns no endpoints of its own: every operation lives on one of the clients below, so this class
 * exists only so they are reached as `$client->reception->{child}`.
 */
class ReceptionClient
{
  public ReceptionistsClient $receptionists;
  public TeamClient $team;
  public PhoneNumbersClient $phoneNumbers;
  public AssetsClient $assets;
  public ServicesClient $services;
  public ProductsClient $products;
  public StaffClient $staff;
  public HolidaysClient $holidays;
  public LocationsClient $locations;
  public BusinessProfileClient $businessProfile;
  public KnowledgeSourcesClient $knowledgeSources;
  public WorkspacesClient $workspaces;
  public SubscriptionsClient $subscriptions;
  public TiersClient $tiers;
  public BillingClient $billing;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    $this->receptionists = new ReceptionistsClient($client, $options);
    $this->team = new TeamClient($client, $options);
    $this->phoneNumbers = new PhoneNumbersClient($client, $options);
    $this->assets = new AssetsClient($client, $options);
    $this->services = new ServicesClient($client, $options);
    $this->products = new ProductsClient($client, $options);
    $this->staff = new StaffClient($client, $options);
    $this->holidays = new HolidaysClient($client, $options);
    $this->locations = new LocationsClient($client, $options);
    $this->businessProfile = new BusinessProfileClient($client, $options);
    $this->knowledgeSources = new KnowledgeSourcesClient($client, $options);
    $this->workspaces = new WorkspacesClient($client, $options);
    $this->subscriptions = new SubscriptionsClient($client, $options);
    $this->tiers = new TiersClient($client, $options);
    $this->billing = new BillingClient($client, $options);
  }
}
