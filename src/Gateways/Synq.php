<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/14/17
 * Time: 6:04 PM
 */

namespace CraftedSystems\LaravelSMS\Gateways;


use CraftedSystems\Synq\SynqSMS;
use CraftedSystems\LaravelSMS\Contracts\SMSContract;
use Illuminate\Http\Request;

class Synq implements SMSContract
{
    /**
     * @var SynqSMS
     */
    protected $class;


    /**
     * Synq constructor.
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        if (!class_exists('CraftedSystems\Synq\SynqSMS')) {

            throw new \Exception("Class 'CraftedSystems\Synq\SynqSMS' does not exist");
        }

        $this->class = new SynqSMS($settings);
    }

    /**
     * @param $recipient
     * @param $message
     * @param null $params
     * @return mixed
     * @throws \Exception
     */
    public function send($recipient, $message, $params = null)
    {
        $response = $this->class->send($recipient, $message, $params['message_id']);
        $d = substr($response, 0, 2);

        $data = [
            'is_success' => $d === 'OK'
        ];

        return (object)$data;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->class->getBalance();
    }


    /**
     * @param Request $request
     * @return mixed|object
     */
    public function getDeliveryReports(Request $request)
    {
        $response = $this->class->getDeliveryReports($request);

        $data = [
            'status' => '',
            'message_id' => ''
        ];

        return (object)$data;
    }
}