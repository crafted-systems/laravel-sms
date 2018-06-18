<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/14/17
 * Time: 6:04 PM
 */

namespace CraftedSystems\LaravelSMS\Gateways;

use CraftedSystems\Tilil\TililSMS;
use CraftedSystems\LaravelSMS\Contracts\SMSContract;
use Illuminate\Http\Request;

class Tilil implements SMSContract
{
    /**
     * @var TililSMS
     */
    protected $class;


    /**
     * MicroMobile constructor.
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        if (!class_exists('CraftedSystems\Tilil\TililSMS')) {

            throw new \Exception("Class 'CraftedSystems\Tilil\TililSMS' does not exist");
        }

        $this->class = new TililSMS($settings);
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
        $response = $this->class->send($recipient, $message);
        $d = explode(";", $response);

        $data = [
            'is_success' => $d[1] === 'Success',
            'destination' => $d[2],
            'message_id' => $d[0],
            'network_id' => $d[3]
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
            'status' => $response->dlrDesc,
            'message_id' => $response->messageId,
            'network' => $response->network
        ];

        return (object)$data;
    }
}