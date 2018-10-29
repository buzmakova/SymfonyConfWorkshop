<?php declare(strict_types=1);
/**
 * @author Evgeniya Kungurova <e.a.kungurova@gmail.com>
 * @date 25.10.2018
 */

namespace example;

use PHPUnit\Framework\TestCase;

/**
 * @covers \example\Container
 */
final class ContainerTest extends TestCase
{
    const CORRECT_CONTAINER_ID = 'CSQU3054383';

    public function test_has_a_id(): void
    {
        $id = ContainerId::fromString(self::CORRECT_CONTAINER_ID);

        $container = new Container($id);

        $this->assertInstanceOf(ContainerId::class, $container->getId());
        $this->assertEquals($id, $container->getId());
    }

    public function test_has_a_purpose_port()
    {
        $port = new Port('Westhafen');

        $id = ContainerId::fromString(self::CORRECT_CONTAINER_ID);
        $container = new Container($id);
        $container->setPurposePort($port);

        $this->assertInstanceOf(Port::class, $container->getPurposePort());
        $this->assertEquals($port, $container->getPurposePort());
    }
}
