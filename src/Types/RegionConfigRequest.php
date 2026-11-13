<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class RegionConfigRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\TwilioRegionId>
   * Valid Twilio region IDs.
   */
  #[JsonProperty('region_id', required: true)]
  public string $regionId;

  /**
   * Auth Token for this region
   */
  #[JsonProperty('token', required: true)]
  public string $token;

  /**
   * @var value-of<\ElevenLabs\Types\TwilioEdgeLocation>
   * Valid Twilio edge locations.
   */
  #[JsonProperty('edge_location', required: true)]
  public string $edgeLocation;

  /**
   * @param array{
   *   regionId: value-of<\ElevenLabs\Types\TwilioRegionId>,
   *   token: string,
   *   edgeLocation: value-of<\ElevenLabs\Types\TwilioEdgeLocation>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->regionId = $values['regionId'];
    $this->token = $values['token'];
    $this->edgeLocation = $values['edgeLocation'];

    $this->_dirtyFields = [
      'region_id' => true,
      'token' => true,
      'edge_location' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'region_id',
      'contents' => $this->regionId
    ];

    $parts[] = [
      'name' => 'token',
      'contents' => $this->token
    ];

    $parts[] = [
      'name' => 'edge_location',
      'contents' => $this->edgeLocation
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
