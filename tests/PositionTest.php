<?php declare(strict_types=1);
/**
 * @author Evgeniya Kungurova <e.a.kungurova@gmail.com>
 * @date 25.10.2018
 */

namespace example;

use PHPUnit\Framework\TestCase;

/**
 * @covers \example\Position
 */
final class PositionTest extends TestCase
{
    const CORRECT_LATITUDE = 10;
    const CORRECT_LONGITUDE = 20;
    /**
     * @var Position
     */
    private $position;

    protected function setUp()
    {
        parent::setUp();

        $this->position = new Position(
            self::CORRECT_LATITUDE,
            self::CORRECT_LONGITUDE
        );
    }

    public function test_has_a_latitude(): void
    {
        $this->assertEquals(self::CORRECT_LATITUDE, $this->position->getLatitude());
    }

    public function test_has_a_longitude(): void
    {
        $this->assertEquals(self::CORRECT_LONGITUDE, $this->position->getLongitude());
    }

    public function test_position_as_string(): void
    {
        $this->assertEquals('GPS: 10°, 20°', 'GPS: '.$this->position);
    }

    /**
     * @param float $latitude
     * @dataProvider wrong_values_provider
     */
    public function test_latitude_cannot_be_per_abs_more_than_180(float $latitude): void
    {
        $this->expectException(InvalidLatitudeException::class);

        new Position($latitude, self::CORRECT_LONGITUDE);
    }

    /**
     * @param float $longitude
     * @dataProvider wrong_values_provider
     */
    public function test_longitude_cannot_be_per_abs_more_than_90(float $longitude): void
    {
        $this->expectException(InvalidLongitudeException::class);

        new Position(self::CORRECT_LATITUDE, $longitude);
    }

    public function wrong_values_provider(): array
    {
        return [
            [-200],
            [250]
        ];
    }
}
