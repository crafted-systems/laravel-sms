<?php

if (!function_exists('sms')) {


    /**
     * @return \CraftedSystems\LaravelSMS\SMS
     */
    function sms()
    {
        return new \CraftedSystems\LaravelSMS\SMS();

    }
}
