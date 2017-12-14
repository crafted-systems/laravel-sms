<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/14/17
 * Time: 6:04 PM
 */

namespace CraftedSystems\LaravelSMS\Gateways;

use CraftedSystems\MicroMobile\MicroMobileSMS;
use CraftedSystems\LaravelSMS\Contracts\SMSContract;
use Illuminate\Http\Request;

class MicroMobile implements SMSContract
{
    /**
     * @var MicroMobileSMS
     */
    protected $class;


    /**
     * MicroMobile constructor.
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        if (!class_exists('CraftedSystems\MicroMobile\MicroMobileSMS')) {

            throw new \Exception("Class 'CraftedSystems\MicroMobile\MicroMobileSMS' does not exist");
        }

        $this->class = new MicroMobileSMS($settings);
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

        $data = [
            'is_success' => $response->transactionStatus === 'QUEUED',
            'correlator' => '',
            'message_id' => $response->id,
            'cost' => $response->creditUnits
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
    public function getDeliveryReport(Request $request)
    {
        $response = $this->class::getDeliveryReport($request);

        $data = [
            'status' => $response->deliveryStatus,
            'message_id' => $response->correlator,
            'phone_number' => $response->msisdn
        ];

        return (object)$data;
    }
}