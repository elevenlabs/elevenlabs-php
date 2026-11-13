<?php

namespace ElevenLabs\Tests\Core\Json;

use JsonSerializable;
use PHPUnit\Framework\TestCase;
use ElevenLabs\Core\Json\JsonEncoder;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Types\ArrayType;

enum Shape: string implements JsonSerializable
{
  case Square = 'SQUARE';
  case Circle = 'CIRCLE';
  case Triangle = 'TRIANGLE';

  /**
   * @return string
   */
  public function jsonSerialize(): string
  {
    return $this->value;
  }
}

class ShapeType extends JsonSerializableType
{
  use \ElevenLabs\Core\Json\ReflectiveSerialization;

  /**
   * @var Shape $shape
   */
  #[JsonProperty('shape')]
  public Shape $shape;

  /**
   * @var Shape[] $shapes
   */
  #[ArrayType([Shape::class])]
  #[JsonProperty('shapes')]
  public array $shapes;

  /**
   * @param Shape $shape
   * @param Shape[] $shapes
   */
  public function __construct(Shape $shape, array $shapes)
  {
    $this->shape = $shape;
    $this->shapes = $shapes;
  }
}

class EnumTest extends TestCase
{
  public function testEnumSerialization(): void
  {
    $object = new ShapeType(Shape::Circle, [Shape::Square, Shape::Circle, Shape::Triangle]);

    $expectedJson = JsonEncoder::encode([
      'shape' => 'CIRCLE',
      'shapes' => ['SQUARE', 'CIRCLE', 'TRIANGLE']
    ]);

    $actualJson = $object->toJson();

    $this->assertJsonStringEqualsJsonString(
      $expectedJson,
      $actualJson,
      'Serialized JSON does not match expected JSON for shape and shapes properties.'
    );
  }
}
