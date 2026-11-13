<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum DirectPublishingReadResponseModelGenreItem: string
{
  case Fantasy = 'Fantasy';
  case Romance = 'Romance';
  case ScienceFiction = 'Science Fiction';
  case MysteryAndThriller = 'Mystery and Thriller';
  case ActionAndAdventure = 'Action and Adventure';
  case Dystopia = 'Dystopia';
  case BusinessAndEconomics = 'Business and Economics';
  case Technology = 'Technology';
  case ChristianInspirational = 'Christian & Inspirational';
  case Horror = 'Horror';
  case BiographyAndMemoir = 'Biography and Memoir';
  case EducationAndLearning = 'Education and Learning';
  case History = 'History';
  case ChildrensLiterature = "Children's Literature";
  case YoungAdult = 'Young Adult';
  case FairyTalesAndFolklore = 'Fairy Tales and Folklore';
  case FanFiction = 'Fan Fiction';
  case GeneralFiction = 'General Fiction';
  case HealthAndWellness = 'Health and Wellness';
  case HistoricalFiction = 'Historical Fiction';
  case Humor = 'Humor';
  case LiteraryClassics = 'Literary Classics';
  case Philosophy = 'Philosophy';
  case Poetry = 'Poetry';
  case PoliticsAndGovernment = 'Politics and Government';
  case Psychology = 'Psychology';
  case ScienceAndNature = 'Science and Nature';
  case SelfHelp = 'Self-Help';
  case SpiritualityAndReligion = 'Spirituality and Religion';
  case Travel = 'Travel';
  case TrueCrime = 'True Crime';
  case Other = 'Other';
}
