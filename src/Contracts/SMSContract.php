<?php

namespace CraftedSystems\LaravelSMS\Contracts;

use Illuminate\Http\Request;

Interface SMSContract
{
    /**
     * Construct the class with the relevant settings.
     *
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
     * @param $payload
     */
    public function sendBatch($payload);


    /**
     * @return mixed
     */
    public function getBalance();


    /**
     * define when the a message is successfully sent
     * @return bool
     */
    public function is_successful();

    /**
     * the message ID as received on the request
     * @return mixed
     */
    public function getMessageID();

    /**
     * @param Request $request
     * @return mixed
     */
    public function getDeliveryReportS(Request $request);
}
