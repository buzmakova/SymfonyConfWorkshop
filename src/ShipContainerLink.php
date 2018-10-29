<?php declare(strict_types=1);
/**
 * @author Evgeniya Kungurova <e.a.kungurova@gmail.com>
 * @date 25.10.2018
 */

namespace example;

final class ShipContainerLink
{
    /**
     * @var Ship
     */
    private $ship;

    /**
     * @var Container
     */
    private $container;

    public function __construct(Ship $ship, Container $container)
    {
        $this->ship = $ship;
        $this->container = $container;
    }

    /**
     * @return Ship
     */
    public function getShip(): Ship
    {
        return $this->ship;
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }
}
