<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/14/17
 * Time: 6:04 PM
 */

namespace CraftedSystems\LaravelSMS\Gateways;


use CraftedSystems\Aptus\AptusSMS;
use CraftedSystems\LaravelSMS\Contracts\SMSContract;
use Illuminate\Http\Request;

class Aptus implements SMSContract
{
    /**
     * @var AptusSMS
     */
    protected $class;


    /**
     * MicroMobile constructor.
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        if (!class_exists('CraftedSystems\Aptus\AptusSMS')) {

            throw new \Exception("Class 'CraftedSystems\Aptus\AptusSMS' does not exist");
        }

        $this->class = new AptusSMS($settings);
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
        $d = explode(",", $response);

        $data = [
            'is_success' => $d[0] === 'OK',
            'queued' => $d[1],
            'message_id' => $d[2]
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