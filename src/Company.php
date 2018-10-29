<?php declare(strict_types=1);
/**
 * @author evgeniya.kungurova <e.a.kungurova@gmail.com>
 * @date 25.10.2018
 */

namespace example;

final class Company
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Ship[]
     */
    private $ships;

    public function __construct(string $name, Ship $ship)
    {
        $this->ensureNameIsNotEmpty($name);

        $this->name = $name;
        $this->ships[] = $ship;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function ensureNameIsNotEmpty(string $name): void
    {
        if (empty(\trim($name))) {
            throw new InvalidNameException('Name of company must not be empty');
        }
    }

    public function getShipByPurposePort(Port $port): ?Ship
    {
        foreach ($this->ships as $ship) {
            if (in_array($port, $ship->getPurposePorts())) {
                return $ship;
            }
        }

        return null;
    }
}
