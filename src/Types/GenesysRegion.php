<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum GenesysRegion: string
{
  case UsEast1 = 'us_east_1';
  case EuWest1 = 'eu_west_1';
  case ApSoutheast2 = 'ap_southeast_2';
  case ApNortheast1 = 'ap_northeast_1';
  case EuCentral1 = 'eu_central_1';
  case UsWest2 = 'us_west_2';
  case CaCentral1 = 'ca_central_1';
  case ApNortheast2 = 'ap_northeast_2';
  case EuWest2 = 'eu_west_2';
  case ApSouth1 = 'ap_south_1';
  case UsEast2 = 'us_east_2';
  case SaEast1 = 'sa_east_1';
  case MeCentral1 = 'me_central_1';
  case ApNortheast3 = 'ap_northeast_3';
  case EuCentral2 = 'eu_central_2';
  case MxCentral1 = 'mx_central_1';
  case ApSoutheast1 = 'ap_southeast_1';
}
