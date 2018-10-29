<?php declare(strict_types=1);
/**
 * @author Evgeniya Kungurova <e.a.kungurova@gmail.com>
 * @date 25.10.2018
 */

namespace example;

use PHPUnit\Framework\TestCase;

/**
 * @covers \example\Ship
 */
final class ShipTest extends TestCase
{
    const CORRECT_SHIP_NAME = 'Maria';
    const CORRECT_PORT_NAME = 'Westhafen';

    /** @var Ship */
    private $ship;

    /** @var Port */
    private $port;

    /** @var Port */
    private $port2;

    protected function setUp()
    {
        parent::setUp();

        $this->port = new Port(self::CORRECT_PORT_NAME);
        $this->port2 = new Port(self::CORRECT_PORT_NAME . '2');

        $this->ship = new Ship(
            self::CORRECT_SHIP_NAME,
            1,
            $this->port
        );
    }

    public function test_has_a_name(): void
    {
        $this->assertEquals(self::CORRECT_SHIP_NAME, $this->ship->getName());
    }

    public function test_has_a_capacity(): void
    {
        $this->assertEquals(1, $this->ship->getCapacity());
    }

    public function test_has_at_least_one_purpose_port()
    {
        $this->assertCount(1, $this->ship->getPurposePorts());
    }

    public function test_has_an_actual_position_string(): void
    {
        $position = new Position(15.25, 20.34);
        $this->ship->setActualPosition($position);
        $this->assertEquals('GPS: 15.25°, 20.34°', $this->ship->getActualPositionString());
    }

    /**
     * @param string $name
     * @dataProvider empty_name_provider
     */
    public function test_name_cannot_be_empty(string $name): void
    {
        $this->expectException(InvalidNameException::class);

        new Ship($name, 1, $this->port);
    }

    /**
     * @param int $capacity
     * @dataProvider less_than_0_capacity_provider
     */
    public function test_capacity_cannot_be_less_than_0(int $capacity): void
    {
        $this->expectException(InvalidCapacityException::class);

        new Ship(self::CORRECT_SHIP_NAME, $capacity, $this->port);
    }


    public function test_same_port_add_is_not_allowed(): void
    {
        $this->expectException(DuplicatePurposePortException::class);
        $this->ship->addPurposePort($this->port);
    }

    public function test_port_is_added_success(): void
    {
        $this->ship->addPurposePort($this->port2);
        $this->assertCount(2, $this->ship->getPurposePorts());
    }

    public function test_port_is_removed_success(): void
    {
        $this->assertCount(1, $this->ship->getPurposePorts());
        $this->ship->addPurposePort($this->port2);
        $this->ship->removePurposePort($this->port2);
        $this->assertCount(1, $this->ship->getPurposePorts());
    }

    public function test_last_port_remove_is_not_allowed(): void
    {
        $this->expectException(LastPurposePortRemoveException::class);
        $this->ship->removePurposePort($this->port);
    }

    public function empty_name_provider(): array
    {
        return [
            [''],
            [' ']
        ];
    }

    public function less_than_0_capacity_provider(): array
    {
        return [
            [0],
            [-2]
        ];
    }
}
