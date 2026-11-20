<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ReceptionVertical: string
{
  case SalonBarbershop = 'salon_barbershop';
  case NailBeauty = 'nail_beauty';
  case Spa = 'spa';
  case Medical = 'medical';
  case Veterinary = 'veterinary';
  case Fitness = 'fitness';
  case HomeServices = 'home_services';
  case Photography = 'photography';
  case Consulting = 'consulting';
  case Restaurant = 'restaurant';
  case Dental = 'dental';
  case AutoService = 'auto_service';
  case Tutoring = 'tutoring';
  case Legal = 'legal';
  case RealEstate = 'real_estate';
  case Other = 'other';
}
