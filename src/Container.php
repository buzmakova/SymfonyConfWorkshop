<?php declare(strict_types=1);
/**
 * @author Evgeniya Kungurova <e.a.kungurova@gmail.com>
 * @date 25.10.2018
 */

namespace example;

final class Container
{
    /**
     * @var ContainerId
     */
    private $id;

    /**
     * @var Port
     */
    private $purposePort;

    public function __construct(ContainerId $id)
    {
        $this->id = $id;
    }

    public function getId(): ContainerId
    {
        return $this->id;
    }

    /**
     * @return Port
     */
    public function getPurposePort(): Port
    {
        return $this->purposePort;
    }

    /**
     * @param Port $purposePort
     * @return Container
     */
    public function setPurposePort(Port $purposePort): Container
    {
        $this->purposePort = $purposePort;

        return $this;
    }
}
