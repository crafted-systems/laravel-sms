<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/14/17
 * Time: 6:04 PM
 */

namespace CraftedSystems\LaravelSMS\Gateways;

use CraftedSystems\LaravelSMS\Contracts\SMSContract;
use Illuminate\Http\Request;
use AfricasTalking\AfricasTalkingGateway;

class AfricasTalking implements SMSContract
{
    /**
     * @var AfricasTalkingGateway
     */
    protected $class;


    /**
     * MicroMobile constructor.
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        if (!class_exists('AfricasTalking\AfricasTalkingGateway')) {

            throw new \Exception("Class 'AfricasTalking\AfricasTalkingGateway' does not exist");
        }

        $s = (object)$settings;

        $this->class = new AfricasTalkingGateway($s->username, $s->api_key);
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
        $response = $this->class->sendMessage($recipient, $message, config('sms.gateways.africastalking.from'));

        $data = [
            'is_success' => $response[0]->status === 'Success',
            'correlator' => '',
            'message_id' => $response[0]->messageId,
            'cost' => $response[0]->cost
        ];

        return (object)$data;
    }


    /**
     * @return mixed
     * @throws \AfricasTalking\AfricasTalkingGatewayException
     */
    public function getBalance()
    {
        return trim(str_replace('KES', '', $this->class->getUserData()->balance));
    }


    /**
     * @param Request $request
     * @return mixed|object
     */
    public function getDeliveryReports(Request $request)
    {
        $status = $request->status;

        if ($status == "Failed" || $status == "Rejected") {

            $fs = $request->failureReason;

        } else {

            $fs = $status;
        }


        $data = [
            'status' => $fs,
            'message_id' => $request->id,
            'phone_number' => ''
        ];

        return (object)$data;
    }
}