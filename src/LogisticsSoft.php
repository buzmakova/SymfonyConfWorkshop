<?php declare(strict_types=1);
/**
 * @author Evgeniya Kungurova <e.a.kungurova@gmail.com>
 * @date 25.10.2018
 */

namespace example;

final class LogisticsSoft
{
    /**
     * @var Port
     */
    private $port;

    /**
     * @var Company[]
     */
    private $companies;

    /**
     * @var Container[]
     */
    private $registeredContainers;

    /**
     * @var ShipContainerLink[]
     */
    private $shipContainerLinks;

    public function __construct(Port $port, array $companies)
    {
        $this->port      = $port;
        $this->companies = $companies;
    }

    /**
     * @return Port
     */
    public function getPort(): Port
    {
        return $this->port;
    }

    public function getCompanies() : array
    {
        return $this->companies;
    }

    public function assignShip(Container $container)
    {
        $ship = $this->findAppropriateShip($container);
        $this->reduceShipCapacity($ship);
        $this->addShipContainerLink($container, $ship);
    }

    private function addShipContainerLink(Container $container, Ship $ship)
    {
        $this->shipContainerLinks[] = new ShipContainerLink($ship, $container);
    }

    private function reduceShipCapacity(Ship $ship)
    {
        // @todo: add weight for container
        $ship->setCapacity($ship->getCapacity() - 1);
    }

    private function findAppropriateShip(Container $container)
    {
        $purposePort = $container->getPurposePort();

        /** @var Company[] $companies */
        $companies = $this->getCompanies();
        foreach ($companies as $company) {
            $purposeShip = $company->getShipByPurposePort($purposePort);
            if (!is_null($purposeShip)) {
                return $purposeShip;
            }
        }

        throw new NoShipWasFoundException('No appropriate ship was found');
    }

    public function registerContainer(Container $container)
    {
        $this->registeredContainers[] = $container;
    }

    /**
     * @return Container[]
     */
    public function getRegisteredContainers(): array
    {
        return $this->registeredContainers;
    }

    /**
     * @return array
     */
    public function getShipContainerLinks(): array
    {
        return $this->shipContainerLinks;
    }
}
