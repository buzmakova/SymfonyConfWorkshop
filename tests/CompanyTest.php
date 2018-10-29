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
final class CompanyTest extends TestCase
{
    const CORRECT_SHIP_NAME = 'Maria';
    const CORRECT_PORT_NAME = 'Westhafen';
    const CORRECT_COMPANY_NAME = 'Vektor';

    /** @var Company */
    private $company;

    /** @var Ship */
    private $ship;

    /** @var Port */
    private $port;

    protected function setUp()
    {
        parent::setUp();

        $this->port = new Port(self::CORRECT_PORT_NAME);

        $this->ship = new Ship(
            self::CORRECT_SHIP_NAME,
            1,
            $this->port
        );

        $this->company = new Company(
            self::CORRECT_COMPANY_NAME,
            $this->ship
        );
    }

    public function test_has_a_name(): void
    {
        $this->assertEquals(self::CORRECT_COMPANY_NAME, $this->company->getName());
    }

    /**
     * @param string $name
     * @dataProvider empty_name_provider
     */
    public function test_name_cannot_be_empty(string $name): void
    {
        $this->expectException(InvalidNameException::class);

        new Company($name, $this->ship);
    }

    public function empty_name_provider(): array
    {
        return [
            [''],
            [' ']
        ];
    }

    public function test_has_ship_for_port()
    {
        $ship = $this->company->getShipByPurposePort($this->port);
        $this->assertEquals($ship, $this->ship);
    }
}
