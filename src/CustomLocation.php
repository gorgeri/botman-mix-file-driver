<?php

namespace BotMan\BotMan\Messages\Attachments;

class CustomLocation extends Location
{
    protected $location_name;

    /**
     * Message constructor.
     * @param string $latitude
     * @param string $longitude
     * @param $location_name
     * @param mixed $payload
     */
    public function __construct($latitude, $longitude, $location_name = null, $payload = null)
    {
        parent::__construct($latitude, $longitude, $payload);
        $this->location_name = $location_name;
    }

    /**
     * @param string $latitude
     * @param string $longitude
     * @param $location_name
     * @return CustomLocation
     */
    public static function create($latitude, $longitude, $location_name = null)
    {
        return new self($latitude, $longitude, $location_name);
    }

    /**
     * @return string
     */
    public function getLocationName()
    {
        return $this->location_name;
    }

    /**
     * Get the instance as a web accessible array.
     * This will be used within the WebDriver.
     *
     * @return array
     */
    public function toWebDriver()
    {
        return [
            'type' => 'location',
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'location_name' => $this->location_name,
        ];
    }
}