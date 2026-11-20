<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\BusinessProfile\Types;

/**
 * Currency code for all prices (ISO 4217)
 */
enum ReceptionUpdateAgentInfoRequestCurrency: string
{
  case Usd = 'USD';
  case Eur = 'EUR';
  case Gbp = 'GBP';
  case Pln = 'PLN';
  case Cad = 'CAD';
  case Aud = 'AUD';
  case Chf = 'CHF';
  case Sek = 'SEK';
  case Nok = 'NOK';
  case Dkk = 'DKK';
  case Isk = 'ISK';
  case Czk = 'CZK';
  case Huf = 'HUF';
  case Ron = 'RON';
  case Bgn = 'BGN';
  case Jpy = 'JPY';
  case Cny = 'CNY';
  case Twd = 'TWD';
  case Inr = 'INR';
  case Brl = 'BRL';
  case Mxn = 'MXN';
  case Krw = 'KRW';
  case Sgd = 'SGD';
  case Hkd = 'HKD';
  case Nzd = 'NZD';
  case Zar = 'ZAR';
  case Aed = 'AED';
  case Sar = 'SAR';
  case Qar = 'QAR';
  case Kwd = 'KWD';
  case Ils = 'ILS';
  case Try_ = 'TRY';
  case Thb = 'THB';
  case Idr = 'IDR';
  case Myr = 'MYR';
  case Php = 'PHP';
  case Vnd = 'VND';
  case Bdt = 'BDT';
  case Rub = 'RUB';
  case Uah = 'UAH';
  case Clp = 'CLP';
  case Cop = 'COP';
  case Ars = 'ARS';
  case Pen = 'PEN';
  case Egp = 'EGP';
  case Ngn = 'NGN';
  case Kes = 'KES';
  case Pkr = 'PKR';
  case Gel = 'GEL';
}
