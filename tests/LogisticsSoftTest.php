<?php declare(strict_types=1);
/**
 * @author Evgeniya Kungurova <e.a.kungurova@gmail.com>
 * @date 25.10.2018
 */

namespace example;

use PHPUnit\Framework\TestCase;

/**
 * @covers \example\Company
 */
final class LogisticsSoftTest extends TestCase
{
    const CORRECT_PORT_NAME    = 'Westhafen';
    const CORRECT_COMPANY_NAME = 'Vektor';
    const CORRECT_SHIP_NAME    = 'Maria';
    const CORRECT_CONTAINER_ID = 'CSQU3054383';

    /** @var Port */
    private $port;

    /** @var Port */
    private $port2;

    /** @var Company */
    private $company;

    /** @var Ship */
    private $ship;

    /** @var LogisticsSoft */
    private $logisticsSoft;

    protected function setUp()
    {
        parent::setUp();

        $this->port = new Port(self::CORRECT_PORT_NAME);
        $this->port2 = new Port(self::CORRECT_PORT_NAME.'2');

        $this->ship = new Ship(
            self::CORRECT_SHIP_NAME,
            1,
            $this->port
        );

        $this->company = new Company(
            self::CORRECT_COMPANY_NAME,
            $this->ship
        );

        $this->logisticsSoft = new LogisticsSoft(
            $this->port,
            [$this->company]
        );
    }

    public function test_has_a_port()
    {
        $this->assertEquals($this->port, $this->logisticsSoft->getPort());
    }

    public function test_has_companies()
    {
        $this->assertEquals([$this->company], $this->logisticsSoft->getCompanies());
    }

    public function test_container_is_registered_success(): void
    {
        $container = new Container(ContainerId::fromString(self::CORRECT_CONTAINER_ID));
        $this->logisticsSoft->registerContainer($container);

        $this->assertCount(1, $this->logisticsSoft->getRegisteredContainers());
    }

    public function test_container_is_assigned_with_ship_success(): void
    {
        $container = new Container(ContainerId::fromString(self::CORRECT_CONTAINER_ID));
        $container->setPurposePort($this->port);
        $this->logisticsSoft->assignShip($container);

        $this->assertCount(1, $this->logisticsSoft->getShipContainerLinks());
        /** @var ShipContainerLink $shipContainerLink */
        $shipContainerLink = $this->logisticsSoft->getShipContainerLinks()[0];
        $this->assertEquals($container, $shipContainerLink->getContainer());
        $this->assertEquals($this->ship, $shipContainerLink->getShip());

        $this->assertEmpty($this->ship->getCapacity());
    }

    public function test_no_appropriate_ship_was_found(): void
    {
        $this->expectException(NoShipWasFoundException::class);

        $container = new Container(ContainerId::fromString(self::CORRECT_CONTAINER_ID));
        $container->setPurposePort($this->port2);
        $this->logisticsSoft->assignShip($container);
    }
}
