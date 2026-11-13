<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Discriminated union type (oneOf) representing exactly one of multiple possible types.
 *
 * This class implements a type-safe union where the value can be exactly one of the
 * defined variant types. It provides factory methods for construction, type-checking
 * methods, safe and throwing getters, and pattern matching for exhaustive handling.
 *
 * The oneOf pattern enforces that only one type can be present at a time, unlike anyOf
 * which allows multiple types simultaneously.
 */
class SmbToolConfigParams extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $smbToolType;

  /**
   * @var \ElevenLabs\Types\SearchClientsParams|\ElevenLabs\Types\SendCustomEmailParams|\ElevenLabs\Types\ListClientsParams|\ElevenLabs\Types\GetClientByPhoneParams|\ElevenLabs\Types\CreateClientParams|\ElevenLabs\Types\UpdateClientParams|\ElevenLabs\Types\DeleteClientParams|\ElevenLabs\Types\ListStaffParams|\ElevenLabs\Types\CreateStaffParams|\ElevenLabs\Types\UpdateStaffParams|\ElevenLabs\Types\DeleteStaffParams|\ElevenLabs\Types\ListAssetsParams|\ElevenLabs\Types\CreateAssetParams|\ElevenLabs\Types\UpdateAssetParams|\ElevenLabs\Types\DeleteAssetParams|\ElevenLabs\Types\ListServicesParams|\ElevenLabs\Types\CreateServiceParams|\ElevenLabs\Types\UpdateServiceParams|\ElevenLabs\Types\DeleteServiceParams|\ElevenLabs\Types\ListProductsParams|\ElevenLabs\Types\CreateProductParams|\ElevenLabs\Types\UpdateProductParams|\ElevenLabs\Types\DeleteProductParams|\ElevenLabs\Types\CheckServiceAvailabilityParams|\ElevenLabs\Types\CreateClientAppointmentParams|\ElevenLabs\Types\GetClientAppointmentsParams|\ElevenLabs\Types\GetAppointmentByConfirmationNumberParams|\ElevenLabs\Types\CreateOrderParams|\ElevenLabs\Types\GetOrderByConfirmationNumberParams|\ElevenLabs\Types\GetClientOrdersParams|\ElevenLabs\Types\UpdateOrderParams|\ElevenLabs\Types\CancelOrderParams|\ElevenLabs\Types\ListGroupSessionsParams|\ElevenLabs\Types\ScheduleGroupSessionParams|\ElevenLabs\Types\RegisterForGroupSessionParams|\ElevenLabs\Types\CancelGroupSessionRegistrationParams|\ElevenLabs\Types\UpdateGroupSessionSeatsParams|\ElevenLabs\Types\CancelGroupSessionForAllParams|\ElevenLabs\Types\DeleteGroupSessionParams|\ElevenLabs\Types\ListCalendarEventsParams|\ElevenLabs\Types\UpdateCalendarEventParams|\ElevenLabs\Types\CancelCalendarEventParams|\ElevenLabs\Types\RestoreCalendarEventParams|\ElevenLabs\Types\DeleteCalendarEventParams|\ElevenLabs\Types\ListCustomerFacingAgentsParams|\ElevenLabs\Types\GetAgentConfigParams|\ElevenLabs\Types\ListAgentRulesParams|\ElevenLabs\Types\CreateAgentRuleParams|\ElevenLabs\Types\UpdateAgentRuleParams|\ElevenLabs\Types\DeleteAgentRuleParams|\ElevenLabs\Types\ListTransferRulesParams|\ElevenLabs\Types\CreateTransferRuleParams|\ElevenLabs\Types\UpdateTransferRuleParams|\ElevenLabs\Types\DeleteTransferRuleParams|\ElevenLabs\Types\ListAgentProceduresParams|\ElevenLabs\Types\ListAgentReferencesParams|\ElevenLabs\Types\CreateAgentProcedureParams|\ElevenLabs\Types\UpdateAgentProcedureParams|\ElevenLabs\Types\DeleteAgentProcedureParams|\ElevenLabs\Types\ListHolidaysParams|\ElevenLabs\Types\CreateHolidayParams|\ElevenLabs\Types\UpdateHolidayParams|\ElevenLabs\Types\DeleteHolidayParams|\ElevenLabs\Types\GetScheduleParams|\ElevenLabs\Types\SubmitBusinessInfoParams|\ElevenLabs\Types\UpdateBusinessInfoParams|\ElevenLabs\Types\UpdateAgentConfigParams|\ElevenLabs\Types\GetAnalyticsSummaryParams|\ElevenLabs\Types\GetWorkspacePlanParams|\ElevenLabs\Types\GetBookingPageSettingsParams|\ElevenLabs\Types\UpdateBookingPageSettingsParams|\ElevenLabs\Types\UpdateBookingPageAppearanceParams|\ElevenLabs\Types\GetBookingSlugStatusParams|\ElevenLabs\Types\SetBookingSlugParams|\ElevenLabs\Types\ListClientInteractionsParams|\ElevenLabs\Types\CreateClientInteractionParams|\ElevenLabs\Types\DeleteClientInteractionParams|\ElevenLabs\Types\ListLocationsParams|\ElevenLabs\Types\CreateLocationParams|\ElevenLabs\Types\UpdateLocationParams|\ElevenLabs\Types\DeleteLocationParams|\ElevenLabs\Types\LeaveMessageParams|\ElevenLabs\Types\CreateServiceQuoteRequestParams|\ElevenLabs\Types\CreateProductQuoteRequestParams|\ElevenLabs\Types\ReportKnowledgeGapParams|\ElevenLabs\Types\OptInSmsReminderParams|\ElevenLabs\Types\OptOutSmsReminderParams|\ElevenLabs\Types\TriggerUserVerificationParams|\ElevenLabs\Types\ValidateUserVerificationCodeParams|\ElevenLabs\Types\OwnerListStaffParams|\ElevenLabs\Types\OwnerListAssetsParams|\ElevenLabs\Types\OwnerListLocationsParams|\ElevenLabs\Types\OwnerListServicesParams|\ElevenLabs\Types\OwnerListProductsParams|\ElevenLabs\Types\OwnerGetClientAppointmentsParams|array<string, mixed> The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /** The type index of a payload whose discriminator names no variant this SDK knows. */
  private const UNKNOWN = -1;

  /**
   * Whether the payload's discriminator named a variant this SDK does not know (a variant added to
   * the API after this SDK was generated). Its raw payload is kept, as Fern's `_unknown` variant does.
   *
   * Underscore-prefixed because a union may legitimately have a variant NAMED `unknown`, whose own
   * accessors are `isUnknown()`/`asUnknown()`. Declaring both is a fatal `Cannot redeclare` and the
   * class cannot load at all. The prefix matches Fern's `_unknown` sentinel and Java's
   * `_isUnknown()`/`_getUnknown()`, and a variant accessor is always `isX`/`asX`, never `_isX` --
   * so the two can never collide whatever a spec calls its variants.
   */
  public function _isUnknown(): bool
  {
    return $this->typeIndex === self::UNKNOWN;
  }

  /**
   * @return array<string, mixed> The raw payload of an unknown variant
   * @throws \RuntimeException if this SmbToolConfigParams holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('SmbToolConfigParams does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\SearchClientsParams|\ElevenLabs\Types\SendCustomEmailParams|\ElevenLabs\Types\ListClientsParams|\ElevenLabs\Types\GetClientByPhoneParams|\ElevenLabs\Types\CreateClientParams|\ElevenLabs\Types\UpdateClientParams|\ElevenLabs\Types\DeleteClientParams|\ElevenLabs\Types\ListStaffParams|\ElevenLabs\Types\CreateStaffParams|\ElevenLabs\Types\UpdateStaffParams|\ElevenLabs\Types\DeleteStaffParams|\ElevenLabs\Types\ListAssetsParams|\ElevenLabs\Types\CreateAssetParams|\ElevenLabs\Types\UpdateAssetParams|\ElevenLabs\Types\DeleteAssetParams|\ElevenLabs\Types\ListServicesParams|\ElevenLabs\Types\CreateServiceParams|\ElevenLabs\Types\UpdateServiceParams|\ElevenLabs\Types\DeleteServiceParams|\ElevenLabs\Types\ListProductsParams|\ElevenLabs\Types\CreateProductParams|\ElevenLabs\Types\UpdateProductParams|\ElevenLabs\Types\DeleteProductParams|\ElevenLabs\Types\CheckServiceAvailabilityParams|\ElevenLabs\Types\CreateClientAppointmentParams|\ElevenLabs\Types\GetClientAppointmentsParams|\ElevenLabs\Types\GetAppointmentByConfirmationNumberParams|\ElevenLabs\Types\CreateOrderParams|\ElevenLabs\Types\GetOrderByConfirmationNumberParams|\ElevenLabs\Types\GetClientOrdersParams|\ElevenLabs\Types\UpdateOrderParams|\ElevenLabs\Types\CancelOrderParams|\ElevenLabs\Types\ListGroupSessionsParams|\ElevenLabs\Types\ScheduleGroupSessionParams|\ElevenLabs\Types\RegisterForGroupSessionParams|\ElevenLabs\Types\CancelGroupSessionRegistrationParams|\ElevenLabs\Types\UpdateGroupSessionSeatsParams|\ElevenLabs\Types\CancelGroupSessionForAllParams|\ElevenLabs\Types\DeleteGroupSessionParams|\ElevenLabs\Types\ListCalendarEventsParams|\ElevenLabs\Types\UpdateCalendarEventParams|\ElevenLabs\Types\CancelCalendarEventParams|\ElevenLabs\Types\RestoreCalendarEventParams|\ElevenLabs\Types\DeleteCalendarEventParams|\ElevenLabs\Types\ListCustomerFacingAgentsParams|\ElevenLabs\Types\GetAgentConfigParams|\ElevenLabs\Types\ListAgentRulesParams|\ElevenLabs\Types\CreateAgentRuleParams|\ElevenLabs\Types\UpdateAgentRuleParams|\ElevenLabs\Types\DeleteAgentRuleParams|\ElevenLabs\Types\ListTransferRulesParams|\ElevenLabs\Types\CreateTransferRuleParams|\ElevenLabs\Types\UpdateTransferRuleParams|\ElevenLabs\Types\DeleteTransferRuleParams|\ElevenLabs\Types\ListAgentProceduresParams|\ElevenLabs\Types\ListAgentReferencesParams|\ElevenLabs\Types\CreateAgentProcedureParams|\ElevenLabs\Types\UpdateAgentProcedureParams|\ElevenLabs\Types\DeleteAgentProcedureParams|\ElevenLabs\Types\ListHolidaysParams|\ElevenLabs\Types\CreateHolidayParams|\ElevenLabs\Types\UpdateHolidayParams|\ElevenLabs\Types\DeleteHolidayParams|\ElevenLabs\Types\GetScheduleParams|\ElevenLabs\Types\SubmitBusinessInfoParams|\ElevenLabs\Types\UpdateBusinessInfoParams|\ElevenLabs\Types\UpdateAgentConfigParams|\ElevenLabs\Types\GetAnalyticsSummaryParams|\ElevenLabs\Types\GetWorkspacePlanParams|\ElevenLabs\Types\GetBookingPageSettingsParams|\ElevenLabs\Types\UpdateBookingPageSettingsParams|\ElevenLabs\Types\UpdateBookingPageAppearanceParams|\ElevenLabs\Types\GetBookingSlugStatusParams|\ElevenLabs\Types\SetBookingSlugParams|\ElevenLabs\Types\ListClientInteractionsParams|\ElevenLabs\Types\CreateClientInteractionParams|\ElevenLabs\Types\DeleteClientInteractionParams|\ElevenLabs\Types\ListLocationsParams|\ElevenLabs\Types\CreateLocationParams|\ElevenLabs\Types\UpdateLocationParams|\ElevenLabs\Types\DeleteLocationParams|\ElevenLabs\Types\LeaveMessageParams|\ElevenLabs\Types\CreateServiceQuoteRequestParams|\ElevenLabs\Types\CreateProductQuoteRequestParams|\ElevenLabs\Types\ReportKnowledgeGapParams|\ElevenLabs\Types\OptInSmsReminderParams|\ElevenLabs\Types\OptOutSmsReminderParams|\ElevenLabs\Types\TriggerUserVerificationParams|\ElevenLabs\Types\ValidateUserVerificationCodeParams|\ElevenLabs\Types\OwnerListStaffParams|\ElevenLabs\Types\OwnerListAssetsParams|\ElevenLabs\Types\OwnerListLocationsParams|\ElevenLabs\Types\OwnerListServicesParams|\ElevenLabs\Types\OwnerListProductsParams|\ElevenLabs\Types\OwnerGetClientAppointmentsParams|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->smbToolType = match ($typeIndex) {
      0 => 'search_clients',
      1 => 'send_custom_email',
      2 => 'list_clients',
      3 => 'get_client_by_phone',
      4 => 'create_client',
      5 => 'update_client',
      6 => 'delete_client',
      7 => 'list_staff',
      8 => 'create_staff',
      9 => 'update_staff',
      10 => 'delete_staff',
      11 => 'list_assets',
      12 => 'create_asset',
      13 => 'update_asset',
      14 => 'delete_asset',
      15 => 'list_services',
      16 => 'create_service',
      17 => 'update_service',
      18 => 'delete_service',
      19 => 'list_products',
      20 => 'create_product',
      21 => 'update_product',
      22 => 'delete_product',
      23 => 'check_service_availability',
      24 => 'create_client_appointment',
      25 => 'get_client_appointments',
      26 => 'get_appointment_by_confirmation_number',
      27 => 'create_order',
      28 => 'get_order_by_confirmation_number',
      29 => 'get_client_orders',
      30 => 'update_order',
      31 => 'cancel_order',
      32 => 'list_group_sessions',
      33 => 'schedule_group_session',
      34 => 'register_for_group_session',
      35 => 'cancel_group_session_registration',
      36 => 'update_group_session_seats',
      37 => 'cancel_group_session_for_all',
      38 => 'delete_group_session',
      39 => 'list_calendar_events',
      40 => 'update_calendar_event',
      41 => 'cancel_calendar_event',
      42 => 'restore_calendar_event',
      43 => 'delete_calendar_event',
      44 => 'list_customer_facing_agents',
      45 => 'get_agent_config',
      46 => 'list_agent_rules',
      47 => 'create_agent_rule',
      48 => 'update_agent_rule',
      49 => 'delete_agent_rule',
      50 => 'list_transfer_rules',
      51 => 'create_transfer_rule',
      52 => 'update_transfer_rule',
      53 => 'delete_transfer_rule',
      54 => 'list_agent_procedures',
      55 => 'list_agent_references',
      56 => 'create_agent_procedure',
      57 => 'update_agent_procedure',
      58 => 'delete_agent_procedure',
      59 => 'list_holidays',
      60 => 'create_holiday',
      61 => 'update_holiday',
      62 => 'delete_holiday',
      63 => 'get_schedule',
      64 => 'submit_business_info',
      65 => 'update_business_info',
      66 => 'update_agent_config',
      67 => 'get_analytics_summary',
      68 => 'get_workspace_plan',
      69 => 'get_booking_page_settings',
      70 => 'update_booking_page_settings',
      71 => 'update_booking_page_appearance',
      72 => 'get_booking_slug_status',
      73 => 'set_booking_slug',
      74 => 'list_client_interactions',
      75 => 'create_client_interaction',
      76 => 'delete_client_interaction',
      77 => 'list_locations',
      78 => 'create_location',
      79 => 'update_location',
      80 => 'delete_location',
      81 => 'leave_message',
      82 => 'create_service_quote_request',
      83 => 'create_product_quote_request',
      84 => 'report_knowledge_gap',
      85 => 'opt_in_sms_reminder',
      86 => 'opt_out_sms_reminder',
      87 => 'trigger_user_verification',
      88 => 'validate_user_verification_code',
      89 => 'owner_list_staff',
      90 => 'owner_list_assets',
      91 => 'owner_list_locations',
      92 => 'owner_list_services',
      93 => 'owner_list_products',
      94 => 'owner_get_client_appointments',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\SearchClientsParams
   */
  public static function searchClients(\ElevenLabs\Types\SearchClientsParams $searchClients): self
  {
    return new self($searchClients, 0);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\SendCustomEmailParams
   */
  public static function sendCustomEmail(
    \ElevenLabs\Types\SendCustomEmailParams $sendCustomEmail
  ): self {
    return new self($sendCustomEmail, 1);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListClientsParams
   */
  public static function listClients(\ElevenLabs\Types\ListClientsParams $listClients): self
  {
    return new self($listClients, 2);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\GetClientByPhoneParams
   */
  public static function getClientByPhone(
    \ElevenLabs\Types\GetClientByPhoneParams $getClientByPhone
  ): self {
    return new self($getClientByPhone, 3);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateClientParams
   */
  public static function createClient(\ElevenLabs\Types\CreateClientParams $createClient): self
  {
    return new self($createClient, 4);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateClientParams
   */
  public static function updateClient(\ElevenLabs\Types\UpdateClientParams $updateClient): self
  {
    return new self($updateClient, 5);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\DeleteClientParams
   */
  public static function deleteClient(\ElevenLabs\Types\DeleteClientParams $deleteClient): self
  {
    return new self($deleteClient, 6);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListStaffParams
   */
  public static function listStaff(\ElevenLabs\Types\ListStaffParams $listStaff): self
  {
    return new self($listStaff, 7);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateStaffParams
   */
  public static function createStaff(\ElevenLabs\Types\CreateStaffParams $createStaff): self
  {
    return new self($createStaff, 8);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateStaffParams
   */
  public static function updateStaff(\ElevenLabs\Types\UpdateStaffParams $updateStaff): self
  {
    return new self($updateStaff, 9);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\DeleteStaffParams
   */
  public static function deleteStaff(\ElevenLabs\Types\DeleteStaffParams $deleteStaff): self
  {
    return new self($deleteStaff, 10);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListAssetsParams
   */
  public static function listAssets(\ElevenLabs\Types\ListAssetsParams $listAssets): self
  {
    return new self($listAssets, 11);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateAssetParams
   */
  public static function createAsset(\ElevenLabs\Types\CreateAssetParams $createAsset): self
  {
    return new self($createAsset, 12);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateAssetParams
   */
  public static function updateAsset(\ElevenLabs\Types\UpdateAssetParams $updateAsset): self
  {
    return new self($updateAsset, 13);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\DeleteAssetParams
   */
  public static function deleteAsset(\ElevenLabs\Types\DeleteAssetParams $deleteAsset): self
  {
    return new self($deleteAsset, 14);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListServicesParams
   */
  public static function listServices(\ElevenLabs\Types\ListServicesParams $listServices): self
  {
    return new self($listServices, 15);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateServiceParams
   */
  public static function createService(\ElevenLabs\Types\CreateServiceParams $createService): self
  {
    return new self($createService, 16);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateServiceParams
   */
  public static function updateService(\ElevenLabs\Types\UpdateServiceParams $updateService): self
  {
    return new self($updateService, 17);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\DeleteServiceParams
   */
  public static function deleteService(\ElevenLabs\Types\DeleteServiceParams $deleteService): self
  {
    return new self($deleteService, 18);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListProductsParams
   */
  public static function listProducts(\ElevenLabs\Types\ListProductsParams $listProducts): self
  {
    return new self($listProducts, 19);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateProductParams
   */
  public static function createProduct(\ElevenLabs\Types\CreateProductParams $createProduct): self
  {
    return new self($createProduct, 20);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateProductParams
   */
  public static function updateProduct(\ElevenLabs\Types\UpdateProductParams $updateProduct): self
  {
    return new self($updateProduct, 21);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\DeleteProductParams
   */
  public static function deleteProduct(\ElevenLabs\Types\DeleteProductParams $deleteProduct): self
  {
    return new self($deleteProduct, 22);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CheckServiceAvailabilityParams
   */
  public static function checkServiceAvailability(
    \ElevenLabs\Types\CheckServiceAvailabilityParams $checkServiceAvailability
  ): self {
    return new self($checkServiceAvailability, 23);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateClientAppointmentParams
   */
  public static function createClientAppointment(
    \ElevenLabs\Types\CreateClientAppointmentParams $createClientAppointment
  ): self {
    return new self($createClientAppointment, 24);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\GetClientAppointmentsParams
   */
  public static function getClientAppointments(
    \ElevenLabs\Types\GetClientAppointmentsParams $getClientAppointments
  ): self {
    return new self($getClientAppointments, 25);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\GetAppointmentByConfirmationNumberParams
   */
  public static function getAppointmentByConfirmationNumber(
    \ElevenLabs\Types\GetAppointmentByConfirmationNumberParams $getAppointmentByConfirmationNumber
  ): self {
    return new self($getAppointmentByConfirmationNumber, 26);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateOrderParams
   */
  public static function createOrder(\ElevenLabs\Types\CreateOrderParams $createOrder): self
  {
    return new self($createOrder, 27);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\GetOrderByConfirmationNumberParams
   */
  public static function getOrderByConfirmationNumber(
    \ElevenLabs\Types\GetOrderByConfirmationNumberParams $getOrderByConfirmationNumber
  ): self {
    return new self($getOrderByConfirmationNumber, 28);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\GetClientOrdersParams
   */
  public static function getClientOrders(
    \ElevenLabs\Types\GetClientOrdersParams $getClientOrders
  ): self {
    return new self($getClientOrders, 29);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateOrderParams
   */
  public static function updateOrder(\ElevenLabs\Types\UpdateOrderParams $updateOrder): self
  {
    return new self($updateOrder, 30);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CancelOrderParams
   */
  public static function cancelOrder(\ElevenLabs\Types\CancelOrderParams $cancelOrder): self
  {
    return new self($cancelOrder, 31);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListGroupSessionsParams
   */
  public static function listGroupSessions(
    \ElevenLabs\Types\ListGroupSessionsParams $listGroupSessions
  ): self {
    return new self($listGroupSessions, 32);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ScheduleGroupSessionParams
   */
  public static function scheduleGroupSession(
    \ElevenLabs\Types\ScheduleGroupSessionParams $scheduleGroupSession
  ): self {
    return new self($scheduleGroupSession, 33);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\RegisterForGroupSessionParams
   */
  public static function registerForGroupSession(
    \ElevenLabs\Types\RegisterForGroupSessionParams $registerForGroupSession
  ): self {
    return new self($registerForGroupSession, 34);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CancelGroupSessionRegistrationParams
   */
  public static function cancelGroupSessionRegistration(
    \ElevenLabs\Types\CancelGroupSessionRegistrationParams $cancelGroupSessionRegistration
  ): self {
    return new self($cancelGroupSessionRegistration, 35);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateGroupSessionSeatsParams
   */
  public static function updateGroupSessionSeats(
    \ElevenLabs\Types\UpdateGroupSessionSeatsParams $updateGroupSessionSeats
  ): self {
    return new self($updateGroupSessionSeats, 36);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CancelGroupSessionForAllParams
   */
  public static function cancelGroupSessionForAll(
    \ElevenLabs\Types\CancelGroupSessionForAllParams $cancelGroupSessionForAll
  ): self {
    return new self($cancelGroupSessionForAll, 37);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\DeleteGroupSessionParams
   */
  public static function deleteGroupSession(
    \ElevenLabs\Types\DeleteGroupSessionParams $deleteGroupSession
  ): self {
    return new self($deleteGroupSession, 38);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListCalendarEventsParams
   */
  public static function listCalendarEvents(
    \ElevenLabs\Types\ListCalendarEventsParams $listCalendarEvents
  ): self {
    return new self($listCalendarEvents, 39);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateCalendarEventParams
   */
  public static function updateCalendarEvent(
    \ElevenLabs\Types\UpdateCalendarEventParams $updateCalendarEvent
  ): self {
    return new self($updateCalendarEvent, 40);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CancelCalendarEventParams
   */
  public static function cancelCalendarEvent(
    \ElevenLabs\Types\CancelCalendarEventParams $cancelCalendarEvent
  ): self {
    return new self($cancelCalendarEvent, 41);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\RestoreCalendarEventParams
   */
  public static function restoreCalendarEvent(
    \ElevenLabs\Types\RestoreCalendarEventParams $restoreCalendarEvent
  ): self {
    return new self($restoreCalendarEvent, 42);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\DeleteCalendarEventParams
   */
  public static function deleteCalendarEvent(
    \ElevenLabs\Types\DeleteCalendarEventParams $deleteCalendarEvent
  ): self {
    return new self($deleteCalendarEvent, 43);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListCustomerFacingAgentsParams
   */
  public static function listCustomerFacingAgents(
    \ElevenLabs\Types\ListCustomerFacingAgentsParams $listCustomerFacingAgents
  ): self {
    return new self($listCustomerFacingAgents, 44);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\GetAgentConfigParams
   */
  public static function getAgentConfig(
    \ElevenLabs\Types\GetAgentConfigParams $getAgentConfig
  ): self {
    return new self($getAgentConfig, 45);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListAgentRulesParams
   */
  public static function listAgentRules(
    \ElevenLabs\Types\ListAgentRulesParams $listAgentRules
  ): self {
    return new self($listAgentRules, 46);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateAgentRuleParams
   */
  public static function createAgentRule(
    \ElevenLabs\Types\CreateAgentRuleParams $createAgentRule
  ): self {
    return new self($createAgentRule, 47);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateAgentRuleParams
   */
  public static function updateAgentRule(
    \ElevenLabs\Types\UpdateAgentRuleParams $updateAgentRule
  ): self {
    return new self($updateAgentRule, 48);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\DeleteAgentRuleParams
   */
  public static function deleteAgentRule(
    \ElevenLabs\Types\DeleteAgentRuleParams $deleteAgentRule
  ): self {
    return new self($deleteAgentRule, 49);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListTransferRulesParams
   */
  public static function listTransferRules(
    \ElevenLabs\Types\ListTransferRulesParams $listTransferRules
  ): self {
    return new self($listTransferRules, 50);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateTransferRuleParams
   */
  public static function createTransferRule(
    \ElevenLabs\Types\CreateTransferRuleParams $createTransferRule
  ): self {
    return new self($createTransferRule, 51);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateTransferRuleParams
   */
  public static function updateTransferRule(
    \ElevenLabs\Types\UpdateTransferRuleParams $updateTransferRule
  ): self {
    return new self($updateTransferRule, 52);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\DeleteTransferRuleParams
   */
  public static function deleteTransferRule(
    \ElevenLabs\Types\DeleteTransferRuleParams $deleteTransferRule
  ): self {
    return new self($deleteTransferRule, 53);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListAgentProceduresParams
   */
  public static function listAgentProcedures(
    \ElevenLabs\Types\ListAgentProceduresParams $listAgentProcedures
  ): self {
    return new self($listAgentProcedures, 54);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListAgentReferencesParams
   */
  public static function listAgentReferences(
    \ElevenLabs\Types\ListAgentReferencesParams $listAgentReferences
  ): self {
    return new self($listAgentReferences, 55);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateAgentProcedureParams
   */
  public static function createAgentProcedure(
    \ElevenLabs\Types\CreateAgentProcedureParams $createAgentProcedure
  ): self {
    return new self($createAgentProcedure, 56);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateAgentProcedureParams
   */
  public static function updateAgentProcedure(
    \ElevenLabs\Types\UpdateAgentProcedureParams $updateAgentProcedure
  ): self {
    return new self($updateAgentProcedure, 57);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\DeleteAgentProcedureParams
   */
  public static function deleteAgentProcedure(
    \ElevenLabs\Types\DeleteAgentProcedureParams $deleteAgentProcedure
  ): self {
    return new self($deleteAgentProcedure, 58);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListHolidaysParams
   */
  public static function listHolidays(\ElevenLabs\Types\ListHolidaysParams $listHolidays): self
  {
    return new self($listHolidays, 59);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateHolidayParams
   */
  public static function createHoliday(\ElevenLabs\Types\CreateHolidayParams $createHoliday): self
  {
    return new self($createHoliday, 60);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateHolidayParams
   */
  public static function updateHoliday(\ElevenLabs\Types\UpdateHolidayParams $updateHoliday): self
  {
    return new self($updateHoliday, 61);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\DeleteHolidayParams
   */
  public static function deleteHoliday(\ElevenLabs\Types\DeleteHolidayParams $deleteHoliday): self
  {
    return new self($deleteHoliday, 62);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\GetScheduleParams
   */
  public static function getSchedule(\ElevenLabs\Types\GetScheduleParams $getSchedule): self
  {
    return new self($getSchedule, 63);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\SubmitBusinessInfoParams
   */
  public static function submitBusinessInfo(
    \ElevenLabs\Types\SubmitBusinessInfoParams $submitBusinessInfo
  ): self {
    return new self($submitBusinessInfo, 64);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateBusinessInfoParams
   */
  public static function updateBusinessInfo(
    \ElevenLabs\Types\UpdateBusinessInfoParams $updateBusinessInfo
  ): self {
    return new self($updateBusinessInfo, 65);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateAgentConfigParams
   */
  public static function updateAgentConfig(
    \ElevenLabs\Types\UpdateAgentConfigParams $updateAgentConfig
  ): self {
    return new self($updateAgentConfig, 66);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\GetAnalyticsSummaryParams
   */
  public static function getAnalyticsSummary(
    \ElevenLabs\Types\GetAnalyticsSummaryParams $getAnalyticsSummary
  ): self {
    return new self($getAnalyticsSummary, 67);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\GetWorkspacePlanParams
   */
  public static function getWorkspacePlan(
    \ElevenLabs\Types\GetWorkspacePlanParams $getWorkspacePlan
  ): self {
    return new self($getWorkspacePlan, 68);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\GetBookingPageSettingsParams
   */
  public static function getBookingPageSettings(
    \ElevenLabs\Types\GetBookingPageSettingsParams $getBookingPageSettings
  ): self {
    return new self($getBookingPageSettings, 69);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateBookingPageSettingsParams
   */
  public static function updateBookingPageSettings(
    \ElevenLabs\Types\UpdateBookingPageSettingsParams $updateBookingPageSettings
  ): self {
    return new self($updateBookingPageSettings, 70);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateBookingPageAppearanceParams
   */
  public static function updateBookingPageAppearance(
    \ElevenLabs\Types\UpdateBookingPageAppearanceParams $updateBookingPageAppearance
  ): self {
    return new self($updateBookingPageAppearance, 71);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\GetBookingSlugStatusParams
   */
  public static function getBookingSlugStatus(
    \ElevenLabs\Types\GetBookingSlugStatusParams $getBookingSlugStatus
  ): self {
    return new self($getBookingSlugStatus, 72);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\SetBookingSlugParams
   */
  public static function setBookingSlug(
    \ElevenLabs\Types\SetBookingSlugParams $setBookingSlug
  ): self {
    return new self($setBookingSlug, 73);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListClientInteractionsParams
   */
  public static function listClientInteractions(
    \ElevenLabs\Types\ListClientInteractionsParams $listClientInteractions
  ): self {
    return new self($listClientInteractions, 74);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateClientInteractionParams
   */
  public static function createClientInteraction(
    \ElevenLabs\Types\CreateClientInteractionParams $createClientInteraction
  ): self {
    return new self($createClientInteraction, 75);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\DeleteClientInteractionParams
   */
  public static function deleteClientInteraction(
    \ElevenLabs\Types\DeleteClientInteractionParams $deleteClientInteraction
  ): self {
    return new self($deleteClientInteraction, 76);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ListLocationsParams
   */
  public static function listLocations(\ElevenLabs\Types\ListLocationsParams $listLocations): self
  {
    return new self($listLocations, 77);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateLocationParams
   */
  public static function createLocation(
    \ElevenLabs\Types\CreateLocationParams $createLocation
  ): self {
    return new self($createLocation, 78);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\UpdateLocationParams
   */
  public static function updateLocation(
    \ElevenLabs\Types\UpdateLocationParams $updateLocation
  ): self {
    return new self($updateLocation, 79);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\DeleteLocationParams
   */
  public static function deleteLocation(
    \ElevenLabs\Types\DeleteLocationParams $deleteLocation
  ): self {
    return new self($deleteLocation, 80);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\LeaveMessageParams
   */
  public static function leaveMessage(\ElevenLabs\Types\LeaveMessageParams $leaveMessage): self
  {
    return new self($leaveMessage, 81);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateServiceQuoteRequestParams
   */
  public static function createServiceQuoteRequest(
    \ElevenLabs\Types\CreateServiceQuoteRequestParams $createServiceQuoteRequest
  ): self {
    return new self($createServiceQuoteRequest, 82);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\CreateProductQuoteRequestParams
   */
  public static function createProductQuoteRequest(
    \ElevenLabs\Types\CreateProductQuoteRequestParams $createProductQuoteRequest
  ): self {
    return new self($createProductQuoteRequest, 83);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ReportKnowledgeGapParams
   */
  public static function reportKnowledgeGap(
    \ElevenLabs\Types\ReportKnowledgeGapParams $reportKnowledgeGap
  ): self {
    return new self($reportKnowledgeGap, 84);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\OptInSmsReminderParams
   */
  public static function optInSmsReminder(
    \ElevenLabs\Types\OptInSmsReminderParams $optInSmsReminder
  ): self {
    return new self($optInSmsReminder, 85);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\OptOutSmsReminderParams
   */
  public static function optOutSmsReminder(
    \ElevenLabs\Types\OptOutSmsReminderParams $optOutSmsReminder
  ): self {
    return new self($optOutSmsReminder, 86);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\TriggerUserVerificationParams
   */
  public static function triggerUserVerification(
    \ElevenLabs\Types\TriggerUserVerificationParams $triggerUserVerification
  ): self {
    return new self($triggerUserVerification, 87);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\ValidateUserVerificationCodeParams
   */
  public static function validateUserVerificationCode(
    \ElevenLabs\Types\ValidateUserVerificationCodeParams $validateUserVerificationCode
  ): self {
    return new self($validateUserVerificationCode, 88);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\OwnerListStaffParams
   */
  public static function ownerListStaff(
    \ElevenLabs\Types\OwnerListStaffParams $ownerListStaff
  ): self {
    return new self($ownerListStaff, 89);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\OwnerListAssetsParams
   */
  public static function ownerListAssets(
    \ElevenLabs\Types\OwnerListAssetsParams $ownerListAssets
  ): self {
    return new self($ownerListAssets, 90);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\OwnerListLocationsParams
   */
  public static function ownerListLocations(
    \ElevenLabs\Types\OwnerListLocationsParams $ownerListLocations
  ): self {
    return new self($ownerListLocations, 91);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\OwnerListServicesParams
   */
  public static function ownerListServices(
    \ElevenLabs\Types\OwnerListServicesParams $ownerListServices
  ): self {
    return new self($ownerListServices, 92);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\OwnerListProductsParams
   */
  public static function ownerListProducts(
    \ElevenLabs\Types\OwnerListProductsParams $ownerListProducts
  ): self {
    return new self($ownerListProducts, 93);
  }

  /**
   * Create a SmbToolConfigParams instance containing a \ElevenLabs\Types\OwnerGetClientAppointmentsParams
   */
  public static function ownerGetClientAppointments(
    \ElevenLabs\Types\OwnerGetClientAppointmentsParams $ownerGetClientAppointments
  ): self {
    return new self($ownerGetClientAppointments, 94);
  }

  // Type checking methods
  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\SearchClientsParams
   */
  public function isSearchClients(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\SendCustomEmailParams
   */
  public function isSendCustomEmail(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListClientsParams
   */
  public function isListClients(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\GetClientByPhoneParams
   */
  public function isGetClientByPhone(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateClientParams
   */
  public function isCreateClient(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateClientParams
   */
  public function isUpdateClient(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteClientParams
   */
  public function isDeleteClient(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListStaffParams
   */
  public function isListStaff(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateStaffParams
   */
  public function isCreateStaff(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateStaffParams
   */
  public function isUpdateStaff(): bool
  {
    return $this->typeIndex === 9;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteStaffParams
   */
  public function isDeleteStaff(): bool
  {
    return $this->typeIndex === 10;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListAssetsParams
   */
  public function isListAssets(): bool
  {
    return $this->typeIndex === 11;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateAssetParams
   */
  public function isCreateAsset(): bool
  {
    return $this->typeIndex === 12;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateAssetParams
   */
  public function isUpdateAsset(): bool
  {
    return $this->typeIndex === 13;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteAssetParams
   */
  public function isDeleteAsset(): bool
  {
    return $this->typeIndex === 14;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListServicesParams
   */
  public function isListServices(): bool
  {
    return $this->typeIndex === 15;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateServiceParams
   */
  public function isCreateService(): bool
  {
    return $this->typeIndex === 16;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateServiceParams
   */
  public function isUpdateService(): bool
  {
    return $this->typeIndex === 17;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteServiceParams
   */
  public function isDeleteService(): bool
  {
    return $this->typeIndex === 18;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListProductsParams
   */
  public function isListProducts(): bool
  {
    return $this->typeIndex === 19;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateProductParams
   */
  public function isCreateProduct(): bool
  {
    return $this->typeIndex === 20;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateProductParams
   */
  public function isUpdateProduct(): bool
  {
    return $this->typeIndex === 21;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteProductParams
   */
  public function isDeleteProduct(): bool
  {
    return $this->typeIndex === 22;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CheckServiceAvailabilityParams
   */
  public function isCheckServiceAvailability(): bool
  {
    return $this->typeIndex === 23;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateClientAppointmentParams
   */
  public function isCreateClientAppointment(): bool
  {
    return $this->typeIndex === 24;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\GetClientAppointmentsParams
   */
  public function isGetClientAppointments(): bool
  {
    return $this->typeIndex === 25;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\GetAppointmentByConfirmationNumberParams
   */
  public function isGetAppointmentByConfirmationNumber(): bool
  {
    return $this->typeIndex === 26;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateOrderParams
   */
  public function isCreateOrder(): bool
  {
    return $this->typeIndex === 27;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\GetOrderByConfirmationNumberParams
   */
  public function isGetOrderByConfirmationNumber(): bool
  {
    return $this->typeIndex === 28;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\GetClientOrdersParams
   */
  public function isGetClientOrders(): bool
  {
    return $this->typeIndex === 29;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateOrderParams
   */
  public function isUpdateOrder(): bool
  {
    return $this->typeIndex === 30;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CancelOrderParams
   */
  public function isCancelOrder(): bool
  {
    return $this->typeIndex === 31;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListGroupSessionsParams
   */
  public function isListGroupSessions(): bool
  {
    return $this->typeIndex === 32;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ScheduleGroupSessionParams
   */
  public function isScheduleGroupSession(): bool
  {
    return $this->typeIndex === 33;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\RegisterForGroupSessionParams
   */
  public function isRegisterForGroupSession(): bool
  {
    return $this->typeIndex === 34;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CancelGroupSessionRegistrationParams
   */
  public function isCancelGroupSessionRegistration(): bool
  {
    return $this->typeIndex === 35;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateGroupSessionSeatsParams
   */
  public function isUpdateGroupSessionSeats(): bool
  {
    return $this->typeIndex === 36;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CancelGroupSessionForAllParams
   */
  public function isCancelGroupSessionForAll(): bool
  {
    return $this->typeIndex === 37;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteGroupSessionParams
   */
  public function isDeleteGroupSession(): bool
  {
    return $this->typeIndex === 38;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListCalendarEventsParams
   */
  public function isListCalendarEvents(): bool
  {
    return $this->typeIndex === 39;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateCalendarEventParams
   */
  public function isUpdateCalendarEvent(): bool
  {
    return $this->typeIndex === 40;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CancelCalendarEventParams
   */
  public function isCancelCalendarEvent(): bool
  {
    return $this->typeIndex === 41;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\RestoreCalendarEventParams
   */
  public function isRestoreCalendarEvent(): bool
  {
    return $this->typeIndex === 42;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteCalendarEventParams
   */
  public function isDeleteCalendarEvent(): bool
  {
    return $this->typeIndex === 43;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListCustomerFacingAgentsParams
   */
  public function isListCustomerFacingAgents(): bool
  {
    return $this->typeIndex === 44;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\GetAgentConfigParams
   */
  public function isGetAgentConfig(): bool
  {
    return $this->typeIndex === 45;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListAgentRulesParams
   */
  public function isListAgentRules(): bool
  {
    return $this->typeIndex === 46;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateAgentRuleParams
   */
  public function isCreateAgentRule(): bool
  {
    return $this->typeIndex === 47;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateAgentRuleParams
   */
  public function isUpdateAgentRule(): bool
  {
    return $this->typeIndex === 48;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteAgentRuleParams
   */
  public function isDeleteAgentRule(): bool
  {
    return $this->typeIndex === 49;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListTransferRulesParams
   */
  public function isListTransferRules(): bool
  {
    return $this->typeIndex === 50;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateTransferRuleParams
   */
  public function isCreateTransferRule(): bool
  {
    return $this->typeIndex === 51;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateTransferRuleParams
   */
  public function isUpdateTransferRule(): bool
  {
    return $this->typeIndex === 52;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteTransferRuleParams
   */
  public function isDeleteTransferRule(): bool
  {
    return $this->typeIndex === 53;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListAgentProceduresParams
   */
  public function isListAgentProcedures(): bool
  {
    return $this->typeIndex === 54;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListAgentReferencesParams
   */
  public function isListAgentReferences(): bool
  {
    return $this->typeIndex === 55;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateAgentProcedureParams
   */
  public function isCreateAgentProcedure(): bool
  {
    return $this->typeIndex === 56;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateAgentProcedureParams
   */
  public function isUpdateAgentProcedure(): bool
  {
    return $this->typeIndex === 57;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteAgentProcedureParams
   */
  public function isDeleteAgentProcedure(): bool
  {
    return $this->typeIndex === 58;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListHolidaysParams
   */
  public function isListHolidays(): bool
  {
    return $this->typeIndex === 59;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateHolidayParams
   */
  public function isCreateHoliday(): bool
  {
    return $this->typeIndex === 60;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateHolidayParams
   */
  public function isUpdateHoliday(): bool
  {
    return $this->typeIndex === 61;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteHolidayParams
   */
  public function isDeleteHoliday(): bool
  {
    return $this->typeIndex === 62;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\GetScheduleParams
   */
  public function isGetSchedule(): bool
  {
    return $this->typeIndex === 63;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\SubmitBusinessInfoParams
   */
  public function isSubmitBusinessInfo(): bool
  {
    return $this->typeIndex === 64;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateBusinessInfoParams
   */
  public function isUpdateBusinessInfo(): bool
  {
    return $this->typeIndex === 65;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateAgentConfigParams
   */
  public function isUpdateAgentConfig(): bool
  {
    return $this->typeIndex === 66;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\GetAnalyticsSummaryParams
   */
  public function isGetAnalyticsSummary(): bool
  {
    return $this->typeIndex === 67;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\GetWorkspacePlanParams
   */
  public function isGetWorkspacePlan(): bool
  {
    return $this->typeIndex === 68;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\GetBookingPageSettingsParams
   */
  public function isGetBookingPageSettings(): bool
  {
    return $this->typeIndex === 69;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateBookingPageSettingsParams
   */
  public function isUpdateBookingPageSettings(): bool
  {
    return $this->typeIndex === 70;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateBookingPageAppearanceParams
   */
  public function isUpdateBookingPageAppearance(): bool
  {
    return $this->typeIndex === 71;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\GetBookingSlugStatusParams
   */
  public function isGetBookingSlugStatus(): bool
  {
    return $this->typeIndex === 72;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\SetBookingSlugParams
   */
  public function isSetBookingSlug(): bool
  {
    return $this->typeIndex === 73;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListClientInteractionsParams
   */
  public function isListClientInteractions(): bool
  {
    return $this->typeIndex === 74;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateClientInteractionParams
   */
  public function isCreateClientInteraction(): bool
  {
    return $this->typeIndex === 75;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteClientInteractionParams
   */
  public function isDeleteClientInteraction(): bool
  {
    return $this->typeIndex === 76;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ListLocationsParams
   */
  public function isListLocations(): bool
  {
    return $this->typeIndex === 77;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateLocationParams
   */
  public function isCreateLocation(): bool
  {
    return $this->typeIndex === 78;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateLocationParams
   */
  public function isUpdateLocation(): bool
  {
    return $this->typeIndex === 79;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteLocationParams
   */
  public function isDeleteLocation(): bool
  {
    return $this->typeIndex === 80;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\LeaveMessageParams
   */
  public function isLeaveMessage(): bool
  {
    return $this->typeIndex === 81;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateServiceQuoteRequestParams
   */
  public function isCreateServiceQuoteRequest(): bool
  {
    return $this->typeIndex === 82;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateProductQuoteRequestParams
   */
  public function isCreateProductQuoteRequest(): bool
  {
    return $this->typeIndex === 83;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ReportKnowledgeGapParams
   */
  public function isReportKnowledgeGap(): bool
  {
    return $this->typeIndex === 84;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\OptInSmsReminderParams
   */
  public function isOptInSmsReminder(): bool
  {
    return $this->typeIndex === 85;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\OptOutSmsReminderParams
   */
  public function isOptOutSmsReminder(): bool
  {
    return $this->typeIndex === 86;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\TriggerUserVerificationParams
   */
  public function isTriggerUserVerification(): bool
  {
    return $this->typeIndex === 87;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\ValidateUserVerificationCodeParams
   */
  public function isValidateUserVerificationCode(): bool
  {
    return $this->typeIndex === 88;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\OwnerListStaffParams
   */
  public function isOwnerListStaff(): bool
  {
    return $this->typeIndex === 89;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\OwnerListAssetsParams
   */
  public function isOwnerListAssets(): bool
  {
    return $this->typeIndex === 90;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\OwnerListLocationsParams
   */
  public function isOwnerListLocations(): bool
  {
    return $this->typeIndex === 91;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\OwnerListServicesParams
   */
  public function isOwnerListServices(): bool
  {
    return $this->typeIndex === 92;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\OwnerListProductsParams
   */
  public function isOwnerListProducts(): bool
  {
    return $this->typeIndex === 93;
  }

  /**
   * Check if this SmbToolConfigParams contains a \ElevenLabs\Types\OwnerGetClientAppointmentsParams
   */
  public function isOwnerGetClientAppointments(): bool
  {
    return $this->typeIndex === 94;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\SearchClientsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\SearchClientsParams
   */
  public function asSearchClients(): \ElevenLabs\Types\SearchClientsParams
  {
    if (!$this->isSearchClients()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\SearchClientsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SendCustomEmailParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\SendCustomEmailParams
   */
  public function asSendCustomEmail(): \ElevenLabs\Types\SendCustomEmailParams
  {
    if (!$this->isSendCustomEmail()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\SendCustomEmailParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListClientsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListClientsParams
   */
  public function asListClients(): \ElevenLabs\Types\ListClientsParams
  {
    if (!$this->isListClients()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListClientsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetClientByPhoneParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\GetClientByPhoneParams
   */
  public function asGetClientByPhone(): \ElevenLabs\Types\GetClientByPhoneParams
  {
    if (!$this->isGetClientByPhone()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\GetClientByPhoneParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateClientParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateClientParams
   */
  public function asCreateClient(): \ElevenLabs\Types\CreateClientParams
  {
    if (!$this->isCreateClient()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateClientParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateClientParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateClientParams
   */
  public function asUpdateClient(): \ElevenLabs\Types\UpdateClientParams
  {
    if (!$this->isUpdateClient()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateClientParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DeleteClientParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\DeleteClientParams
   */
  public function asDeleteClient(): \ElevenLabs\Types\DeleteClientParams
  {
    if (!$this->isDeleteClient()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\DeleteClientParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListStaffParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListStaffParams
   */
  public function asListStaff(): \ElevenLabs\Types\ListStaffParams
  {
    if (!$this->isListStaff()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListStaffParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateStaffParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateStaffParams
   */
  public function asCreateStaff(): \ElevenLabs\Types\CreateStaffParams
  {
    if (!$this->isCreateStaff()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateStaffParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateStaffParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateStaffParams
   */
  public function asUpdateStaff(): \ElevenLabs\Types\UpdateStaffParams
  {
    if (!$this->isUpdateStaff()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateStaffParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DeleteStaffParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\DeleteStaffParams
   */
  public function asDeleteStaff(): \ElevenLabs\Types\DeleteStaffParams
  {
    if (!$this->isDeleteStaff()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\DeleteStaffParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListAssetsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListAssetsParams
   */
  public function asListAssets(): \ElevenLabs\Types\ListAssetsParams
  {
    if (!$this->isListAssets()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListAssetsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateAssetParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateAssetParams
   */
  public function asCreateAsset(): \ElevenLabs\Types\CreateAssetParams
  {
    if (!$this->isCreateAsset()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateAssetParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateAssetParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateAssetParams
   */
  public function asUpdateAsset(): \ElevenLabs\Types\UpdateAssetParams
  {
    if (!$this->isUpdateAsset()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateAssetParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DeleteAssetParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\DeleteAssetParams
   */
  public function asDeleteAsset(): \ElevenLabs\Types\DeleteAssetParams
  {
    if (!$this->isDeleteAsset()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\DeleteAssetParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListServicesParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListServicesParams
   */
  public function asListServices(): \ElevenLabs\Types\ListServicesParams
  {
    if (!$this->isListServices()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListServicesParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateServiceParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateServiceParams
   */
  public function asCreateService(): \ElevenLabs\Types\CreateServiceParams
  {
    if (!$this->isCreateService()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateServiceParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateServiceParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateServiceParams
   */
  public function asUpdateService(): \ElevenLabs\Types\UpdateServiceParams
  {
    if (!$this->isUpdateService()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateServiceParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DeleteServiceParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\DeleteServiceParams
   */
  public function asDeleteService(): \ElevenLabs\Types\DeleteServiceParams
  {
    if (!$this->isDeleteService()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\DeleteServiceParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListProductsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListProductsParams
   */
  public function asListProducts(): \ElevenLabs\Types\ListProductsParams
  {
    if (!$this->isListProducts()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListProductsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateProductParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateProductParams
   */
  public function asCreateProduct(): \ElevenLabs\Types\CreateProductParams
  {
    if (!$this->isCreateProduct()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateProductParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateProductParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateProductParams
   */
  public function asUpdateProduct(): \ElevenLabs\Types\UpdateProductParams
  {
    if (!$this->isUpdateProduct()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateProductParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DeleteProductParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\DeleteProductParams
   */
  public function asDeleteProduct(): \ElevenLabs\Types\DeleteProductParams
  {
    if (!$this->isDeleteProduct()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\DeleteProductParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CheckServiceAvailabilityParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CheckServiceAvailabilityParams
   */
  public function asCheckServiceAvailability(): \ElevenLabs\Types\CheckServiceAvailabilityParams
  {
    if (!$this->isCheckServiceAvailability()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CheckServiceAvailabilityParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateClientAppointmentParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateClientAppointmentParams
   */
  public function asCreateClientAppointment(): \ElevenLabs\Types\CreateClientAppointmentParams
  {
    if (!$this->isCreateClientAppointment()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateClientAppointmentParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetClientAppointmentsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\GetClientAppointmentsParams
   */
  public function asGetClientAppointments(): \ElevenLabs\Types\GetClientAppointmentsParams
  {
    if (!$this->isGetClientAppointments()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\GetClientAppointmentsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetAppointmentByConfirmationNumberParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\GetAppointmentByConfirmationNumberParams
   */
  public function asGetAppointmentByConfirmationNumber(): \ElevenLabs\Types\GetAppointmentByConfirmationNumberParams
  {
    if (!$this->isGetAppointmentByConfirmationNumber()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\GetAppointmentByConfirmationNumberParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateOrderParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateOrderParams
   */
  public function asCreateOrder(): \ElevenLabs\Types\CreateOrderParams
  {
    if (!$this->isCreateOrder()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateOrderParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetOrderByConfirmationNumberParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\GetOrderByConfirmationNumberParams
   */
  public function asGetOrderByConfirmationNumber(): \ElevenLabs\Types\GetOrderByConfirmationNumberParams
  {
    if (!$this->isGetOrderByConfirmationNumber()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\GetOrderByConfirmationNumberParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetClientOrdersParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\GetClientOrdersParams
   */
  public function asGetClientOrders(): \ElevenLabs\Types\GetClientOrdersParams
  {
    if (!$this->isGetClientOrders()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\GetClientOrdersParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateOrderParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateOrderParams
   */
  public function asUpdateOrder(): \ElevenLabs\Types\UpdateOrderParams
  {
    if (!$this->isUpdateOrder()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateOrderParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CancelOrderParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CancelOrderParams
   */
  public function asCancelOrder(): \ElevenLabs\Types\CancelOrderParams
  {
    if (!$this->isCancelOrder()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CancelOrderParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListGroupSessionsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListGroupSessionsParams
   */
  public function asListGroupSessions(): \ElevenLabs\Types\ListGroupSessionsParams
  {
    if (!$this->isListGroupSessions()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListGroupSessionsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScheduleGroupSessionParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ScheduleGroupSessionParams
   */
  public function asScheduleGroupSession(): \ElevenLabs\Types\ScheduleGroupSessionParams
  {
    if (!$this->isScheduleGroupSession()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ScheduleGroupSessionParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\RegisterForGroupSessionParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\RegisterForGroupSessionParams
   */
  public function asRegisterForGroupSession(): \ElevenLabs\Types\RegisterForGroupSessionParams
  {
    if (!$this->isRegisterForGroupSession()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\RegisterForGroupSessionParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CancelGroupSessionRegistrationParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CancelGroupSessionRegistrationParams
   */
  public function asCancelGroupSessionRegistration(): \ElevenLabs\Types\CancelGroupSessionRegistrationParams
  {
    if (!$this->isCancelGroupSessionRegistration()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CancelGroupSessionRegistrationParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateGroupSessionSeatsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateGroupSessionSeatsParams
   */
  public function asUpdateGroupSessionSeats(): \ElevenLabs\Types\UpdateGroupSessionSeatsParams
  {
    if (!$this->isUpdateGroupSessionSeats()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateGroupSessionSeatsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CancelGroupSessionForAllParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CancelGroupSessionForAllParams
   */
  public function asCancelGroupSessionForAll(): \ElevenLabs\Types\CancelGroupSessionForAllParams
  {
    if (!$this->isCancelGroupSessionForAll()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CancelGroupSessionForAllParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DeleteGroupSessionParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\DeleteGroupSessionParams
   */
  public function asDeleteGroupSession(): \ElevenLabs\Types\DeleteGroupSessionParams
  {
    if (!$this->isDeleteGroupSession()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\DeleteGroupSessionParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListCalendarEventsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListCalendarEventsParams
   */
  public function asListCalendarEvents(): \ElevenLabs\Types\ListCalendarEventsParams
  {
    if (!$this->isListCalendarEvents()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListCalendarEventsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateCalendarEventParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateCalendarEventParams
   */
  public function asUpdateCalendarEvent(): \ElevenLabs\Types\UpdateCalendarEventParams
  {
    if (!$this->isUpdateCalendarEvent()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateCalendarEventParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CancelCalendarEventParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CancelCalendarEventParams
   */
  public function asCancelCalendarEvent(): \ElevenLabs\Types\CancelCalendarEventParams
  {
    if (!$this->isCancelCalendarEvent()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CancelCalendarEventParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\RestoreCalendarEventParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\RestoreCalendarEventParams
   */
  public function asRestoreCalendarEvent(): \ElevenLabs\Types\RestoreCalendarEventParams
  {
    if (!$this->isRestoreCalendarEvent()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\RestoreCalendarEventParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DeleteCalendarEventParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\DeleteCalendarEventParams
   */
  public function asDeleteCalendarEvent(): \ElevenLabs\Types\DeleteCalendarEventParams
  {
    if (!$this->isDeleteCalendarEvent()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\DeleteCalendarEventParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListCustomerFacingAgentsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListCustomerFacingAgentsParams
   */
  public function asListCustomerFacingAgents(): \ElevenLabs\Types\ListCustomerFacingAgentsParams
  {
    if (!$this->isListCustomerFacingAgents()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListCustomerFacingAgentsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetAgentConfigParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\GetAgentConfigParams
   */
  public function asGetAgentConfig(): \ElevenLabs\Types\GetAgentConfigParams
  {
    if (!$this->isGetAgentConfig()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\GetAgentConfigParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListAgentRulesParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListAgentRulesParams
   */
  public function asListAgentRules(): \ElevenLabs\Types\ListAgentRulesParams
  {
    if (!$this->isListAgentRules()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListAgentRulesParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateAgentRuleParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateAgentRuleParams
   */
  public function asCreateAgentRule(): \ElevenLabs\Types\CreateAgentRuleParams
  {
    if (!$this->isCreateAgentRule()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateAgentRuleParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateAgentRuleParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateAgentRuleParams
   */
  public function asUpdateAgentRule(): \ElevenLabs\Types\UpdateAgentRuleParams
  {
    if (!$this->isUpdateAgentRule()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateAgentRuleParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DeleteAgentRuleParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\DeleteAgentRuleParams
   */
  public function asDeleteAgentRule(): \ElevenLabs\Types\DeleteAgentRuleParams
  {
    if (!$this->isDeleteAgentRule()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\DeleteAgentRuleParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListTransferRulesParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListTransferRulesParams
   */
  public function asListTransferRules(): \ElevenLabs\Types\ListTransferRulesParams
  {
    if (!$this->isListTransferRules()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListTransferRulesParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateTransferRuleParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateTransferRuleParams
   */
  public function asCreateTransferRule(): \ElevenLabs\Types\CreateTransferRuleParams
  {
    if (!$this->isCreateTransferRule()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateTransferRuleParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateTransferRuleParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateTransferRuleParams
   */
  public function asUpdateTransferRule(): \ElevenLabs\Types\UpdateTransferRuleParams
  {
    if (!$this->isUpdateTransferRule()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateTransferRuleParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DeleteTransferRuleParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\DeleteTransferRuleParams
   */
  public function asDeleteTransferRule(): \ElevenLabs\Types\DeleteTransferRuleParams
  {
    if (!$this->isDeleteTransferRule()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\DeleteTransferRuleParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListAgentProceduresParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListAgentProceduresParams
   */
  public function asListAgentProcedures(): \ElevenLabs\Types\ListAgentProceduresParams
  {
    if (!$this->isListAgentProcedures()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListAgentProceduresParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListAgentReferencesParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListAgentReferencesParams
   */
  public function asListAgentReferences(): \ElevenLabs\Types\ListAgentReferencesParams
  {
    if (!$this->isListAgentReferences()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListAgentReferencesParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateAgentProcedureParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateAgentProcedureParams
   */
  public function asCreateAgentProcedure(): \ElevenLabs\Types\CreateAgentProcedureParams
  {
    if (!$this->isCreateAgentProcedure()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateAgentProcedureParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateAgentProcedureParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateAgentProcedureParams
   */
  public function asUpdateAgentProcedure(): \ElevenLabs\Types\UpdateAgentProcedureParams
  {
    if (!$this->isUpdateAgentProcedure()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateAgentProcedureParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DeleteAgentProcedureParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\DeleteAgentProcedureParams
   */
  public function asDeleteAgentProcedure(): \ElevenLabs\Types\DeleteAgentProcedureParams
  {
    if (!$this->isDeleteAgentProcedure()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\DeleteAgentProcedureParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListHolidaysParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListHolidaysParams
   */
  public function asListHolidays(): \ElevenLabs\Types\ListHolidaysParams
  {
    if (!$this->isListHolidays()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListHolidaysParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateHolidayParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateHolidayParams
   */
  public function asCreateHoliday(): \ElevenLabs\Types\CreateHolidayParams
  {
    if (!$this->isCreateHoliday()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateHolidayParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateHolidayParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateHolidayParams
   */
  public function asUpdateHoliday(): \ElevenLabs\Types\UpdateHolidayParams
  {
    if (!$this->isUpdateHoliday()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateHolidayParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DeleteHolidayParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\DeleteHolidayParams
   */
  public function asDeleteHoliday(): \ElevenLabs\Types\DeleteHolidayParams
  {
    if (!$this->isDeleteHoliday()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\DeleteHolidayParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetScheduleParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\GetScheduleParams
   */
  public function asGetSchedule(): \ElevenLabs\Types\GetScheduleParams
  {
    if (!$this->isGetSchedule()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\GetScheduleParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubmitBusinessInfoParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\SubmitBusinessInfoParams
   */
  public function asSubmitBusinessInfo(): \ElevenLabs\Types\SubmitBusinessInfoParams
  {
    if (!$this->isSubmitBusinessInfo()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\SubmitBusinessInfoParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateBusinessInfoParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateBusinessInfoParams
   */
  public function asUpdateBusinessInfo(): \ElevenLabs\Types\UpdateBusinessInfoParams
  {
    if (!$this->isUpdateBusinessInfo()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateBusinessInfoParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateAgentConfigParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateAgentConfigParams
   */
  public function asUpdateAgentConfig(): \ElevenLabs\Types\UpdateAgentConfigParams
  {
    if (!$this->isUpdateAgentConfig()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateAgentConfigParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetAnalyticsSummaryParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\GetAnalyticsSummaryParams
   */
  public function asGetAnalyticsSummary(): \ElevenLabs\Types\GetAnalyticsSummaryParams
  {
    if (!$this->isGetAnalyticsSummary()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\GetAnalyticsSummaryParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetWorkspacePlanParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\GetWorkspacePlanParams
   */
  public function asGetWorkspacePlan(): \ElevenLabs\Types\GetWorkspacePlanParams
  {
    if (!$this->isGetWorkspacePlan()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\GetWorkspacePlanParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetBookingPageSettingsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\GetBookingPageSettingsParams
   */
  public function asGetBookingPageSettings(): \ElevenLabs\Types\GetBookingPageSettingsParams
  {
    if (!$this->isGetBookingPageSettings()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\GetBookingPageSettingsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateBookingPageSettingsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateBookingPageSettingsParams
   */
  public function asUpdateBookingPageSettings(): \ElevenLabs\Types\UpdateBookingPageSettingsParams
  {
    if (!$this->isUpdateBookingPageSettings()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateBookingPageSettingsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateBookingPageAppearanceParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateBookingPageAppearanceParams
   */
  public function asUpdateBookingPageAppearance(): \ElevenLabs\Types\UpdateBookingPageAppearanceParams
  {
    if (!$this->isUpdateBookingPageAppearance()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateBookingPageAppearanceParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetBookingSlugStatusParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\GetBookingSlugStatusParams
   */
  public function asGetBookingSlugStatus(): \ElevenLabs\Types\GetBookingSlugStatusParams
  {
    if (!$this->isGetBookingSlugStatus()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\GetBookingSlugStatusParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SetBookingSlugParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\SetBookingSlugParams
   */
  public function asSetBookingSlug(): \ElevenLabs\Types\SetBookingSlugParams
  {
    if (!$this->isSetBookingSlug()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\SetBookingSlugParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListClientInteractionsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListClientInteractionsParams
   */
  public function asListClientInteractions(): \ElevenLabs\Types\ListClientInteractionsParams
  {
    if (!$this->isListClientInteractions()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListClientInteractionsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateClientInteractionParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateClientInteractionParams
   */
  public function asCreateClientInteraction(): \ElevenLabs\Types\CreateClientInteractionParams
  {
    if (!$this->isCreateClientInteraction()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateClientInteractionParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DeleteClientInteractionParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\DeleteClientInteractionParams
   */
  public function asDeleteClientInteraction(): \ElevenLabs\Types\DeleteClientInteractionParams
  {
    if (!$this->isDeleteClientInteraction()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\DeleteClientInteractionParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ListLocationsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ListLocationsParams
   */
  public function asListLocations(): \ElevenLabs\Types\ListLocationsParams
  {
    if (!$this->isListLocations()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ListLocationsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateLocationParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateLocationParams
   */
  public function asCreateLocation(): \ElevenLabs\Types\CreateLocationParams
  {
    if (!$this->isCreateLocation()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateLocationParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateLocationParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\UpdateLocationParams
   */
  public function asUpdateLocation(): \ElevenLabs\Types\UpdateLocationParams
  {
    if (!$this->isUpdateLocation()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\UpdateLocationParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DeleteLocationParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\DeleteLocationParams
   */
  public function asDeleteLocation(): \ElevenLabs\Types\DeleteLocationParams
  {
    if (!$this->isDeleteLocation()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\DeleteLocationParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\LeaveMessageParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\LeaveMessageParams
   */
  public function asLeaveMessage(): \ElevenLabs\Types\LeaveMessageParams
  {
    if (!$this->isLeaveMessage()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\LeaveMessageParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateServiceQuoteRequestParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateServiceQuoteRequestParams
   */
  public function asCreateServiceQuoteRequest(): \ElevenLabs\Types\CreateServiceQuoteRequestParams
  {
    if (!$this->isCreateServiceQuoteRequest()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateServiceQuoteRequestParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateProductQuoteRequestParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\CreateProductQuoteRequestParams
   */
  public function asCreateProductQuoteRequest(): \ElevenLabs\Types\CreateProductQuoteRequestParams
  {
    if (!$this->isCreateProductQuoteRequest()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\CreateProductQuoteRequestParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ReportKnowledgeGapParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ReportKnowledgeGapParams
   */
  public function asReportKnowledgeGap(): \ElevenLabs\Types\ReportKnowledgeGapParams
  {
    if (!$this->isReportKnowledgeGap()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ReportKnowledgeGapParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\OptInSmsReminderParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\OptInSmsReminderParams
   */
  public function asOptInSmsReminder(): \ElevenLabs\Types\OptInSmsReminderParams
  {
    if (!$this->isOptInSmsReminder()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\OptInSmsReminderParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\OptOutSmsReminderParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\OptOutSmsReminderParams
   */
  public function asOptOutSmsReminder(): \ElevenLabs\Types\OptOutSmsReminderParams
  {
    if (!$this->isOptOutSmsReminder()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\OptOutSmsReminderParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TriggerUserVerificationParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\TriggerUserVerificationParams
   */
  public function asTriggerUserVerification(): \ElevenLabs\Types\TriggerUserVerificationParams
  {
    if (!$this->isTriggerUserVerification()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\TriggerUserVerificationParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ValidateUserVerificationCodeParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\ValidateUserVerificationCodeParams
   */
  public function asValidateUserVerificationCode(): \ElevenLabs\Types\ValidateUserVerificationCodeParams
  {
    if (!$this->isValidateUserVerificationCode()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\ValidateUserVerificationCodeParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\OwnerListStaffParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\OwnerListStaffParams
   */
  public function asOwnerListStaff(): \ElevenLabs\Types\OwnerListStaffParams
  {
    if (!$this->isOwnerListStaff()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\OwnerListStaffParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\OwnerListAssetsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\OwnerListAssetsParams
   */
  public function asOwnerListAssets(): \ElevenLabs\Types\OwnerListAssetsParams
  {
    if (!$this->isOwnerListAssets()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\OwnerListAssetsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\OwnerListLocationsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\OwnerListLocationsParams
   */
  public function asOwnerListLocations(): \ElevenLabs\Types\OwnerListLocationsParams
  {
    if (!$this->isOwnerListLocations()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\OwnerListLocationsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\OwnerListServicesParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\OwnerListServicesParams
   */
  public function asOwnerListServices(): \ElevenLabs\Types\OwnerListServicesParams
  {
    if (!$this->isOwnerListServices()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\OwnerListServicesParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\OwnerListProductsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\OwnerListProductsParams
   */
  public function asOwnerListProducts(): \ElevenLabs\Types\OwnerListProductsParams
  {
    if (!$this->isOwnerListProducts()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\OwnerListProductsParams'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\OwnerGetClientAppointmentsParams value
   * @throws \RuntimeException if this SmbToolConfigParams does not contain a \ElevenLabs\Types\OwnerGetClientAppointmentsParams
   */
  public function asOwnerGetClientAppointments(): \ElevenLabs\Types\OwnerGetClientAppointmentsParams
  {
    if (!$this->isOwnerGetClientAppointments()) {
      throw new \RuntimeException(
        'SmbToolConfigParams does not contain \ElevenLabs\Types\OwnerGetClientAppointmentsParams'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\SearchClientsParams value
   * @return \ElevenLabs\Types\SearchClientsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\SearchClientsParams, null otherwise
   */
  public function tryAsSearchClients(): ?\ElevenLabs\Types\SearchClientsParams
  {
    return $this->isSearchClients() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SendCustomEmailParams value
   * @return \ElevenLabs\Types\SendCustomEmailParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\SendCustomEmailParams, null otherwise
   */
  public function tryAsSendCustomEmail(): ?\ElevenLabs\Types\SendCustomEmailParams
  {
    return $this->isSendCustomEmail() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListClientsParams value
   * @return \ElevenLabs\Types\ListClientsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListClientsParams, null otherwise
   */
  public function tryAsListClients(): ?\ElevenLabs\Types\ListClientsParams
  {
    return $this->isListClients() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetClientByPhoneParams value
   * @return \ElevenLabs\Types\GetClientByPhoneParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\GetClientByPhoneParams, null otherwise
   */
  public function tryAsGetClientByPhone(): ?\ElevenLabs\Types\GetClientByPhoneParams
  {
    return $this->isGetClientByPhone() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateClientParams value
   * @return \ElevenLabs\Types\CreateClientParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateClientParams, null otherwise
   */
  public function tryAsCreateClient(): ?\ElevenLabs\Types\CreateClientParams
  {
    return $this->isCreateClient() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateClientParams value
   * @return \ElevenLabs\Types\UpdateClientParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateClientParams, null otherwise
   */
  public function tryAsUpdateClient(): ?\ElevenLabs\Types\UpdateClientParams
  {
    return $this->isUpdateClient() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DeleteClientParams value
   * @return \ElevenLabs\Types\DeleteClientParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteClientParams, null otherwise
   */
  public function tryAsDeleteClient(): ?\ElevenLabs\Types\DeleteClientParams
  {
    return $this->isDeleteClient() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListStaffParams value
   * @return \ElevenLabs\Types\ListStaffParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListStaffParams, null otherwise
   */
  public function tryAsListStaff(): ?\ElevenLabs\Types\ListStaffParams
  {
    return $this->isListStaff() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateStaffParams value
   * @return \ElevenLabs\Types\CreateStaffParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateStaffParams, null otherwise
   */
  public function tryAsCreateStaff(): ?\ElevenLabs\Types\CreateStaffParams
  {
    return $this->isCreateStaff() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateStaffParams value
   * @return \ElevenLabs\Types\UpdateStaffParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateStaffParams, null otherwise
   */
  public function tryAsUpdateStaff(): ?\ElevenLabs\Types\UpdateStaffParams
  {
    return $this->isUpdateStaff() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DeleteStaffParams value
   * @return \ElevenLabs\Types\DeleteStaffParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteStaffParams, null otherwise
   */
  public function tryAsDeleteStaff(): ?\ElevenLabs\Types\DeleteStaffParams
  {
    return $this->isDeleteStaff() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListAssetsParams value
   * @return \ElevenLabs\Types\ListAssetsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListAssetsParams, null otherwise
   */
  public function tryAsListAssets(): ?\ElevenLabs\Types\ListAssetsParams
  {
    return $this->isListAssets() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateAssetParams value
   * @return \ElevenLabs\Types\CreateAssetParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateAssetParams, null otherwise
   */
  public function tryAsCreateAsset(): ?\ElevenLabs\Types\CreateAssetParams
  {
    return $this->isCreateAsset() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateAssetParams value
   * @return \ElevenLabs\Types\UpdateAssetParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateAssetParams, null otherwise
   */
  public function tryAsUpdateAsset(): ?\ElevenLabs\Types\UpdateAssetParams
  {
    return $this->isUpdateAsset() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DeleteAssetParams value
   * @return \ElevenLabs\Types\DeleteAssetParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteAssetParams, null otherwise
   */
  public function tryAsDeleteAsset(): ?\ElevenLabs\Types\DeleteAssetParams
  {
    return $this->isDeleteAsset() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListServicesParams value
   * @return \ElevenLabs\Types\ListServicesParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListServicesParams, null otherwise
   */
  public function tryAsListServices(): ?\ElevenLabs\Types\ListServicesParams
  {
    return $this->isListServices() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateServiceParams value
   * @return \ElevenLabs\Types\CreateServiceParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateServiceParams, null otherwise
   */
  public function tryAsCreateService(): ?\ElevenLabs\Types\CreateServiceParams
  {
    return $this->isCreateService() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateServiceParams value
   * @return \ElevenLabs\Types\UpdateServiceParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateServiceParams, null otherwise
   */
  public function tryAsUpdateService(): ?\ElevenLabs\Types\UpdateServiceParams
  {
    return $this->isUpdateService() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DeleteServiceParams value
   * @return \ElevenLabs\Types\DeleteServiceParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteServiceParams, null otherwise
   */
  public function tryAsDeleteService(): ?\ElevenLabs\Types\DeleteServiceParams
  {
    return $this->isDeleteService() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListProductsParams value
   * @return \ElevenLabs\Types\ListProductsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListProductsParams, null otherwise
   */
  public function tryAsListProducts(): ?\ElevenLabs\Types\ListProductsParams
  {
    return $this->isListProducts() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateProductParams value
   * @return \ElevenLabs\Types\CreateProductParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateProductParams, null otherwise
   */
  public function tryAsCreateProduct(): ?\ElevenLabs\Types\CreateProductParams
  {
    return $this->isCreateProduct() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateProductParams value
   * @return \ElevenLabs\Types\UpdateProductParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateProductParams, null otherwise
   */
  public function tryAsUpdateProduct(): ?\ElevenLabs\Types\UpdateProductParams
  {
    return $this->isUpdateProduct() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DeleteProductParams value
   * @return \ElevenLabs\Types\DeleteProductParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteProductParams, null otherwise
   */
  public function tryAsDeleteProduct(): ?\ElevenLabs\Types\DeleteProductParams
  {
    return $this->isDeleteProduct() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CheckServiceAvailabilityParams value
   * @return \ElevenLabs\Types\CheckServiceAvailabilityParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CheckServiceAvailabilityParams, null otherwise
   */
  public function tryAsCheckServiceAvailability(): ?\ElevenLabs\Types\CheckServiceAvailabilityParams
  {
    return $this->isCheckServiceAvailability() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateClientAppointmentParams value
   * @return \ElevenLabs\Types\CreateClientAppointmentParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateClientAppointmentParams, null otherwise
   */
  public function tryAsCreateClientAppointment(): ?\ElevenLabs\Types\CreateClientAppointmentParams
  {
    return $this->isCreateClientAppointment() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetClientAppointmentsParams value
   * @return \ElevenLabs\Types\GetClientAppointmentsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\GetClientAppointmentsParams, null otherwise
   */
  public function tryAsGetClientAppointments(): ?\ElevenLabs\Types\GetClientAppointmentsParams
  {
    return $this->isGetClientAppointments() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetAppointmentByConfirmationNumberParams value
   * @return \ElevenLabs\Types\GetAppointmentByConfirmationNumberParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\GetAppointmentByConfirmationNumberParams, null otherwise
   */
  public function tryAsGetAppointmentByConfirmationNumber(): ?\ElevenLabs\Types\GetAppointmentByConfirmationNumberParams
  {
    return $this->isGetAppointmentByConfirmationNumber() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateOrderParams value
   * @return \ElevenLabs\Types\CreateOrderParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateOrderParams, null otherwise
   */
  public function tryAsCreateOrder(): ?\ElevenLabs\Types\CreateOrderParams
  {
    return $this->isCreateOrder() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetOrderByConfirmationNumberParams value
   * @return \ElevenLabs\Types\GetOrderByConfirmationNumberParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\GetOrderByConfirmationNumberParams, null otherwise
   */
  public function tryAsGetOrderByConfirmationNumber(): ?\ElevenLabs\Types\GetOrderByConfirmationNumberParams
  {
    return $this->isGetOrderByConfirmationNumber() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetClientOrdersParams value
   * @return \ElevenLabs\Types\GetClientOrdersParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\GetClientOrdersParams, null otherwise
   */
  public function tryAsGetClientOrders(): ?\ElevenLabs\Types\GetClientOrdersParams
  {
    return $this->isGetClientOrders() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateOrderParams value
   * @return \ElevenLabs\Types\UpdateOrderParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateOrderParams, null otherwise
   */
  public function tryAsUpdateOrder(): ?\ElevenLabs\Types\UpdateOrderParams
  {
    return $this->isUpdateOrder() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CancelOrderParams value
   * @return \ElevenLabs\Types\CancelOrderParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CancelOrderParams, null otherwise
   */
  public function tryAsCancelOrder(): ?\ElevenLabs\Types\CancelOrderParams
  {
    return $this->isCancelOrder() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListGroupSessionsParams value
   * @return \ElevenLabs\Types\ListGroupSessionsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListGroupSessionsParams, null otherwise
   */
  public function tryAsListGroupSessions(): ?\ElevenLabs\Types\ListGroupSessionsParams
  {
    return $this->isListGroupSessions() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScheduleGroupSessionParams value
   * @return \ElevenLabs\Types\ScheduleGroupSessionParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ScheduleGroupSessionParams, null otherwise
   */
  public function tryAsScheduleGroupSession(): ?\ElevenLabs\Types\ScheduleGroupSessionParams
  {
    return $this->isScheduleGroupSession() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\RegisterForGroupSessionParams value
   * @return \ElevenLabs\Types\RegisterForGroupSessionParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\RegisterForGroupSessionParams, null otherwise
   */
  public function tryAsRegisterForGroupSession(): ?\ElevenLabs\Types\RegisterForGroupSessionParams
  {
    return $this->isRegisterForGroupSession() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CancelGroupSessionRegistrationParams value
   * @return \ElevenLabs\Types\CancelGroupSessionRegistrationParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CancelGroupSessionRegistrationParams, null otherwise
   */
  public function tryAsCancelGroupSessionRegistration(): ?\ElevenLabs\Types\CancelGroupSessionRegistrationParams
  {
    return $this->isCancelGroupSessionRegistration() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateGroupSessionSeatsParams value
   * @return \ElevenLabs\Types\UpdateGroupSessionSeatsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateGroupSessionSeatsParams, null otherwise
   */
  public function tryAsUpdateGroupSessionSeats(): ?\ElevenLabs\Types\UpdateGroupSessionSeatsParams
  {
    return $this->isUpdateGroupSessionSeats() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CancelGroupSessionForAllParams value
   * @return \ElevenLabs\Types\CancelGroupSessionForAllParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CancelGroupSessionForAllParams, null otherwise
   */
  public function tryAsCancelGroupSessionForAll(): ?\ElevenLabs\Types\CancelGroupSessionForAllParams
  {
    return $this->isCancelGroupSessionForAll() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DeleteGroupSessionParams value
   * @return \ElevenLabs\Types\DeleteGroupSessionParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteGroupSessionParams, null otherwise
   */
  public function tryAsDeleteGroupSession(): ?\ElevenLabs\Types\DeleteGroupSessionParams
  {
    return $this->isDeleteGroupSession() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListCalendarEventsParams value
   * @return \ElevenLabs\Types\ListCalendarEventsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListCalendarEventsParams, null otherwise
   */
  public function tryAsListCalendarEvents(): ?\ElevenLabs\Types\ListCalendarEventsParams
  {
    return $this->isListCalendarEvents() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateCalendarEventParams value
   * @return \ElevenLabs\Types\UpdateCalendarEventParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateCalendarEventParams, null otherwise
   */
  public function tryAsUpdateCalendarEvent(): ?\ElevenLabs\Types\UpdateCalendarEventParams
  {
    return $this->isUpdateCalendarEvent() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CancelCalendarEventParams value
   * @return \ElevenLabs\Types\CancelCalendarEventParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CancelCalendarEventParams, null otherwise
   */
  public function tryAsCancelCalendarEvent(): ?\ElevenLabs\Types\CancelCalendarEventParams
  {
    return $this->isCancelCalendarEvent() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\RestoreCalendarEventParams value
   * @return \ElevenLabs\Types\RestoreCalendarEventParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\RestoreCalendarEventParams, null otherwise
   */
  public function tryAsRestoreCalendarEvent(): ?\ElevenLabs\Types\RestoreCalendarEventParams
  {
    return $this->isRestoreCalendarEvent() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DeleteCalendarEventParams value
   * @return \ElevenLabs\Types\DeleteCalendarEventParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteCalendarEventParams, null otherwise
   */
  public function tryAsDeleteCalendarEvent(): ?\ElevenLabs\Types\DeleteCalendarEventParams
  {
    return $this->isDeleteCalendarEvent() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListCustomerFacingAgentsParams value
   * @return \ElevenLabs\Types\ListCustomerFacingAgentsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListCustomerFacingAgentsParams, null otherwise
   */
  public function tryAsListCustomerFacingAgents(): ?\ElevenLabs\Types\ListCustomerFacingAgentsParams
  {
    return $this->isListCustomerFacingAgents() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetAgentConfigParams value
   * @return \ElevenLabs\Types\GetAgentConfigParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\GetAgentConfigParams, null otherwise
   */
  public function tryAsGetAgentConfig(): ?\ElevenLabs\Types\GetAgentConfigParams
  {
    return $this->isGetAgentConfig() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListAgentRulesParams value
   * @return \ElevenLabs\Types\ListAgentRulesParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListAgentRulesParams, null otherwise
   */
  public function tryAsListAgentRules(): ?\ElevenLabs\Types\ListAgentRulesParams
  {
    return $this->isListAgentRules() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateAgentRuleParams value
   * @return \ElevenLabs\Types\CreateAgentRuleParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateAgentRuleParams, null otherwise
   */
  public function tryAsCreateAgentRule(): ?\ElevenLabs\Types\CreateAgentRuleParams
  {
    return $this->isCreateAgentRule() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateAgentRuleParams value
   * @return \ElevenLabs\Types\UpdateAgentRuleParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateAgentRuleParams, null otherwise
   */
  public function tryAsUpdateAgentRule(): ?\ElevenLabs\Types\UpdateAgentRuleParams
  {
    return $this->isUpdateAgentRule() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DeleteAgentRuleParams value
   * @return \ElevenLabs\Types\DeleteAgentRuleParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteAgentRuleParams, null otherwise
   */
  public function tryAsDeleteAgentRule(): ?\ElevenLabs\Types\DeleteAgentRuleParams
  {
    return $this->isDeleteAgentRule() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListTransferRulesParams value
   * @return \ElevenLabs\Types\ListTransferRulesParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListTransferRulesParams, null otherwise
   */
  public function tryAsListTransferRules(): ?\ElevenLabs\Types\ListTransferRulesParams
  {
    return $this->isListTransferRules() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateTransferRuleParams value
   * @return \ElevenLabs\Types\CreateTransferRuleParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateTransferRuleParams, null otherwise
   */
  public function tryAsCreateTransferRule(): ?\ElevenLabs\Types\CreateTransferRuleParams
  {
    return $this->isCreateTransferRule() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateTransferRuleParams value
   * @return \ElevenLabs\Types\UpdateTransferRuleParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateTransferRuleParams, null otherwise
   */
  public function tryAsUpdateTransferRule(): ?\ElevenLabs\Types\UpdateTransferRuleParams
  {
    return $this->isUpdateTransferRule() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DeleteTransferRuleParams value
   * @return \ElevenLabs\Types\DeleteTransferRuleParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteTransferRuleParams, null otherwise
   */
  public function tryAsDeleteTransferRule(): ?\ElevenLabs\Types\DeleteTransferRuleParams
  {
    return $this->isDeleteTransferRule() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListAgentProceduresParams value
   * @return \ElevenLabs\Types\ListAgentProceduresParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListAgentProceduresParams, null otherwise
   */
  public function tryAsListAgentProcedures(): ?\ElevenLabs\Types\ListAgentProceduresParams
  {
    return $this->isListAgentProcedures() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListAgentReferencesParams value
   * @return \ElevenLabs\Types\ListAgentReferencesParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListAgentReferencesParams, null otherwise
   */
  public function tryAsListAgentReferences(): ?\ElevenLabs\Types\ListAgentReferencesParams
  {
    return $this->isListAgentReferences() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateAgentProcedureParams value
   * @return \ElevenLabs\Types\CreateAgentProcedureParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateAgentProcedureParams, null otherwise
   */
  public function tryAsCreateAgentProcedure(): ?\ElevenLabs\Types\CreateAgentProcedureParams
  {
    return $this->isCreateAgentProcedure() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateAgentProcedureParams value
   * @return \ElevenLabs\Types\UpdateAgentProcedureParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateAgentProcedureParams, null otherwise
   */
  public function tryAsUpdateAgentProcedure(): ?\ElevenLabs\Types\UpdateAgentProcedureParams
  {
    return $this->isUpdateAgentProcedure() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DeleteAgentProcedureParams value
   * @return \ElevenLabs\Types\DeleteAgentProcedureParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteAgentProcedureParams, null otherwise
   */
  public function tryAsDeleteAgentProcedure(): ?\ElevenLabs\Types\DeleteAgentProcedureParams
  {
    return $this->isDeleteAgentProcedure() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListHolidaysParams value
   * @return \ElevenLabs\Types\ListHolidaysParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListHolidaysParams, null otherwise
   */
  public function tryAsListHolidays(): ?\ElevenLabs\Types\ListHolidaysParams
  {
    return $this->isListHolidays() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateHolidayParams value
   * @return \ElevenLabs\Types\CreateHolidayParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateHolidayParams, null otherwise
   */
  public function tryAsCreateHoliday(): ?\ElevenLabs\Types\CreateHolidayParams
  {
    return $this->isCreateHoliday() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateHolidayParams value
   * @return \ElevenLabs\Types\UpdateHolidayParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateHolidayParams, null otherwise
   */
  public function tryAsUpdateHoliday(): ?\ElevenLabs\Types\UpdateHolidayParams
  {
    return $this->isUpdateHoliday() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DeleteHolidayParams value
   * @return \ElevenLabs\Types\DeleteHolidayParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteHolidayParams, null otherwise
   */
  public function tryAsDeleteHoliday(): ?\ElevenLabs\Types\DeleteHolidayParams
  {
    return $this->isDeleteHoliday() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetScheduleParams value
   * @return \ElevenLabs\Types\GetScheduleParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\GetScheduleParams, null otherwise
   */
  public function tryAsGetSchedule(): ?\ElevenLabs\Types\GetScheduleParams
  {
    return $this->isGetSchedule() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubmitBusinessInfoParams value
   * @return \ElevenLabs\Types\SubmitBusinessInfoParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\SubmitBusinessInfoParams, null otherwise
   */
  public function tryAsSubmitBusinessInfo(): ?\ElevenLabs\Types\SubmitBusinessInfoParams
  {
    return $this->isSubmitBusinessInfo() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateBusinessInfoParams value
   * @return \ElevenLabs\Types\UpdateBusinessInfoParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateBusinessInfoParams, null otherwise
   */
  public function tryAsUpdateBusinessInfo(): ?\ElevenLabs\Types\UpdateBusinessInfoParams
  {
    return $this->isUpdateBusinessInfo() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateAgentConfigParams value
   * @return \ElevenLabs\Types\UpdateAgentConfigParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateAgentConfigParams, null otherwise
   */
  public function tryAsUpdateAgentConfig(): ?\ElevenLabs\Types\UpdateAgentConfigParams
  {
    return $this->isUpdateAgentConfig() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetAnalyticsSummaryParams value
   * @return \ElevenLabs\Types\GetAnalyticsSummaryParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\GetAnalyticsSummaryParams, null otherwise
   */
  public function tryAsGetAnalyticsSummary(): ?\ElevenLabs\Types\GetAnalyticsSummaryParams
  {
    return $this->isGetAnalyticsSummary() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetWorkspacePlanParams value
   * @return \ElevenLabs\Types\GetWorkspacePlanParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\GetWorkspacePlanParams, null otherwise
   */
  public function tryAsGetWorkspacePlan(): ?\ElevenLabs\Types\GetWorkspacePlanParams
  {
    return $this->isGetWorkspacePlan() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetBookingPageSettingsParams value
   * @return \ElevenLabs\Types\GetBookingPageSettingsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\GetBookingPageSettingsParams, null otherwise
   */
  public function tryAsGetBookingPageSettings(): ?\ElevenLabs\Types\GetBookingPageSettingsParams
  {
    return $this->isGetBookingPageSettings() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateBookingPageSettingsParams value
   * @return \ElevenLabs\Types\UpdateBookingPageSettingsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateBookingPageSettingsParams, null otherwise
   */
  public function tryAsUpdateBookingPageSettings(): ?\ElevenLabs\Types\UpdateBookingPageSettingsParams
  {
    return $this->isUpdateBookingPageSettings() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateBookingPageAppearanceParams value
   * @return \ElevenLabs\Types\UpdateBookingPageAppearanceParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateBookingPageAppearanceParams, null otherwise
   */
  public function tryAsUpdateBookingPageAppearance(): ?\ElevenLabs\Types\UpdateBookingPageAppearanceParams
  {
    return $this->isUpdateBookingPageAppearance() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetBookingSlugStatusParams value
   * @return \ElevenLabs\Types\GetBookingSlugStatusParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\GetBookingSlugStatusParams, null otherwise
   */
  public function tryAsGetBookingSlugStatus(): ?\ElevenLabs\Types\GetBookingSlugStatusParams
  {
    return $this->isGetBookingSlugStatus() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SetBookingSlugParams value
   * @return \ElevenLabs\Types\SetBookingSlugParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\SetBookingSlugParams, null otherwise
   */
  public function tryAsSetBookingSlug(): ?\ElevenLabs\Types\SetBookingSlugParams
  {
    return $this->isSetBookingSlug() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListClientInteractionsParams value
   * @return \ElevenLabs\Types\ListClientInteractionsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListClientInteractionsParams, null otherwise
   */
  public function tryAsListClientInteractions(): ?\ElevenLabs\Types\ListClientInteractionsParams
  {
    return $this->isListClientInteractions() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateClientInteractionParams value
   * @return \ElevenLabs\Types\CreateClientInteractionParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateClientInteractionParams, null otherwise
   */
  public function tryAsCreateClientInteraction(): ?\ElevenLabs\Types\CreateClientInteractionParams
  {
    return $this->isCreateClientInteraction() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DeleteClientInteractionParams value
   * @return \ElevenLabs\Types\DeleteClientInteractionParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteClientInteractionParams, null otherwise
   */
  public function tryAsDeleteClientInteraction(): ?\ElevenLabs\Types\DeleteClientInteractionParams
  {
    return $this->isDeleteClientInteraction() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ListLocationsParams value
   * @return \ElevenLabs\Types\ListLocationsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ListLocationsParams, null otherwise
   */
  public function tryAsListLocations(): ?\ElevenLabs\Types\ListLocationsParams
  {
    return $this->isListLocations() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateLocationParams value
   * @return \ElevenLabs\Types\CreateLocationParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateLocationParams, null otherwise
   */
  public function tryAsCreateLocation(): ?\ElevenLabs\Types\CreateLocationParams
  {
    return $this->isCreateLocation() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateLocationParams value
   * @return \ElevenLabs\Types\UpdateLocationParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\UpdateLocationParams, null otherwise
   */
  public function tryAsUpdateLocation(): ?\ElevenLabs\Types\UpdateLocationParams
  {
    return $this->isUpdateLocation() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DeleteLocationParams value
   * @return \ElevenLabs\Types\DeleteLocationParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\DeleteLocationParams, null otherwise
   */
  public function tryAsDeleteLocation(): ?\ElevenLabs\Types\DeleteLocationParams
  {
    return $this->isDeleteLocation() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\LeaveMessageParams value
   * @return \ElevenLabs\Types\LeaveMessageParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\LeaveMessageParams, null otherwise
   */
  public function tryAsLeaveMessage(): ?\ElevenLabs\Types\LeaveMessageParams
  {
    return $this->isLeaveMessage() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateServiceQuoteRequestParams value
   * @return \ElevenLabs\Types\CreateServiceQuoteRequestParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateServiceQuoteRequestParams, null otherwise
   */
  public function tryAsCreateServiceQuoteRequest(): ?\ElevenLabs\Types\CreateServiceQuoteRequestParams
  {
    return $this->isCreateServiceQuoteRequest() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateProductQuoteRequestParams value
   * @return \ElevenLabs\Types\CreateProductQuoteRequestParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\CreateProductQuoteRequestParams, null otherwise
   */
  public function tryAsCreateProductQuoteRequest(): ?\ElevenLabs\Types\CreateProductQuoteRequestParams
  {
    return $this->isCreateProductQuoteRequest() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ReportKnowledgeGapParams value
   * @return \ElevenLabs\Types\ReportKnowledgeGapParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ReportKnowledgeGapParams, null otherwise
   */
  public function tryAsReportKnowledgeGap(): ?\ElevenLabs\Types\ReportKnowledgeGapParams
  {
    return $this->isReportKnowledgeGap() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\OptInSmsReminderParams value
   * @return \ElevenLabs\Types\OptInSmsReminderParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\OptInSmsReminderParams, null otherwise
   */
  public function tryAsOptInSmsReminder(): ?\ElevenLabs\Types\OptInSmsReminderParams
  {
    return $this->isOptInSmsReminder() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\OptOutSmsReminderParams value
   * @return \ElevenLabs\Types\OptOutSmsReminderParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\OptOutSmsReminderParams, null otherwise
   */
  public function tryAsOptOutSmsReminder(): ?\ElevenLabs\Types\OptOutSmsReminderParams
  {
    return $this->isOptOutSmsReminder() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TriggerUserVerificationParams value
   * @return \ElevenLabs\Types\TriggerUserVerificationParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\TriggerUserVerificationParams, null otherwise
   */
  public function tryAsTriggerUserVerification(): ?\ElevenLabs\Types\TriggerUserVerificationParams
  {
    return $this->isTriggerUserVerification() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ValidateUserVerificationCodeParams value
   * @return \ElevenLabs\Types\ValidateUserVerificationCodeParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\ValidateUserVerificationCodeParams, null otherwise
   */
  public function tryAsValidateUserVerificationCode(): ?\ElevenLabs\Types\ValidateUserVerificationCodeParams
  {
    return $this->isValidateUserVerificationCode() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\OwnerListStaffParams value
   * @return \ElevenLabs\Types\OwnerListStaffParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\OwnerListStaffParams, null otherwise
   */
  public function tryAsOwnerListStaff(): ?\ElevenLabs\Types\OwnerListStaffParams
  {
    return $this->isOwnerListStaff() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\OwnerListAssetsParams value
   * @return \ElevenLabs\Types\OwnerListAssetsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\OwnerListAssetsParams, null otherwise
   */
  public function tryAsOwnerListAssets(): ?\ElevenLabs\Types\OwnerListAssetsParams
  {
    return $this->isOwnerListAssets() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\OwnerListLocationsParams value
   * @return \ElevenLabs\Types\OwnerListLocationsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\OwnerListLocationsParams, null otherwise
   */
  public function tryAsOwnerListLocations(): ?\ElevenLabs\Types\OwnerListLocationsParams
  {
    return $this->isOwnerListLocations() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\OwnerListServicesParams value
   * @return \ElevenLabs\Types\OwnerListServicesParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\OwnerListServicesParams, null otherwise
   */
  public function tryAsOwnerListServices(): ?\ElevenLabs\Types\OwnerListServicesParams
  {
    return $this->isOwnerListServices() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\OwnerListProductsParams value
   * @return \ElevenLabs\Types\OwnerListProductsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\OwnerListProductsParams, null otherwise
   */
  public function tryAsOwnerListProducts(): ?\ElevenLabs\Types\OwnerListProductsParams
  {
    return $this->isOwnerListProducts() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\OwnerGetClientAppointmentsParams value
   * @return \ElevenLabs\Types\OwnerGetClientAppointmentsParams|null Returns the value if this SmbToolConfigParams contains a \ElevenLabs\Types\OwnerGetClientAppointmentsParams, null otherwise
   */
  public function tryAsOwnerGetClientAppointments(): ?\ElevenLabs\Types\OwnerGetClientAppointmentsParams
  {
    return $this->isOwnerGetClientAppointments() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\SearchClientsParams): T $onSearchClients
   * @param callable(\ElevenLabs\Types\SendCustomEmailParams): T $onSendCustomEmail
   * @param callable(\ElevenLabs\Types\ListClientsParams): T $onListClients
   * @param callable(\ElevenLabs\Types\GetClientByPhoneParams): T $onGetClientByPhone
   * @param callable(\ElevenLabs\Types\CreateClientParams): T $onCreateClient
   * @param callable(\ElevenLabs\Types\UpdateClientParams): T $onUpdateClient
   * @param callable(\ElevenLabs\Types\DeleteClientParams): T $onDeleteClient
   * @param callable(\ElevenLabs\Types\ListStaffParams): T $onListStaff
   * @param callable(\ElevenLabs\Types\CreateStaffParams): T $onCreateStaff
   * @param callable(\ElevenLabs\Types\UpdateStaffParams): T $onUpdateStaff
   * @param callable(\ElevenLabs\Types\DeleteStaffParams): T $onDeleteStaff
   * @param callable(\ElevenLabs\Types\ListAssetsParams): T $onListAssets
   * @param callable(\ElevenLabs\Types\CreateAssetParams): T $onCreateAsset
   * @param callable(\ElevenLabs\Types\UpdateAssetParams): T $onUpdateAsset
   * @param callable(\ElevenLabs\Types\DeleteAssetParams): T $onDeleteAsset
   * @param callable(\ElevenLabs\Types\ListServicesParams): T $onListServices
   * @param callable(\ElevenLabs\Types\CreateServiceParams): T $onCreateService
   * @param callable(\ElevenLabs\Types\UpdateServiceParams): T $onUpdateService
   * @param callable(\ElevenLabs\Types\DeleteServiceParams): T $onDeleteService
   * @param callable(\ElevenLabs\Types\ListProductsParams): T $onListProducts
   * @param callable(\ElevenLabs\Types\CreateProductParams): T $onCreateProduct
   * @param callable(\ElevenLabs\Types\UpdateProductParams): T $onUpdateProduct
   * @param callable(\ElevenLabs\Types\DeleteProductParams): T $onDeleteProduct
   * @param callable(\ElevenLabs\Types\CheckServiceAvailabilityParams): T $onCheckServiceAvailability
   * @param callable(\ElevenLabs\Types\CreateClientAppointmentParams): T $onCreateClientAppointment
   * @param callable(\ElevenLabs\Types\GetClientAppointmentsParams): T $onGetClientAppointments
   * @param callable(\ElevenLabs\Types\GetAppointmentByConfirmationNumberParams): T $onGetAppointmentByConfirmationNumber
   * @param callable(\ElevenLabs\Types\CreateOrderParams): T $onCreateOrder
   * @param callable(\ElevenLabs\Types\GetOrderByConfirmationNumberParams): T $onGetOrderByConfirmationNumber
   * @param callable(\ElevenLabs\Types\GetClientOrdersParams): T $onGetClientOrders
   * @param callable(\ElevenLabs\Types\UpdateOrderParams): T $onUpdateOrder
   * @param callable(\ElevenLabs\Types\CancelOrderParams): T $onCancelOrder
   * @param callable(\ElevenLabs\Types\ListGroupSessionsParams): T $onListGroupSessions
   * @param callable(\ElevenLabs\Types\ScheduleGroupSessionParams): T $onScheduleGroupSession
   * @param callable(\ElevenLabs\Types\RegisterForGroupSessionParams): T $onRegisterForGroupSession
   * @param callable(\ElevenLabs\Types\CancelGroupSessionRegistrationParams): T $onCancelGroupSessionRegistration
   * @param callable(\ElevenLabs\Types\UpdateGroupSessionSeatsParams): T $onUpdateGroupSessionSeats
   * @param callable(\ElevenLabs\Types\CancelGroupSessionForAllParams): T $onCancelGroupSessionForAll
   * @param callable(\ElevenLabs\Types\DeleteGroupSessionParams): T $onDeleteGroupSession
   * @param callable(\ElevenLabs\Types\ListCalendarEventsParams): T $onListCalendarEvents
   * @param callable(\ElevenLabs\Types\UpdateCalendarEventParams): T $onUpdateCalendarEvent
   * @param callable(\ElevenLabs\Types\CancelCalendarEventParams): T $onCancelCalendarEvent
   * @param callable(\ElevenLabs\Types\RestoreCalendarEventParams): T $onRestoreCalendarEvent
   * @param callable(\ElevenLabs\Types\DeleteCalendarEventParams): T $onDeleteCalendarEvent
   * @param callable(\ElevenLabs\Types\ListCustomerFacingAgentsParams): T $onListCustomerFacingAgents
   * @param callable(\ElevenLabs\Types\GetAgentConfigParams): T $onGetAgentConfig
   * @param callable(\ElevenLabs\Types\ListAgentRulesParams): T $onListAgentRules
   * @param callable(\ElevenLabs\Types\CreateAgentRuleParams): T $onCreateAgentRule
   * @param callable(\ElevenLabs\Types\UpdateAgentRuleParams): T $onUpdateAgentRule
   * @param callable(\ElevenLabs\Types\DeleteAgentRuleParams): T $onDeleteAgentRule
   * @param callable(\ElevenLabs\Types\ListTransferRulesParams): T $onListTransferRules
   * @param callable(\ElevenLabs\Types\CreateTransferRuleParams): T $onCreateTransferRule
   * @param callable(\ElevenLabs\Types\UpdateTransferRuleParams): T $onUpdateTransferRule
   * @param callable(\ElevenLabs\Types\DeleteTransferRuleParams): T $onDeleteTransferRule
   * @param callable(\ElevenLabs\Types\ListAgentProceduresParams): T $onListAgentProcedures
   * @param callable(\ElevenLabs\Types\ListAgentReferencesParams): T $onListAgentReferences
   * @param callable(\ElevenLabs\Types\CreateAgentProcedureParams): T $onCreateAgentProcedure
   * @param callable(\ElevenLabs\Types\UpdateAgentProcedureParams): T $onUpdateAgentProcedure
   * @param callable(\ElevenLabs\Types\DeleteAgentProcedureParams): T $onDeleteAgentProcedure
   * @param callable(\ElevenLabs\Types\ListHolidaysParams): T $onListHolidays
   * @param callable(\ElevenLabs\Types\CreateHolidayParams): T $onCreateHoliday
   * @param callable(\ElevenLabs\Types\UpdateHolidayParams): T $onUpdateHoliday
   * @param callable(\ElevenLabs\Types\DeleteHolidayParams): T $onDeleteHoliday
   * @param callable(\ElevenLabs\Types\GetScheduleParams): T $onGetSchedule
   * @param callable(\ElevenLabs\Types\SubmitBusinessInfoParams): T $onSubmitBusinessInfo
   * @param callable(\ElevenLabs\Types\UpdateBusinessInfoParams): T $onUpdateBusinessInfo
   * @param callable(\ElevenLabs\Types\UpdateAgentConfigParams): T $onUpdateAgentConfig
   * @param callable(\ElevenLabs\Types\GetAnalyticsSummaryParams): T $onGetAnalyticsSummary
   * @param callable(\ElevenLabs\Types\GetWorkspacePlanParams): T $onGetWorkspacePlan
   * @param callable(\ElevenLabs\Types\GetBookingPageSettingsParams): T $onGetBookingPageSettings
   * @param callable(\ElevenLabs\Types\UpdateBookingPageSettingsParams): T $onUpdateBookingPageSettings
   * @param callable(\ElevenLabs\Types\UpdateBookingPageAppearanceParams): T $onUpdateBookingPageAppearance
   * @param callable(\ElevenLabs\Types\GetBookingSlugStatusParams): T $onGetBookingSlugStatus
   * @param callable(\ElevenLabs\Types\SetBookingSlugParams): T $onSetBookingSlug
   * @param callable(\ElevenLabs\Types\ListClientInteractionsParams): T $onListClientInteractions
   * @param callable(\ElevenLabs\Types\CreateClientInteractionParams): T $onCreateClientInteraction
   * @param callable(\ElevenLabs\Types\DeleteClientInteractionParams): T $onDeleteClientInteraction
   * @param callable(\ElevenLabs\Types\ListLocationsParams): T $onListLocations
   * @param callable(\ElevenLabs\Types\CreateLocationParams): T $onCreateLocation
   * @param callable(\ElevenLabs\Types\UpdateLocationParams): T $onUpdateLocation
   * @param callable(\ElevenLabs\Types\DeleteLocationParams): T $onDeleteLocation
   * @param callable(\ElevenLabs\Types\LeaveMessageParams): T $onLeaveMessage
   * @param callable(\ElevenLabs\Types\CreateServiceQuoteRequestParams): T $onCreateServiceQuoteRequest
   * @param callable(\ElevenLabs\Types\CreateProductQuoteRequestParams): T $onCreateProductQuoteRequest
   * @param callable(\ElevenLabs\Types\ReportKnowledgeGapParams): T $onReportKnowledgeGap
   * @param callable(\ElevenLabs\Types\OptInSmsReminderParams): T $onOptInSmsReminder
   * @param callable(\ElevenLabs\Types\OptOutSmsReminderParams): T $onOptOutSmsReminder
   * @param callable(\ElevenLabs\Types\TriggerUserVerificationParams): T $onTriggerUserVerification
   * @param callable(\ElevenLabs\Types\ValidateUserVerificationCodeParams): T $onValidateUserVerificationCode
   * @param callable(\ElevenLabs\Types\OwnerListStaffParams): T $onOwnerListStaff
   * @param callable(\ElevenLabs\Types\OwnerListAssetsParams): T $onOwnerListAssets
   * @param callable(\ElevenLabs\Types\OwnerListLocationsParams): T $onOwnerListLocations
   * @param callable(\ElevenLabs\Types\OwnerListServicesParams): T $onOwnerListServices
   * @param callable(\ElevenLabs\Types\OwnerListProductsParams): T $onOwnerListProducts
   * @param callable(\ElevenLabs\Types\OwnerGetClientAppointmentsParams): T $onOwnerGetClientAppointments
   * @return T
   */
  public function match(
    callable $onSearchClients,
    callable $onSendCustomEmail,
    callable $onListClients,
    callable $onGetClientByPhone,
    callable $onCreateClient,
    callable $onUpdateClient,
    callable $onDeleteClient,
    callable $onListStaff,
    callable $onCreateStaff,
    callable $onUpdateStaff,
    callable $onDeleteStaff,
    callable $onListAssets,
    callable $onCreateAsset,
    callable $onUpdateAsset,
    callable $onDeleteAsset,
    callable $onListServices,
    callable $onCreateService,
    callable $onUpdateService,
    callable $onDeleteService,
    callable $onListProducts,
    callable $onCreateProduct,
    callable $onUpdateProduct,
    callable $onDeleteProduct,
    callable $onCheckServiceAvailability,
    callable $onCreateClientAppointment,
    callable $onGetClientAppointments,
    callable $onGetAppointmentByConfirmationNumber,
    callable $onCreateOrder,
    callable $onGetOrderByConfirmationNumber,
    callable $onGetClientOrders,
    callable $onUpdateOrder,
    callable $onCancelOrder,
    callable $onListGroupSessions,
    callable $onScheduleGroupSession,
    callable $onRegisterForGroupSession,
    callable $onCancelGroupSessionRegistration,
    callable $onUpdateGroupSessionSeats,
    callable $onCancelGroupSessionForAll,
    callable $onDeleteGroupSession,
    callable $onListCalendarEvents,
    callable $onUpdateCalendarEvent,
    callable $onCancelCalendarEvent,
    callable $onRestoreCalendarEvent,
    callable $onDeleteCalendarEvent,
    callable $onListCustomerFacingAgents,
    callable $onGetAgentConfig,
    callable $onListAgentRules,
    callable $onCreateAgentRule,
    callable $onUpdateAgentRule,
    callable $onDeleteAgentRule,
    callable $onListTransferRules,
    callable $onCreateTransferRule,
    callable $onUpdateTransferRule,
    callable $onDeleteTransferRule,
    callable $onListAgentProcedures,
    callable $onListAgentReferences,
    callable $onCreateAgentProcedure,
    callable $onUpdateAgentProcedure,
    callable $onDeleteAgentProcedure,
    callable $onListHolidays,
    callable $onCreateHoliday,
    callable $onUpdateHoliday,
    callable $onDeleteHoliday,
    callable $onGetSchedule,
    callable $onSubmitBusinessInfo,
    callable $onUpdateBusinessInfo,
    callable $onUpdateAgentConfig,
    callable $onGetAnalyticsSummary,
    callable $onGetWorkspacePlan,
    callable $onGetBookingPageSettings,
    callable $onUpdateBookingPageSettings,
    callable $onUpdateBookingPageAppearance,
    callable $onGetBookingSlugStatus,
    callable $onSetBookingSlug,
    callable $onListClientInteractions,
    callable $onCreateClientInteraction,
    callable $onDeleteClientInteraction,
    callable $onListLocations,
    callable $onCreateLocation,
    callable $onUpdateLocation,
    callable $onDeleteLocation,
    callable $onLeaveMessage,
    callable $onCreateServiceQuoteRequest,
    callable $onCreateProductQuoteRequest,
    callable $onReportKnowledgeGap,
    callable $onOptInSmsReminder,
    callable $onOptOutSmsReminder,
    callable $onTriggerUserVerification,
    callable $onValidateUserVerificationCode,
    callable $onOwnerListStaff,
    callable $onOwnerListAssets,
    callable $onOwnerListLocations,
    callable $onOwnerListServices,
    callable $onOwnerListProducts,
    callable $onOwnerGetClientAppointments
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onSearchClients($this->value),
      1 => $onSendCustomEmail($this->value),
      2 => $onListClients($this->value),
      3 => $onGetClientByPhone($this->value),
      4 => $onCreateClient($this->value),
      5 => $onUpdateClient($this->value),
      6 => $onDeleteClient($this->value),
      7 => $onListStaff($this->value),
      8 => $onCreateStaff($this->value),
      9 => $onUpdateStaff($this->value),
      10 => $onDeleteStaff($this->value),
      11 => $onListAssets($this->value),
      12 => $onCreateAsset($this->value),
      13 => $onUpdateAsset($this->value),
      14 => $onDeleteAsset($this->value),
      15 => $onListServices($this->value),
      16 => $onCreateService($this->value),
      17 => $onUpdateService($this->value),
      18 => $onDeleteService($this->value),
      19 => $onListProducts($this->value),
      20 => $onCreateProduct($this->value),
      21 => $onUpdateProduct($this->value),
      22 => $onDeleteProduct($this->value),
      23 => $onCheckServiceAvailability($this->value),
      24 => $onCreateClientAppointment($this->value),
      25 => $onGetClientAppointments($this->value),
      26 => $onGetAppointmentByConfirmationNumber($this->value),
      27 => $onCreateOrder($this->value),
      28 => $onGetOrderByConfirmationNumber($this->value),
      29 => $onGetClientOrders($this->value),
      30 => $onUpdateOrder($this->value),
      31 => $onCancelOrder($this->value),
      32 => $onListGroupSessions($this->value),
      33 => $onScheduleGroupSession($this->value),
      34 => $onRegisterForGroupSession($this->value),
      35 => $onCancelGroupSessionRegistration($this->value),
      36 => $onUpdateGroupSessionSeats($this->value),
      37 => $onCancelGroupSessionForAll($this->value),
      38 => $onDeleteGroupSession($this->value),
      39 => $onListCalendarEvents($this->value),
      40 => $onUpdateCalendarEvent($this->value),
      41 => $onCancelCalendarEvent($this->value),
      42 => $onRestoreCalendarEvent($this->value),
      43 => $onDeleteCalendarEvent($this->value),
      44 => $onListCustomerFacingAgents($this->value),
      45 => $onGetAgentConfig($this->value),
      46 => $onListAgentRules($this->value),
      47 => $onCreateAgentRule($this->value),
      48 => $onUpdateAgentRule($this->value),
      49 => $onDeleteAgentRule($this->value),
      50 => $onListTransferRules($this->value),
      51 => $onCreateTransferRule($this->value),
      52 => $onUpdateTransferRule($this->value),
      53 => $onDeleteTransferRule($this->value),
      54 => $onListAgentProcedures($this->value),
      55 => $onListAgentReferences($this->value),
      56 => $onCreateAgentProcedure($this->value),
      57 => $onUpdateAgentProcedure($this->value),
      58 => $onDeleteAgentProcedure($this->value),
      59 => $onListHolidays($this->value),
      60 => $onCreateHoliday($this->value),
      61 => $onUpdateHoliday($this->value),
      62 => $onDeleteHoliday($this->value),
      63 => $onGetSchedule($this->value),
      64 => $onSubmitBusinessInfo($this->value),
      65 => $onUpdateBusinessInfo($this->value),
      66 => $onUpdateAgentConfig($this->value),
      67 => $onGetAnalyticsSummary($this->value),
      68 => $onGetWorkspacePlan($this->value),
      69 => $onGetBookingPageSettings($this->value),
      70 => $onUpdateBookingPageSettings($this->value),
      71 => $onUpdateBookingPageAppearance($this->value),
      72 => $onGetBookingSlugStatus($this->value),
      73 => $onSetBookingSlug($this->value),
      74 => $onListClientInteractions($this->value),
      75 => $onCreateClientInteraction($this->value),
      76 => $onDeleteClientInteraction($this->value),
      77 => $onListLocations($this->value),
      78 => $onCreateLocation($this->value),
      79 => $onUpdateLocation($this->value),
      80 => $onDeleteLocation($this->value),
      81 => $onLeaveMessage($this->value),
      82 => $onCreateServiceQuoteRequest($this->value),
      83 => $onCreateProductQuoteRequest($this->value),
      84 => $onReportKnowledgeGap($this->value),
      85 => $onOptInSmsReminder($this->value),
      86 => $onOptOutSmsReminder($this->value),
      87 => $onTriggerUserVerification($this->value),
      88 => $onValidateUserVerificationCode($this->value),
      89 => $onOwnerListStaff($this->value),
      90 => $onOwnerListAssets($this->value),
      91 => $onOwnerListLocations($this->value),
      92 => $onOwnerListServices($this->value),
      93 => $onOwnerListProducts($this->value),
      94 => $onOwnerGetClientAppointments($this->value),
      default => throw new \UnexpectedValueException("Unknown type index: $this->typeIndex")
    };
  }

  /**
   * Deserialize from data - try each type in order
   * @param array<string, mixed> $data
   * @return self
   * @throws \InvalidArgumentException if data doesn't match any type
   */
  public static function fromArray(array $data): self
  {
    // Best-match-wins: collect every variant that fromArray() accepted,
    // score each by how many of the input keys it actually consumed
    // (looked up via the per-instance _dirtyFields populated by the
    // variant's own fromArray), then keep the highest-scoring one. Ties
    // break to the first-declared variant because PHP's usort is stable
    // when compared values are equal and we visit variants in order.
    // This is what makes oneOf with overlapping schemas (e.g. Cat & Dog
    // both have `name`, only Cat has `color`) pick the right variant
    // when discriminating fields are present.
    // The payload's own discriminator value picks the variant. Scoring alone ties whenever two
    // members have the same shape and differ only in that constant, and the first would win.
    if (is_array($data) && isset($data['smb_tool_type']) && is_string($data['smb_tool_type'])) {
      switch ($data['smb_tool_type']) {
        case 'cancel_calendar_event':
          return new self(\ElevenLabs\Types\CancelCalendarEventParams::fromArray($data), 41);
        case 'cancel_group_session_for_all':
          return new self(\ElevenLabs\Types\CancelGroupSessionForAllParams::fromArray($data), 37);
        case 'cancel_group_session_registration':
          return new self(
            \ElevenLabs\Types\CancelGroupSessionRegistrationParams::fromArray($data),
            35
          );
        case 'cancel_order':
          return new self(\ElevenLabs\Types\CancelOrderParams::fromArray($data), 31);
        case 'check_service_availability':
          return new self(\ElevenLabs\Types\CheckServiceAvailabilityParams::fromArray($data), 23);
        case 'create_agent_procedure':
          return new self(\ElevenLabs\Types\CreateAgentProcedureParams::fromArray($data), 56);
        case 'create_agent_rule':
          return new self(\ElevenLabs\Types\CreateAgentRuleParams::fromArray($data), 47);
        case 'create_asset':
          return new self(\ElevenLabs\Types\CreateAssetParams::fromArray($data), 12);
        case 'create_client':
          return new self(\ElevenLabs\Types\CreateClientParams::fromArray($data), 4);
        case 'create_client_appointment':
          return new self(\ElevenLabs\Types\CreateClientAppointmentParams::fromArray($data), 24);
        case 'create_client_interaction':
          return new self(\ElevenLabs\Types\CreateClientInteractionParams::fromArray($data), 75);
        case 'create_holiday':
          return new self(\ElevenLabs\Types\CreateHolidayParams::fromArray($data), 60);
        case 'create_location':
          return new self(\ElevenLabs\Types\CreateLocationParams::fromArray($data), 78);
        case 'create_order':
          return new self(\ElevenLabs\Types\CreateOrderParams::fromArray($data), 27);
        case 'create_product':
          return new self(\ElevenLabs\Types\CreateProductParams::fromArray($data), 20);
        case 'create_product_quote_request':
          return new self(\ElevenLabs\Types\CreateProductQuoteRequestParams::fromArray($data), 83);
        case 'create_service':
          return new self(\ElevenLabs\Types\CreateServiceParams::fromArray($data), 16);
        case 'create_service_quote_request':
          return new self(\ElevenLabs\Types\CreateServiceQuoteRequestParams::fromArray($data), 82);
        case 'create_staff':
          return new self(\ElevenLabs\Types\CreateStaffParams::fromArray($data), 8);
        case 'create_transfer_rule':
          return new self(\ElevenLabs\Types\CreateTransferRuleParams::fromArray($data), 51);
        case 'delete_agent_procedure':
          return new self(\ElevenLabs\Types\DeleteAgentProcedureParams::fromArray($data), 58);
        case 'delete_agent_rule':
          return new self(\ElevenLabs\Types\DeleteAgentRuleParams::fromArray($data), 49);
        case 'delete_asset':
          return new self(\ElevenLabs\Types\DeleteAssetParams::fromArray($data), 14);
        case 'delete_calendar_event':
          return new self(\ElevenLabs\Types\DeleteCalendarEventParams::fromArray($data), 43);
        case 'delete_client':
          return new self(\ElevenLabs\Types\DeleteClientParams::fromArray($data), 6);
        case 'delete_client_interaction':
          return new self(\ElevenLabs\Types\DeleteClientInteractionParams::fromArray($data), 76);
        case 'delete_group_session':
          return new self(\ElevenLabs\Types\DeleteGroupSessionParams::fromArray($data), 38);
        case 'delete_holiday':
          return new self(\ElevenLabs\Types\DeleteHolidayParams::fromArray($data), 62);
        case 'delete_location':
          return new self(\ElevenLabs\Types\DeleteLocationParams::fromArray($data), 80);
        case 'delete_product':
          return new self(\ElevenLabs\Types\DeleteProductParams::fromArray($data), 22);
        case 'delete_service':
          return new self(\ElevenLabs\Types\DeleteServiceParams::fromArray($data), 18);
        case 'delete_staff':
          return new self(\ElevenLabs\Types\DeleteStaffParams::fromArray($data), 10);
        case 'delete_transfer_rule':
          return new self(\ElevenLabs\Types\DeleteTransferRuleParams::fromArray($data), 53);
        case 'get_agent_config':
          return new self(\ElevenLabs\Types\GetAgentConfigParams::fromArray($data), 45);
        case 'get_analytics_summary':
          return new self(\ElevenLabs\Types\GetAnalyticsSummaryParams::fromArray($data), 67);
        case 'get_appointment_by_confirmation_number':
          return new self(
            \ElevenLabs\Types\GetAppointmentByConfirmationNumberParams::fromArray($data),
            26
          );
        case 'get_booking_page_settings':
          return new self(\ElevenLabs\Types\GetBookingPageSettingsParams::fromArray($data), 69);
        case 'get_booking_slug_status':
          return new self(\ElevenLabs\Types\GetBookingSlugStatusParams::fromArray($data), 72);
        case 'get_client_appointments':
          return new self(\ElevenLabs\Types\GetClientAppointmentsParams::fromArray($data), 25);
        case 'get_client_by_phone':
          return new self(\ElevenLabs\Types\GetClientByPhoneParams::fromArray($data), 3);
        case 'get_client_orders':
          return new self(\ElevenLabs\Types\GetClientOrdersParams::fromArray($data), 29);
        case 'get_order_by_confirmation_number':
          return new self(
            \ElevenLabs\Types\GetOrderByConfirmationNumberParams::fromArray($data),
            28
          );
        case 'get_schedule':
          return new self(\ElevenLabs\Types\GetScheduleParams::fromArray($data), 63);
        case 'get_workspace_plan':
          return new self(\ElevenLabs\Types\GetWorkspacePlanParams::fromArray($data), 68);
        case 'leave_message':
          return new self(\ElevenLabs\Types\LeaveMessageParams::fromArray($data), 81);
        case 'list_agent_procedures':
          return new self(\ElevenLabs\Types\ListAgentProceduresParams::fromArray($data), 54);
        case 'list_agent_references':
          return new self(\ElevenLabs\Types\ListAgentReferencesParams::fromArray($data), 55);
        case 'list_agent_rules':
          return new self(\ElevenLabs\Types\ListAgentRulesParams::fromArray($data), 46);
        case 'list_assets':
          return new self(\ElevenLabs\Types\ListAssetsParams::fromArray($data), 11);
        case 'list_calendar_events':
          return new self(\ElevenLabs\Types\ListCalendarEventsParams::fromArray($data), 39);
        case 'list_client_interactions':
          return new self(\ElevenLabs\Types\ListClientInteractionsParams::fromArray($data), 74);
        case 'list_clients':
          return new self(\ElevenLabs\Types\ListClientsParams::fromArray($data), 2);
        case 'list_customer_facing_agents':
          return new self(\ElevenLabs\Types\ListCustomerFacingAgentsParams::fromArray($data), 44);
        case 'list_group_sessions':
          return new self(\ElevenLabs\Types\ListGroupSessionsParams::fromArray($data), 32);
        case 'list_holidays':
          return new self(\ElevenLabs\Types\ListHolidaysParams::fromArray($data), 59);
        case 'list_locations':
          return new self(\ElevenLabs\Types\ListLocationsParams::fromArray($data), 77);
        case 'list_products':
          return new self(\ElevenLabs\Types\ListProductsParams::fromArray($data), 19);
        case 'list_services':
          return new self(\ElevenLabs\Types\ListServicesParams::fromArray($data), 15);
        case 'list_staff':
          return new self(\ElevenLabs\Types\ListStaffParams::fromArray($data), 7);
        case 'list_transfer_rules':
          return new self(\ElevenLabs\Types\ListTransferRulesParams::fromArray($data), 50);
        case 'opt_in_sms_reminder':
          return new self(\ElevenLabs\Types\OptInSmsReminderParams::fromArray($data), 85);
        case 'opt_out_sms_reminder':
          return new self(\ElevenLabs\Types\OptOutSmsReminderParams::fromArray($data), 86);
        case 'owner_get_client_appointments':
          return new self(\ElevenLabs\Types\OwnerGetClientAppointmentsParams::fromArray($data), 94);
        case 'owner_list_assets':
          return new self(\ElevenLabs\Types\OwnerListAssetsParams::fromArray($data), 90);
        case 'owner_list_locations':
          return new self(\ElevenLabs\Types\OwnerListLocationsParams::fromArray($data), 91);
        case 'owner_list_products':
          return new self(\ElevenLabs\Types\OwnerListProductsParams::fromArray($data), 93);
        case 'owner_list_services':
          return new self(\ElevenLabs\Types\OwnerListServicesParams::fromArray($data), 92);
        case 'owner_list_staff':
          return new self(\ElevenLabs\Types\OwnerListStaffParams::fromArray($data), 89);
        case 'register_for_group_session':
          return new self(\ElevenLabs\Types\RegisterForGroupSessionParams::fromArray($data), 34);
        case 'report_knowledge_gap':
          return new self(\ElevenLabs\Types\ReportKnowledgeGapParams::fromArray($data), 84);
        case 'restore_calendar_event':
          return new self(\ElevenLabs\Types\RestoreCalendarEventParams::fromArray($data), 42);
        case 'schedule_group_session':
          return new self(\ElevenLabs\Types\ScheduleGroupSessionParams::fromArray($data), 33);
        case 'search_clients':
          return new self(\ElevenLabs\Types\SearchClientsParams::fromArray($data), 0);
        case 'send_custom_email':
          return new self(\ElevenLabs\Types\SendCustomEmailParams::fromArray($data), 1);
        case 'set_booking_slug':
          return new self(\ElevenLabs\Types\SetBookingSlugParams::fromArray($data), 73);
        case 'submit_business_info':
          return new self(\ElevenLabs\Types\SubmitBusinessInfoParams::fromArray($data), 64);
        case 'trigger_user_verification':
          return new self(\ElevenLabs\Types\TriggerUserVerificationParams::fromArray($data), 87);
        case 'update_agent_config':
          return new self(\ElevenLabs\Types\UpdateAgentConfigParams::fromArray($data), 66);
        case 'update_agent_procedure':
          return new self(\ElevenLabs\Types\UpdateAgentProcedureParams::fromArray($data), 57);
        case 'update_agent_rule':
          return new self(\ElevenLabs\Types\UpdateAgentRuleParams::fromArray($data), 48);
        case 'update_asset':
          return new self(\ElevenLabs\Types\UpdateAssetParams::fromArray($data), 13);
        case 'update_booking_page_appearance':
          return new self(
            \ElevenLabs\Types\UpdateBookingPageAppearanceParams::fromArray($data),
            71
          );
        case 'update_booking_page_settings':
          return new self(\ElevenLabs\Types\UpdateBookingPageSettingsParams::fromArray($data), 70);
        case 'update_business_info':
          return new self(\ElevenLabs\Types\UpdateBusinessInfoParams::fromArray($data), 65);
        case 'update_calendar_event':
          return new self(\ElevenLabs\Types\UpdateCalendarEventParams::fromArray($data), 40);
        case 'update_client':
          return new self(\ElevenLabs\Types\UpdateClientParams::fromArray($data), 5);
        case 'update_group_session_seats':
          return new self(\ElevenLabs\Types\UpdateGroupSessionSeatsParams::fromArray($data), 36);
        case 'update_holiday':
          return new self(\ElevenLabs\Types\UpdateHolidayParams::fromArray($data), 61);
        case 'update_location':
          return new self(\ElevenLabs\Types\UpdateLocationParams::fromArray($data), 79);
        case 'update_order':
          return new self(\ElevenLabs\Types\UpdateOrderParams::fromArray($data), 30);
        case 'update_product':
          return new self(\ElevenLabs\Types\UpdateProductParams::fromArray($data), 21);
        case 'update_service':
          return new self(\ElevenLabs\Types\UpdateServiceParams::fromArray($data), 17);
        case 'update_staff':
          return new self(\ElevenLabs\Types\UpdateStaffParams::fromArray($data), 9);
        case 'update_transfer_rule':
          return new self(\ElevenLabs\Types\UpdateTransferRuleParams::fromArray($data), 52);
        case 'validate_user_verification_code':
          return new self(
            \ElevenLabs\Types\ValidateUserVerificationCodeParams::fromArray($data),
            88
          );
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\SearchClientsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SearchClientsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SendCustomEmailParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SendCustomEmailParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListClientsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListClientsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetClientByPhoneParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetClientByPhoneParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateClientParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateClientParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateClientParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateClientParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DeleteClientParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DeleteClientParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListStaffParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListStaffParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateStaffParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateStaffParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateStaffParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateStaffParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DeleteStaffParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 10, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DeleteStaffParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListAssetsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 11, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListAssetsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateAssetParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 12, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateAssetParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateAssetParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 13, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateAssetParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DeleteAssetParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 14, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DeleteAssetParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListServicesParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 15, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListServicesParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateServiceParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 16, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateServiceParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateServiceParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 17, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateServiceParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DeleteServiceParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 18, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DeleteServiceParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListProductsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 19, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListProductsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateProductParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 20, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateProductParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateProductParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 21, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateProductParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DeleteProductParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 22, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DeleteProductParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CheckServiceAvailabilityParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 23, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CheckServiceAvailabilityParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateClientAppointmentParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 24, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateClientAppointmentParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetClientAppointmentsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 25, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetClientAppointmentsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetAppointmentByConfirmationNumberParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 26, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetAppointmentByConfirmationNumberParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateOrderParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 27, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateOrderParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetOrderByConfirmationNumberParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 28, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetOrderByConfirmationNumberParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetClientOrdersParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 29, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetClientOrdersParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateOrderParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 30, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateOrderParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CancelOrderParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 31, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CancelOrderParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListGroupSessionsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 32, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListGroupSessionsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScheduleGroupSessionParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 33, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScheduleGroupSessionParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\RegisterForGroupSessionParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 34, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\RegisterForGroupSessionParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CancelGroupSessionRegistrationParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 35, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CancelGroupSessionRegistrationParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateGroupSessionSeatsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 36, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateGroupSessionSeatsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CancelGroupSessionForAllParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 37, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CancelGroupSessionForAllParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DeleteGroupSessionParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 38, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DeleteGroupSessionParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListCalendarEventsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 39, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListCalendarEventsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateCalendarEventParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 40, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateCalendarEventParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CancelCalendarEventParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 41, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CancelCalendarEventParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\RestoreCalendarEventParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 42, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\RestoreCalendarEventParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DeleteCalendarEventParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 43, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DeleteCalendarEventParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListCustomerFacingAgentsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 44, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListCustomerFacingAgentsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetAgentConfigParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 45, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetAgentConfigParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListAgentRulesParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 46, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListAgentRulesParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateAgentRuleParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 47, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateAgentRuleParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateAgentRuleParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 48, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateAgentRuleParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DeleteAgentRuleParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 49, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DeleteAgentRuleParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListTransferRulesParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 50, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListTransferRulesParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateTransferRuleParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 51, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateTransferRuleParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateTransferRuleParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 52, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateTransferRuleParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DeleteTransferRuleParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 53, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DeleteTransferRuleParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListAgentProceduresParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 54, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListAgentProceduresParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListAgentReferencesParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 55, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListAgentReferencesParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateAgentProcedureParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 56, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateAgentProcedureParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateAgentProcedureParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 57, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateAgentProcedureParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DeleteAgentProcedureParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 58, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DeleteAgentProcedureParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListHolidaysParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 59, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListHolidaysParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateHolidayParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 60, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateHolidayParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateHolidayParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 61, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateHolidayParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DeleteHolidayParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 62, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DeleteHolidayParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetScheduleParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 63, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetScheduleParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubmitBusinessInfoParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 64, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubmitBusinessInfoParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateBusinessInfoParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 65, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateBusinessInfoParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateAgentConfigParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 66, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateAgentConfigParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetAnalyticsSummaryParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 67, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetAnalyticsSummaryParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetWorkspacePlanParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 68, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetWorkspacePlanParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetBookingPageSettingsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 69, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetBookingPageSettingsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateBookingPageSettingsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 70, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateBookingPageSettingsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateBookingPageAppearanceParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 71, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateBookingPageAppearanceParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetBookingSlugStatusParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 72, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetBookingSlugStatusParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SetBookingSlugParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 73, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SetBookingSlugParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListClientInteractionsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 74, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListClientInteractionsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateClientInteractionParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 75, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateClientInteractionParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DeleteClientInteractionParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 76, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DeleteClientInteractionParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ListLocationsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 77, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ListLocationsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateLocationParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 78, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateLocationParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateLocationParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 79, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateLocationParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DeleteLocationParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 80, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DeleteLocationParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\LeaveMessageParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 81, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\LeaveMessageParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateServiceQuoteRequestParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 82, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateServiceQuoteRequestParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateProductQuoteRequestParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 83, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateProductQuoteRequestParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ReportKnowledgeGapParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 84, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ReportKnowledgeGapParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\OptInSmsReminderParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 85, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OptInSmsReminderParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\OptOutSmsReminderParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 86, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OptOutSmsReminderParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TriggerUserVerificationParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 87, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TriggerUserVerificationParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ValidateUserVerificationCodeParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 88, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ValidateUserVerificationCodeParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\OwnerListStaffParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 89, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OwnerListStaffParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\OwnerListAssetsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 90, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OwnerListAssetsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\OwnerListLocationsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 91, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OwnerListLocationsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\OwnerListServicesParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 92, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OwnerListServicesParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\OwnerListProductsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 93, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OwnerListProductsParams didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\OwnerGetClientAppointmentsParams::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 94, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OwnerGetClientAppointmentsParams didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any SmbToolConfigParams type');
    }
    $best = $candidates[0];
    foreach ($candidates as $candidate) {
      if ($candidate['score'] > $best['score']) {
        $best = $candidate;
      }
    }
    return new self($best['instance'], $best['idx']);
  }

  /**
   * Serialize to JSON - returns the serialized inner value
   *
   * @return array<mixed>
   */
  public function jsonSerialize(): array
  {
    if ($this->_isUnknown()) {
      return $this->_asUnknown();
    }
    return $this->value->jsonSerialize();
  }
}
