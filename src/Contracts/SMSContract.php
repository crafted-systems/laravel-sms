<?php

namespace CraftedSystems\LaravelSMS\Contracts;

use Illuminate\Http\Request;

Interface SMSContract
{
    /**
     * Construct the class with the relevant settings.
     *
     * SendSmsInterface constructor.
     * @param $settings object
     */
    public function __construct($settings);


    /**
     * @param $recipient
     * @param $message
     * @param null $params
     * @return mixed
     */
    public function send($recipient, $message, $params = null);


    /**
     * @return mixed
     */
    public function getBalance();

    /**
     * @param Request $request
     * @return mixed
     */
    public function getDeliveryReport(Request $request);
}
