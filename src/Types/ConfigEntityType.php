<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Entity types for the API configuration.
 *
 * This enum contains all valid entity type configurations that users can specify:
 * - Parent types (e.g., "name", "financial_id") that expand to all subtypes
 * - Specific subtypes using dot notation (e.g., "name.full_name")
 * - Standalone terminal types (e.g., "email_address")
 *
 * When converted for service use, parent types expand to all their terminal subtypes.
 */
enum ConfigEntityType: string
{
  case Name = 'name';
  case NameNameGiven = 'name.name_given';
  case NameNameFamily = 'name.name_family';
  case NameNameOther = 'name.name_other';
  case EmailAddress = 'email_address';
  case ContactNumber = 'contact_number';
  case Dob = 'dob';
  case Age = 'age';
  case ReligiousBelief = 'religious_belief';
  case PoliticalOpinion = 'political_opinion';
  case SexualOrientation = 'sexual_orientation';
  case EthnicityRace = 'ethnicity_race';
  case MaritalStatus = 'marital_status';
  case Occupation = 'occupation';
  case PhysicalAttribute = 'physical_attribute';
  case Language = 'language';
  case Username = 'username';
  case Password = 'password';
  case Url = 'url';
  case Organization = 'organization';
  case FinancialId = 'financial_id';
  case FinancialIdPaymentCard = 'financial_id.payment_card';
  case FinancialIdPaymentCardPaymentCardNumber = 'financial_id.payment_card.payment_card_number';
  case FinancialIdPaymentCardPaymentCardExpirationDate = 'financial_id.payment_card.payment_card_expiration_date';
  case FinancialIdPaymentCardPaymentCardCvv = 'financial_id.payment_card.payment_card_cvv';
  case FinancialIdBankAccount = 'financial_id.bank_account';
  case FinancialIdBankAccountBankAccountNumber = 'financial_id.bank_account.bank_account_number';
  case FinancialIdBankAccountBankRoutingNumber = 'financial_id.bank_account.bank_routing_number';
  case FinancialIdBankAccountSwiftBicCode = 'financial_id.bank_account.swift_bic_code';
  case FinancialIdFinancialIdOther = 'financial_id.financial_id_other';
  case Location = 'location';
  case LocationLocationAddress = 'location.location_address';
  case LocationLocationCity = 'location.location_city';
  case LocationLocationPostalCode = 'location.location_postal_code';
  case LocationLocationCoordinate = 'location.location_coordinate';
  case LocationLocationState = 'location.location_state';
  case LocationLocationCountry = 'location.location_country';
  case LocationLocationOther = 'location.location_other';
  case Date = 'date';
  case DateInterval = 'date_interval';
  case UniqueId = 'unique_id';
  case UniqueIdGovernmentIssuedId = 'unique_id.government_issued_id';
  case UniqueIdAccountNumber = 'unique_id.account_number';
  case UniqueIdVehicleId = 'unique_id.vehicle_id';
  case UniqueIdHealthcareNumber = 'unique_id.healthcare_number';
  case UniqueIdHealthcareNumberMedicalRecordNumber = 'unique_id.healthcare_number.medical_record_number';
  case UniqueIdHealthcareNumberHealthPlanBeneficiaryNumber = 'unique_id.healthcare_number.health_plan_beneficiary_number';
  case UniqueIdDeviceId = 'unique_id.device_id';
  case UniqueIdUniqueIdOther = 'unique_id.unique_id_other';
  case Medical = 'medical';
  case MedicalMedicalCondition = 'medical.medical_condition';
  case MedicalMedication = 'medical.medication';
  case MedicalMedicalProcedure = 'medical.medical_procedure';
  case MedicalMedicalMeasurement = 'medical.medical_measurement';
  case MedicalMedicalOther = 'medical.medical_other';
}
