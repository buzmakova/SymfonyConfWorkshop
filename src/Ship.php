<?php declare(strict_types=1);
/**
 * @author Evgeniya Kungurova <e.a.kungurova@gmail.com>
 * @date 25.10.2018
 */

namespace example;

final class Ship
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $capacity;

    /**
     * @var Position
     */
    private $actualPosition;

    /**
     * @var Port[]
     */
    private $purposePorts;

    public function __construct(
        string $name,
        int $capacity,
        $purposePort
    ) {
        $this->ensureNameIsNotEmpty($name);
        $this->ensureCapacityIsGreaterThanNull($capacity);

        $this->name           = $name;
        $this->capacity       = $capacity;
        $this->purposePorts[] = $purposePort;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): Ship
    {
        $this->capacity = $capacity;
        return $this;
    }

    /**
     * @return Position
     */
    public function getActualPosition(): Position
    {
        return $this->actualPosition;
    }

    /**
     * @return string
     */
    public function getActualPositionString(): string
    {
        return 'GPS: '.$this->actualPosition;
    }

    /**
     * @param Position $actualPosition
     * @return Ship
     */
    public function setActualPosition(Position $actualPosition): Ship
    {
        $this->actualPosition = $actualPosition;
        return $this;
    }

    public function addPurposePort(Port $port)
    {
        $this->ensurePurposePortIsNotAddedYet($this->purposePorts, $port);

        $this->purposePorts[] = $port;
    }

    public function removePurposePort(Port $port)
    {
        $this->ensureItIsNotLastPurposePort($this->purposePorts);

        // @todo: check, if port exists not
        $key = array_search($port, $this->purposePorts);
        unset($this->purposePorts[$key]);
    }

    public function getPurposePorts(): array
    {
        return $this->purposePorts;
    }

    private function ensureNameIsNotEmpty(string $name): void
    {
        if (empty(\trim($name))) {
            throw new InvalidNameException('Name of ship must not be empty');
        }
    }

    private function ensureCapacityIsGreaterThanNull(int $capacity): void
    {
        if ($capacity <= 0) {
            throw new InvalidCapacityException('Capacity of ship must be greater than 0');
        }
    }

    private function ensurePurposePortIsNotAddedYet(array $purposePorts, Port $port): void
    {
        if (in_array($port, $purposePorts))
        {
            throw new DuplicatePurposePortException('It is not allowed same purpose port add');
        }
    }

    private function ensureItIsNotLastPurposePort(array $purposePorts)
    {
        if (count($purposePorts) == 1) {
            throw new LastPurposePortRemoveException('It is not allowed remove last purpose port for ship');
        }
    }
}
