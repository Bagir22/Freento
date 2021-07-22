<?php
    class Team
    {
        function __construct($name, $country = NULL)
        {
            $this->name = $name;
            $this->country = $country;
        }

        function setCountry($country)
        {
            $this->country = $country;
            return $this;
        }
    }