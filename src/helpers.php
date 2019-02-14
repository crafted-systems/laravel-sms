<?php

if (!function_exists('sms')) {


    /**
     * @return \CraftedSystems\LaravelSMS\SMS
     * @throws Exception
     */
    function sms()
    {
        return new \CraftedSystems\LaravelSMS\SMS();

    }
}
