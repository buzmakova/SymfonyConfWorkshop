<?php declare(strict_types=1);
/**
 * @author Evgeniya Kungurova <e.a.kungurova@gmail.com>
 * @date 25.10.2018
 */

namespace example;

final class Position
{
    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    public function __construct(float $latitude, float $longitude)
    {
        $this->ensureLatitudeIsCorrect($latitude);
        $this->ensureLongitudeIsCorrect($longitude);

        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     * @return Position
     */
    public function setLatitude(float $latitude): Position
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     * @return Position
     */
    public function setLongitude(float $longitude): Position
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function __toString()
    {
        return $this->latitude .'°'.', '.$this->longitude.'°';
    }

    private function ensureLatitudeIsCorrect(float $latitude): void
    {
        if (180 < abs($latitude)) {
            throw new InvalidLatitudeException('Latitude must be between -180 and 180');
        }
    }

    private function ensureLongitudeIsCorrect(float $longitude): void
    {
        if (90 < abs($longitude)) {
            throw new InvalidLongitudeException('Longitude must be between -90 and 90');
        }
    }
}
