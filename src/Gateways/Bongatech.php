<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/14/17
 * Time: 6:04 PM
 */

namespace CraftedSystems\LaravelSMS\Gateways;

use CraftedSystems\Bongatech\BongatechSMS;
use CraftedSystems\LaravelSMS\Contracts\SMSContract;
use Illuminate\Http\Request;

class Bongatech implements SMSContract
{
    /**
     * @var BongatechSMS
     */
    protected $class;


    /**
     * MicroMobile constructor.
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        if (!class_exists('CraftedSystems\Bongatech\BongatechSMS')) {

            throw new \Exception("Class 'CraftedSystems\Bongatech\BongatechSMS' does not exist");
        }

        $this->class = new BongatechSMS($settings);
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
        $response = $this->class->send($recipient, $message, $params = null);

        $data = [
            'is_success' => $response->ResponseCode === '1001',
            'correlator' => $response->Correlator,
            'message_id' => $response->MessageID,
            'cost' => ''
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
            'status' => $response[0]->dlr_report,
            'message_id' => $response[0]->msg_id
        ];

        return (object)$data;
    }
}